<?php

namespace App\Http\Controllers\Apis\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ApiV1\Address\StoreAddressRequest;
use App\Http\Requests\Apis\ApiV1\Address\UpdateAddressRequest;
use App\Models\Address;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {

            $addresses = auth()->user()->addresses()->get();

            $addresses->map(function ($item) {
                if (auth()->user()->getCurrentAddress($item->id))
                    $item->CurrentAddress = true;

            });

            return $this->successMessage($addresses);


        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressRequest $request
     * @return JsonResponse
     */
    public function store(StoreAddressRequest $request): JsonResponse
    {
        try {
            auth()->user()->addresses()->create([
                "width" => $request->input("width"),
                "height" => $request->input("height"),
                "state" => $request->input("state"),
                "city" => $request->input("city"),
                "street" => $request->input("street"),
                "pluck" => $request->input("pluck"),
            ]);

            return $this->successMessage("address added successfully");

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $address
     * @return JsonResponse
     */
    public function setCurrentAddress(int $address): JsonResponse
    {
        try {
            auth()->user()->update([
                "currentAddress" => $address
            ]);

            return $this->successMessage("current address updated successfully");

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddressRequest $request
     * @param Address $address
     * @return JsonResponse
     */
    public function update(UpdateAddressRequest $request, Address $address): JsonResponse
    {
        try {
            $address->update($request->all());
            return $this->successMessage([
                "msg" => "address updated successfully",
                "status" => true
            ]);
        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(Address $address): JsonResponse
    {
        try {

            $address->delete();
            return $this->successMessage([
                "msg" => "address deleted successfully",
                "status" => true
            ]);

        } catch (Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }
}
