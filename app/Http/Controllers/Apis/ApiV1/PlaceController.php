<?php

namespace App\Http\Controllers\Apis\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {

            $places = Place::with(["schedules", "address"]);

            if ($word = request("type")) {
                $places->whereHas("placetypes", function ($query) use ($word) {
                    return $query->where("name", "LIKE", "%{$word}%");
                });
            }
            $places = $places->paginate();
            $places->map(function ($item) {
                foreach ($item->schedules as $schedule) {
                    $item->isOpen = $schedule->checkIsOpen();
                }
            });

            if (request("isOpen") == true) {
                $places = $places->filter(function ($item) {
                    return $item->isOpen;
                });

            }
            return $this->successMessage($places);

        } catch (\Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return JsonResponse
     */
    public function show(Place $place): JsonResponse
    {
        try {
            $place = $place->with(["schedules", "categories", "placetypes"])->first();

            $place->schedules->map(function ($schedule) use ($place) {
                $place->isOpen = $schedule->checkIsOpen();
            });

            return $this->successMessage($place);

        } catch (\Exception $exception) {
            return $this->throwErrorMessageException([
                "message" => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }


}
