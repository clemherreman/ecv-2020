<?php
require_once __DIR__.'/Personnage.php';
require_once __DIR__.'/Guerrier.php';
require_once __DIR__.'/Magicien.php';
require_once __DIR__.'/Zombie.php';
require_once __DIR__.'/Humain.php';
require_once __DIR__.'/Jeu.php';

$mike = new Guerrier('Mike');
$robert = new Zombie('Robert');
$gandalf = new Magicien('Gandalf');
$jean = new Humain('Jean');


$game = new Jeu();
$game->setAdversaire($robert, $gandalf);

$game->combattre();