<?php

require_once(__DIR__.'/Interfaces/Shape.php');

class Rectangle implements Shape
{
    private float $long;
    private float $larg;

    public function __construct(float $long, float $larg)
    {
        $this->long = $long;
        $this->larg = $larg;
    }

    public function calculPerimetre(): float
    {
        return ($this->long + $this->larg) * 2;
    }

    public function calculAire(): float
    {
        return $this->long * $this->larg;
    }
}


//echo "Rectangle 4x5".PHP_EOL;
//$rec = new Rectangle(4, 5);
//echo "Perimetre: " . $rec->calculPerimetre(). PHP_EOL;
//echo "Aire: " . $rec->calculAire(). PHP_EOL;
