<?php

namespace Fulll\App\Handler;

use Fulll\App\Command\CheckVehicleInFleetCommand;

class CheckVehicleInFleetHandler
{
    public function handle(CheckVehicleInFleetCommand $checkVehicleInFleetCommand): bool
    {
        $isVehicleInFleet = $checkVehicleInFleetCommand->getFleet()->hasVehicle($checkVehicleInFleetCommand->getVehicle());

        return $isVehicleInFleet;
    }
}
