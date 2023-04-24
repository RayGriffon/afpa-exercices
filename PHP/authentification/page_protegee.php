<?php
// Démarre la session
session_start();

// Vérification de l'authentification
if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 'ok') {
	header('Location: login_form.php');
	exit();
}

// Page protégée
echo "Vous êtes connecté !";
