<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	
		<link rel="icon" type="image/png" href="images/lp2i2.png" />
		<!-- Balise META -->
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="content-language" content="fr-FR" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_self" />
		
		<title>Tracker GPS</title>
		
	</head>

	<body oncontextmenu="return false">
		<?php
								
			// Récupération des informations de connexion (host,login,mdp de la BdD,...)
			require 'connexion_bdd.php';

			try 
			{
				// Tentative de connexion à la base de données avec les options définies ci-dessus
				$bdd = new PDO($dsn,$login_bdd,$mdp_bdd,$pdo_options);
				
				// Définition de la requête SQL    
				$sql = "POST * FROM `mission` WHERE login='$login'";
				
				$reponse = $bdd->query($sql);

				
				echo '<br>';
						
				// Déconnexion
				$reponse->closeCursor();
			}
			catch ( Exception $e ) 
			{
				echo "Erreur MySQL : ", $e->getMessage();
				die();
			}
		?>
	</body>
</html>
