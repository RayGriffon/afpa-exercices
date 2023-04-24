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
    <!-- Import de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Détails </h1>
        <div class="row">
            <div class="col-md-6">
                <p>Titre : <?= $disc['disc_title'] ?></p>
                <p>Année : <?= $disc['disc_year'] ?></p>
                <p>Label : <?= $disc['disc_label'] ?></p>
            </div>
            <div class="col-md-6">
                <p>Artiste : <?= $disc['artist_name'] ?></p>
                <p>Genre : <?= $disc['disc_genre'] ?></p>
                <p>Prix : <?= $disc['disc_price'] ?> €</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="pictures/<?= $disc['disc_picture'] ?>" alt="<?= $disc['disc_title'] ?>" width="500">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="update_form.php?id=<?= $disc['disc_id'] ?>"><button type="button" class="btn btn-primary btn-sm">Modifier</button></a>
                <a href="delete_form.php?id=<?= $disc['disc_id'] ?>"><button type="button" class="btn btn-primary btn-sm">Supprimer</button></a>
                <a href="index.php"><button type="button" class="btn btn-primary btn-sm">Retour</button></a>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>