<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return !!$user->activeCode()->whereCode($code)->where('expired_at', '>', now())->first();
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
            $user->activeCode()->create([
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
        return !!$user->activeCode()->whereCode($code)->first();
    }

    private function getAliveCodeForUser($user)
    {
        return $user->activeCode()->where('expired_at', '>', now())->first();
    }



}
