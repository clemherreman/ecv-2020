<?php


interface Personnage
{
    /**
     * Retourne le nom du personnage.
     */
    public function getName(): string;

    /**
     * Attaque un ennemi. Change les hp de l'ennemi en fonction de la réussite de l'attaque.
     */
    public function attack(Personnage $ennemi);

    /**
     * Enleve des points de vie d'un Personnage.
     * Les hp d'un Personnage peuvent devenir négatifs, mais ne peuvent être
     * inférieurs a -15.
     *
     * @param int $hpLost Number of Hp lost
     */
    public function removeHp(int $hpLost);

    /**
     * Indique si un Personnage est mort.
     */
    public function isDead(): bool;
}

