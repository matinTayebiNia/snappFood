<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $place_id
 * @property string $height
 * @property string $width
 * @property string $state
 * @property string $city
 * @property string $street
 * @property string $pluck
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePluck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereWidth($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "place_id", "width", "height", "state", "city", "street", "pluck"
    ];

    protected $hidden = [
        "id",
        "created_at",
        'updated_at',
        "user_id",
        "place_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
