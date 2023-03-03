Exercice :

1.
DELIMITER |
CREATE TRIGGER modif_reservation AFTER UPDATE ON reservation
FOR EACH ROW
BEGIN
	SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'Un problème est survenu. Il est interdit de modifier une réservation';
END |

2.
DELIMITER |
CREATE TRIGGER insert_reservation
BEFORE INSERT ON reservation
FOR EACH ROW
BEGIN
    DECLARE nb_reservations INT;

    SELECT COUNT(*) INTO nb_reservations
    FROM reservation
    JOIN chambre ON reservation.res_cha_id = chambre.cha_id
    JOIN hotel ON chambre.cha_hot_id = hotel.hot_id
    WHERE hotel.hot_id = NEW.res_cha_id;

    IF nb_reservations >= 10 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Impossible de réserver. L''hôtel a déjà 10 réservations.';
    END IF;
END;|

3.
DELIMITER |
CREATE TRIGGER insert_reservation2
BEFORE INSERT ON reservation
FOR EACH ROW
BEGIN
    DECLARE nb_reservations INT;

    SELECT COUNT(*) INTO nb_reservations
    FROM reservation
    WHERE client.cli_id = NEW.res_cli_id;

    IF nb_reservations >= 3 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Impossible de réserver. Le client a déjà 3 réservations.';
    END IF;
END;|

4.
DELIMITER |
CREATE TRIGGER insert_chambre
BEFORE INSERT ON chambre
FOR EACH ROW
BEGIN
    DECLARE total_capacite INT;
    SELECT SUM(chambre.cha_capacite) INTO total_capacite FROM chambre WHERE cha_hot_id = NEW.cha_hot_id;
    IF (total_capacite + NEW.cha_capacite) >= 50 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = "Impossible d'ajouter une chambre. La capacité max de l'hotel est atteinte";
    END IF;
END;|



CAS PRATIQUE

CREATE TRIGGER maj_total AFTER INSERT ON lignedecommande
    FOR EACH ROW
    BEGIN
        DECLARE id_c INT;
        DECLARE tot DOUBLE;
        SET id_c = NEW.id_commande;
        SET tot = (SELECT sum(prix*quantite) FROM lignedecommande WHERE id_commande=id_c);
        SET tot = tot - (SELECT remise FROM commande WHERE id=id_c);
        UPDATE commande SET total=tot WHERE id=id_c;
    END;
    
CREATE TRIGGER maj_total_update AFTER UPDATE ON lignedecommande
    FOR EACH ROW
    BEGIN
        DECLARE id_c INT;
        DECLARE tot DOUBLE;
        SET id_c = NEW.id_commande; 
        SET tot = (SELECT sum(prix*quantite) FROM lignedecommande WHERE id_commande=id_c); 
        SET tot = tot - (SELECT remise FROM commande WHERE id=id_c); 
        UPDATE commande SET total=tot WHERE id=id_c;
    END;

CREATE TRIGGER maj_total_delete AFTER DELETE ON lignedecommande
    FOR EACH ROW
    BEGIN
        DECLARE id_c INT;
        DECLARE tot DOUBLE;
        SET id_c = OLD.id_commande; 
        SET tot = (SELECT sum(prix*quantite) FROM lignedecommande WHERE id_commande=id_c);
        SET tot = tot - (SELECT remise FROM commande WHERE id=id_c);
        UPDATE commande SET total=tot WHERE id=id_c;
    END;