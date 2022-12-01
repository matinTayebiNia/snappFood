<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\PlaceType
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Place[] $places
 * @property-read int|null $places_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlaceType extends Model
{
    use HasFactory;

    protected $table = "placetypes";

    protected $fillable = ["name", "icon", "slug"];
    protected $guarded = ["id"];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "category_placetype", "placetype_id", "category_id");
    }

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, "place_placetype", "placetype_id", "place_id");
    }

    protected $hidden = [
        "created_at",
        "updated_at",
        "pivot",
        "slug"
    ];
}
