<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property int $place_id
 * @property string $day
 * @property string $startTime
 * @property string $endTime
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Schedule newModelQuery()
 * @method static Builder|Schedule newQuery()
 * @method static Builder|Schedule query()
 * @method static Builder|Schedule whereCreatedAt($value)
 * @method static Builder|Schedule whereDay($value)
 * @method static Builder|Schedule whereEndTime($value)
 * @method static Builder|Schedule whereId($value)
 * @method static Builder|Schedule wherePlaceId($value)
 * @method static Builder|Schedule whereStartTime($value)
 * @method static Builder|Schedule whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Place $place
 * @method static Builder|Schedule checkSchedule($schedules)
 */
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        "place_id", "day", "startTime", "endTime"
    ];
    protected $hidden = [
        "id",
        "place_id",
        "created_at",
        "updated_at"
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function checkIsOpen(): bool
    {

        return !!$this->where("day", now()->dayName)
            ->where('endTime', '>', now()->hour)
            ->where("startTime", "<", now()->hour)
            ->first();
    }

    public function scopeCheckSchedule($schedules): bool
    {
        $isOpen = false;
        foreach ($schedules as $schedule) {
            $isOpen = $schedule->checkIsOpen();
        }

        return $isOpen;
    }

}
