<?php

namespace App\Http\Controllers\Apis\V1;

use App\Events\NewCommentForOwnerEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {

    }

    public function store(StoreCommentRequest $request): JsonResponse
    {
        try {
            $user = auth()->user();
            $order = Order::find($request->input("order_id"));
            $subject = $request->input("forFood")
                ? $order->products->first()
                : $order->products->first()->place;
            $this->StoreCommentAndScore($user, $subject, $request);


            return successMessage("your comment and score registered! ", 201);

        } catch (Exception $exception) {

            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * @param Authenticatable|null $user
     * @param Model $subject
     * @param StoreCommentRequest $request
     */
    private function StoreCommentAndScore(?Authenticatable $user, Model $subject, StoreCommentRequest $request)
    {

        $user->comments()->create([
            "commentable_id" => $subject->id,
            "commentable_type" => get_class($subject),
            "comment" => $request->input("message"),
            "parent_id" => $request->input("parent_id") ?? 0,
        ]);

        $user->scores()->create([
            "scoreable_id" => $subject->id,
            "scoreable_type" => get_class($subject),
            "score" => $request->input("score"),
        ]);
        
        $avg = $this->calculationOfScoreSubject($subject);
        $subject->update([
            "score" => max($avg, 1),
        ]);


    }

    /**
     * @param Model $subject
     * @return float|int
     */
    private function calculationOfScoreSubject(Model $subject): int|float
    {
        $count = $subject->scores->count();

        $sumOfScores = $subject->scores->sum(function ($score) {
            return $score->score;
        });
        return $sumOfScores / $count;
    }
}
