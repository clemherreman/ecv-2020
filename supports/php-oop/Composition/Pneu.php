<?php


class Pneu
{
    private string $marque;
    private string $taille;

    /**
     * @var int Indice d'usure, entre 100 (neuf) et 0 (mort).
     */
    private int $usure;

    public function __construct(string $marque, string $taille = '22"')
    {
        $this->marque = $marque;
        $this->taille = $taille;
        $this->usure = 100;
    }

    public function estUse(): bool
    {
        return $this->usure < 30;
    }

    public function peutRouler(): bool
    {
        return $this->usure > 5;
    }

    public function getMarque(): string
    {
        return $this->marque;
    }

    public function getTaille(): string
    {
        return $this->taille;
    }


    public function user(int $kms)
    {
        $this->usure -= $kms / 100; // Un pneu = 10 000km
    }
}
//
//class PneuCross extends Pneu
//{
//    public function user(int $kms)
//    {
//        $this->usure -= ($kms / 10) * $this->age; // Un pneu = 10 000km
//    }
//}