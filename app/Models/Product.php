<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $Basic_cases
 * @property int $price
 * @property string $image
 * @property int $category_id
 * @property int $count
 * @property int $place_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read Place $place
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBasicCases($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereCount($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePlaceId($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $score
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Score[] $scores
 * @property-read int|null $scores_count
 * @method static Builder|Product whereScore($value)
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "Basic_cases", "price", "image", "category_id", "place_id", "count","score"
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "place_id",
        "category_id",
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scores(): MorphMany
    {
        return $this->morphMany(Score::class,"scoreable");
    }
}
