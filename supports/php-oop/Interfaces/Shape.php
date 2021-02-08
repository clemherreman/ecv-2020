<?php

interface Shape
{
    /**
     * Calcule le perimetre de la forme
     *
     * @return float
     */
    public function calculPerimetre(): float;

    /**
     * Calcule l'aire de la forme
     *
     * @return float
     */
    public function calculAire(): float;
}