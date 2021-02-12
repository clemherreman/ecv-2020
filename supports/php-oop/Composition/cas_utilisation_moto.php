<?php

require_once __DIR__.'/Pneu.php';
require_once __DIR__.'/Moteur.php';
require_once __DIR__.'/Moto.php';
require_once __DIR__.'/Carburant.php';

$pneu1 = new Pneu('Michelin');
$pneu2 = new Pneu('Goodyear');

$moteur = new Moteur(new Carburant(Carburant::GAZOLE));

$moto = new Moto($moteur, $pneu1, $pneu2);

$moto->demarrer();

echo sprintf('La moto peut rouler ? %s '.PHP_EOL, $moto->peutRouler() ? 'oui' : 'non');
echo sprintf('Un voyant jaune est il allumé ? %s '.PHP_EOL, $moto->doitAllumerVoyantJaune() ? 'oui' : 'non');

// Pas de soucis, la moto roule bien

$kms = 100;
$moto->rouler($kms);
echo sprintf('On roule %s km !'.PHP_EOL, $kms);

$kms = 100;
$moto->rouler($kms);
echo sprintf('On roule %s km !'.PHP_EOL, $kms);

$kms = 100;
$moto->rouler($kms);
echo sprintf('On roule %s km !'.PHP_EOL, $kms);

$kms = 1600;
$moto->rouler($kms);
echo sprintf('On roule %s km !'.PHP_EOL, $kms);


// Après beaucoup de kilometre, les voyants s'allument : pneu fatigués, niveau d'essence bas, etc.
echo sprintf('Un voyant jaune est il allumé ? %s '.PHP_EOL, $moto->doitAllumerVoyantJaune() ? 'oui' : 'non');

