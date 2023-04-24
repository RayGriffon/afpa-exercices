<?php
// Connexion à la base de données
try {
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=mdpExo', 'admin', 'Nathan');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Vérification des données
$errors = array();

// Vérification du prénom
if (empty($first_name)) {
    $errors[] = "Le prénom est obligatoire.";
}

// Vérification du nom de famille
if (empty($last_name)) {
    $errors[] = "Le nom de famille est obligatoire.";
}

// Vérification de l'adresse email
if (empty($email)) {
    $errors[] = "L'adresse email est obligatoire.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "L'adresse email n'est pas valide.";
} else {
    // Vérification de l'unicité de l'adresse email
    $query = $db->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $query->execute(array($email));
    $count = $query->fetchColumn();

    if ($count > 0) {
        $errors[] = "Cette adresse email est déjà utilisée.";
    }
}

// Vérification du mot de passe
if (empty($password)) {
    $errors[] = "Le mot de passe est obligatoire.";
}

if (count($errors) > 0) {
    // S'il y a des erreurs, on les affiche
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} else {
    // Sinon, on enregistre l'utilisateur dans la base de données
    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = $db->prepare("INSERT INTO user (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $query->execute(array($first_name, $last_name, $email, $hashed_password));

    // Redirection vers la page d'accueil
    header('Location: login_form.php');
    exit();
}
?>
