<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Owner
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Place|null $place
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Owner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Owner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Owner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Owner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Owner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Owner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
        'remember_token',
    ];

    public function place(): HasOne
    {
        return $this->hasOne(Place::class);
    }



}
