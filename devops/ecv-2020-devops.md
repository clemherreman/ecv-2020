# ECV 2020 - Devops

## Objectif en fin de journée

A partir d'un serveur tout neuf, pouvoir y héberger votre site PHP, avec sa base de données.

### Prérequis

1. Installer [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
2. Télécharger l'image Debian déjà faite.

### Sommaire

1. Qu'est ce qu'un système Linux \(ici Debian\), avoir une "grande image" de comment ça tourne.
2. Faire connaissance avec le terminal et la ligne de commande
   1. Commandes de base
   2. Architecture des dossiers
   3. Editer et manipuler des fichiers, les permissions
   4. Commandes un peu plus complexes, le pipe !
3. Le cycle de vie d'une requête HTTP
   1. Anatomie d'une requête et d'une réponse HTTP
   2. Stack Nginx -&gt; PHP-FPM -&gt; MySQL
4. Installer ce qu'il faut
   1. Gestionnaire de package \(ici apt\).
   2. Installer Nginx
      1. Configurer un virtual host
   3. Installer PHP & FPM
      1. Différence configuration FPM & CLI
   4. Installer MySQL
5. Avoir son site qui tourne !
   1. Comment le joindre, via quel nom de domaine / IP ?
6. Aller plus loin...



