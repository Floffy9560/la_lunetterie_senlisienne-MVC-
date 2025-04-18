<?php
ob_start(); // Active le tampon de sortie

require_once __DIR__ . '/../models/fonctions_formulaire.php';
require_once __DIR__ . '/../models/fonctions_reset_password.php';
include __DIR__ . '/../views/reset_password.php';


if (!empty($_POST['checkMail'])) {
      $mail = $_POST['checkMail'];
      // récuperer l'id de l'utilisateur
      $id = getUserIdByMail($mail);
      if ($id) { // Vérifie si un ID a été trouvé
            $_SESSION['user_id'] = $id;
      } else {
            echo "<p style='color:red;'>⚠️ Aucun utilisateur trouvé avec cet email.</p>";
      }
}

if (!empty($_POST['confirmPassword'])) {

      $id = $_SESSION['user_id'] ?? null;
      if (!$id) {
            echo "<p style='color:red;'>⚠️ Erreur : Aucun utilisateur trouvé.</p>";
            exit();
      }


      //changer le mot de passe en BDD.
      $newPassword = $_POST['confirmPassword'];
      $result = cleanPassword($newPassword);

      // Vérifie si la fonction a retourné un tableau d'erreurs
      if (is_array($result)) {
            // Affichage des erreurs
            echo "<ul style='color:red;'>";
            foreach ($result as $error) { // Parcours du tableau des erreurs
                  echo "<li>$error</li>";
            }
            echo "</ul>";
      } else {
            // Si $result n'est PAS un tableau, alors c'est un mot de passe valide
            $hashedPassword = $result;

            // Mettre à jour le mot de passe dans la BDD
            changePassword($id, $hashedPassword);

            // Envoi de la redirection après modification du mot de passe
            $_SESSION['success_message'] = "Mot de passe mis à jour avec succès !";
            header('location: inscription');
            exit();
            ob_end_flush(); // Vide le tampon et envoie les données
      }
      if ($result['succes'] == false) {
            // Affichage des erreurs
            echo "<ul style='color:red;'>";
            foreach ($result['errors'] as $error) {
                  echo "<li>$error</li>";
            }
            echo "</ul>";
      }
}
