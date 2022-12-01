<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $price
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read User $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order wherePrice($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "price", "user_id", "status"
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getOrderOptions(): array
    {
        return   ["unpaid", "canceled",
            "notPosted", "posted", "Received", "paid"];
    }
}
