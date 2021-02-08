<?php

require_once(__DIR__.'/../Interfaces/Shape.php');
require_once(__DIR__.'/ShapePrinterInterface.php');

class CliShapePrinter implements ShapePrinterInterface
{
    public function printShape(Shape $shape): string
    {
        return sprintf(
            '%s - Perimetre: ~ %0.2f, Aire: ~ %0.2f'.PHP_EOL,
            get_class($shape),
            $shape->calculPerimetre(),
            $shape->calculAire()
        );
    }
}