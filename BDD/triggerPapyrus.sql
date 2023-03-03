DELIMITER |
CREATE TRIGGER `stock_alerte` AFTER UPDATE ON `produit`
FOR EACH ROW
BEGIN
    DECLARE qte_commandee INT;
    IF NEW.stkphy <= NEW.stkale THEN
        SELECT (NEW.stkale - NEW.stkphy) - COALESCE((SELECT SUM(qte) FROM articles_a_commander WHERE codart = NEW.codart AND date IS NULL), 0) INTO qte_commandee;
        IF qte_commandee > 0 THEN
            INSERT INTO articles_a_commander (codart, date, qte) VALUES (NEW.codart, NOW(), qte_commandee);
        END IF;
    END IF;
END;|