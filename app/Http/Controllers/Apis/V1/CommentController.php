<?php

namespace App\Http\Controllers\Apis\V1;

use App\Events\NewCommentForOwnerEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Comment\ShowCommentRequest;
use App\Http\Requests\Apis\Comment\StoreCommentRequest;
use App\Http\Resources\Comments\ShowCommentsResource;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Place;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {

            $subject = Place::find($request->input("restaurant_id"));
            if ($subject) {
                return ShowCommentsResource::collection($subject->comments()
                    ->where("approved", 1)->where("parent_id", 0)
                    ->paginate());
            }
            $subject = Order::with("products")
                ->whereHas("products", function ($query) use ($request) {
                    $query->where("id", $request->input("food_id"));
                })->first();
            return ShowCommentsResource::collection($subject->comments()
                ->where("approved", 1)->where("parent_id", 0)
                ->paginate());

        } catch (Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode(),
            ]);
        }
    }

    public function store(StoreCommentRequest $request): JsonResponse
    {
        try {
            $user = auth()->user();
            $order = Order::find($request->input("order_id"));
            //todo change register strategy of comment !
            $user->comments()->create([
                "commentable_id" => $order->id,
                "commentable_type" => get_class($order),
                "comment" => $request->input("message"),
                "parent_id" => $request->input("parent_id") ?? 0,
            ]);

            $user->scores()->create([
                "scoreable_id" => $order->id,
                "scoreable_type" => get_class($order),
                "score" => $request->input("score"),
            ]);

            $avg = $this->calculationOfScoreSubject($order);

            $order->products()->update([
                "score" => max($avg, 1),
            ]);

            return successMessage("your comment and score registered! ", 201);

        } catch (Exception $exception) {

            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * @param Model $subject
     * @return float|int
     */
    private function calculationOfScoreSubject(Model $subject): int|float
    {

        return $subject->scores->avg(function ($score) {
            return $score->score;
        });

    }
}
