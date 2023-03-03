Exercice 1 :

Rendre la modification permanente :

START TRANSACTION;
UPDATE fournis  SET nomfou= 'GROSBRIGAND' WHERE numfou=120 ;
COMMIT;

Annuler la transaction :

START TRANSACTION;
UPDATE fournis  SET nomfou= 'GROSBRIGAND' WHERE numfou=120 ;
ROLLBACK;

