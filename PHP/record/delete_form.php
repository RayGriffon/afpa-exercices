<?php
// vérification que l'ID du disque est passé en paramètre GET
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// connexion à la base de données
$dbh = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Nathan');

// récupération du disque avec les informations de l'artiste associé
$query = "SELECT disc.disc_id, disc.disc_title, disc.disc_picture, disc.disc_label, disc.disc_year, disc.disc_genre, disc.disc_price, artist.artist_name, artist.artist_id FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc.disc_id = :id";
$stmt = $dbh->prepare($query);
$stmt->bindParam(":id", $_GET['id']);
$stmt->execute();
$disc = $stmt->fetch(PDO::FETCH_ASSOC);

// vérification que le disque existe dans la base de données
if (!$disc) {
    header("Location: index.php");
    exit;
}

// Afficher le formulaire de confirmation de suppression
?>

<h1>Supprimer un disque</h1>

<p>Voulez-vous vraiment supprimer le disque suivant ?</p>

<div>
	<img src="<?= $disc['disc_picture'] ?>" alt="Image de <?= $disc['disc_title'] ?>">
</div>

<p><strong>Titre :</strong> <?= $disc['disc_title'] ?></p>
<p><strong>Artiste :</strong> <?= $disc['artist_name'] ?></p>
<p><strong>Année :</strong> <?= $disc['disc_year'] ?></p>
<p><strong>Label :</strong> <?= $disc['disc_label'] ?></p>
<p><strong>Genre :</strong> <?= $disc['disc_genre'] ?></p>
<p><strong>Prix :</strong> <?= $disc['disc_price'] ?> €</p>

<form action="delete_script.php" method="post">
	<input type="hidden" name="disc_id" value="<?= $disc['disc_id'] ?>">
	<button type="submit">Supprimer</button>
	<a href="details.php?id=<?= $disc['disc_id'] ?>"><button type="button" class="btn btn-primary btn-sm">Retour</button></a>
</form>
