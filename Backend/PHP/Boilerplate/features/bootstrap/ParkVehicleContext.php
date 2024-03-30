<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Fulll\Domain\Fleet;
use Fulll\Domain\Location;
use Fulll\Domain\Vehicle;

class ParkVehicleContext implements Context
{
    private Fleet $myFleet;
    private Vehicle $vehicle;
    private Location $location;

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

    // /**
    //  * @Given I have registered this vehicle into my fleet
    //  */
    // public function iHaveRegisteredThisVehicleIntoMyFleet()
    // {
    //     throw new PendingException();
    // }

    /**
     * @Given a location
     */
    public function aLocation()
    {
        $this->location = new Location(1, 1);
    }

    /**
     * @When I park my vehicle at this location
     */
    public function iParkMyVehicleAtThisLocation()
    {
        throw new PendingException();
    }

    /**
     * @Then the known location of my vehicle should verify this location
     */
    public function theKnownLocationOfMyVehicleShouldVerifyThisLocation()
    {
        throw new PendingException();
    }

    /**
     * @Given my vehicle has been parked into this location
     */
    public function myVehicleHasBeenParkedIntoThisLocation()
    {
        throw new PendingException();
    }

    /**
     * @When I try to park my vehicle at this location
     */
    public function iTryToParkMyVehicleAtThisLocation()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be informed that my vehicle is already parked at this location
     */
    public function iShouldBeInformedThatMyVehicleIsAlreadyParkedAtThisLocation()
    {
        throw new PendingException();
    }

    /**
     * @When I register this vehicle into my fleet
     */
    public function iRegisterThisVehicleIntoMyFleet()
    {
        throw new PendingException();
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet()
    {
        throw new PendingException();
    }

    /**
     * @When I try to register this vehicle into my fleet
     */
    public function iTryToRegisterThisVehicleIntoMyFleet()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be informed this vehicle has already been registered into my fleet
     */
    public function iShouldBeInformedThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
    {
        throw new PendingException();
    }

    /**
     * @Given the fleet of another user
     */
    public function theFleetOfAnotherUser()
    {
        throw new PendingException();
    }

    /**
     * @Given this vehicle has been registered into the other user's fleet
     */
    public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet()
    {
        throw new PendingException();
    }
}
