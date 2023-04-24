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

$pdo->exec("DROP TABLE alea;");
// Création de la table alea
$pdo->exec("CREATE TABLE IF NOT EXISTS alea (
    ch1 varchar(250) NOT NULL,
    ch2 varchar(50) NOT NULL,
    x int NOT NULL
)");

//Définir le nombre de ligne à génerer
$nb_entrees = 1000000;

//Lance la fonction
$duree = generer_donnees_aleatoires($pdo, $nb_entrees);


//Recommence en supprimant la table
$pdo->exec("DROP TABLE alea;");
// Création de la table alea
$pdo->exec("CREATE TABLE IF NOT EXISTS alea (
    ch1 varchar(250) NOT NULL,
    ch2 varchar(50) NOT NULL,
    x int NOT NULL
)");
//Ajout des index
$pdo->exec("CREATE INDEX idx_ch1 ON alea(ch1)");
$pdo->exec("CREATE INDEX idx_ch2 ON alea(ch2)");
$pdo->exec("CREATE INDEX idx_x ON alea(x)");

//Lance la fonction
$duree2 = generer_donnees_aleatoires($pdo, $nb_entrees);

//Affiche le temps de calcul
echo "Les données sans index ont été générées avec succès en " . round($duree, 2) . " secondes.\n";
echo "Les données avec index ont été générées avec succès en " . round($duree2, 2) . " secondes.\n";





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
        if (($i%10000)==0) echo ".";
    }
    echo "\n\n$ch1\n\n";
    $pdo->commit();
    $start2 = microtime(true); // Temps de départ de la requete select
    $lastRow = $pdo->query("SELECT * FROM alea WHERE ch1='".$ch1."';")->fetch();
    $end2 = microtime(true); // Temps de fin de la requete select
    echo "Dernière entrée trouvé en ".round(($end2-$start2), 6)."\n";
    $end = microtime(true); // Temps de fin de la génération
    $duree = $end - $start; // Calcul de la durée de la génération
    return $duree;
}
