<?php

namespace App;

use App\Util\Assert;
use Illuminate\Database\Eloquent\Model;

class VotingHistory extends Model
{
    public $table = 'voting_history';
    public $timestamps = false;
    public $fillable = ['raw', 'last_ip', 'last_seen_at'];

    private $ideas = [];
    private $comments = [];

    public function getIdeaVote(int $idea_id) : int
    {
        return $this->ideas[$idea_id] ?? 0;
    }

    public function getCommentVote(int $comment_id) : int
    {
        return $this->comments[$comment_id] ?? 0;
    }

    public function setIdeaVote(int $idea_id, int $vote)
    {
        Assert::assertTrue(in_array($vote, [-1, 0, 1]));
        if ($vote === 0) {
            unset($this->ideas[$idea_id]);
        } else {
            $this->ideas[$idea_id] = $vote;
        }

        $this->serializeValue();
        $this->save();
    }

    public function setCommentVote(int $comment_id, int $vote)
    {
        Assert::assertTrue(in_array($vote, [-1, 0, 1]));
        if ($vote === 0) {
            unset($this->comments[$comment_id]);
        } else {
            $this->comments[$comment_id] = $vote;
        }

        $this->serializeValue();
        $this->save();
    }

    private function serializeValue() : void
    {
        $result = 'i';
        foreach ($this->ideas as $idea_id => $vote) {
            $result .= "$idea_id=$vote,";
        }
        $result = rtrim($result, ',');
        $result .= 'c';
        foreach ($this->comments as $comment_id => $vote) {
            $result .= "$comment_id=$vote,";
        }
        $result = rtrim($result, ',');
        $this->raw = $result;
    }

    private function deserializeValue() : void
    {
        $this->ideas = [];
        $this->comments = [];
        preg_match('@^i([^c]*)c(.*)$@', $this->raw, $matches);
        $ideas = $matches[1] ? explode(',', $matches[1]) : [];
        foreach ($ideas as $idea) {
            $parts = explode('=', $idea);
            $this->ideas[$parts[0]] = $parts[1];
        }
        $comments = $matches[2] ? explode(',', $matches[2]) : [];
        foreach ($comments as $comment) {
            $parts = explode('=', $comment);
            $this->comments[$parts[0]] = $parts[1];
        }
    }

    protected static function booted()
    {
        static::retrieved(function (VotingHistory $voting_history) {
            $voting_history->deserializeValue();
        });
    }
}
