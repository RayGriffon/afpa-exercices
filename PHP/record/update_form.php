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

// récupération de tous les artistes pour la liste déroulante de modification
$query = "SELECT * FROM artist";
$stmt = $dbh->prepare($query);
$stmt->execute();
$artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Détails du disque <?= $disc['disc_title'] ?></title>
</head>
<body>
    <h1>Modifier un vinyle</h1>
    <form method="post" action="update_script.php" enctype="multipart/form-data">
        <input type="hidden" name="disc_id" value="<?= $disc['disc_id'] ?>">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="<?= $disc['disc_title'] ?>"><br>
        <label for="artist">Artiste :</label>
        <select name="artist" id="artist">
            <?php foreach ($artists as $artist): ?>
                <option value="<?= $artist['artist_id'] ?>" <?php if ($disc['artist_id'] == $artist['artist_id']) echo "selected" ?>><?= $artist['artist_name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="label">Label :</label>
        <input type="text" name="label" id="label" value="<?= $disc['disc_label'] ?>"><br>
        <label for="year">Année :</label>
        <input type="number" name="year" id="year" value="<?= $disc['disc_year'] ?>"><br>
        <label for="genre">Genre :</label>
        <input type="text" name="genre" id="genre" value="<?= $disc['disc_genre'] ?>"><br>
        <label for="price">Prix :</label>
        <input type="number" name="price" id="price" value="<?= $disc['disc_price'] ?>"><br>
        <label for="picture">Image :</label>
        <input type="file" name="picture" id="picture"><br>
        <img src="pictures/<?= $disc['disc_picture'] ?>" alt="<?= $disc['disc_title'] ?>" width="200"><br>

        <button type="submit">Modifier</button>
    </form>
    <a href="details.php?id=<?= $disc['disc_id'] ?>"><button type="button" class="btn btn-primary btn-sm">Retour</button></a>
</body>
</html>
