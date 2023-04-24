<?php

$db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Nathan');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Récupère les infos des disc
$requeteToutDisc = $db->query("SELECT*FROM disc INNER JOIN artist ON disc.artist_id = artist.artist_id WHERE disc.disc_id");
$tableauToutDisc = $requeteToutDisc->fetchAll(PDO::FETCH_OBJ);
$requeteToutDisc->closeCursor();

?>