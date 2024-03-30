<?php

namespace Fulll\App\Handler;

use Fulll\App\Command\RegisterVehicleCommand;

class RegisterVehicleHandler
{
    public function handle(RegisterVehicleCommand $registerVehicleCommand): void
    {
        $registerVehicleCommand->getFleet()->addVehicle($registerVehicleCommand->getVehicle());
    }
}
