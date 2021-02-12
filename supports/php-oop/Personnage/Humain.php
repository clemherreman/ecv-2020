<?php

require_once __DIR__.'/Personnage.php';

class Humain implements Personnage
{
    private int $hp;
    private string $name;
    public function __construct(string $name, int $hp = 10)
    {
        $this->name = $name;
        if ($this->getName() === "Jean-Pierre") {
            $this->hp = 15;
        } else {
            $this->hp = $hp;
        }
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function attack(Personnage $ennemi): int
    {
        $ennemi->removeHp(3);
        return 3;
    }
    public function removeHp(int $hpLost)
    {
        $newHp = $this->hp - $hpLost;
        $this->hp = max(-15, $newHp);
    }
    public function isDead(): bool
    {
        return $this->hp <= 0;
    }
}