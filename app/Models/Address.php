<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
