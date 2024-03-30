<?php

namespace Fulll\Domain;

use Fulll\Domain\Location;

class Vehicle
{
    private Location $location = null;
    
    public function __construct(private int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }
}
