<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>

    <!-- Balise META -->
    <link rel="icon" type="image/png" href="../images/logo3iL.png" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="content-language" content="fr-FR" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base target="_self" />

    <title>3iCase</title>

</head>

<body oncontextmenu="return false">
<?php
// On teste si les variables sont définies
if (($_POST['login']!=NULL) && ($_POST['mdp']!=NULL))
{
    $login = mb_strtolower(htmlspecialchars($_POST['login']));
    $mdp = $_POST['mdp'];
    $mdpcrypt = "SELECT password FROM `users` WHERE login='$login'";


    password_verify($mdp,$mdpcrypt);

    // Récupération des informations de connexion (host,login,mdp de la BdD,...)
    require 'connexion_bdd.php';

    try
    {
        // Tentative de connexion à la base de données avec les options définies ci-dessus
        $bdd = new PDO($dsn,$login_bdd,$mdp_bdd,$pdo_options);

        // Définition de la requête SQL
        $sql = "SELECT * FROM `users` WHERE login='$login'";

        $reponse = $bdd->query($sql);

        // On évalue le nombre de lignes de résultats de la requête
        // 1 ou + : l'utilisateur a été trouvé, l'association login/mot de passe est bon.
        // 0 : le login et/ou le mot de passe sont/est incorrect/s.
        $num=$reponse->rowCount();

        echo '<br>';

        if($num==1) // Utilisateur trouvé
        {
            $data = $reponse->fetch(PDO::FETCH_ASSOC);

            $_SESSION['auth']="yes";
            $_SESSION['level']=$data['level'];
            $_SESSION['login']=$data['login'];

            // Redirection selon le niveau d'autorisation
            switch ($data['level'])
            {
                case 1:
                    header('Location:admin.php');
                    break;
                case 2:
                    header('Location:user.php');
                    break;
            }
        }
        else
        {
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            echo '<meta http-equiv="refresh" content="0;URL=index.html">';
        }

        // Déconnexion
        $reponse->closeCursor();
    }
    catch ( Exception $e )
    {
        echo "Erreur MySQL : ", $e->getMessage();
        die();
    }
}
else
{
    echo '<pre>Identifiants non saisis.</pre>';
    echo '<br>';
    echo '<a href="../index.html">Veuillez réessayer s.v.p.</a>';
}
?>
</body>
</html>
