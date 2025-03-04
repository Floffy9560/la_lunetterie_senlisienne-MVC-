<?php

require __DIR__ . '/../models/fonctions_account.php';

// idées si $post['customerMail'] && $post['passwordCustomer'] alors (on récu^ère les infos utilisateur via getUserInfos($mail) ) et on se connecte au compte 
// si $post['mail'] se connecté au compte pas de vérification car c'est une création

if (!empty($_SESSION['userInfos'])) {
      if ($_SESSION['userInfos']['id_role'] == 2) {
            // Si l'utilisateur est connecté, rediriger vers la page de compte
            include_once __DIR__ . '/../views/account.php';
            exit();
      } else {
            // Si l'admin est connecté, rediriger vers la page de compte admin
            include_once __DIR__ . '/../views/accountADMIN.php';
            exit();
      }
} else {
      // // Si l'utilisateur vient de créer un compte le rediriger vers la page de compte
      // if ((!empty($_POST['email']) && !empty($_POST['password'])) || (!empty($_POST['customerMail']) && !empty($_POST['passwordCustomer']))) {
      //       include_once __DIR__ . '/../views/account.php';
      //       exit();
      // }
      // Si l'utilisateur n'est pas connecté, rediriger vers la page d'inscription
      include_once __DIR__ . '/../controllers/inscription_controller.php';
      exit();
}
