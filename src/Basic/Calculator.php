<?php
namespace src\Basic;

class Calculator
{
    /**
     * Função responsável por multiplicar elementos de um array
     */
    public function total_multiplication(array $items = [], $discount)
    {
        if ($discount > 1.00) {
            throw new \Exception('Desconto precisa ser maior que 1.00');
        }

        $product = array_product($items);
        if (! is_null($discount)) {
            return $product - ($product * $discount);
        }
        return $product;
    }

    public function convertDollarToReal($dollarAmount, $conversionFactor)
    {
        return ($dollarAmount * $conversionFactor);
    }

    /**
     * Função para somar duas moedas
     */
    public function calculateCoinSum(Coin $coin1, Coin $coin2){
        return $coin1->getCoinvalue() + $coin2->getCoinvalue();
    }
}