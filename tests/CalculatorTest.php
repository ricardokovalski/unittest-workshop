<?php

use PHPUnit\Framework\TestCase;
use src\Basic\Calculator;

class CalculatorTest extends TestCase
{
    public function setUp()
    {
        $this->calculator = new Calculator();
    }
    public function tearDown()
    {
        unset($this->calculator);
    }
    /**
     * Validar obrigatoriedade de parâmetros em outras versões do PHP
     */
    public function testTotalMultiplication()
    {
        $discount = null;
        $result = $this->calculator->total_multiplication([2,5,3], $discount);
        $this->assertEquals(30, $result,'O valor deve ser igual à 30');
    }

    public function testConvertDollarToReal()
    {
        $dollarAmount = 10.00;
        $conversionFactor = 3.17;
        $output = $this->calculator->convertDollarToReal($dollarAmount, $conversionFactor);
        $this->assertEquals(31.7, $output,'O valor deve ser igual à 31.7');
    }

    public function testTotalMultiplicationWithDiscount()
    {
        $discount = 0.20;
        $result = $this->calculator->total_multiplication([2,5,3], $discount);
        $this->assertEquals(
            24,
            $result,
            'Quando somados o total deve ser 24'
        );
    }

    public function testMultiplyAndConvertStub() {
        //cria o stub
        $calculator = $this->getMockBuilder('src\Basic\Calculator')->getMock();

        //diz o que o metodo vai retornar
        $calculator->expects($this->once())->method('total_multiplication')->will($this->returnValue(10.00));

        //diz o que o metodo vai retornar
        $calculator->expects($this->once())->method('convertDollarToReal')->will($this->returnValue(1.00));

        $this->assertEquals(10.00, $calculator->total_multiplication([2,5,3], null));
        $this->assertEquals(1.00, $calculator->convertDollarToReal(10.00, 3.17));
    }

    public function testCalculateCoinSum(){

        $coin1 = $this->getMockBuilder('src\Basic\Coin')
            ->getMock();                                              //cria o mock do coin

        $coin1->expects($this->once())                                // diz que será chamado 1 vez
            ->method('getCoinValue')                                  // o metodo que será sobrescrito
            ->will($this->returnValue(17.00));                  // o valor fixo que retornará

        $coin2 = $this->getMockBuilder('src\Basic\Coin')        // => cria o mock do coin 2
            ->getMock();

        $coin2->expects($this->once())                                // diz que será chamado 1 vez
            ->method('getCoinValue')                                  // o metodo que será sobrescrito
            ->will($this->returnValue(13.00));                  // o valor fixo que retornará

        $output = $this->calculator->calculateCoinSum($coin1, $coin2);

        $this->assertEquals(30.00, $output);
    }

    /**
     *  @dataProvider provideTotal
     */
    public function testTotalMultiplicationWithDataProvider($items, $expected)
    {
        $discount = null;
        $result = $this->calculator->total_multiplication($items, $discount);
        $this->assertEquals($expected, $result);
    }

    public function provideTotal()
    {
        // items[], expected
        return [
            [[1,2,5,8], 80],
            [[-1,2,5,8], -80],
            [[1,2,8], 16],
        ];
    }

    /**
     * @expectedException     \Exception
     */
    public function testTotaException()
    {
        $discount = 1.20;
        //$this->expectException('Exception'); PHPUNIT > 5.7.6
        $this->calculator->total_multiplication([2,5,3], $discount);
    }
}