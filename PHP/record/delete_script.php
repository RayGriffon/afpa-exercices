<?php

// connexion à la base de données
$dbh = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Nathan');

// Vérifier si l'ID du disque est passé en paramètre POST
if (!isset($_POST['disc_id'])) {
	header('Location: index.php');
	exit();
}

// Récupérer les informations du disque à supprimer
$stmt = $dbh->prepare('SELECT * FROM disc WHERE disc_id = ?');
$stmt->execute([$_POST['disc_id']]);
$disc = $stmt->fetch();

// Vérifier si le disque existe
if (!$disc) {
	header('Location: index.php');
	exit();
}

// Supprimer le disque de la base de données
$stmt = $dbh->prepare('DELETE FROM disc WHERE disc_id = ?');
$stmt->execute([$_POST['disc_id']]);

// Rediriger vers la liste des disques
header('Location: index.php');
exit();

?>