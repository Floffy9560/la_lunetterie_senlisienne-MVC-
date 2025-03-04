<?php

// Démarrage de la session
session_start();

// var_dump(session_id()); // Vérifie si l'ID de session existe
// var_dump($_COOKIE); // Vérifie si PHPSESSID est bien stocké


if (isset($_SESSION['userInfos'])) {
	echo "<pre>";
	print_r($_SESSION); // Affiche les infos de l'utilisateur
	echo "</pre>";
} else {
	echo "Aucune session active.";
}


// echo "<p style='color:yellow'>ce qu'il y as dans session :" . var_dump($_SESSION) . "</p>";

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'models/databases.php';


//Récupération de l'adresse de la page 
$path = $_SERVER['REDIRECT_URL'];


if ($path == '/') {
	require 'controllers/index_controller.php';
} else {
	$path = explode('/', $path)[1];

	$controlleur = 'controllers/' . $path . '_controller.php';

	if (file_exists($controlleur)) {
		require $controlleur;
	} elseif (!file_exists($controlleur)) {
		include 'views/' . $path . '.php';
	} else {
		if ($path == 'instagrame') {
			header('location: url du site');
		} elseif ($path == 'facebook') {
			header('location: url du site');
		} else {
			require 'views/404.php';
		}
	}
}
