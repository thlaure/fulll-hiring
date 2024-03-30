<?php

namespace Fulll\Domain;

use Fulll\Domain\Vehicle;

class Fleet
{
    private int $id;

    private array $vehicles;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->vehicles = [];
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): void
    {
        if ($this->hasVehicle($vehicle)) {
            throw new \Exception('Vehicle is already registered');
        }

        $this->vehicles[] = $vehicle;
    }

    public function hasVehicle(Vehicle $vehicle): bool
    {
        foreach ($this->vehicles as $registeredVehicle) {
            if ($registeredVehicle->getId() === $vehicle->getId()) {
                return true;
            }
        }

        return false;
    }
}
