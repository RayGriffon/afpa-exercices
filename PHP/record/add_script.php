<?php
// Connexion à la base de données
try {
	$db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Nathan');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire
$disc_title = $_POST['title'];
$disc_year = $_POST['year'];
$disc_label = $_POST['label'];
$disc_genre = $_POST['genre'];
$disc_price = $_POST['price'];
$artist_id = $_POST['artist'];

// Gestion de l'upload de l'image
$target_dir = "pictures/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$target_name = basename($_FILES["picture"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$allowed_extensions = array("jpg", "jpeg", "png", "gif");

if(!in_array($imageFileType, $allowed_extensions)) {
	die("Erreur : seules les extensions JPG, JPEG, PNG et GIF sont autorisées.");
}

if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
	$disc_picture = $target_name;
} else {
	$disc_picture = "";
}

// Insertion des données dans la base de données
$query = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) VALUES (:disc_title, :disc_year, :disc_picture, :disc_label, :disc_genre, :disc_price, :artist_id)");
$query->bindParam(':disc_title', $disc_title);
$query->bindParam(':disc_year', $disc_year);
$query->bindParam(':disc_picture', $disc_picture);
$query->bindParam(':disc_label', $disc_label);
$query->bindParam(':disc_genre', $disc_genre);
$query->bindParam(':disc_price', $disc_price);
$query->bindParam(':artist_id', $artist_id);
$query->execute();

// Redirection vers la page d'index
header('Location: index.php');
exit();
?>