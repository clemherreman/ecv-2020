<?php

require_once __DIR__.'/Personnage.php';

class Guerrier implements Personnage
{
    private int $hp;
    private string $name;
    public function __construct(string $name, int $hp = 17)
    {
        $this->name = $name;
        $this->hp = $hp;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function attack(Personnage $ennemi): int
    {
        $damage = random_int(2, 5);
        $self_damage = random_int(1, 5);
        if ($self_damage === 1) {
            $this->removeHp(1);
        }
        $ennemi->removeHp($damage);
        return $damage;
    }
    public function removeHp(int $hpLost)
    {
        $last_chance = random_int(1, 5);
        if ($last_chance === 1 && $this->hp - $hpLost <= 0) {
            $this->hp = 1;
        } else {
            $newHp = $this->hp - $hpLost;
            $this->hp = max(-15, $newHp);
        }
    }
    public function isDead(): bool
    {
        return $this->hp <= 0;
    }
}
