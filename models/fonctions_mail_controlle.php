<?php

function checkMail($mail)
{
      $pdo = getConnexion();

      $sql = "SELECT mail 
            FROM kghdsi_user_infos
            WHERE mail = :mail";

      try {
            // Préparer la requête
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer le mot de passe stocké
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe
            if (!$user) {
                  return false; // Retourne false si l'utilisateur n'existe pas
            } else {
                  return true; // Retourne true si l'utilisateur existe
            }
      } catch (PDOException $e) {
            // Gestion des erreurs en cas d'échec de la requête
            echo "Erreur lors de la vérification : " . $e->getMessage();
            return false;
      }
}
