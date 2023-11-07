<html>
	<head>
		<title>Vérification Compte</title>
	</head>
	<body>
		<h2>Bonjour Vous êtes à la dernière étape pour activer votre compte vérifions ensemble</h2>
		<p>Votre  Compte:</p>
		<p>Email: <?= $email ?></p>
		<p>Password: <?= $password ?></p>
		<p>Pour terminer clicker sur le lien.</p>
		<h4><a href='<?= base_url()."user/activate/".$userId.$inputLink ?>'>Activer Mon Compte</a></h4>
	</body>
</html>