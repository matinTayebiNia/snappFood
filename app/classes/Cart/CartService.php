<?php

namespace App\classes\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartService
{
    protected mixed $cart;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct()
    {
        $this->cart = session()->get("cart") ?? collect([]);
    }


    /**
     * @param array $value
     * @param Model $obj
     * @return $this
     */
    public function put(array $value, Model $obj): static
    {

        if (!isset($value["id"]))
            $value = array_merge($value, [
                "id" => Str::random(10),
                "subject_id" => $obj->id,
                "subject_type" => get_class($obj)
            ]);
        else
            $value = array_merge($value, [
                "subject_id" => $obj->id,
                "subject_type" => get_class($obj)
            ]);


        $this->cart->put($value["id"], $value);
        session()->put("cart", $this->cart);

        return $this;

    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key): bool
    {
        return !is_null(
            $this->cart->where("subject_id", $key->id)
                ->where("subject_type", get_class($key))->first()
        );
    }

    /**
     * @param $key
     * @param bool $withRelatedData
     * @return array|mixed|null
     */
    public function get($key, bool $withRelatedData = true): mixed
    {
        if ($this->has($key)) {
            $cart = $this->cart->where("subject_id", $key->id)
                ->where("subject_type", get_class($key))->first();

            return $withRelatedData ?
                $this->getSubjectOfData($cart) :
                $cart;
        }
        return null;
    }

    /**
     * @param array|string|null $relations
     * @return mixed
     */
    public function all(array|string|null $relations = null): mixed
    {
        if (is_string($relations))
            $relations = explode("|", $relations);

        return $this->cart->map(function ($cart) use ($relations) {
            return $this->getCartsWithSubjectRelations($cart, $relations);
        });
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->cart = collect([]);
        session()->put("cart", $this->cart);
    }

    /**
     * @param Model $key
     * @return void
     */
    public function forget(Model $key): void
    {
        $cart = $this->get($key, false);
        if ($cart) {
            $this->cart = $this->cart->forget($cart);
            session()->put("cart", $this->cart);
        }
    }


    public function update(Model $key, $option): static
    {
        $cart = collect($this->get($key, false));
        if (is_numeric($option)) {
            $cart = $cart->merge([
                "count" => $cart["count"] + $option
            ]);
        }
        $this->put($cart->toArray(), $key);

        return $this;
    }

    public function TheCostOfTheNumberOfMealsOfThisCart(Model $key): float|int
    {
        $cart = $this->get($key, false);
        return $cart['price'] * $cart['count'];
    }

    public function count($key): int
    {
        if (!$this->has($key)) return 0;
        return intval($this->get($key, false)["count"]);
    }

    public function totalPrice()
    {
        return $this->all()->sum(function ($cart) {
            return $cart['price'] * $cart['count'];
        });
    }

    /**
     * @param $cart
     * @return array|null
     */
    private function getSubjectOfData($cart): ?array
    {
        return $cart ? array_merge($cart, ["dataOfCart" =>
            $cart['subject_type']::where("id", $cart["subject_id"])
                ->first()]) : null;
    }

    /**
     * @param $cart
     * @param array|string $relations
     * @return array|null
     */
    private function getSubjectOfDataWithRelation($cart, array|string $relations): ?array
    {
        return $cart ? array_merge($cart, ["dataOfCart" =>
            $cart['subject_type']::where("id", $cart["subject_id"])
                ->with($relations)->first()]) : null;
    }

    /**
     * @param $cart
     * @param array|string|null $relations
     * @return mixed
     */
    private function getCartsWithSubjectRelations($cart, array|string|null $relations): mixed
    {
        return !is_null($relations) ?
            $this->getSubjectOfDataWithRelation($cart, $relations) :
            $this->getSubjectOfData($cart);
    }


}
