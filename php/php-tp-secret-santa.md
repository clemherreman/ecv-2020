# PHP - TP Secret Santa

## But

Créer une petite application web qui vous permettra d'organiser un Secret Santa avec vos amis.

Pour rappel, un Secret Santa consiste, pour chaque personne dans un groupe de gens, à offrir un cadeau à un autre membre du groupe, ce dernier de sachant pas qui va lui offrir un cadeau. 

Typiquement le tirage au sort est fait par une personne, à l'abri du regard des autres. Celle-ci donne alors à chaque participant le nom de celui ou celle à qui offrir un cadeau.

## Déroulé de notre future application

De manière plus pratique et technique, notre Secret Santa se déroule de la manière suivante :

* Alice va sur `/new-santa.php`

  Elle y remplit un court formulaire, en donnant son nom et son email \(et eventuellement un nom personnalisé pour son groupe\)

* **Un nouveau groupe est créé en DB**. Alice obtient un lien unique qu'elle peut partager avec ses amis : `/inscription.php?id_group=1a5g3ht6f3`
* Bob et Carol reçoivent le lien de la part d'Alice. Sur cette page, il peuvent saisir leur nom et leur email, **afin de s'inscrire.**
* Une fois que tout ses amis son bien inscrits, Alice peut aller sur la page d'administration de son groupe, `/admin.php?id_group=1a5g3ht6f3`

  Sur cette page, elle peut **marquer le groupe comme "complet", via un bouton**.

* Lorsque le groupe est marqué comme complet, l'application web decide aléatoirement qui va offrir un cadeau à qui.

{% hint style="danger" %}
Attention : une personne ne peut pas s'offrir un cadeau à elle même.
{% endhint %}

{% hint style="success" %}
**Bonus :** Vous pouvez faire en sorte qu'il n'y ait pas de "couple", par exemple si Dave offre un cadeau à Eve, faites en sorte que Eve n'offre pas de cadeau à Dave, dans la mesure du possible \(sauf si le groupe n'est composé que de 2 personnes bien sur..\)
{% endhint %}

* Alice voit donc la liste des personnes inscrites, et pour chacun, le destinataire de son cadeau. E.g

  | Faiseur de cadeau | Receveur de cadeau |
  | :--- | :--- |
  | Alice | Carol |
  | Bob | Alice |
  | Carol | Eve |
  | Dave | Bob |
  | Eve | Dave |

  Alice pourra ensuite prévenir tout le monde par le moyen de son choix.

{% hint style="success" %}
**Bonus :** Chaque participant ayant saisi son email, Alice pourrait cliquer sur un bouton, et envoyer automatiquement à chaque participant un email, contenant le nom de la personne à qui offrir un cadeau.
{% endhint %}

## Résumé

### Pages

* new-santa.php
* inscription.php
* admin.php

### Actions

* Créer un nouveau groupe
* S'inscrire à un nouveau groupe
* Marquer un groupe comme complet

### Points d'attention

* Utiliser PDO pour tout dialogue avec la DB, et s'assurer de la sécurité des requêtes exécutée, notamment via à vis des injections SQL \(cf [PHP 102](php-102.md#bien-utiliser-des-requetes-preparees)\) 
* S'assurer que le numéro unique désignant un groupe est aléatoire, e.g. 1a5g3ht6f3 pour éviter que des petits malins viennent embêter les autres groupes de Santa
* Prenez le temps de réfléchir à la structure des tables et des données avant d'écrire la première ligne de code. 
  * De quelles tables ai-je besoin ? 
  * Quelles données appartiennent à quelle table ? 
  * Quelles sont les relations entre mes tables ?
* Comment relier un participant à un autre participant ? _Hint: cela s'appelle une relation reflexive._
* Vous avez tous le niveau et les connaissances, via vos cours précédents, pour réussir complètement ce TP :\)

