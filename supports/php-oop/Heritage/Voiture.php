<?php



class Voiture extends Vehicule
{
    /**
     * @var int Cyclindrée, en chevaux
     */
    private int $cylindree;

    public function __construct(string $numUnique, int $cylindree)
    {
        parent::__construct($numUnique);
        $this->cylindree = $cylindree;
    }

    public function getCylindree(): int
    {
        return $this->cylindree;
    }

    public function getEtiquetteVente(): string
    {
        $label = sprintf(
            'Voiture, %d cm3 pour %s kg, de couleur %s',
            $this->cylindree, // Possible car "cylindrée" appartient a la classe Voiture

            $this->poids,     // Possible car "couleur" appartient à Vehicule (dont herite Voiture)
            $this->couleur    //     et car "couleur" est protected, et non pas private.
        );

//        $numUnique = $this->numUnique; // Impossible, car numUnique est private.
        $numUnique = $this->getNumUnique(); // On passe par un accesseur

        return $label;
    }

    public function getNombreRoues(): int
    {
        return 4;
    }

    public function avancer()
    {
        // Allumer le moteur, passer la 1ere, etc.
    }
}