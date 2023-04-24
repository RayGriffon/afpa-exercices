<?php
// Démarre la session
session_start();

// Connexion à la base de données
try {
	$db = new PDO('mysql:host=localhost;charset=utf8;dbname=mdpExo', 'admin', 'Nathan');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire
$login = $_POST['login'];
$password = $_POST['password'];

// Vérification des identifiants dans la base de données
$query = $db->prepare("SELECT * FROM user WHERE email=:login");
$query->bindParam(':login', $login);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
	// Authentification réussie
	$_SESSION['auth'] = 'ok';
	header('Location: page_protegee.php');
	exit();
} else {
	// Authentification échouée
	unset($_SESSION['auth']);
	header('Location: login_form.php');
	exit();
}
