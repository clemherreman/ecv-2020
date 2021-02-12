<?php


abstract class Vehicule
{
     protected string $couleur;

    /**
     * @var float Poids en kilo.
     */
    protected float $poids;

    public function __construct(string $numUnique)
    {
        if (!$this->checkNumUnique($numUnique)) {
            throw new \Exception('Invalid unique number');
        }

        $this->numUnique = $numUnique;
    }

    private function checkNumUnique(string $numUnique): bool
    {
        return strlen($numUnique) === 13;
    }

    public function getNumUnique(): string
    {
        return $this->numUnique;
    }
    public function getEtiquetteVente(): string
    {
        $label = sprintf(
            'Vehicule, de couleur %s',
            $this->couleur // Possible car "couleur" appartient a la classe Vehicule
        );

        return $label;
    }

    abstract public function getNombreRoues(): int;

    abstract public function avancer();
}