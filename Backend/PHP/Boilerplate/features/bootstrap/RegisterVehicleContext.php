<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
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
        $this->myFleet->addVehicle($this->vehicle);
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet()
    {
        if (!$this->myFleet->hasVehicle($this->vehicle)) {
            throw new \Exception('Vehicle is not part of my fleet');
        }
    }

    /**
     * @Given I have registered this vehicle into my fleet
     */
    public function iHaveRegisteredThisVehicleIntoMyFleet()
    {
        $this->myFleet->addVehicle($this->vehicle);
    }

    /**
     * @When I try to register this vehicle into my fleet
     */
    public function iTryToRegisterThisVehicleIntoMyFleet()
    {
        try {
            $this->myFleet->addVehicle($this->vehicle);
        } catch (\Exception $exception) {
            $this->exceptionMessage = $exception->getMessage();
        }
    }

    /**
     * @Then I should be informed this vehicle has already been registered into my fleet
     */
    public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
    {
        var_dump($this->exceptionMessage);
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
        $this->anotherFleet->addVehicle($this->vehicle);
        if (!$this->anotherFleet->hasVehicle($this->vehicle)) {
            throw new \Exception('Vehicle is not part of the fleet.');
        }
    }
}
