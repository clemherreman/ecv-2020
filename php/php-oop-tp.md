# PHP OOP - TP

## Abstract

On souhaite developper un logiciel de gestion de bibliotheque. Pour cela, vous êtes missionné pour modéliser et écrire l'ensemble des classes qui constitueront le domaine métier de l'application. 

A partir du descriptif suivant du besoin du directeur de la bibliothèque :

1. Vous modéliserez les classes representant les différents aspects de la bibliothèque : livres, allées, clients, etc.
2. Vous écrirez des fichiers PHP utilisant ces classes, afin d'illustrer leur utilisation pour chaque cas concret fourni par le directeur de bibliothèque. **Ces fichiers doivent être executable via le CLI PHP \(en terminal\), et fournir un sortie texte.**

_Pour rappel, voici un exemple d'un de ces fichiers PHP d'illustration, tiré d'un cours précédent :_

```php
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

echo 'On roule !'.PHP_EOL;

$moto->rouler(1800);

// Après beaucoup de kilometre, les voyants s'allument : pneu fatigués, niveau d'essence bas, etc.
echo sprintf('Un voyant jaune est il allumé ? %s '.PHP_EOL, $moto->doitAllumerVoyantJaune() ? 'oui' : 'non');
```

{% hint style="info" %}
Le but de ces fichiers est de montrer comment s'utilisent les classes, comment leur instance s'initialisent, et de montrer clairement quelles méthodes servent à quoi, et pour quel but.

Plus cela est clair dans les exemples, meilleur sera la notation.
{% endhint %}

**Remarque** : le bibliothecaire, comme tous les clients, connait bien son metier, mais ne sait pas forcement clairement l'expliquer. Il est possible qu'il soit un peu ambigu, ou un peu vague. 

Dans ce cas, adaptez votre modelisation pour coller au mieux au besoin, ou pour gérer les différents cas possible. Dans ce cas, n'hésitez pas indiquer ces choix par autant de commentaires que necessaire au sein de vos classes ou de votre code.

_Comme tout travail d'ingenierie, il n'y a pas de solution unique, mais un ensemble de solutions possibles, amenant plus ou moins de compromis et de complexité._

## Descriptif du besoin

Notre bibliothèque est une médiathèque municipale : nous offrons en prêt à la fois des livres, des CDs et des DVDs. Chaque client peut louer 10 objets simultanément : maximum 7 livres, 5 CD et 3 DVD. 

Un client peut ramener ses objets quand il le souhaite, partiellement ou totalement, c'est à dire qu'il est possible d'emprunter 3 livres et 1 CD, de ramener ensuite 2 livres et d'emprunter un DVD, puis de ramener l'ensemble plus tard. Il est important de savoir à quel date chaque objet a été emprunté, car un **cas d'utilisation** courant est le suivant : tous les matins je souhaite avoir la liste de tous nos clients ayant en leur possession un objet emprunté depuis plus de 30j, cela afin de les contacter pour leur rappeler de nous le retourner.

Nous contactons nos clients via leur numero de téléphone ou par email. Si besoin, nous transmettons leur adresse postale au service recouvrement.

Une autre part importante de notre activité consiste à ranger, cartographier, indexer nos objets. Chaque objet est identifié de manière unique par un numero, précédé d'une lettre indiquant son type : L pour les livres, C pour les CD et D pour les DVDs. 

Pour chaque livre on connait ses auteurs. Idem pour les CD. Pour les DVDs, on connait son réalisateur, son casting d'acteurs, ainsi que son age minimum recommandé.

Chaque objet est rangé dans une zone : jeunesse, adulte, interactif. Un objet appartient toujours à la même zone, et ne peut être rangé que dans celle-ci. Chaque zone a son lot d'étagères : elles sont numérotées de A à Z, et contiennent chacune 4 à 8 étages, divisés en 5 à 15 casiers. Un exemple de localisation précise :

```text
Le livre L53675 se trouve en zone Jeunesse, emplacement A-4-12
C'est à dire rangée A, étage 4, casier 12.
```

Les casiers sont de différentes taille, suivant la hauteur de la rangée, et leur propre largeur. Ils peuvent contenir un nombre maximal d'objet.

Afin de pouvoir être efficace dans le rangement, il est important pour nous d'avoir le **cas d'utilisation** suivant : un client venant de ramener un ensemble d'objets, le système doit pouvoir proposer automatiquement 1 à 3 casiers permettant de ranger chaque objet, dans la bonne zone. Si aucun casier n'est disponible, il doit immediatement en informer le bibliothecaire, qui trouvera tout seul une solution alternative.

Cela m'amène à une autre part cruciale de notre activité : les abonnements. Chaque client s'abonne afin de beneficier des services de la médiathèque. Pour cela, il choisit s'il s'abonne pour 1 an, 2 ans ou 3 ans. 

| Durée | Prix \(en euro / an\) |
| :--- | :--- |
| 1 an | 130e |
| 2 ans | 120e |
| 3 ans | 100e |

Pour s'abonner, il choisit son moyen de paiement : carte bleu, cheque ou exoneration.

En cas de paiement par carte bleu, l'abonnement est validé de suite. Par cheque, on applique un delai de 15j avant de valider manuellement son abonnement, afin d'attendre l'encaissement du cheque.

L'exoneration est particulier. Dans ce cas, le client ne paie rien, son abonnement est pris en charge par la mairie. Pour cela il doit fournir 2 justificatifs parmi les suivants, au format PDF :

* Attestation sur l'honneur
* Declaration de revenu
* Livret de famille indiquant qu'il a plus de 3 enfants
* Preuve de domiciliation

Il est possible pour chaque client de parrainer un autre client : dans ce cas on appliquera un rabais de 20% sur le coût total du client parrainé. Pour cela, le client parrainé doit fournir un code unique de parrainage, propre au compte client de son parrain.

Tous les jours, un préposé à la clientèle est confronté au **cas d'utilisation** suivant : il a besoin de consulter la liste de tous les clients à contacter pour une raison ou une autre :

* Un client a son abonnement qui va bientôt expirer dans moins de 3 semaines
* Un client a payé par chèque, mais celui-ci a été rejeté par la banque
* Un client est exonéré, mais n'a pas encore fournit tous les documents permettant de valider son abonnement

Enfin, dernière part de nos responsabilité : les statistiques d'utilisation. C'est un **cas d'utilisation** concret nous permettant d'aiguiller nos choix d'achat d'objets, afin d'optimiser la satisfaction de nos clients

Le but est de pouvoir connaitre :

* quels objets ont été prétés le plus de fois pour une année donnée
* quels objets ont passé le plus de temps à l'intérieur de la médiathèque, ainsi que ceux qui ont passé le plus de temps à l'exterieur de la médiathèque
* quel est l'auteur le plus présent dans notre bibliothèque, afin de pouvoir l'inviter a une séance de dédicace
* quel client a été le plus assidu, et à emprunté le plus de chaque type d'objet au cours de l'année, afin de leur offrir une copie de cet objet pour chez eux.

## Notation

| Critère | Part de la notation |
| :--- | :--- |
| Modélisation des classes correcte, répondant aux besoins du bibliothécaire | 50% |
| Code clair, indenté, commenté, lisible | 15% |
| Cas d'utilisation concrets, compréhensible, fonctionnant en CLI sans erreur | 15% |
| Utilisation au maximum de classe, d'objets. Très peu \(quelques lignes\) de code en dehors de classes, même dans les exemples de cas d'utilisation. | 10% |
| Maitrise de la POO : encapsulation au maximum, portées des attributs et méthodes correctes, accesseur uniquement quand/si necessaires. | 10% |

