<?php
require_once __DIR__ . '/../models/fonctions_formulaire.php';
require_once __DIR__ . '/../models/fonctions_modification.php';
include __DIR__ . '/../views/modification.php';


if (!empty($_POST)) {
      // Récupération des données du formulaire
      $id = $_SESSION['userInfos']['id_users'];
      $email = nettoyerEmail($_POST['modifyMail']); // Nettoyage de l'email
      $lastname = clean($_POST['modifyLastname']);
      $firstname = clean($_POST['modifyFirstname']);
      $address = nettoyerAdresse($_POST['modifyAddress']);
      $phone = cleanPhone($_POST['modifyPhone']);

      // Vérifier que l'email est bien valide après nettoyage
      if ($email === false) {
            $_SESSION['error'] = "Erreur : Adresse email invalide ou déjà utilisée.";
            exit();
      }

      modification($id, $lastname, $firstname, $email, $phone, $address);
}
