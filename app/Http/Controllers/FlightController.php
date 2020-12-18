<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlightService;
use Illuminate\Validation\Rule;

/**
 * @author Everton Rodrigues
 * @since 2020-12-16
 */
class FlightController extends Controller
{
    private $vooService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FlightService $vooService)
    {
        $this->service = $vooService;
    }

    /**
     * @OA\Get(
     *     tags={"flights"},
     *     summary="Flights data",
     *     description="Return all flights and groups data",
     *     path="/api/v1/flights",
     *     @OA\Response(
	 *          response="200",
	 *          description="Flights data",
	 *          @OA\JsonContent(
	 *         		type="array",
	 *              @OA\Items(
	 *              	type="object",
	 *                 	@OA\Property(
     *                       property="flights", 
     *                       type="array",
     *                       @OA\Items(
     *                            @OA\Property(property="id", type="integer"),
     *                            @OA\Property(property="cia", type="string"),
     *                            @OA\Property(property="fare", type="string"),
     *                            @OA\Property(property="flightNumber", type="string"),
     *                            @OA\Property(property="origin", type="string"),
     *                            @OA\Property(property="destination", type="string"),
     *                            @OA\Property(property="departureDate", type="string"),
     *                            @OA\Property(property="arrivalDate", type="string"),
     *                            @OA\Property(property="departureTime", type="string"),
     *                            @OA\Property(property="arrivalTime", type="string"),
     *                            @OA\Property(property="classService", type="integer"),
     *                            @OA\Property(property="price", type="number"),
     *                            @OA\Property(property="tax", type="integer"),
     *                            @OA\Property(property="outbound", type="integer"),
     *                            @OA\Property(property="inbound", type="integer"),
     *                            @OA\Property(property="duration", type="string"),
     *                       )
     *                  ),
	 *                 	@OA\Property(
     *                       property="groups", 
     *                       type="array",
     *                       @OA\Items(
     *                            @OA\Property(property="uniqueId", type="integer"),
     *                            @OA\Property(property="totalPrice", type="number"),
     *                            @OA\Property(
     *                                 property="outbound", 
     *                                 type="array",
     *                                 @OA\Items(
     *                                      @OA\Property(property="id", type="integer"),
     *                                      @OA\Property(property="cia", type="string"),
     *                                      @OA\Property(property="fare", type="string"),
     *                                      @OA\Property(property="flightNumber", type="string"),
     *                                      @OA\Property(property="origin", type="string"),
     *                                      @OA\Property(property="destination", type="string"),
     *                                      @OA\Property(property="departureDate", type="string"),
     *                                      @OA\Property(property="arrivalDate", type="string"),
     *                                      @OA\Property(property="departureTime", type="string"),
     *                                      @OA\Property(property="arrivalTime", type="string"),
     *                                      @OA\Property(property="classService", type="integer"),
     *                                      @OA\Property(property="price", type="number"),
     *                                      @OA\Property(property="tax", type="integer"),
     *                                      @OA\Property(property="outbound", type="integer"),
     *                                      @OA\Property(property="inbound", type="integer"),
     *                                      @OA\Property(property="duration", type="string"),
     *                                 )
     *                            ),
     *                            @OA\Property(
     *                                 property="inbound", 
     *                                 type="array",
     *                                 @OA\Items(
     *                                      @OA\Property(property="id", type="integer"),
     *                                      @OA\Property(property="cia", type="string"),
     *                                      @OA\Property(property="fare", type="string"),
     *                                      @OA\Property(property="flightNumber", type="string"),
     *                                      @OA\Property(property="origin", type="string"),
     *                                      @OA\Property(property="destination", type="string"),
     *                                      @OA\Property(property="departureDate", type="string"),
     *                                      @OA\Property(property="arrivalDate", type="string"),
     *                                      @OA\Property(property="departureTime", type="string"),
     *                                      @OA\Property(property="arrivalTime", type="string"),
     *                                      @OA\Property(property="classService", type="integer"),
     *                                      @OA\Property(property="price", type="number"),
     *                                      @OA\Property(property="tax", type="integer"),
     *                                      @OA\Property(property="outbound", type="integer"),
     *                                      @OA\Property(property="inbound", type="integer"),
     *                                      @OA\Property(property="duration", type="string"),
     *                                 )
     *                            ),
     *                       )
     *                  ),
	 *                 	@OA\Property(property="totalGroups", type="integer"),
	 *                 	@OA\Property(property="totalFlights", type="integer"),
	 *                 	@OA\Property(property="cheapestPrice", type="number"),
	 *                 	@OA\Property(property="cheapestGroup", type="integer"),
	 *              ),
	 *          )
	 *     )
     * ),
     * 
     */
    public function index(Request $request)
    {
        $data = $this->service->collection($request);

        return response()->json($data, 200);
    }
}
