<?php

namespace Fulll\App\Command;

use Fulll\Domain\Fleet;
use Fulll\Domain\Vehicle;

final readonly class CheckVehicleInFleetCommand
{
    public function __construct(private Fleet $fleet, private Vehicle $vehicle)
    {}

    public function getFleet(): Fleet
    {
        return $this->fleet;
    }

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }
}
