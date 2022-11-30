<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Place
 *
 * @property int $id
 * @property string $name
 * @property string $Number
 * @property string $account_number
 * @property string $image
 * @property int $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address|null $address
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Owner $owner
 * @property-read Collection|PlaceType[] $placeTypes
 * @property-read int|null $place_types_count
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read Collection|Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @method static Builder|Place newModelQuery()
 * @method static Builder|Place newQuery()
 * @method static Builder|Place query()
 * @method static Builder|Place whereAccountNumber($value)
 * @method static Builder|Place whereCreatedAt($value)
 * @method static Builder|Place whereId($value)
 * @method static Builder|Place whereImage($value)
 * @method static Builder|Place whereName($value)
 * @method static Builder|Place whereNumber($value)
 * @method static Builder|Place whereOwnerId($value)
 * @method static Builder|Place whereUpdatedAt($value)
 * @method static Builder|Place PlaceTypeSearch(string $word)
 * @method static Builder|Place PlaceIsOpen()
 * @mixin Eloquent
 */
class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "Number", 'account_number', "owner_id", "image","score"
    ];

    protected $hidden = [
        "created_at", "updated_at", "owner_id"
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function placeTypes(): BelongsToMany
    {
        return $this->belongsToMany(PlaceType::class, "place_placetype", "place_id", "placetype_id");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function scopePlaceTypeSearch($query, string $word)
    {
        return $query->whereHas("placetypes", function ($query) use ($word) {
            return $query->where("name", "LIKE", "%{$word}%");
        });
    }

    public function scopePlaceIsOpen($query)
    {
        $query->whereHas("schedules", function ($query) {
            return $query->where("day", now()->dayName)
                ->where('endTime', '>', now()->hour)
                ->where("startTime", "<", now()->hour);
        });
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
