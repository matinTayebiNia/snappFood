<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Place;
use App\Models\Product;
use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $products = auth()->user()->place->products->pluck("id");
        $place_id = auth()->user()->place->id;
        $score = Score::query();
        list($FoodMonths, $FoodAvg) = $this->getFoodScore($products, $score);
        list($RestaurantMonths, $RestaurantAvg) = $this->getRestaurantScore($score, $place_id);
        $comments = auth()->user()->place->comments()->where("commentable_id", $place_id)
            ->where("commentable_type", Place::class)->latest()->paginate(10);


        return view("owner.charts.index", compact("FoodMonths",
            "FoodAvg", "RestaurantAvg", "RestaurantMonths", "comments"));
    }

    /**
     * @param Collection $products
     * @param Builder $score
     * @return array
     */
    private function getFoodScore(Collection $products, Builder $score): array
    {
        $FoodScores = $score->whereIn("scoreable_id", $products)
            ->where("scoreable_type", Product::class)
            ->select('score', "created_at")
            ->get()
            ->groupBy(function ($data) {
                return Carbon::parse($data->created_at)->format("M");
            });
        if (!$FoodScores->isEmpty()) {
            $FoodMonths = $FoodScores->keys();
            $FoodAvg = $FoodScores->map(function ($data) {
                return $data->avg(fn($item) => $item->score);
            });
            return array($FoodMonths, $FoodAvg);
        }
        return array(collect([]), collect([]));


    }

    /**
     * @param Builder|Score $score
     * @param $place_id
     * @return array
     */
    private function getRestaurantScore(Builder|Score $score, $place_id): array
    {
        $RestaurantScore = $score->where("scoreable_id", $place_id)
            ->where("scoreable_type", Place::class)
            ->get()->groupBy(function ($data) {
                return Carbon::parse($data->created_at)->format("M");
            });
        if ($RestaurantScore->isNotEmpty()) {
            $RestaurantMonths = $RestaurantScore->keys();
            $RestaurantAvg = $RestaurantScore->map(function ($data) {
                return $data->avg(fn($item) => $item->score);
            });
            return array($RestaurantMonths, $RestaurantAvg);
        }
        return array(collect([]), collect([]));
    }
}
