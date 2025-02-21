<?php
require 'utils/utils.php';


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
