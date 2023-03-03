Exercice 1

1.
CREATE VIEW v_hotel_et_station
AS
SELECT sta_nom, hot_nom
FROM hotel
JOIN station
ON hot_sta_id = sta_id

2.
CREATE VIEW v_hotel_et_chambres
AS
SELECT hot_nom, cha_numero, cha_type, cha_capacite
FROM chambre
JOIN hotel
ON cha_hot_id = hot_id

3.
CREATE VIEW v_reservation_par_clients
AS
SELECT cli_nom, cli_prenom, res_date_debut, res_date_fin
FROM reservation
JOIN client
ON res_cli_id = cli_id

4.
CREATE VIEW v_chambre_hotel_station
AS
SELECT sta_nom, hot_nom, cha_numero, cha_type, cha_capacite
FROM chambre
JOIN hotel
ON cha_hot_id = hot_id
JOIN station
ON hot_sta_id = sta_id

5.
CREATE VIEW v_reservation_client_hotel
AS
SELECT cli_nom, cli_prenom, res_date_debut, res_date_fin, cha_numero, hot_nom
FROM reservation
JOIN client
ON res_cli_id = cli_id
JOIN chambre
ON res_cha_id = cha_id
JOIN hotel
ON cha_hot_id = hot_id
JOIN station
ON hot_sta_id = sta_id



Exercice 2

1.
CREATE VIEW v_GlobalCde
AS
SELECT ligcom.codart, SUM(ligcom.qtecde) AS QteTot, ligcom.priuni*ligcom.qtecde AS PrixTot
FROM ligcom
GROUP BY codart

2.
CREATE VIEW v_VentesI100
AS
SELECT vente.*
FROM vente
WHERE vente.codart = 'I100'

3.
CREATE VIEW v_VentesI100Grobrigan
AS
SELECT vente.*
FROM vente
WHERE vente.codart = 'I100' AND vente.numfou = "00120"