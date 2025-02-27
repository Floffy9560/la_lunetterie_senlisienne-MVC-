<?php

require __DIR__ . '/../models/fonctions_account.php';




// idées si $post['customerMail'] && $post['passwordCustomer'] alors (on vérifie le mail via getUser() ) et on se connecte au compte 
// si $post['mail'] se connecté au compte pas de vérification car c'est une création

if (!empty($_SESSION)) {
      // Si l'utilisateur est connecté, rediriger vers la page de compte
      include __DIR__ . '/../views/account.php';
} else {
      // Si l'utilisateur vient de créer un compte le rediriger vers la page de compte
      if ((!empty($_POST['email']) && !empty($_POST['password'])) || (!empty($_POST['customerMail']) && !empty($_POST['passwordCustomer']))) {
            include __DIR__ . '/../views/account.php';
      }
      // Si l'utilisateur n'est pas connecté, rediriger vers la page d'inscription
      include __DIR__ . '/../controllers/inscription_controller.php';
}
