<?php

// Démarrage de la session
session_start();


// Test pour savoir comment récupérer les infos sur la session et comment elle fonctionne  !! A RETIRERE A LA FIN !!
if (isset($_SESSION)) {
	echo "<div style='background-color:gainsboro';>";
	echo "<pre>";
	print_r($_SESSION); // Affiche les infos de l'utilisateur
	echo "</pre>";
	echo "</div>";
} else {
	echo "Aucune session active.";
}
// echo " Donnée du post : " . var_dump($_POST);



// Activation des erreurs et affiche des messages d'erreur
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'models/databases.php';


//Récupération de l'adresse de la page 
$path = $_SERVER['REDIRECT_URL'];


if ($path == '/') {
	require 'controllers/index_controller.php';
} elseif ($path == '/robots.txt') {
	require_once 'robots.txt';
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
