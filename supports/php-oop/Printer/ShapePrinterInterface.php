<?php

require_once(__DIR__.'/../Interfaces/Shape.php');

interface ShapePrinterInterface
{
    /**
     * Return a formatted string, containing all the information about a Shape :
     *   - Name/nature
     *   - Area
     *   - Perimeter
     *
     * @param Shape $shape
     * @return string
     */
    public function printShape(Shape $shape): string;
}