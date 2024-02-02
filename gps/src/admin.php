<?php
session_start();

if(empty($_SESSION['auth']))
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location:index.html');
  exit();
}
else
{
	$LOGIN=$_SESSION['login'];
}
?>
<!DOCTYPE html>
<html>
	<head>
	
		<link rel="icon" type="image/png" href="../images/logo3iL.png" />
		<!-- Balise META -->
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="content-language" content="fr-FR" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_self" />
		
		<title>Projet Alex/Nico</title>
		
	</head>

	<body oncontextmenu="return false">
		<br>
		<p>Bienvenue <?php echo $LOGIN?>. Votre statut de connexion est : administrateur.</p>
		<hr>
		<?php session_destroy();?>
		<img src="images/support.png" />
		<hr>
		<form method="POST" action="afficher_mission.php">
				<table>
					<tr>
						<td><input type="submit" name="creation" value="créer une mission" /></td>
						<td><input type="submit" name="consultation" value="consulter/modifier les missions" /></td>
						<td><input type="reset" name="annuler" value="retour" /></td>
					</tr>
				</table>
			</form>
		<a href="index.html">Accueil</a>
		<hr>
	</body>
</html>
