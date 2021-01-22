# SQL QCM \#1

## Evaluation

* Une bonne réponse apporte 1 point. 
* Une absence ou une mauvaise réponse apporte 0 point.

Chaque question à choix multiples peut avoir une ou plusieurs bonnes réponses. Veuillez entourer la ou les réponses que vous jugez correctes. Toutes les réponses correctes doivent être entourées.

## Enoncé

Pour les questions suivante, on considère :

Soit une table `owner` , possédant les colonnes suivantes :

* `id` , entier et clé primaire
* `first_name` , chaine de caractères
* `last_name` , chaine de caractères
* `gender` , chaine de caractères \("M" pour masculin, "F" pour féminin\)
* `age` , entier

Soit une table `pet` , possédant les colonnes suivantes :

* `id ,` entier et clé primaire
* `name` , chaine de caractères
* `age` , entier

Soit une table `owner_pet` , possédant les colonnes suivantes :

* `owner_id` , entier
* `pet_id` , entier

`owner_pet` est un table effectuant la liaison entre `owner` et `pet` , et indique qui est propriétaire de quels animaux.

##  Questions

Vous avez retrouvé une requête SQL qui semble partiellement effacée. Les passages effacés sont représentés sous la forme `[MISSING]`:

```sql
SELECT last_name, [MISSING], name
FROM pet, [MISSING]
WHERE owner.id = owner_pet.id
AND [MISSING]
AND pet.age < 3
```

**Q1 : Que pouvez-vous dire de cette requête ?**

* Réponse A : Elle retourne une liste de propriétaires et d'animaux
* Réponse B : Elle ne contient que des propriétaires de moins de 3 ans
* Réponse C : Elle peut contenir des animaux de moins de 3 ans
* Réponse D : Elle ne contient que les animaux appartenant à une femme

**Q2 : On vous indique que cette requête doit retourner le nom et l'âge de tous les propriétaires d'animaux de moins de 3 ans, ainsi que l'âge et le nom de l'animal. Compléter la requête :**

Réponse

```sql
SELECT last_name,              , name
FROM pet
       owner.id = owner_pet.owner_id
AND 
AND pet.age < 3
```

**Q3: Pour une opération marketing d'assurance-maladie animale, on vous demande de fournir la liste des propriétaires possédant un animal de plus de 15 ans. Ecrire la requête:**

**Q4: Pour une opération marketing de vente de jouets, on vous demande de fournir la liste des petites filles de moins de 10 ans possédant un animal. Quelle requête écririez-vous ?**

* Réponse A : 

```sql
SELECT name
FROM pet
WHERE age < 10
```

* Réponse B :

```sql
SELECT first_name, last_name
FROM pet, owner_pet, owner
WHERE age > 10
AND gender = 'F'
```

* Réponse C :

```sql
SELECT first_name, last_name
FROM owner
WHERE age < 10
AND gender = 'F'
```

**Q5: Écrire la requête SQL permettant la création de la table `owner`**

**Q6: Qu'est ce qu'une jointure ? A quoi cela sert-it ?**

\*\*\*\*

