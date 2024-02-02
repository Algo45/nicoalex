<?php
session_start();

	$LOGIN=$_SESSION['login'];
?>
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

			// Récupération des informations de connexion (host,login,mdp de la BdD,...)
			require 'connexion_bdd.php';

			try
			{
				// Tentative de connexion à la base de données avec les options définies ci-dessus
				$bdd = new PDO($dsn,$login_bdd,$mdp_bdd,$pdo_options);



				// Définition de la requête SQL
				$id_users = "SELECT iduser FROM 'users' WHERE login='$login'";
				$sql = "SELECT * FROM 'inventory' WHERE id_user='$id_users'";

				//reponse de la requete
				$reponse_id = $bdd->query($id_users);
				$reponse = $bdd->query($sql);


				echo '<br>';


?>
<table>
	<thead>
		<tr>
			<th>Arme</th>
			<th>Skin</th>
			<th>État</th>
			<th>prix</th>
            <th>Image</th>
		</tr>
	</thead>
	<?php
	while ($data=$reponse->fetch())
	{
		echo '<tr>';
			echo '<td>',$data['arme'], '</td>';
			echo '<td>',$data['skin'], '</td>';
			echo '<td>',$data['prix'], '</td>';
			echo '<td>',$data['etat'], '</td>';
            echo '<td>',$data['image'], '</td>';
        echo '</tr>';
	}
	?>
</table>

<?php
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
