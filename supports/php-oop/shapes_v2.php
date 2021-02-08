<?php

require_once(__DIR__.'/Rectangle.php');
require_once(__DIR__.'/Cercle.php');
require_once(__DIR__.'/SimpleShapePrinter.php');
require_once(__DIR__.'/Printer/CliShapePrinter.php');
require_once(__DIR__.'/Printer/HtmlShapePrinter.php');
require_once(__DIR__.'/Printer/PrinterFactory.php');

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


if (php_sapi_name() == "cli") {
    // In cli-mode
    $printer = new CliShapePrinter();
} else {
    // Not in cli-mode
    $printer = new HtmlShapePrinter();
}

$printerFactory = new PrinterFactory();
$printer = $printerFactory->buildPrinter();


foreach ($shapes as $shape) {
    echo $printer->printShape($shape);
}