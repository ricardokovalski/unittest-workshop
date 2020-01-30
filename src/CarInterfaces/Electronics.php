<?php
namespace src\CarInterfaces;

class Electronics
{
    public function turnOn(Lights $lights) {}

    public function accelerate() {}

    public function pushBrakes($brakingPower) {}
}