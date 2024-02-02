<?php
//PHP --> MySQL
//Paramètres de la BdD (hôte,nom de la BdD, nom de la table à afficher)
$host = 'localhost';
$DB = 'projet_alexnico';

//Définition du nom de la source de données (Data Source Name dsn)
$dsn = 'mysql:host=' . $host . ';dbname=' . $DB . ';charset=utf8';

//Définition du logueur à la bdd
$login_bdd = 'root';
$mdp_bdd = '';

// Définition des options de PHP Data Objects (PDO)
$pdo_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true);
