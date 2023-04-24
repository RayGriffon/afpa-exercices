<?php
// connexion à la base de données
$dbh = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Nathan');

// Si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On récupère les données du formulaire
    $title = $_POST['title'];
    $year = $_POST['year'];
    $label = $_POST['label'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $artist_id = $_POST['artist'];

    // On vérifie que le champ artiste est rempli
    if (!$artist_id) {
        die('L\'artiste est obligatoire');
    }

    // On prépare la requête d'insertion du disque
    $query = $dbh->prepare('INSERT INTO disc (disc_title, disc_year, disc_label, disc_genre, disc_price, artist_id, disc_picture) VALUES (:title, :year, :label, :genre, :price, :artist_id, :picture)');

    // On bind les valeurs des paramètres
    $query->bindParam(':title', $title);
    $query->bindParam(':year', $year);
    $query->bindParam(':label', $label);
    $query->bindParam(':genre', $genre);
    $query->bindParam(':price', $price);
    $query->bindParam(':artist_id', $artist_id);

    // On vérifie si un fichier a été uploadé pour l'image
    if ($_FILES['picture']['size'] > 0) {
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
        $query->bindParam(':picture', $picture, PDO::PARAM_LOB);
    } else {
        $query->bindValue(':picture', null, PDO::PARAM_NULL);
    }

    // On exécute la requête d'insertion
    $query->execute();

    // On redirige vers la page d'accueil
    header('Location: index.php');
    exit;
}

// On récupère tous les artistes de la table artist
$artists = $dbh->query('SELECT * FROM artist')->fetchAll();

?>

<body>
    <h1>Ajouter un disque</h1>
    <form action="add_script.php" method="post" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required><br><br>
        <label for="year">Année :</label>
        <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="2022" required><br><br>
        <label for="label">Label :</label>
        <input type="text" id="label" name="label" required><br><br>
        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre" required><br><br>
        <label for="price">Prix :</label>
        <input type="number" id="price" name="price" min="0" max="9999" step="0.01" required><br><br>
        <label for="artist">Artiste :</label>
        <select id="artist" name="artist" required>
            <?php
            $sql = "SELECT artist_id, artist_name FROM artist ORDER BY artist_name";
            $stmt = $dbh->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['artist_id'] . "'>" . $row['artist_name'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for="picture">Image :</label>
        <input type="file" id="picture" name="picture" accept="image/*" required><br><br>
        <input type="submit" value="Ajouter">
    </form>
    <a href="index.php"><button type="button" class="btn btn-primary btn-sm">Retour</button></a>
</body>