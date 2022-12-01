<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;


class CommentController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function unapproved(): Factory|View|Application
    {
        $comments = Comment::whereApproved(0);
        $this->searchingWord($comments);
        $comments = $comments->latest()->paginate(10);
        return view("admin.comments.unapprovedComments", compact("comments"));
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $comments = Comment::whereApproved(1);
        $this->searchingWord($comments);
        $comments = $comments->latest()->paginate(10);
        return view("admin.comments.approvedComments", compact("comments"));
    }


    /**
     * @param Comment $comment
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Comment $comment): Redirector|RedirectResponse|Application
    {
        $comment->update([
            "approved" => 1
        ]);

        return redirect(route("admin.comments.index"));
    }

    /**
     * @param Comment $comment
     * @return Application|Factory|View|RedirectResponse
     */
    public function destroy(Comment $comment): View|Factory|RedirectResponse|Application
    {
        try {
            $comment->delete();
            return back();
        } catch (Exception $exception) {
            return \view("errors.500");
        }
    }

    /**
     * @param Builder|Comment $comments
     * @return void
     */
    private function searchingWord(Builder|Comment $comments): void
    {
        if ($word = \request("search")) {
            $comments->where("comment", "LIKE", "%{$word}%")
                ->whereHas("user", function ($query) use ($word) {
                    return $query->where("name", "LIKE", "%{$word}%");
                });
        }
    }

}
