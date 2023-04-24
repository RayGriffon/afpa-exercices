<?php

// creation de la base sans index
// Insertion des lignes (avec transaction)
// Recherche des dernières valeurs 
// suppression de la base
// creation de la base avec index
// Insertion des lignes (avec transaction)
// Recherche des dernières valeurs 


// Configuration de la base de données
$hostze = "localhost";
$dbname = "testSpeed";
$user = "admin";
$password = "Nathan";

// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Création de la base de données
$pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
$pdo->exec("USE $dbname");

// Création de la table alea
$pdo->exec("CREATE TABLE IF NOT EXISTS alea (
    ch1 varchar(250) NOT NULL,
    ch2 varchar(50) NOT NULL,
    x int NOT NULL
)");

// Génération de données aléatoires dans la table alea
function generer_donnees_aleatoires($pdo, $nb_entrees)
{
    $start = microtime(true); // Temps de départ de la génération
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO alea (ch1, ch2, x) VALUES (:ch1, :ch2, :x)");

    // Génération de données aléatoires
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for ($i = 0; $i < $nb_entrees; $i++) {
        $ch1 = substr(str_shuffle($chars), 0, 250);
        $ch2 = substr(str_shuffle($chars), 0, 50);
        $x = mt_rand(1, 100);
        $stmt->execute(array(
            ":ch1" => $ch1,
            ":ch2" => $ch2,
            ":x" => $x
        ));
    }
    echo "<pre>$ch1</pre>";
    $pdo->commit();
    $end = microtime(true); // Temps de fin de la génération
    $duree = $end - $start; // Calcul de la durée de la génération
    return $duree;
}

// Récupération des paramètres du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nb_entrees = $_POST["nb_entrees"];
    $action = $_POST["action"];
    // Exécution de l'action correspondante
    if ($action == "delete_base_de_donnees") {
        // Création de la base de données et de la table
        $pdo->exec("DROP TABLE alea");
        echo "La base de données a été supprimée correctement.";
    } elseif ($action == "creer_index") {
        // Création de l'index sur le champ x
        $pdo->exec("CREATE INDEX idx_ch1 ON alea(ch1)");
        echo "L'index a été créé avec succès.";
    } elseif ($action == "creer_index2") {
        // Création de l'index sur le champ x
        $pdo->exec("CREATE INDEX idx_ch2 ON alea(ch2)");
        echo "L'index a été créé avec succès.";
    } elseif ($action == "creer_index3") {
        // Création de l'index sur le champ x
        $pdo->exec("CREATE INDEX idx_x ON alea(x)");
        echo "L'index a été créé avec succès.";
    } elseif ($action == "generer_donnees") {
        // Génération de données aléatoires dans la table alea
        $duree = generer_donnees_aleatoires($pdo, $nb_entrees);
        echo "Les données ont été générées avec succès en " . round($duree, 2) . " secondes.";
    }
}
?>

<!-- Formulaire pour créer la base de données, créer l'index ou générer des données aléatoires -->
<form method="post">
    <label for="nb_entrees">Nombre d'entrées :</label>
    <input type="number" name="nb_entrees" id="nb_entrees" max="1000000">
    <br>
    <input type="radio" name="action" value="delete_base_de_donnees" required> Vider la base de données et la table alea<br>
    <input type="radio" name="action" value="creer_index"> Créer un index sur le champ ch1 de la table alea<br>
    <input type="radio" name="action" value="creer_index2"> Créer un index sur le champ ch2 de la table alea<br>
    <input type="radio" name="action" value="creer_index3"> Créer un index sur le champ x de la table alea<br>
    <input type="radio" name="action" value="generer_donnees"> Générer des données aléatoires dans la table alea<br>
    <br>
    <button type="submit">Valider</button>
</form>


<!-- 
    Génération 100 000 en 151 secondes sans index
    Génération 100 000 en 152,7 secondes sur index ch1
    Génération 100 000 en 140,79 secondes sur index ch2
    Génération 100 000 en 146.63 secondes sur index x
-->