# ECV 2020 - Devops

## Objectif en fin de journée

A partir d'un serveur tout neuf, pouvoir y héberger votre site PHP, avec sa base de données.

### Prérequis

1. Installer [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
2. Télécharger l'image Debian déjà faite, via [https://gofile.io/d/Pl6uJZ](https://gofile.io/d/Pl6uJZ)

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
Ici c'est plutôt "importer sa machine virtuelle". Je vous fournis une image déjà existante, vous epargnant l'installation en elle-même.
{% endhint %}

### Etape 1 : importer dans Virtualbox

![Cliquer sur &quot;Import&quot;](../.gitbook/assets/image%20%281%29.png)

![Choisir le fichier .ova pr&#xE9;c&#xE9;demment t&#xE9;l&#xE9;charg&#xE9;](../.gitbook/assets/image%20%282%29.png)

![](../.gitbook/assets/image%20%283%29.png)

Suivant les capacité de votre machine, vous pouvez changer la RAM et le nombre de CPU pour l'émulation.

{% hint style="info" %}
Je recommande à minima 1024MB, et 2048MB pour être plus tranquille. Idem pour les CPU : 1 à minima, 2 ou 3 pour être tranquille.
{% endhint %}

L'import se fait ensuite et peut prendre quelques minutes. La machine importée apparaît ensuite dans la liste des machines de Virtualbox.

![](../.gitbook/assets/image%20%284%29.png)

Vous pouvez ensuite lancer la machine et être accueillis par un chaleureux écran de login

![](../.gitbook/assets/image%20%286%29.png)

Les identifiants à utiliser sont les suivants

{% hint style="info" %}
Login : student  
Password : ecv
{% endhint %}

## Se familiariser avec un système Linux

### Hierarchie de dossiers

Contraintement à Windows, et comme MacOS, il n'y a qu'une seule racine, `/` , là ou Windows a plusieurs lecteurs : `C:` ou `D:` etc.

Architecture des dossiers à la racine :

```text
.
├── bin -> usr/bin
├── boot
├── cdrom
├── dev
├── etc
├── home
├── lib -> usr/lib
├── lib32 -> usr/lib32
├── lib64 -> usr/lib64
├── libx32 -> usr/libx32
├── lost+found
├── media
├── mnt
├── opt
├── proc
├── root
├── run
├── sbin -> usr/sbin
├── snap
├── srv
├── sys
├── tmp
├── usr
└── var
```

Les plus notables, avec leur rôle :

#### `/bin` et `/sbin`

Ils contiennent les binaires les plus important pour le système entier. On y trouve `grep`, `zip`, `apt`, `cat` et d'autres.

#### `/etc`

Il contient tous les fichiers de configuration de tout ce qui tourne sur un serveur : serveur web, SSH, PHP.

#### `/home` et `/root`

Ils contiennent les fichiers personnels des utilisateurs. Un utilisateur `student` aura un dossier `/home/student` qui lui permettra de stocker ce que bon lui semble.

`/root` est la même chose, mais comme `root` est un utilisateur particulier, il a son propre dossier à la racine.

{% hint style="info" %}
C'est notamment ici qu'on trouve les fichiers `.bashrc` pour les utilisateurs, permettant de customiser son terminal.
{% endhint %}

#### `/var`

L'usage de `/var` est multiple :

* On y met les fichiers applicatifs des site web/application qu'on veut y faire tourner, par exemples les fichiers PHP & JS.
* Les différents services, e.g. serveurs web, processus batch, y écrivent ce dont ils ont besoin :
  * Si un site permet d'uploader des fichiers, il seront quelque part dans`/var`
  * Si une application à besoin d'écrire des logs, idem

Dossiers notables :

* `/var/log` : dossier racine de tous les logs. Les logs de serveur web seront dans /var/log/nginx par exemple.
* `/var/www` : dossier racine de tous les sites/app webs hébergées par ce serveur.

**TL;DR: C'est là où se trouve tout ce qui est nécessaire aux opérations "normales" que doit effectuer le serveur.**

### Commandes de base

Une commande a une syntaxe : \`&lt;commande&gt; 

#### `cd` - Se déplacer dans les dossiers

```text
student@debian:~$ cd /var/www/
student@debian:/var/www$ cd ecv/
student@debian:/var/www/ecv$ cd ..
student@debian:/var/www$ 
```

`cd <dossier de destination>`

`<dossier de destination>` peut avoir plusieurs formes :

* Chemin absolu : `/var/www/ecv`
* Chemin relatif à là où je me trouve : `www/ecv`
* Remonter d'un niveau : `..`. e.g. `cd ../../other/folder` 

#### `ls` - Lister ce qu'il y a dans un dossier

```text
student@debian:~$ ls
Desktop  Documents  Downloads  Music  Pictures  Public  Templates  Videos
student@debian:~$ ls -l
total 32
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Desktop
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Documents
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Downloads
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Music
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Pictures
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Public
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Templates
drwxr-xr-x 2 student student 4096 Nov 27 14:26 Videos
```

#### `nano` - Editer un fichier

```text
student@debian:~$ nano my_file.txt
```

Pour sauvegarder : `Ctrl+X`

#### `cat` - Voir le contenu d'un fichier

```text
student@debian:~$ cat hello.txt 
Hello ECV students!

Have a nice day
```

#### `grep` - Rechercher du texte

```text
student@debian:~$ cat hello.txt 
Hello ECV students!

Have a nice day
student@debian:~$ grep 'nice' hello.txt 
Have a nice day
student@debian:~$ grep 'NICE' hello.txt 
student@debian:~$ grep -i 'nice' hello.txt 
Have a nice day
```

`grep` est souvent utilisé avec un `|` pour filtrer des fichiers, de log notamment 

```text
student@debian:~$ cat hello.txt | grep 'nice'
Have a nice day
```

#### `sudo` - Exécuter une commande en tant que `root`

```text
student@debian:~$ rm /root/secret_file
rm: cannot remove '/root/secret_file': Permission denied

student@debian:~$ sudo rm /root/secret_file.txt
[sudo] password for student: 

```

#### `apt` - Installer & désinstaller des packages

```text
student@debian:~$ sudo apt install cowsay
Reading package lists... Done
Building dependency tree       
Reading state information... Done
Suggested packages:
  filters cowsay-off
The following NEW packages will be installed:
  cowsay
0 upgraded, 1 newly installed, 0 to remove and 0 not upgraded.
Need to get 20.9 kB of archives.
After this operation, 92.2 kB of additional disk space will be used.
Get:1 http://deb.debian.org/debian buster/main amd64 cowsay all 3.03+dfsg2-6 [20.9 kB]
Fetched 20.9 kB in 0s (422 kB/s)
Selecting previously unselected package cowsay.
(Reading database ... 122796 files and directories currently installed.)
Preparing to unpack .../cowsay_3.03+dfsg2-6_all.deb ...
Unpacking cowsay (3.03+dfsg2-6) ...
Setting up cowsay (3.03+dfsg2-6) ...
Processing triggers for man-db (2.8.5-2) ...
```

{% hint style="info" %}
`apt` est particulière car elle a des sous-commandes : ici `install` est une sous-commande de `apt`, et non pas un argument.
{% endhint %}

#### chmod et chown - Gérer les permissions

**Les types d'utilisateurs**

* Le propriétaire du fichier \(user\)
* Le groupe du propriétaire du fichier \(group\)
* Les autres utilisateurs, ou encore le reste du monde \(others\)

{% hint style="info" %}
Les groupes permettent à plusieurs utilisateur de lire/écrire des fichiers en commun.
{% endhint %}

**Les types de droits**

* r : droit de lecture \(**R**ead\)
* w : droit d'écriture \(**W**rite\)
* x : droit d'exécution \(e**X**ecute\)

| Position Binaire | Valeur octale | Droits | Signification |
| :--- | :--- | :--- | :--- |
| 000 | 0 | - - - | Aucun droit |
| 001 | 1 | - -x | Exécutable |
| 010 | 2 | - w - | Ecriture |
| 011 | 3 | - w x | Ecrire et exécuter |
| 100 | 4 | r - - | Lire |
| 101 | 5 | r - x | Lire et exécuter |
| 110 | 6 | r w - | Lire et écrire |
| 111 | 7 | r w x | Lire écrire et exécuter |

```text
student@debian:/var/www$ chmod 600 ecv/
student@debian:/var/www$ chmod +w ecv/
student@debian:/var/www$ chmod -R 777 ecv/
```

{% hint style="danger" %}
Ici le `777` est un exemple à ne pas suivre. C'est full accès à tout le monde, sur tout. A utiliser avec parcimonie, seulement pour tester.
{% endhint %}

`chmod <permissions> <dossier de destination>`

`chown <new_user>[:<new_group>] <dossier de destination>`

#### `man` - la documentation

```text
student@debian:/var/www$ man ls
```

{% hint style="info" %}
Bonus : explainshell.com permet de décortiquer une commande. 

Exemple : que fait `ls -alh --color` ? [https://explainshell.com/explain?cmd=ls+-alh+--color](https://explainshell.com/explain?cmd=ls+-alh+--color) 
{% endhint %}

## Anatomie de HTTP

HTTP est un protocole s'exprimant via texte, et comprenant 2 parties : la requête et la réponse.

### Requête HTTP

La requête HTTP est composée de 3 parties

1. La ligne de requête, obligatoire
2. Les headers, _quasiment_ optionnels\*
3. Le body, optionnel.

#### Ligne de requête

```text
GET /wiki/ECV HTTP/1.1         <==== Ligne de requete
Host: fr.wikipedia.org         <==== Headers
Accept-Language: en-US,en
```

Ici `GET /wiki/ECV HTTP/1.1` est composé de 3 parties : 

* le verbe `GET`
* l'URI `/wiki/ECV`
*  le protocole \(il existe plusieurs version de HTTP\) `HTTP/1.1`

#### Headers

Les headers ont toujours la forme &lt;name&gt;: &lt;value&gt;. Les plus courants :

* `Host`: permet au serveur de savoir quel site on cherche à joindre, beaucoup de machines hebergeant plusieurs site avec des noms différents.
* `Accept-Language`: permet de préciser au serveurs les languages préférés, et leur ordre de priorisation
* `Accept`: permet de préciser au serveur les formats préférés, et leur ordre de priorisation.

#### Body

Le body est optionnel, et souvent utilisé pour des autres verbes, comme `POST` ou `PUT`. Il est séparé des headers par deux retours à la ligne \(une ligne vide donc\).

```text
POST /login HTTP/1.1                         <==== Ligne de requete
Host: myprivatewebsite.org                   
Content-Type: application/json               <==== Précise le type du body
                                             <==== Séparation du body.
{ "username": "student", "password": "ecv" }
```

### Reponse HTTP

Une réponse est très similaire à une requête. On utilise parfois le terme "message HTTP" pour désigner l'un ou l'autre.

Une réponse est composée également des 3 mêmes parties

1. La ligne de réponse, obligatoire
2. Les headers, _quasiment_ optionnels\*
3. Le body, optionnel.

```text
HTTP/1.1 200 OK
Date: Sun, 29 Nov 2020 20:18:03 GMT
Content-type: application/json; charset=UTF-8
Cache-control: private, s-maxage=0, max-age=0, must-revalidate

{"login_token": "ecv4358ecv3267575ecv"}
```

La ligne de réponse `HTTP/1.1 200 OK` est composé de 3 parties

* Le protocole de réponse, `HTTP/1.1`normalement identique à celui de la requête, obligatoire
* Le code de status, `200`, indiquant le succès ou non de la réponse, obligatoire
* Le message de status, `OK` accompagnant le code, optionnel\* \(mais souvent là\).

### Ressources

* Un bon billet explicatif [https://gavilan.blog/2019/01/03/anatomy-of-an-http-request/](https://gavilan.blog/2019/01/03/anatomy-of-an-http-request/)

## Installer une stack web

### Nginx

Nginx est un serveur web, permettant de servir des fichiers statique, comme de servir du contenu dynamique, c'est à dire généré par du code. Pour notre exemple ce sera du PHP.

```text
student@debian:~$ sudo apt install nginx
```

Les fichiers de configuration se trouvent dans `/etc/nginx`.

* `/etc/nginx/nginx.conf` : fichier racine de la configuration de nginx.

C'est lui notamment qui charge les autres dossiers, dont `conf.d/`

* `/etc/nginx/conf.d/` : dossier contenant les configuration ajoutées manuellement à nginx.

C'est ici que l'on va venir placer des fichiers pour expliquer à nginx quoi servir, à quelle URL répondre, quels ports écouter, comment mettre en place le HTTPS / SSL.

{% hint style="info" %}
S'assurer que nginx tourne ? `sudo service nginx status`
{% endhint %}

Ressources :

* [La documentation officielle de nginx](https://nginx.org/en/docs) : un peu raide pour un débutant, mais le [beginner's guide](https://nginx.org/en/docs/beginners_guide.html), et le [How nginx processes a request](https://nginx.org/en/docs/http/request_processing.html) sont intéressants pour avoir plus de recul.
* [Setup minimal pour Symfony](https://symfony.com/doc/current/setup/web_server_configuration.html#nginx)

### PHP - CLI et FPM

PHP est un language de programmation. Il est globalement simple a installer et à utiliser.

#### Différence entre CLI et FPM ?

Un même script PHP peut être utilisé de deux manières différentes : 

* soit en ligne de commande. On parlera alors de mode **CLI** \(**C**ommande **L**ine **I**nterface\)
* soit par un navigateur, via une requête HTTP. On parlera alors de mode FPM [\(**F**astCGI **P**rocess **M**anager](https://www.php.net/manual/fr/install.fpm.php)\)

Ces deux contextes d'execution permettent de séparer deux usages qui ont généralement des contraintes et des permissions très différentes.

En mode _CLI_, on sera souvent dans des process plus lourds, plus gourmands, e.g. un script d'import d'un catalogue complet de produits, peut aisément prendre 2GB de RAM, s'executer pendant plusieurs heures, et manger du CPU de manière obscène. Il aura également des permissions d'écrire dans des endroits plus sensibles, suivant le user avec lequel on le lance.

En mode FPM, on va plutôt limiter ce que la requête à le droit de consommer, mettre un timeout sur son temps d'execution, et bien verrouiller les permissions qu'on lui donne. Impossible d'avoir 1000 visiteurs en simultané si on laisse chaque requête manger 500MB de RAM...

#### Installation

```text
student@debian:~$ sudo apt install php-common php-cli php-fpm
```

#### Configuration

{% hint style="warning" %}
Une erreur commune lorsqu'on configure PHP est de ne modifier que les fichiers de configuration pour le CLI et pas pour FPM, ou l'inverse.

Une seconde erreur, bien pire, consiste à mettre la même chose dans les deux.
{% endhint %}

Les fichiers de configuration se trouvent dans `/etc/php/7.3/` \(`7.3` car la version de PHP installée est la 7.3\).

* /etc/php/7.3/cli/ : dossier racine de la configuration PHP pour le contexte CLI
* /etc/php/7.3/fpm/ : dossier racine de la configuration PHP pour le contexte FPM
* /etc/php/7.3/fpm/php-fpm.conf : fichier racine de la **configuration FPM**.

Il contient notamment la configuration sur combien de requêtes gérer en parallèle, quelle stratégie pour les processus, etc.

* /etc/php/7.3/fpm/conf.d/ : dossier contenant la configuration PHP dans un contexte FPM

{% hint style="warning" %}
Il s'agit bien de la configuration _PHP_ et non pas _FPM_.
{% endhint %}

{% hint style="info" %}
La configuration PHP régie la configuration d'un seul process PHP, la où la configuration FPM sert à gérer comment les requêtes HTTP sont transformées en process PHP
{% endhint %}

* /etc/php/7.3/cli/conf.d/ : dossier contenant la configuration PHP dans un contexte CLI



