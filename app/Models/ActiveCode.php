<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ActiveCode
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode generateCode($user)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode verifyCode($code, $user)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveCode whereUserId($value)
 */

class ActiveCode extends Model
{
    use HasFactory;


    protected $fillable = [
        "user_id", "code", "expired_at"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVerifyCode($query, $code, $user): bool
    {
        return !!$user->activeCodes()->whereCode($code)->where('expired_at', '>', now())->first();
    }

    public function scopeGenerateCode($query, $user): int
    {
        // use the old code when the expired_at is Not finished yet(Avoid duplicate code)
        //this command use the
        if ($code = $this->getAliveCodeForUser($user)) {
            return $code->code;
        } else {
            do {
                $code = mt_rand(111111, 999999);
            } while ($this->checkCodeIsUnique($user, $code));
            //store the code
            $user->activeCodes()->create([
                'code' => $code,
                'expired_at' => now()->addMinutes(10),
            ]);
            return $code;
        }
//        $user->activeCode()->delete();
        // generating code for activating phone number and checking code has unique.

    }

    private function checkCodeIsUnique($user, $code): bool
    {
        return !!$user->activeCodes()->whereCode($code)->first();
    }

    private function getAliveCodeForUser($user)
    {
        return $user->activeCodes()->where('expired_at', '>', now())->first();
    }



}
