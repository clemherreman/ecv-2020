<?php

require_once(__DIR__.'/CliShapePrinter.php');
require_once(__DIR__.'/HtmlShapePrinter.php');
require_once(__DIR__.'/ShapePrinterInterface.php');


class PrinterFactory
{
    public function buildPrinter(): ShapePrinterInterface
    {
        if (php_sapi_name() == "cli") {
            // In cli-mode
            $printer = new CliShapePrinter();
        } else {
            // Not in cli-mode
            $printer = new HtmlShapePrinter();
        }

        return $printer;
    }
}