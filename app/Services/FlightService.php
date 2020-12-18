<?php

namespace App\Services;

use App\Repositories\FlightRepository;

/**
 * @author Everton Rodrigues
 * @since 2020-12-16
 */
class FlightService
{
    private $flightRepository;
    
    /**
     * Construct
     */
    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    /**
     * Return collection
     */
    public function collection($request)
    {
        return [
            'flights' => $this->flightRepository->getFlights(),
            'groups'=> $this->flightRepository->getGroups(),
            'totalGroups' => $this->flightRepository->getTotalGroups(),
            'totalFlights'=> $this->flightRepository->getTotalFlights(),
            'cheapestPrice' => $this->flightRepository->getCheapestPrice(),
            'cheapestGroup' => $this->flightRepository->getCheapestGroup(),
        ];
    }
}