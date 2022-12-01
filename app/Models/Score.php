<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Score
 *
 * @property int $id
 * @property int $user_id
 * @property int $score
 * @property int $scoreable_id
 * @property string $scoreable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $scoreable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Score newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Score newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Score query()
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereScoreableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereScoreableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Score whereUserId($value)
 * @mixin \Eloquent
 */
class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        "score", "scoreable_id", "scoreable_type"
    ];

    public function scoreable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
