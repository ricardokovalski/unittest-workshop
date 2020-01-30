<?php

use src\CarInterfaces\CarController;
use src\CarInterfaces\Electronics;
use src\CarInterfaces\Engine;
use src\CarInterfaces\Gearbox;
use src\CarInterfaces\SpyingElectronics;
use src\CarInterfaces\SpyingStatusPanel;
use PHPUnit\Framework\TestCase;

class CarControlTest extends TestCase
{
    public function testItCanGetReadyTheCar()
    {
        $carController = new CarController();

        $engine = new Engine();
        $gearbox = new Gearbox();
        $electornics = new Electronics();

        $dummyLights = $this->getMock('src\CarInterfaces\Lights');

        $this->assertTrue($carController->getReadyToGo($engine, $gearbox, $electornics, $dummyLights));
    }

    function testItCanAccelerate()
    {
        $carController = new CarController();

        $electronics = $this->getMock('src\CarInterfaces\Electronics');
        $electronics->expects($this->once())->method('accelerate');
        //$electronics->expects($this->exactly(2))->method('accelerate');


        $stubStatusPanel = $this->getMock('src\CarInterfaces\StatusPanel');

        $stubStatusPanel->expects($this->any())->method('thereIsEnoughFuel')->will($this->returnValue(TRUE));
        $stubStatusPanel->expects($this->any())->method('engineIsRunning')->will($this->returnValue(TRUE));

        $carController->goForward($electronics, $stubStatusPanel);
    }

    public function testItCanStop()
    {
        $halfBrakingPower = 50;
        $electronicsSpy = new SpyingElectronics();
        $statusPanelSpy = new SpyingStatusPanel();

        $carController = new CarController();
        $carController->stop($halfBrakingPower, $electronicsSpy, $statusPanelSpy);

        $this->assertEquals($halfBrakingPower, $electronicsSpy->getBrakingPower());
        $this->assertTrue($statusPanelSpy->speedWasRequested());
        $this->assertEquals(0, $statusPanelSpy->spyOnSpeed(),
            'Velocidade deveria ser 0 (zero) depois de parar, mas atualmente é ' . $statusPanelSpy->spyOnSpeed());
    }

    function testItCanStopWithMock()
    {
        $halfBrakingPower = 50;
        $electronicsSpy = $this->getMock('src\CarInterfaces\Electronics');
        $electronicsSpy->expects($this->exactly(2))->method('pushBrakes')->with($halfBrakingPower);
        $statusPanelSpy = $this->getMock('src\CarInterfaces\StatusPanel');
        $statusPanelSpy->expects($this->at(0))->method('getSpeed')->will($this->returnValue(0));
        $statusPanelSpy->expects($this->at(1))->method('getSpeed')->will($this->returnValue(1));

        $carController = new CarController();
        $carController->stop($halfBrakingPower, $electronicsSpy, $statusPanelSpy);
    }
}