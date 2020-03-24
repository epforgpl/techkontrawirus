<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Idea;
use Illuminate\Support\Facades\Request;

class IdeasController extends Controller
{
    public function ideas()
    {
        $ideas = Idea::all();
        $ideas = $ideas->sortBy(function (Idea $idea) {
            return $idea->minus - $idea->plus;
        });
        return view('ideas')->with([
            'ideas' => $ideas,
            'voting_history' => request()->voting_history
        ]);
    }

    public function idea($idea_id)
    {
        $idea = Idea::with('comments')->find($idea_id);
        if (!$idea) {
            abort(404);
        }

        $is_new_idea = (Request::input('nowy-pomysl') === '1');
        $has_new_comment = (Request::input('nowy-komentarz') === '1');

        return view('idea')->with([
            'idea' => $idea,
            'voting_history' => request()->voting_history,
            'is_new_idea' => $is_new_idea,
            'has_new_comment' => $has_new_comment
        ]);
    }

    public function newIdea()
    {
        return view('new-idea');
    }

    public function saveNewIdea()
    {
        $title = Request::input('title');
        $description = Request::input('description');
        $problem = Request::input('problem');
        $recipients = Request::input('recipients');
        $solution = Request::input('solution');
        if (!$this->validateIdeaInput($title, $description, $problem, $recipients, $solution)) {
            abort(400);
        }

        $idea = Idea::create([
            'title' => $title,
            'description' => $description,
            'problem' => $problem,
            'recipients' => $recipients,
            'solution' => $solution
        ]);
        return redirect("/pomysl/$idea->id?nowy-pomysl=1");
    }

    private function validateIdeaInput(?string $title, ?string $description, ?string $problem, ?string $recipients,
                                       ?string $solution): bool
    {
        if (!$title || !$description || !$problem || !$recipients || !$solution) {
            return false;
        }
        if ((strlen($title) > 170) || (strlen($description) > 700) || (strlen($problem) > 1200)
            || (strlen($recipients) > 1200) || (strlen($solution) > 1200)) {
            return false;
        }
        return true;
    }

    public function saveNewComment(int $idea_id)
    {
        $content = Request::input('content');
        if (!$this->validateCommentInput(Idea::find($idea_id), $content)) {
            abort(400);
        }

        Comment::create([
            'idea_id' => $idea_id,
            'content' => $content,
        ]);
        return redirect("/pomysl/$idea_id?nowy-komentarz=1");
    }

    private function validateCommentInput(?Idea $idea, ?string $content) : bool
    {
        if (!$idea || !$content) {
            return false;
        }
        if (strlen($content) > 700) {
            return false;
        }
        return true;
    }

    public function saveIdeaVote(int $idea_id)
    {
        $idea = Idea::find($idea_id);
        if (!$this->validateVoteInput($idea, Request::input('is_plus'), Request::input('is_canceling'))) {
            abort(400);
        }
        $is_plus = (bool) Request::input('is_plus');
        $is_canceling = (bool) Request::input('is_canceling');
        if ($is_plus) {
            $idea->plus = $idea->plus + ($is_canceling ? -1 : 1);
        } else {
            $idea->minus = $idea->minus + ($is_canceling ? -1 : 1);
        }
        $idea->save();

        request()->voting_history->setIdeaVote($idea_id, $is_canceling ? 0 : ($is_plus ? 1 : -1));
    }

    public function saveCommentVote(int $comment_id)
    {
        $comment = Comment::find($comment_id);
        if (!$this->validateVoteInput($comment, Request::input('is_plus'), Request::input('is_canceling'))) {
            abort(400);
        }
        $is_plus = (bool) Request::input('is_plus');
        $is_canceling = (bool) Request::input('is_canceling');
        if ($is_plus) {
            $comment->plus = $comment->plus + ($is_canceling ? -1 : 1);
        } else {
            $comment->minus = $comment->minus + ($is_canceling ? -1 : 1);
        }
        $comment->save();

        request()->voting_history->setCommentVote($comment_id, $is_canceling ? 0 : ($is_plus ? 1 : -1));
    }

    private function validateVoteInput($entity, ?string $is_plus, ?string $is_canceling)
    {
        if ($entity === null) {
            return false;
        }
        if (!in_array($is_plus, ['0', '1']) || !in_array($is_canceling, ['0', '1'])) {
            return false;
        }
        return true;
    }
}
