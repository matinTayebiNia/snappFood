<?php

namespace App\classes\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
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
     * @param $obj
     * @return $this
     */
    public function put(array $value, $obj = null): static
    {

        if ($obj instanceof Model) {

            $value = array_merge($value, [
                "id" => Str::random(10),
                "subject_id" => $obj->id,
                "subject_type" => get_class($obj)
            ]);

        } else {
            $value = array_merge($value, [
                "id" => Str::random(10)
            ]);
        }

        $this->cart->put($value["id"], $value);
        session()->put("cart", $this->cart);

        return $this;

    }

    public function has($key): bool
    {
        if ($key instanceof Model) {
            return !is_null(
                $this->getSubjectOfCart($key)
            );
        }

        return !is_null(
            $this->cart->firstWhere("id", $key)
        );
    }

    public function get($key): mixed
    {
        return $key instanceof Model
            ? $this->getSubjectOfCart($key)
            : $this->cart->firstWhere("id", $key);
    }

    public function all(): mixed
    {
        return $this->cart;
    }

    public function getAllCartsWithRelationsSubject(array|string $relations): Collection
    {
        if (is_string($relations))
            $relations = explode("|", $relations);

        return $this->cart->map(function ($cart) use ($relations) {
            $subject = $cart['subject_type'];
            $cart["dataOfCart"] = $subject::where("id", $cart["subject_id"])->with($relations)->first();
            unset($cart['subject_type'], $cart["subject_id"]);
            return $cart;
        });

    }

    /**
     * @param Model $key
     * @return mixed
     */
    private function getSubjectOfCart(Model $key): mixed
    {
        return $this->cart->where("subject_id", $key->id)
            ->where("subject_type", get_class($key))->first();
    }


}
