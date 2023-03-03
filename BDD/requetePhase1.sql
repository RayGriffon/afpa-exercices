Formaliser des requêtes SQL

Exercice Phase 1partie 2 : 

Auto-jointure :
SELECT employe1.nom as "Nom employé", employe1.salaire as "Salaire employé", employe2.nom as "Nom chef", employe2.salaire as "Salaire chef"
FROM employe as employe1
LEFT OUTER JOIN employe as employe2 
ON employe1.nosup=employe2.noemp
WHERE employe1.salaire>employe2.salaire


Sous-requêtes :
SELECT nom, titre
FROM employe
WHERE titre = (SELECT titre FROM employe WHERE nom="Amartakaldire")


SELECT nom, salaire, nodep
FROM employe
WHERE salaire > ANY (SELECT salaire FROM employe WHERE nodep="31")


SELECT nom, salaire, nodep
FROM employe
WHERE salaire > ALL (SELECT salaire FROM employe WHERE nodep="31")


SELECT nom, titre
FROM employe
WHERE nodep="31" AND titre = ANY (SELECT titre FROM employe WHERE nodep="32")


SELECT nom, titre
FROM employe
WHERE nodep="31" AND titre != ANY (SELECT titre FROM employe WHERE nodep="32")


SELECT nom, titre, salaire
FROM employe
WHERE titre = ANY (SELECT titre FROM employe WHERE nom="Fairent")
AND salaire = ANY (SELECT salaire FROM employe WHERE nom="Fairent")


Requêtes externe :
SELECT nodep,dept.nom, employe.nom
FROM employe
RIGHT JOIN dept
ON nodep=nodept
ORDER BY nodep ASC

Les groupes :
1.
SELECT titre, Count(*)
FROM employe
Group by titre

2.
SELECT dept.noregion,AVG(salaire), SUM(salaire)
FROM employe
JOIN dept
ON nodep=nodept
GROUP BY noregion


Having :
3.
SELECT nodep, COUNT(*)
FROM employe
GROUP BY titre
HAVING COUNT(*)>2

4.
SELECT substr(nom,1,1) AS alpha, COUNT(*)
  FROM employe
 GROUP BY substr(nom,1,1)
 HAVING COUNT(*)>2

5.
SELECT MAX(salaire) as Max_salaire, MIN(salaire) as Min_salaire, MAX(salaire)-MIN(salaire) as Ecart
FROM employe

6.
SELECT COUNT(DISTINCT titre)
FROM employe

7.
SELECT titre, COUNT(*)
FROM employe
GROUP BY titre

8.
SELECT dept.nom, COUNT(employe.nom)
FROM employe
JOIN dept
ON nodep=nodept
GROUP BY dept.nom

9.
SELECT titre, AVG(salaire)
FROM employe
GROUP BY titre
HAVING AVG(salaire)>(SELECT AVG(salaire)
                     FROM employe
                     WHERE titre="représentant")

10.
SELECT titre, COUNT(*)
FROM employe
WHERE tauxcom IS NOT NULL;

SELECT titre, COUNT(*)
FROM employe
WHERE salaire IS NOT NULL;