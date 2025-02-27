<?php

include __DIR__ . '/../models/fonctions_inscription.php';



if (!empty($_SESSION['user_id'])) {
      // Si l'utilisateur est connecté, rediriger vers la page de compte

      include __DIR__ . '/../controllers/account_controller.php';
} else {
      // Si l'utilisateur n'est pas connecté, rediriger vers la page d'inscription

      include __DIR__ . '/../views/inscription.php';
}

$password = $_POST['$password'];
$motDePasseSecurise = cleanPassword($password);
