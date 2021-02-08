<?php


class SimpleShapePrinter
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