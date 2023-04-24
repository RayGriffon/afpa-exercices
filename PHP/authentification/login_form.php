<!DOCTYPE html>
<html>
<head>
	<title>Formulaire de connexion</title>
</head>
<body>
	<h1>Formulaire de connexion</h1>
	<form method="post" action="login_script.php">
		<label for="login">Login :</label>
		<input type="text" name="login" id="login" required><br><br>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" required><br><br>
		<input type="submit" value="Se connecter">
	</form>
    <a href="inscription_form.html">S'inscrire</a>
</body>
</html>
