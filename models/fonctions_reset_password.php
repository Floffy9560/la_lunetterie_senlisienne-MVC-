<?php
// Récupérer l'ID  un utilisateur par son mail
function getUserIdByMail($mail)
{
      $pdo = getConnexion();
      $sql = "SELECT id_user_infos FROM kghdsi_user_infos WHERE mail = :mail";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            // Récupération de l'ID utilisateur
            $userId = $stmt->fetchColumn();

            return $userId ?: false; // Retourne l'ID ou false si aucun utilisateur trouvé
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
      }
}

// changer le mdp dans la bdd 

function changePassword($id, $hashedPassword)
{
      $pdo = getConnexion();

      $sql = "UPDATE kghdsi_users                 
              SET kghdsi_users.password = :password
              WHERE kghdsi_users.id_users = :id";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();


            $_SESSION['success'] = "✅ Mot de passe changé avec succès. Veuillez vous connecter.";
            return true;
      } catch (PDOException $e) {
            $_SESSION['errorChangeMail'] = "⚠️ Impossible de changer le mot de passe.";
            $_SESSION['error'] = "⚠️ Erreur SQL : " . $e->getMessage();
            return false;
      }
}
