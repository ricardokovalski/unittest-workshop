<?php

namespace src\CarInterfaces;


class SpyingElectronics extends Electronics
{
    private $brakingPower;

    public function pushBrakes($brakingPower)
    {
        $this->brakingPower = $brakingPower;
    }

    public function getBrakingPower()
    {
        return $this->brakingPower;
    }
}