<?php

require_once(__DIR__.'/Interfaces/Shape.php');

class Circle implements Shape
{
    private float $r;

    public function __construct(float $rayon)
    {
        $this->r = $rayon;
    }

    public function calculPerimetre(): float
    {
        return 2 * pi() * $this->r;
    }

    public function calculAire(): float
    {
        return pi() * ($this->r ** 2);
    }
}

//echo 'Cercle r=3'.PHP_EOL;
//$cercle = new Circle(3);
//
//echo 'Perimetre: ' . $cercle->calculPerimetre(). PHP_EOL;
//echo 'Aire: ' . $cercle->calculAire(). PHP_EOL;
//
//// Format with less number after the coma
//echo sprintf('Perimetre: ~ %0.2f', $cercle->calculPerimetre()). PHP_EOL;
//echo sprintf('Aire: ~ %0.2f', $cercle->calculAire()). PHP_EOL;

