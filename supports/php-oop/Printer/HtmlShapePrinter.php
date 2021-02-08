<?php

require_once(__DIR__.'/../Interfaces/Shape.php');
require_once(__DIR__.'/ShapePrinterInterface.php');

class HtmlShapePrinter implements ShapePrinterInterface
{
    public function printShape(Shape $shape): string
    {
        $class = get_class($shape);

        $html =  <<<HTML
<p>$class</p>
<p>
    Perimetre : {$shape->calculPerimetre()} <br />
    Aire : {$shape->calculAire()}
</p>
HTML;

        return $html;
    }
}