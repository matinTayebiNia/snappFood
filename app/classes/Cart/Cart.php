<?php

namespace App\classes\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed get(Model|string $key);
 * @method static CartService put(array $value, Model $obj = null);
 * @method static Collection all();
 * @method static Collection getAllCartsWithRelationsSubject(array|string $relations);
 * @method static bool has(Model|string $key);
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "cart";
    }
}
