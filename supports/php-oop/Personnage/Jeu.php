<?php

require_once __DIR__.'/Personnage.php';


class Jeu
{
    /**
     * @var Personnage
     */
    private $adv1;

    /**
     * @var Personnage
     */
    private $adv2;

    public function setAdversaire(Personnage $adv1, Personnage $adv2)
    {
        $this->adv1 = $adv1;
        $this->adv2 = $adv2;
    }

    public function combattre()
    {
        $i = 1;
        while(!$this->adv1->isDead() && !$this->adv2->isDead())
        {
            echo 'Tour '.$i.PHP_EOL;
            $dmg = $this->adv1->attack($this->adv2);

            echo sprintf(
                '%s a infligé %d dmg à %s'.PHP_EOL,
                $this->adv1->getName(),
                $dmg,
                $this->adv2->getName()
            );

            $dmg = $this->adv2->attack($this->adv1);

            echo sprintf(
                '%s a infligé %d dmg à %s'.PHP_EOL,
                $this->adv2->getName(),
                $dmg,
                $this->adv1->getName()
            );

            echo sprintf(
                '%s: %s | %s: %s'.PHP_EOL,
                $this->adv1->getName(),
                $this->adv1->isDead() ? 'mort' : 'vivant',
                $this->adv2->getName(),
                $this->adv2->isDead() ? 'mort' : 'vivant'
            );

            echo PHP_EOL.PHP_EOL;
            $i++;
        }

        $advMort = $this->adv1->isDead() ? $this->adv1 : $this->adv2;

        echo sprintf('%s est mort !'.PHP_EOL, $advMort->getName());
    }
}