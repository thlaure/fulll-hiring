<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Full\App\Command\CheckVehicleInFleetCommand;
use Full\App\Command\RegisterVehicleCommand;
use Full\App\Handler\CheckVehicleInFleetHandler;
use Full\App\Handler\RegisterVehicleHandler;
use Fulll\Domain\Fleet;
use Fulll\Domain\Vehicle;

class RegisterVehicleContext implements Context
{
    private Fleet $myFleet;
    private Vehicle $vehicle;
    private Fleet $anotherFleet;
    private ?string $exceptionMessage = null;

    /**
     * @Given my fleet
     */
    public function myFleet()
    {
        $this->myFleet = new Fleet(1);
    }

    /**
     * @Given a vehicle
     */
    public function aVehicle()
    {
        $this->vehicle = new Vehicle(1);
    }

    /**
     * @When I register this vehicle into my fleet
     */
    public function iRegisterThisVehicleIntoMyFleet()
    {
        $registerVehicleCommand = new RegisterVehicleCommand($this->myFleet, $this->vehicle);
        $registerVehicleHandler = new RegisterVehicleHandler();
        $registerVehicleHandler->handle($registerVehicleCommand);
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet()
    {
        $checkVehicleInFleetCommand = new CheckVehicleInFleetCommand($this->myFleet, $this->vehicle);
        $checkVehicleInFleetHandler = new CheckVehicleInFleetHandler();
        
        if (!$checkVehicleInFleetHandler->handle($checkVehicleInFleetCommand)) {
            throw new \Exception('Vehicle is not part of the fleet.');
        }
    }

    /**
     * @Given I have registered this vehicle into my fleet
     */
    public function iHaveRegisteredThisVehicleIntoMyFleet()
    {
        $registerVehicleCommand = new RegisterVehicleCommand($this->myFleet, $this->vehicle);
        $registerVehicleHandler = new RegisterVehicleHandler();
        $registerVehicleHandler->handle($registerVehicleCommand);
    }

    /**
     * @When I try to register this vehicle into my fleet
     */
    public function iTryToRegisterThisVehicleIntoMyFleet()
    {
        try {
            $registerVehicleCommand = new RegisterVehicleCommand($this->fleet, $this->vehicle);
            $registerVehicleHandler->handle($registerVehicleCommand);
        } catch (\Exception $exception) {
            $this->exceptionMessage = $exception->getMessage();
        }
    }

    /**
     * @Then I should be informed this vehicle has already been registered into my fleet
     */
    public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
    {
        if (!$this->exceptionMessage || strpos($this->exceptionMessage, 'Vehicle is already registered') === false) {
            throw new \Exception('Expected exception message not found.');
        }
    }

    /**
     * @Given the fleet of another user
     */
    public function theFleetOfAnotherUser()
    {
        $this->anotherFleet = new Fleet(2);
    }

    /**
     * @Given this vehicle has been registered into the other user's fleet
     */
    public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet()
    {
        $checkVehicleInFleetCommand = new CheckVehicleInFleetCommand($this->anotherFleet, $this->vehicle);
        $checkVehicleInFleetHandler = new CheckVehicleInFleetHandler();

        if (!$checkVehicleInFleetHandler->handle($checkVehicleInFleetCommand)) {
            throw new \Exception('Vehicle is not part of the fleet.');
        }
    }
}
