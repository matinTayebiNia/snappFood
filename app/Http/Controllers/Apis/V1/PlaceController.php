<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Place\PlaceResource;
use App\Http\Resources\Place\PlacesResource;
use App\Models\Place;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        try {

            $places = Place::with(["schedules", "address", "placetypes"]);

            if ($word = request("type")) {
                $places = Place::PlaceTypeSearch($word);
            }

            if (request("isOpen") == true) {
                $places = Place::PlaceIsOpen();
            }

            $places = $places->paginate();

            return PlacesResource::collection($places);

        } catch (Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return PlaceResource|JsonResponse
     */
    public function show(Place $place): PlaceResource|JsonResponse
    {
        try {

            return new PlaceResource($place);

        } catch (Exception $exception) {
            return throwErrorMessageException([
                "message" => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }


}
