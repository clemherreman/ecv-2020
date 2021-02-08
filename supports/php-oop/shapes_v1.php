<?php

require_once(__DIR__.'/Rectangle.php');
require_once(__DIR__.'/Cercle.php');
//require_once(__DIR__.'/ShapePrinter.php');

$c1 = new Circle(rand(1, 20));
$c2 = new Circle(rand(1, 20));
$c3 = new Circle(rand(1, 20));
$r1 = new Rectangle(rand(1, 20), rand(1, 20));
$r2 = new Rectangle(rand(1, 20), rand(1, 20));
$r3 = new Rectangle(rand(1, 20), rand(1, 20));

$shapes = [
    $c1, $c2, $c3,
    $r1, $r2, $r3
];

foreach ($shapes as $shape) {
    echo sprintf('Perimetre: ~ %0.2f', $shape->calculPerimetre()). PHP_EOL;
    echo sprintf('Aire: ~ %0.2f', $shape->calculAire()). PHP_EOL;
}

//$printer = new ShapePrinter();
//foreach ($shapes as $shape) {
//    echo $printer->printShape($shape);
//}