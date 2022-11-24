<?php

namespace App\classes\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed get(Model $key,bool $withRelatedData=true);
 * @method static CartService put(array $value, Model $obj);
 * @method static Collection all($relations = null);
 * @method static bool has(Model $key);
 * @method static void flush();
 * @method static void forget(Model $key);
 * @method static CartService update(Model $key,$option);
 * @method static int count(Model $key);
 * @method static float|int TheCostOfTheNumberOfMealsOfThisCart(Model $key);
 * @method static float|int totalPrice();
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "cart";
    }
}
