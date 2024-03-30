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

    private RegisterVehicleCommand $registerVehicleCommand;
    private CheckVehicleInFleetCommand $checkVehicleInFleetCommand;
    private AddVehicleInFleetCommand $addVehicleInFleetCommand;

    private RegisterVehicleHandler $registerVehicleHandler;
    private CheckVehicleInFleetHandler $checkVehicleInFleetHandler;
    private AddVehicleInFleetHandler $addVehicleInFleetHandler;

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
        $this->registerVehicleHandler = new RegisterVehicleHandler($this->fleet, $this->vehicle);
        $this->$registerVehicleHandler->handle($this->registerVehicleHandler);
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet()
    {
        $this->checkVehicleInFleetHandler = new CheckVehicleInFleetHandler($this->myFleet, $this->vehicle);
        
        if (!$this->checkVehicleInFleetHandler->handle($this->checkVehicleInFleetHandler)) {
            throw new \Exception('Vehicle is not part of the fleet.');
        }
    }

    /**
     * @Given I have registered this vehicle into my fleet
     */
    public function iHaveRegisteredThisVehicleIntoMyFleet()
    {
        $this->registerVehicleHandler = new RegisterVehicleHandler($this->fleet, $this->vehicle);
        $this->$registerVehicleHandler->handle($this->registerVehicleHandler);
    }

    /**
     * @When I try to register this vehicle into my fleet
     */
    public function iTryToRegisterThisVehicleIntoMyFleet()
    {
        try {
            $this->registerVehicleHandler = new RegisterVehicleHandler($this->fleet, $this->vehicle);
            $this->$registerVehicleHandler->handle($this->registerVehicleHandler);
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
        $this->addVehicleInFleetHandler = new AddVehicleInFleetHandler($this->anotherFleet, $this->vehicle);
        $this->$addVehicleInFleetHandler->handle($this->addVehicleInFleetHandler);

        $this->checkVehicleInFleetHandler = new CheckVehicleInFleetHandler($this->anotherFleet, $this->vehicle);
        if (!$this->checkVehicleInFleetHandler->handle($this->checkVehicleInFleetHandler)) {
            throw new \Exception('Vehicle is not part of the fleet.');
        }
    }
}
