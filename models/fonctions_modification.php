<?php

function modification($id, $lastname, $firstname, $email, $phone, $address)
{
      // Connexion à la base de données
      $pdo = getConnexion();

      try {
            // Vérifier si l'email existe déjà en base de données, sauf pour l'utilisateur actuel
            $sql_check_email = "SELECT COUNT(*) FROM `kghdsi_user_infos` WHERE `mail` = :email AND `id_user_infos` != :id";
            $stmt_check = $pdo->prepare($sql_check_email);
            $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_check->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_check->execute();
            $email_exists = $stmt_check->fetchColumn();

            // Si l'email existe déjà, retourner une erreur
            if ($email_exists > 0) {

                  $_SESSION['errorModify'] = "Erreur : Email est incorrect ou déjà utilisé.";
                  // Empêche la suite du code de s'exécuter
                  return;
            }


            // Requête SQL avec les bons paramètres pour la mise à jour
            $sql = "UPDATE `kghdsi_user_infos` 
                SET `mail` = :email, 
                    `phone` = :phone, 
                    `lastname` = :lastname, 
                    `firstname` = :firstname, 
                    `address` = :address 
                WHERE `id_user_infos` = :id";

            // Préparation de la requête
            $stmt = $pdo->prepare($sql);

            // Liaison des paramètres à la requête SQL
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->execute();

            // Vérifier si la mise à jour a bien eu lieu
            if ($stmt->rowCount() > 0) {
                  // Mise à jour des valeurs spécifiques dans $_SESSION['userInfos']
                  $_SESSION['userInfos']['mail'] = $email;
                  $_SESSION['userInfos']['phone'] = $phone;
                  $_SESSION['userInfos']['lastname'] = $lastname;
                  $_SESSION['userInfos']['firstname'] = $firstname;
                  $_SESSION['userInfos']['address'] = $address;

                  return true;
            } else {
                  return false;
            }
      } catch (PDOException $e) {
            // Affichage de l'erreur en cas de problème avec la requête
            echo "Erreur récupération des données SQL : " . $e->getMessage();
            return false;
      }
}


function showMessage()
{

      // S'il y as une erreur retourner le message approprié
      if (!empty($_SESSION['errorModify'])) {
            $_SESSION['errorTime'] = time();
            return '<p>' . htmlspecialchars($_SESSION['errorModify']) . '</p>';
      }


      // Si la SESSION à plus de 10 scd la supprimer
      if (isset($_SESSION['errorTime']) && (time() - $_SESSION['errorTime']) > 10) {
            unset($_SESSION['errorModify']);
            unset($_SESSION['errorTime']);
      }



      return "<p>Vos données ont été mises à jour</p>";
}
