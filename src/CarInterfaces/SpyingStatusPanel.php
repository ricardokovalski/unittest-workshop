<?php
namespace src\CarInterfaces;

class SpyingStatusPanel extends StatusPanel
{
    private $speedWasRequested = false;
    private $currentSpeed = 1;

    public function getSpeed()
    {
        if ($this->speedWasRequested) {
            $this->currentSpeed = 0;
        }
        $this->speedWasRequested = true;
        return $this->currentSpeed;
    }

    public function speedWasRequested()
    {
        return $this->speedWasRequested;
    }

    public function spyOnSpeed()
    {
        return $this->currentSpeed;
    }
}