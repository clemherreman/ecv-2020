<?php


class Moto
{
    private string $couleur;

    private Moteur $moteur;

    private Pneu $pneuAvant;
    private Pneu $pneuArriere;

    /**
     * @var int Jauge d'essence. 100 = plein, 0 = vide.
     */
    private int $niveauCarburant = 100;

    public function __construct(Moteur $moteur, Pneu $pneuAvant, Pneu $pneuArriere)
    {
        $this->moteur = $moteur;
        $this->pneuAvant = $pneuAvant;
        $this->pneuArriere = $pneuArriere;
    }

    public function demarrer()
    {
        $this->moteur->demarrer();
    }

    public function rouler(int $kms)
    {
        $this->niveauCarburant -= $kms / 100 * 5; // 5L pour 100km
        $this->pneuAvant->user($kms);
        $this->pneuArriere->user($kms);
    }

    public function peutRouler()
    {
        return $this->moteur->tourne()
            && $this->niveauCarburant > 0
            && $this->pneuAvant->peutRouler()
            && $this->pneuArriere->peutRouler();
    }

    public function doitAllumerVoyantJaune(): bool
    {
        return $this->niveauCarburant < 20
            || $this->pneuArriere->estUse()
            || $this->pneuAvant->estUse();
    }
}