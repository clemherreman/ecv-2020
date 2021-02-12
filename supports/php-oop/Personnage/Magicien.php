<?php

require_once __DIR__.'/Personnage.php';

class Magicien implements Personnage
{
    private int $hp;
    private int $mana;
    private string $name;
    public function __construct(string $name, int $hp = 8)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->mana = random_int(3, 5);
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function attack(Personnage $ennemi): int
    {
        $mana_cost = random_int(1, 2);
        if ($this->mana >= $mana_cost) {
            $damage = random_int(4, 6);
            $this->removeMana($mana_cost);
            $ennemi->removeHp($damage);
            return $damage;
        }
        $ennemi->removeHp(1);
        return 1;
    }
    public function removeHp(int $hpLost)
    {
        if ($this->hp - $hpLost <= 0 && $this->getName() === 'Gandalf') {
            $this->name = 'Gandalf Le Blanc';
            $this->hp = 16;
            $this->mana = random_int(3, 5);
        } else {
            $newHp = $this->hp - $hpLost;
            $this->hp = max(-15, $newHp);
        }
    }
    public function removeMana(int $manaLost)
    {
        $this->mana -= $manaLost;
    }
    public function isDead(): bool
    {
        return $this->hp <= 0;
    }
}
