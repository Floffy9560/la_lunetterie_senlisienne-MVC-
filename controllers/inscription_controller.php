<?php


include_once __DIR__ . '/../models/fonctions_formulaire.php';


if (!empty($_SESSION['userInfos'])) {
      // Si l'utilisateur est connecté, rediriger vers la page de compte

      include_once __DIR__ . '/../controllers/account_controller.php';
      exit();
} else {
      // Si l'utilisateur n'est pas connecté, rediriger vers la page d'inscription
      include_once __DIR__ . '/../views/inscription.php';
      // if (!empty($_SESSION['verificationFalse'])) {
      //       unset($_SESSION['verificationFalse']);
      // }
      // if (isset($_SESSION['error'])) {
      //       unset($_SESSION['error']);
      // }

      exit();
}
