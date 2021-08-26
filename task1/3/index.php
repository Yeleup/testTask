<?php

interface Shipping
{
    public function calculate($weight): float;
}

class KazPost implements Shipping
{

    public function calculate($weight): float
    {
        if ($weight < 10) {
            return 100;
        }

        return 1000;
    }
}

class DHL implements Shipping
{

    public function calculate($weight): float
    {
        return $weight * 100;
    }
}

class X
{
    private $shipping;
    private $weight;


    public function __construct(Shipping $shipping, float $weight)
    {
        $this->shipping = $shipping;
        $this->weight = $weight;
    }

    public function getShippingPrice()
    {
        return $this->shipping->calculate($this->weight);
    }
}

$weight = 2;
$company = new X(new KazPost, $weight);

echo 'KazPost<br>';
echo $company->getShippingPrice();
echo '<br>';


$company = new X(new DHL, $weight);

echo 'DHL<br>';
echo $company->getShippingPrice();
echo '<br>';

