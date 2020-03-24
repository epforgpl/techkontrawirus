<?php

namespace App\Http\Middleware;

use App\Util\Constants;
use App\VotingHistory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SetupVotingHistory
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $ip = $this->getIp();
        $voting_history_id = $request->cookie(Constants::VOTING_COOKIE_NAME);
        $ua = substr($request->server('HTTP_USER_AGENT') ?? '', 0, 100);
        logger("IP: [$ip], cookie id: [$voting_history_id], user agent: [$ua]");

        $voting_history = null;
        $now = new \DateTimeImmutable();

        // Do we have history ID from cookie?
        if ($voting_history_id) {
            // If so, get a corresponding record from DB.
            $voting_history = VotingHistory::find($voting_history_id);

            // If last seen on different IP or over 15 minutes ago, update the record.
            if ($voting_history && (($voting_history->last_ip !== $ip)
                    || $this->isLastSeenOver15MinutesAgo($voting_history, $now))) {
                logger("Updating last IP. Was: [$voting_history->last_ip], is: [$ip]. Cookie: [$voting_history_id].");
                $voting_history->update(['last_ip' => $ip, 'last_seen_at' => $now->format('Y-m-d H:i:s')]);
            }
        }

        // If we didn't have history ID from cookie, or searching by it in DB returned null - and IP is not null.
        if (!$voting_history && $ip) {
            // Try to find the latest history for this IP.
            $voting_history = VotingHistory::where(['last_ip' => $ip])->orderBy('last_seen_at', 'desc')->get()->first();
            if ($voting_history) {
                // If there's history for this IP, but earlier than 15 minutes ago, assume that it could be a different
                // person, and ignore it.
                if ($this->isLastSeenOver15MinutesAgo($voting_history, $now)) {
                    $voting_history = null;
                } else {
                    // Else, the user probably tried opening another browser on this computer, so they should get
                    // a history cookie associated with the record found. We'll use the record.
                    logger("Giving user cookie by IP. IP: [$ip], given cookie id: [$voting_history->id], "
                        . "cookie from browser (if any): [$voting_history_id]");
                    Cookie::queue(Constants::VOTING_COOKIE_NAME, $voting_history->id, 60 * 24 * 365);
                }
            }
        }

        // If we still don't have a history record, create a fresh one, and point cookie to it.
        if (!$voting_history) {
            $voting_history =
                VotingHistory::create(['raw' => 'ic', 'last_ip' => $ip, 'last_seen_at' => $now->format('Y-m-d H:i:s')]);
            Cookie::queue(Constants::VOTING_COOKIE_NAME, $voting_history->id, 60 * 24 * 365);
        }
        $request->voting_history = $voting_history;
        return $next($request);
    }

    private function isLastSeenOver15MinutesAgo(VotingHistory $voting_history, \DateTimeImmutable $now) : bool
    {
        $last_seen_at = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $voting_history->last_seen_at);
        return $last_seen_at->add(new \DateInterval('PT15M')) < $now;
    }

    private function getIp() : ?string
    {
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP',
                     'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                        !== false) {
                        return $ip;
                    }
                }
            }
        }
        return null;
    }
}
