<?php

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

      if ($result['success'] == true) { // Vérifie si la validation a réussi

            $hashedPassword = $result['password']; // Récupère le mot de passe hashé
            // Mettre à jour le mot de passe dans la BDD
            changePassword($id, $hashedPassword);

            // Envoi de la redirection après modification du mot de passe
            $_SESSION['success_message'] = "Mot de passe mis à jour avec succès !";


            header('Location: inscription');
            die(); // Assurez-vous que le script s'arrête après la redirection
      } else {
            // Affichage des erreurs
            echo "<ul style='color:red;'>";
            foreach ($result['errors'] as $error) {
                  echo "<li>$error</li>";
            }
            echo "</ul>";
      }
}
