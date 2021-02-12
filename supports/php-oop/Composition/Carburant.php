<?php


class Carburant
{
    public const SP98 = 'sp98';
    public const GAZOLE = 'diesel';

    private string $nom;

    public function __construct(string $nom)
    {
        if ($nom !== self::SP98 && $nom !== self::GAZOLE) {
            throw new Exception('Carburant inconnu');
        }

        $this->nom = $nom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
}