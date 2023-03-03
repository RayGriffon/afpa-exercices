Papyrus

Les besoins d’affichage

1.
SELECT numcom, nomfou
FROM entcom
JOIN fournis
ON entcom.numfou = fournis.numfou
WHERE fournis.numfou = "09120"

2.
SELECT fournis.numfou
FROM entcom
JOIN fournis
ON entcom.numfou = fournis.numfou
WHERE fournis.numfou IS NOT NULL
GROUP by fournis.numfou

3.
SELECT fournis.numfou, COUNT(*)
FROM entcom
JOIN fournis
ON entcom.numfou = fournis.numfou
WHERE fournis.numfou IS NOT NULL
GROUP by fournis.numfou

4.
SELECT codart, libart, stkphy, stkale, qteann
FROM produit
WHERE stkphy <= stkale AND qteann < 1001

5.
SELECT SUBSTRING(posfou,1,2), nomfou
FROM fournis
WHERE SUBSTRING(posfou,1,2)= 75 
OR SUBSTRING(posfou,1,2)= 78
OR SUBSTRING(posfou,1,2)= 92 
OR SUBSTRING(posfou,1,2)= 77 
ORDER BY posfou DESC, nomfou ASC

6.
SELECT datcom, numcom
FROM entcom
WHERE MONTH(datcom) = 03
OR MONTH(datcom) = 04

7.
SELECT datcom, numcom, obscom
FROM entcom
WHERE obscom != ""

8.
SELECT numcom, SUM(priuni*qtecde) as "Total"
FROM ligcom
GROUP BY numcom
ORDER BY Total DESC

9.
SELECT numcom, SUM(qtecde*priuni) as "Total"
FROM ligcom
WHERE qtecde<1000
GROUP BY numcom
HAVING Total > 10000

10.
SELECT nomfou, numcom, datcom
FROM entcom
JOIN fournis
ON entcom.numfou = fournis.numfou
ORDER BY nomfou ASC

11.
SELECT entcom.numcom, fournis.nomfou, produit.libart, entcom.obscom, ligcom.priuni*ligcom.qtecde as "Sous total"
FROM entcom
JOIN fournis
ON entcom.numfou = fournis.numfou
JOIN ligcom
ON ligcom.numcom = entcom.numcom
JOIN produit
ON produit.codart = ligcom.codart
WHERE entcom.obscom LIKE "%urgent%"

12.
SELECT fournis.nomfou, ligcom.qtecde, ligcom.qteliv
FROM fournis
JOIN entcom
ON fournis.numfou = entcom.numfou
JOIN ligcom
ON entcom.numcom = ligcom.numcom
WHERE qtecde > qteliv

SELECT fournis.nomfou, ligcom.qtecde, ligcom.qteliv
FROM fournis
JOIN entcom
ON fournis.numfou = entcom.numfou
JOIN ligcom
ON entcom.numcom = ligcom.numcom
WHERE qtecde-qteliv > 0

13.
SELECT entcom.numcom, entcom.datcom, entcom.numfou
FROM entcom
WHERE numfou = (SELECT numfou
                FROM entcom
                WHERE numcom = 70210)

14.
SELECT produit.libart, vente.prix1
FROM produit
JOIN vente
ON produit.codart = vente.codart
WHERE vente.prix1 < (SELECT MIN(vente.prix1)
                     FROM produit
                     JOIN vente
                     ON produit.codart = vente.codart
                     WHERE produit.libart LIKE "r%")

15,
SELECT produit.libart, fournis.nomfou
FROM fournis
JOIN entcom
ON fournis.numfou = entcom.numfou
JOIN ligcom
ON entcom.numcom = ligcom.numcom
JOIN produit
ON produit.codart = ligcom.codart
WHERE produit.stkphy <= produit.stkale*1.5
ORDER BY produit.libart ASC, fournis.nomfou DESC

16,
SELECT fournis.nomfou, produit.libart
FROM fournis
JOIN entcom
ON fournis.numfou = entcom.numfou
JOIN ligcom
ON entcom.numcom = ligcom.numcom
JOIN produit
ON produit.codart = ligcom.codart
JOIN vente
ON vente.codart = produit.codart
WHERE produit.stkphy <= produit.stkale*1.5 AND vente.delliv < 31
ORDER BY fournis.nomfou DESC, produit.libart ASC

17.
SELECT fournis.nomfou, produit.libart, SUM(produit.stkale)
FROM fournis
JOIN entcom
ON fournis.numfou = entcom.numfou
JOIN ligcom
ON entcom.numcom = ligcom.numcom
JOIN produit
ON produit.codart = ligcom.codart
JOIN vente
ON vente.codart = produit.codart
WHERE produit.stkphy <= produit.stkale*1.5 AND vente.delliv < 31
GROUP BY fournis.nomfou

18.
SELECT produit.libart
FROM produit
WHERE produit.qteann > 0.9*produit.stkale

19.
SELECT fournis.nomfou, SUM((ligcom.qtecde*ligcom.priuni)/(1.20)) AS CA
FROM fournis
JOIN entcom
ON fournis.numfou = entcom.numfou
JOIN ligcom
ON entcom.numcom = ligcom.numcom
JOIN produit
ON produit.codart = ligcom.codart
JOIN vente
ON vente.codart = produit.codart
GROUP BY fournis.nomfou