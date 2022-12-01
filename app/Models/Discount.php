<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property int $Discount_amount
 * @property string $typeDiscount
 * @property string $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereTypeDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        "code", "title", "Discount_amount", "typeDiscount", "expired_at"
    ];
}
