Les besoins de mise à jour

1.
UPDATE vente
SET prix1 = prix1 * 1.04,
	prix2 = prix2 * 1.02
WHERE numfou = 9180

2.
UPDATE vente
SET prix2 = prix1
WHERE prix2 = 0

3.
UPDATE entcom
JOIN fournis
ON entcom.numfou = fournis.numfou
SET obscom = '*****'
WHERE satisf <5

4.
DELETE FROM vente
WHERE codart = "I110";

DELETE FROM produit
WHERE codart = "I110"