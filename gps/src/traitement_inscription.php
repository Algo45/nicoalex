
<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/png" href="images/logo3iL.png" />
		<!-- Balise META -->
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="content-language" content="fr-FR" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_self" />
		
		<title>3iCase</title>
	</head>

	<body oncontextmenu="return false">
		<?php
			require 'connexion_bdd.php';
			
			date_default_timezone_set('Europe/Paris');
			setlocale(LC_ALL, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
			$calendrier=strftime("%A %d %B %Y");
			$horaire=strftime("%H h %M min");
			
			// Récupération des données POST
			$pwd1=$_POST['pwd1'];
			$pwd2=$_POST['pwd2'];
			
			if ($pwd1!=$pwd2)
			{
				echo '<body onLoad="alert(\'Mots de passe non concordants...\')">
				<meta http-equiv="refresh" content="0;URL=inscription.html">';
			}
			
			else 
			{
				$PWD=password_hash($pwd1,PASSWORD_DEFAULT);
							
				$DATE_INS=date("Y-n-j");
				$LOGIN = mb_strtolower(htmlspecialchars($_POST['login']));
				$EMAIL = mb_strtolower(htmlspecialchars($_POST['email']));
						
				// Initialisation de la variable de préinscription
				$deja=0;
		
				try
				{
					// Tentative de connexion à la base de données
					$bdd = new PDO($dsn,$login_bdd,$mdp_bdd,$pdo_options);
					
					$sql="SELECT * FROM `users` WHERE login='$LOGIN' AND email='$EMAIL'";
					$membre = $bdd->query($sql);
					
					if ($membre->rowCount()>=1) $deja = 1; else $deja = 0;
					
					if ($deja==1)
					{
						echo '<body onLoad="alert(\'Attention, un utilisateur avec ce login et ce mail est déjà enregistré.\')">
						<meta http-equiv="refresh" content="0;URL=index.html">';
					}
					else
					{
						$sql="INSERT INTO users (login,password,email,register_date,privilege) values ('$LOGIN','$PWD','$EMAIL','$DATE_INS',2)";
						$requete=$bdd->query($sql);
						if (isset($requete))
						{
							echo '<p style="font-size:small">L\'inscription de <b>'.$LOGIN.' ('.$EMAIL.') est effective depuis le '.$calendrier.' à '.$horaire.'.</p>';?>
							<button onclick="window.location.href='index.html';">Retour</button>
							<?php
							$requete->closeCursor();
						}
					}
					$membre->closeCursor();
					
				}
				catch ( Exception $e ) 
				{
					echo "Erreur SQL : ", $e->getMessage();
					die();
				}
			}
			?>
	</body>
</html>