<?php

require_once __DIR__.'/Personnage.php';

class Zombie implements Personnage
{
    private int $hp;
    private string $name;
    private bool $hasBrain;
    public function __construct(string $name, int $hp = 8)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->hasBrain = true;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function attack(Personnage $ennemi): int
    {
        $damage = random_int(1, 3);
        $this->addHp(floor($damage / 2));
        $ennemi->removeHp($damage);
        return $damage;
    }
    public function addHp(int $hpGained)
    {
        $this->hp += $hpGained;
    }
    public function removeHp(int $hpLost)
    {
        $newHp = $this->hp - $hpLost;
        $this->hp = max(-15, $newHp);
        if ($this->hp <= -5) {
            $lose_brain = random_int(0, 1);
            if ($lose_brain) {
                $this->hasBrain = false;
            }
        }
    }
    public function isDead(): bool
    {
        return $this->hp <= -15 || $this->hasBrain === false;
    }
}