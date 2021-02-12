<?php


class Moteur
{
    /**
     * @var int|null
     */
    private ?int $cyclindree;
    private Carburant $carburant;
    private bool $estAllume;

    private Sonde $sondeChaleur;

    public function __construct(Carburant $carburant, Sonde $sondeChaleur)
    {
        $this->carburant = $carburant;
        $this->estAllume = false;
        $this->sondeChaleur = $sondeChaleur;
    }

    public function getCyclindree(): ?int
    {
        return $this->cyclindree;
    }

    public function setCyclindree(?int $cyclindree)
    {
        $this->cyclindree = $cyclindree;
    }

    public function getCarburant(): Carburant
    {
        return $this->carburant;
    }

    public function demarrer()
    {
        if ($this->sondeChaleur->suffisamentFroide()) {
            $this->estAllume = true;
        }
    }

    public function eteindre()
    {
        $this->estAllume = false;
    }

    public function tourne(): bool
    {
        return $this->estAllume;
    }

    public function tournerPendant(int $minutes) {
        $this->sondeChaleur->tourne($minutes);
        $this->usure += $minutes / 120000;
    }
}