<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class FlightRepository
{
    const apiUrl = 'http://prova.123milhas.net/api/flights';

    private $flights;
    private $groups;
    private $totalGroups;
    private $totalFlights;
    private $cheapestPrice;
    private $cheapestGroup;
    private $uniqueID;

    public function __construct()
    {
        $this->setFlights();
        $this->setGroups();
        $this->setTotalGroups();
        $this->setTotalFlights();
        $this->setCheapestPrice();
        $this->setCheapestGroup();
        $this->uniqueID = 0;
    }

    /**
     * Retrieve all flights
     */
    public function getFlights()
    {
        return $this->flights;
    }

    /**
     * Set Flights
     */
    public function setFlights()
    {
        $response = Http::get(self::apiUrl);
        
        if ($response->status() !== 200)
        {
            abort(502, 'It was not possible to obtain flight data in the 123 Miles API.');
        }

        $this->flights = $this->sort(json_decode($response->body(), true), 'price');
    }

    /**
     * Get Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set groups
     */
    public function setGroups()
    {
        $this->groups = [];

        $groups = [];

        foreach($this->getFlights() as $key => $flight)
        {
            $type = $flight['outbound'] === 1 ? 'outbound' : 'inbound';
            $groups[$flight['fare']][$type][$flight['price']][] = $flight;
        }

        foreach ($groups as $key => $fare)
        {
            $outboundGroup = !empty($fare['outbound']) ? $fare['outbound'] : [];
            $inboundGroup = !empty($fare['inbound']) ? $fare['inbound'] : [];
            
            if  (!empty($outboundGroup) && !empty($inboundGroup))
            {
                $this->mountGroup($outboundGroup, $inboundGroup);
            }
        }
        
        $this->groups = $this->sort($this->groups, 'totalPrice');
    }

    /**
     * Mount a group
     */
    private function mountGroup($outboundGroup, $inboundGroup)
    {
        foreach($inboundGroup as $inKey => $inPrice)
        {
            foreach($outboundGroup as $outKey => $outPrice)
            {
                $this->uniqueID++;
                $this->groups[] = [
                    'uniqueId' => $this->uniqueID,
                    'totalPrice' => $inKey + $outKey,
                    'outbound' => $outPrice,
                    'inbound' => $inPrice,        
                ];
            }
        }
    }

    /**
     * Get totalGroups
     */
    public function getTotalGroups()
    {
        return $this->totalGroups;
    }

    /**
     * Set totalGroups
     */
    public function setTotalGroups()
    {
        $this->totalGroups = count($this->getGroups());
    }

    /**
     * Get totalFlights
     */
    public function getTotalFlights()
    {
        return $this->totalFlights;
    }

    /**
     * Set totalFlights
     */
    public function setTotalFlights()
    {
        $this->totalFlights = count($this->getFlights());
    }

    /**
     * Get cheapestPrice
     */
    public function getCheapestPrice()
    {
        return $this->cheapestPrice;
    }

    /**
     * Set cheapestPrice
     */
    public function setCheapestPrice()
    {
        $this->cheapestPrice = $this->groups[0]['totalPrice'];
    }

    /**
     * Get cheapestGroup
     */
    public function getCheapestGroup()
    {
        return $this->cheapestGroup;
    }

    /**
     * Set cheapestGroup
     */
    public function setCheapestGroup()
    {
        $this->cheapestGroup = $this->groups[0]['uniqueId'];
    }


    /**
     * Filter collection
     */
    private function filter($array, $field, $value)
    {
        $data = [];

        foreach ($array as $key => $item)
        {
            if (isset($item[$field]) && $item[$field] == $value)
            {
                $data[] = $item;
            }
        }

        return $data;
    }

    /**
     * Sort collection
     */
    private function sort($array, $sortBy)
    {
        usort($array, function ($item1, $item2) use($sortBy) {
            return $item1[$sortBy] <=> $item2[$sortBy];
        });

        return $array;
    }
}