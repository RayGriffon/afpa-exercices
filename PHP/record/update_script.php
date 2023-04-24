<?php
// connexion à la base de données
$dbh = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Nathan');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification du fichier uploadé
    if (isset($_FILES['disc_picture']) && $_FILES['disc_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $target_dir = "pictures/";
        $target_file = $target_dir . basename($_FILES["disc_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérification du type de fichier
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            exit;
        }

        // Déplacement du fichier uploadé
        if (!move_uploaded_file($_FILES["disc_picture"]["tmp_name"], $target_file)) {
            echo "Une erreur est survenue lors du téléchargement du fichier.";
            exit;
        }
    } else {
        $query = "SELECT disc_picture FROM disc WHERE disc_id = :id";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(':id', $_POST['disc_id']);
        $stmt->execute();
        $target_file = $stmt->fetchColumn();
    }

    // Mise à jour des données dans la base de données
    try {
        $stmt = $dbh->prepare("UPDATE disc SET disc_title = :title, disc_year = :year, disc_picture = :picture, disc_label = :label, disc_genre = :genre, disc_price = :price, artist_id = :artist WHERE disc_id = :id");
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':year', $_POST['year']);
        $stmt->bindValue(':label', $_POST['label']);
        $stmt->bindValue(':genre', $_POST['genre']);
        $stmt->bindValue(':price', $_POST['price']);
        $stmt->bindValue(':artist', $_POST['artist']);
        $stmt->bindValue(':id', $_POST['disc_id']);

        if ($target_file !== "") {
            $stmt->bindValue(':picture', $target_file);
        } else {
            $stmt->bindValue(':picture', NULL, PDO::PARAM_NULL);
        }

        $stmt->execute();

        // Redirection vers la page d'index
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        exit;
    }
} else {
    echo "Accès non autorisé.";
    exit;
}
?>