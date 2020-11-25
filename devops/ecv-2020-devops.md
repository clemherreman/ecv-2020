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

## Installer sa machine virtuelle

{% hint style="info" %}
Ici c'est plutôt "importer sa machine virtuelle". Je vous fournis une image déjà existante.
{% endhint %}

### Etape 1 : importer dans Virtualbox

![Cliquer sur &quot;Import&quot;](../.gitbook/assets/image%20%281%29.png)

![Choisir le fichier .ova pr&#xE9;c&#xE9;demment t&#xE9;l&#xE9;charg&#xE9;](../.gitbook/assets/image%20%282%29.png)

![Suivant les capacit&#xE9; de votre machine, vous pouvez changer la RAM et le nombre de CPU pour l&apos;&#xE9;mulation.](../.gitbook/assets/image%20%283%29.png)

Suivant les capacité de votre machine, vous pouvez changer la RAM et le nombre de CPU pour l'émulation.

{% hint style="info" %}
Je recommande à minima 1024MB, et 2048MB pour être plus tranquille. Idem pour les CPU : 1 à minima, 2 ou 3 pour être tranquille.
{% endhint %}

L'import se fait ensuite et peut prendre quelques minutes. La machine importée apparaît ensuite dans la liste des machines de Virtualbox.

![](../.gitbook/assets/image%20%284%29.png)

Vous pouvez ensuite lancer la machine et être accueillis par un chaleureux écran noir et écritures blanches. 

![](../.gitbook/assets/image%20%285%29.png)

Les identifiants à utiliser sont les suivants

{% hint style="info" %}
Login : student  
Password : ecv
{% endhint %}



