# PHP OOP 101

La POO est **une philosophie de design**. Le but est d'aider à représenter le comportement d'une application, en utilisant une analogie de choses réelles.

## Origine de la POO

Il y avait une séparation entre d'un coté les données, et de l'autre le code, agissant sur celles-ci : les fonctions.

```php
$foo = 'I am data';

// I'm a function, I do stuff
function do($stuff) {
    return $stuff + 1/2 * 4;
}
```

Un des buts de la POO est de fournir une structure de données, liant les données au code. Liant une définition de structure à un ensemble de comportement.

Par exemple, liant ce qui caractérise un étudiant, ses données \(id, nom, prénom, date de naissance\), à un comportement qu'on attendrait de lui \(donner son age, afficher sa fiche, s'inscrire dans une école\).

Exemples:

* Procedural

{% code title="student\_procedural.php" %}
```php
<?php

$studentId = 'ST1337';
$studentFirstname = 'John';
$studentLastname = 'Doe';
$studentAddress = '41 rue du port, 59000 Lille';

function showStudentRecord($studentId, $studentFirstname, $studentLastname, $studentAddress)
{
    echo <<<STRING
Student #{$studentId}: {$studentFirstname} {$studentLastname}
Lives at {$studentAddress}
STRING;
}

showStudentRecord($studentId, $studentFirstname, $studentLastname, $studentAddress);
```
{% endcode %}

* Procedural, en ajoutant l'age de l'étudiant

{% code title="student\_procedural\_age.php" %}
```php
<?php

$studentId = 'ST1337';
$studentFirstname = 'John';
$studentLastname = 'Doe';
$studentDob = '1989-01-13';
$studentAddress = '41 rue du port, 59000 Lille';

function showStudentRecord($studentId, $studentFirstname, $studentLastname, $studentDob, $studentAddress)
{
    // previous code
}

function calculateStudentAge($studentId, $studentFirstname, $studentLastname, $studentDob)
{
    // 31556926 is the number of seconds in a year
    $age = floor((time() - strtotime($studentDob)) / 31556926);

    echo <<<STRING
Student #{$studentId} {$studentFirstname} {$studentLastname} is {$age} years old";
STRING;

}

calculateStudentAge($studentId, $studentFirstname, $studentLastname, $studentDob);
```
{% endcode %}

* OOP... mais mal fait

{% code title="student\_oop\_wrong.php" %}
```php
<?php

class Student
{
    public $id;
    public $firstname;
    public $lastname;
    public $dob;
    public $address;
}

$student = new Student();
$student->id = 'ST1337';
$student->firstname = 'John';
$student->lastname = 'Doe';
$student->dob = '1989-01-13';
$student->address = '41 rue du port, 59000 Lille';

function showRecord(Student $student)
{
    $age = floor((time() - strtotime($student->dob)) / 31556926);

    echo <<<STRING
Student #{$student->id}: {$student->firstname} {$student->lastname}
Born on {$student->dob} (age: {$age})
Lives at {$student->address}
STRING;
}

showRecord($student);
```
{% endcode %}

* OOP mieux : encapsulé.

{% code title="student\_oop\_better.php" %}
```php
<?php
use \DateTime;

class Student
{
    private $id;
    private $firstname;
    private $lastname;
    private $dob;
    private $address;

    public function __construct($id, $firstname, $lastname, $dob, $address)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->dob = DateTime::createFromFormat('Y-m-d', $dob);
        $this->address = $address;
    }

    public function getFullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getAge()
    {
        $now = new DateTime();
        $age = $this->dob->diff($now)->y;

        return $age;
    }

    public function showRecord()
    {
        echo <<<STRING
Student #{$this->id}: {$this->getFullname()}
Born on {$this->dob->format('d M. Y')} (age: {$this->getAge()})
Lives at {$this->address}
STRING;
    }
}

$student = new Student('ST1337', 'John', 'Doe', '1989-01-13', '41 rue du Port');
echo $student->getAge();
$student->showRecord();
```
{% endcode %}

## Principes de la POO

### L'encapsulation

L'encapsulation consiste à protéger, voire interdire l'accès direct à un sous-ensemble de données, en faveur d'un accès à un nombre plus réduit de méthodes de manipulation de ces données.

Le but est de ne pas exposer \(rendre publique\) la façon dont les données sont représentées et manipulées **en interne**, mais de fournir au monde extérieur un accès **abstrait et contrôlé** à ces données, appelé le comportement.

Une analogie avec le monde réel : la voiture. Une voiture est un objet très compliqué, avec énormément de variables à l'intérieur : vitesse du moteur, débit de l'essence dans les pistons, cadençage de l'allumage des bougies, transmission du couple et de la direction, etc.\*

Mais toute cette complexité est masquée, encapsulée par le tableau de bord, le volant et les pédales. Allumer la voiture consiste à tourner la clef, et indique à la voiture que je souhaite qu'elle démarre. **C'est ensuite à la voiture de s'occuper de** _**comment démarrer**_. Je ne lui indique pas comment gérer les bougies, comment gérer l'alimentation en mélange air-essence, etc. Tout cela est de **sa responsabilité**, et non de la mienne.

De cette façon, la voiture se protège de l'intervention **extérieure**, qui pourrait mettre en peril son fonctionnement **interne**.

Ce même principe est appliqué en POO, aux objets que nous créons. Imaginons que je crée un objet représentant une liste d'étudiants. Je veux que cette objet sache sauvegarder cette liste quelque part, pour plus tard, et je veux pouvoir demander à ctte objet de me fournir la liste des élèves.

```php
class StudentList 
{
    public function setStudents(array $students)
    {
        // I persist that student list somewhere
        return true; // Everything went smoothly
    }

    public function getAllStudents()
    {
        // I retrieve the students from somewhere, 
        // and put it into $students
        return $students;
    }
}
```

Ce que l'encapsulation assure, c'est que le jour où les élèves ne sont plus stockés dans MS Excel \(Oui…\), mais dans MySQL, un fichier texte, GoogleDrive… je ne verrai aucune différence.

Il est très possible qu'une implementation complète de cette classe ressemble à ceci

```php
<?php
class StudentListBis
{
    public function setStudents(array $students)
    {
        $serializedStudents = serialize($students);
        file_put_contents('student.bin', $serializedStudents);

        return true; // Everything went smoothly
    }

    public function getAllStudents()
    {
        $serializedStudents = file_get_contents('student.bin');
        $students = unserialize($serializedStudents);

        return $students;
    }
}
```

\* Etant très mauvais mécanicien, des erreurs manifestes peuvent s'être glissées dans cette analogie.

### Exercices

E1: Écrire une classe `Rectangle` qui permettra de créer une instance en lui spécifiant une largeur et une longueur.  
Cette classe fournira 2 méthodes, permettant de calculer le périmètre et l'aire d'une instance de Rectangle.

{% code title="Rectangle.php" %}
```php
<?php

class Rectangle 
{
    private float $long;
    private float $larg;
    private string $color;
    private string $oldColor;

    public function __construct(float $long, float $larg)
    {
        $this->long = $long;
        $this->larg = $larg;
        $this->color = 'Black';
    }
    
    public function setColor(string $color) 
    {
        $this->oldColor = $this->color;
        $this->color = $color;
    }
    
    public function revertColor()
    {
        $this->color = $this->oldColor;
    }
    
    public function getColor(): string
    {
        return $this->color;
    }

    public function calculPerimetre(): float
    {
        return ($this->long + $this->larg) * 2;
    }

    public function calculAire(): float
    {
        return $this->long * $this->larg;
    }
}

$rec2 = new Rectangle(); // Error
$rec3 = new Rectangle(1.2); // Error
$rec4 = new Rectangle('coucou', 2); // Error 


echo "Rectangle 4x5".PHP_EOL;
$rec = new Rectangle(4, 5);
$rec->setColor('Pink');
echo "Perimetre: " . $rec->calculPerimetre(). PHP_EOL;
echo "Aire: " . $rec->calculAire(). PHP_EOL;
echo "Couleur: " . $rec->getColor() . PHP_EOL; // 'Pink'
```
{% endcode %}

E2 : Faire la même chose, mais avec une classe `Cercle`

{% hint style="info" %}
Récupérer la valeur de π en PHP : `pi()`
{% endhint %}

## Interface

Une interface est un contrat. Elle permet a une classe d'indiquer qu'elle remplit les conditions, et fournit le comportement exigé par l'interface.

Une interface permet de séparer ce qu'une classe doit être capable de faire \(spécification\), de comment elle le fait exactement \(implémentation\).

Par nature, une interface spécifie des comportements, c'est à dire des méthode. Elle spécifie leur signature, de manière moins formelle, leur sémantique.

Une interface n'a pas pour but de factoriser du code ou un comportement, ou même des données. C'est notamment pour ça qu'on ne peut pas spécifier d'attributs dans une interface.

Une interface permet l'utilisation de polymorphisme.

E3 : écrire une ou plusieurs interfaces qui seraient communes à `Rectangle` ou `Cercle`

{% code title="/Interfaces/Shape.php" %}
```php
interface Shape
{
    /**
     * Calcule le perimetre de la forme
     * Ne peut être négatif.
     */
    public function calculPerimetre(): float;

    /**
     * Calcule l'aire de la forme
     * Ne peut être négatif.
     */
    public function calculAire(): float;
}
```
{% endcode %}

E4: Ecrire une nouvelle classe, représentant une forme, implémentant cette même interface : `TriangleRectangle` ou `Carré`. `Triangle` quelconque pour les plus aventuriers d'entre vous : [https://fr.wikipedia.org/wiki/Formule\_de\_H%C3%A9ron](https://fr.wikipedia.org/wiki/Formule_de_H%C3%A9ron)

## Polymorphisme

Le polymorphisme est un mécanisme en POO qui permet d'utiliser des objets de **classes/types différents** d'une manière unique. De cette façon, il est possible d'écrire une fonction qui pourra recevoir des objets de types différents, mais qui partagent tous quelques chose de commun : soit une interface, _soit une classe parente commune \(on y reviendra\)_.

_Exemple en demo : Shape & Printers._

E5:  On souhaite modéliser un jeu de rôle au tour par tour, permettant à 2 personnages de s'affronter dans un duel à mort.

Un développeur précédent a déjà écrit l'interface suivante, permettant de modéliser les comportements attendu commun à tous les types de personnage.

{% code title="/Personnage.php" %}
```php
<?php


interface Personnage
{
    /**
     * Retourne le nom du personnage.
     */
    public function getName(): string;

    /**
     * Attaque un ennemi. Change les hp de l'ennemi en fonction de la réussite de l'attaque.
     * @return int Le montant des dommages infligés à $ennemi
     */
    public function attack(Personnage $ennemi): int;

    /**
     * Enleve des points de vie d'un Personnage.
     * Les hp d'un Personnage peuvent devenir négatifs, mais ne peuvent être
     * inférieurs a -15.
     *
     * @param int $hpLost Number of Hp lost
     */
    public function removeHp(int $hpLost);

    /**
     * Indique si un Personnage est mort.
     */
    public function isDead(): bool;
}
```
{% endcode %}

E5-1: Ecrire les classes adaptées à la description suivante :

> La race de base est Humain. Un Humain inflige une attaque faible mais constante de 3hp. Un humain a, en général, 10hp, sauf Jean-Pierre, qui en a 15. Un humain n'a pas de pouvoir spéciaux, et meurt à 0hp ou moins.

> Les Guerriers sont plus puissants : ils infligent entre 2 et 5hp de dommage, mais parfois se coupent eux-même, emportés par leur frénésie. Ils s'infligent alors 1hp de dommage. Ils sont physiquement forts, et ont 17hp. Un Guerrier peut continuer de se battre si ses hp sont négatifs : après chacun de ses attaque, il a 20% de chance de ne pas être mort, mais de revenir à 1hp.

> Les Magiciens sont plus frêles, mais redoutables : ils attaquent avec des sorts. Chaque magicien a du mana \(entre 3 et 5 points\) et consomme 1 à 2 points de mana aléatoirement pour attaquer, infligeant entre 4 et 6 hp de dommage. Une fois à court de mana, il attaque faiblement avec son baton \(1hp de dommage\). Les magiciens ont 8hp et meurent normalement, excepté Gandalf, qui revient à la vie avec le double de hp s'il meurt. Il change alors de nom et devient Gandalf Le Blanc.

> Les Zombies sont plus fragiles, avec leur 8hp, mais récupérent la moitié des dommages qu'ils infligent après chaque attaque \(entre 1 et 3hp\). De plus, ils sont déjà morts et ne peuvent pas mourir... à moins de leur écraser le cerveau. Ceci ne peut arriver que s'ils ont moins de -5hp, et arrive 50% du temps après une attaque reçue.

{% hint style="info" %}
L'interface définit les comportements **obligatoires** des classes l'implementant. C'est un **contrat**. Cela ne veut pas dire que les classes n'auront que ces méthodes à implémenter, ni qu'elles n'auront pas d'autres attributs qui leur sont propres.
{% endhint %}

E5-2 : écrire la classe `Jeu` qui permettra de créer et de suivre le déroulement d'un combat. Cette classe aura une méthode `setAdversaires(Personnage $a1, Personnage $a2)` et fera ensuite combattre chaque Personnage jusqu'à ce que l'un d'entre eux soit mort.

Lors de chaque tour, les statistiques des Personnages seront affichés, ainsi que le montant des dommages infligés.

Ecrire ensuite un fichier `jouer.php` qui créera des personnages, les fera combattre. 

E5-3 : Ajouter un formulaire HTML permettant de choisir le nom et le type des 2 Personnages s'affrontant.

## Héritage

Demo.

## Composition

Demo.

