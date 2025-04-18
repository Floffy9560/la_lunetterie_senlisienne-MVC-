<?php
/////////////////////////////////////////////////////////////////
///////////// FONCTIONS UTILISATEUR ////////////////////////////
///////////////////////////////////////////////////////////////



// Récupérer un utilisateur par son Mail ( pour la réinitialisation du MDP)
// =========================================================================
function getUserInfos($mail)  // penser a mettre password pour vérifier 
{
      $pdo = getConnexion();
      // Utilisation de la jointure 
      // $sql = "SELECT * FROM kghdsi_users                  
      //         INNER JOIN kghdsi_user_infos ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos 
      //         LEFT JOIN kghdsi_appointments ON kghdsi_appointments.id_users = kghdsi_user_infos.id_user_infos       
      //         WHERE kghdsi_user_infos.mail = :mail";

      // Utilisation des "alias" pour différencier les colonnes (car si appointment est vide id_users est vide aussie et cela créer des bugs)
      $sql = "SELECT 
                  kghdsi_users.id_users AS user_id,
                  kghdsi_user_infos.id_user_infos AS user_info_id,
                  kghdsi_appointments.id_users AS appointment_user_id,
                  kghdsi_users.*,
                  kghdsi_user_infos.*,
                  kghdsi_appointments.id_appointment,
                  kghdsi_appointments.appointmentDate,
                  kghdsi_appointments.appointmentTime
                  FROM kghdsi_users
                  INNER JOIN kghdsi_user_infos ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos
                  LEFT JOIN kghdsi_appointments ON kghdsi_appointments.id_users = kghdsi_user_infos.id_user_infos
                  WHERE kghdsi_user_infos.mail = :mail;
";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
      }
}


function getUserById($id)
{
      $pdo = getConnexion();
      $sql = "SELECT kghdsi_users.id_users AS user_id,
                  kghdsi_user_infos.id_user_infos AS user_info_id,
                  kghdsi_appointments.id_users AS appointment_user_id,
                  kghdsi_users.*,
                  kghdsi_user_infos.*,
                  kghdsi_appointments.id_appointment,
                  kghdsi_appointments.appointmentDate,
                  kghdsi_appointments.appointmentTime
                  FROM kghdsi_users
                  INNER JOIN kghdsi_user_infos ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos
                  LEFT JOIN kghdsi_appointments ON kghdsi_appointments.id_users = kghdsi_user_infos.id_user_infos        
              WHERE kghdsi_user_infos.id_user_infos = :id";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            // Récupérer une seule ligne (un utilisateur)
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si l'utilisateur existe
            if ($user) {
                  return $user;
            } else {
                  return false;
            }
      } catch (PDOException $e) {
            // Gérer l'erreur si la requête échoue
            $_SESSION['error'] = "⚠️ Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
      }
}


// Créer un nouvel utilisateur
// ============================

function createUserInfos($mail, $phone, $lastname, $firstname, $address)
{
      $pdo = getConnexion();

      // Vérifier si l'utilisateur existe déjà
      $sql_check = "SELECT id_user_infos FROM kghdsi_user_infos WHERE mail = :mail OR phone = :phone";
      $stmt = $pdo->prepare($sql_check);
      $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->execute();

      $result_check = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result_check) {
            echo "<p style='color:white'>Le mail : " . $mail . " est déjà utilisé </p>";
            return false; // Empêche l'insertion
            die();
      }

      // Insérer un nouvel utilisateur
      $sql_insert = "INSERT INTO kghdsi_user_infos (mail, phone, lastname, firstname, address) 
                   VALUES (:mail, :phone, :lastname, :firstname, :address)";
      try {
            $stmt = $pdo->prepare($sql_insert);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR); // Toujours en STR
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer l'ID du nouvel utilisateur
            $id = $pdo->lastInsertId();
            return $id;
      } catch (PDOException $e) {
            echo "<p style='color:white'>Erreur lors de la création de l'utilisateur (user infos) : " . $e->getMessage() . "</p>";
            return false;
      }
}

function createUser($day_of_birth, $month_of_birth, $year_of_birth, $password, $id_user_infos, $id_role)
{
      $pdo = getConnexion();

      $sql = "INSERT INTO kghdsi_users (day_of_birth, month_of_birth,year_of_birth, password,id_user_infos,id_role)
       VALUES (:day_of_birth, :month_of_birth,:year_of_birth, :password, :id_user_infos, :id_role)";


      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':day_of_birth', $day_of_birth, PDO::PARAM_INT);
            $stmt->bindParam(':month_of_birth', $month_of_birth, PDO::PARAM_STR);
            $stmt->bindParam(':year_of_birth', $year_of_birth, PDO::PARAM_INT);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':id_user_infos', $id_user_infos, PDO::PARAM_INT);
            $stmt->bindParam(':id_role', $id_role, PDO::PARAM_INT);
            $stmt->execute();

            // Récupérer l'ID du nouvel utilisateur
            $id = $pdo->lastInsertId();
            return $id;
      } catch (PDOException $e) {
            $_SESSION['error'] = "<p style='color:white'>Erreur lors de la création de l'utilisateur (users) : " . $e->getMessage() . "</p>";
            return false;
      }
}

// Supprimer un utilisateur
// ============================
function deleteUser($idUser)
{
      $pdo = getConnexion();

      // Récupérer id_user_infos et id_role liés à cet utilisateur
      $sql = "SELECT id_user_infos, id_role FROM kghdsi_users WHERE id_users = :idUser";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
      $stmt->execute();
      $userData = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$userData) {
            echo "Utilisateur introuvable.";
            return false;
      }

      $idUserInfos = $userData['id_user_infos'];
      // $idRole = $userData['id_role'];

      try {
            // Commencer une transaction pour éviter les erreurs partielles
            $pdo->beginTransaction();

            //  Supprimer l'utilisateur de `kghdsi_users`
            $sql = "DELETE FROM kghdsi_users WHERE id_users = :idUser";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les informations utilisateur de `kghdsi_user_infos`
            $sql = "DELETE FROM kghdsi_user_infos WHERE id_user_infos = :idUserInfos";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUserInfos', $idUserInfos, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les informations utilisateur de `kghdsi_appointment`
            $sql = "DELETE FROM kghdsi_appointments WHERE id_users = :idUserInfos";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUserInfos', $idUserInfos, PDO::PARAM_INT);
            $stmt->execute();

            // Valider toutes les suppressions si tout s'est bien passé
            $pdo->commit();
            return true;
      } catch (PDOException $e) {

            //  Annuler tout en cas d'erreur
            $pdo->rollBack();
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
      }
}

function verification($mail, $password)
{
      $pdo = getConnexion();

      // Requête SQL pour récupérer le mot de passe
      $sql = "SELECT password 
            FROM kghdsi_users 
            JOIN kghdsi_user_infos  ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos 
            WHERE kghdsi_user_infos.mail = :mail";

      try {
            // Préparation de la requête SQL
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            // Récupération du mot de passe haché
            $hashedPassword = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification si un mot de passe a été trouvé et si le mot de passe correspond
            if ($hashedPassword && password_verify($password, $hashedPassword['password'])) {
                  // Détruire la variable de session de vérification si elle existe
                  if (isset($_SESSION['verificationFalse'])) {
                        unset($_SESSION['verificationFalse']);
                  }
                  return true;
            } else {
                  // Mettre une variable de session pour indiquer une erreur de vérification
                  $_SESSION['verificationFalse'] = "Mauvais mot de passe!";
                  // Retourner false si mot de passe incorrect ou aucun utilisateur trouvé
                  return false;
            }
      } catch (PDOException $e) {
            // Gestion des erreurs en cas de problème avec la base de données
            echo "Erreur lors de la vérification : " . $e->getMessage();
            return false;
      }
}

///////////////////////////////////////////////////////////////////////
//////////////// FONCTIONS ACCOUNT ( RDV)  ///////////////////////////
/////////////////////////////////////////////////////////////////////

function showAppointment()
{
      $id = $_SESSION['userInfos']['id_users'];
      $rdvs = displayRdv($id);
      if (!empty($rdvs)) {
            foreach ($rdvs as $rdv) {
                  // Créer un formatage pour l'affichage avec le mois en FR
                  $appointmentDate = new DateTime($rdv['appointmentDate']);
                  $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                  $formattedDate = $formatter->format($appointmentDate);
                  // Créer un formatage pour l'affichage de l'heure avec le format HH:MM
                  $formattedHoraire = (new DateTime($rdv['appointmentTime']))->format('H:i');
                  echo "<div class='rdv'>
                              <p>Vous avez rendez-vous le :<br>
                                    <span>" . $formattedDate . " à " . $formattedHoraire . "h</span>
                              </p>
                              <div class='rdvBtn'>
                                    <a href='agenda' class='btn modify'>
                                          <i class='bi bi-pencil-square'></i> Modifier mon rendez-vous
                                    </a>
                                    <form action='' method='GET' class='form-delete'>
                                          <input type='hidden' name='dateRDV' value='" . $rdv['appointmentDate'] . "'>
                                          <input type='hidden' name='timeRDV' value='" . $rdv['appointmentTime'] . "'>
                                          <button type='submit' class='btn btnDelete' title='Supprimer le rendez-vous'>
                                          <i class='bi bi-trash3'></i>
                                          </button>
                                    </form>
                              </div>
                        </div>
                        <hr class='hr'>";
            }
      } else echo "<p> Pas de rendez-vous </p>";
      if (!empty($_SESSION['error'])) {
            echo $_SESSION['error'];
      }
}

function displayRdv($id)
{

      $pdo = getConnexion();
      try {
            $sql = "SELECT * FROM `kghdsi_appointments` WHERE id_users = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
      } catch (PDOException $e) {
            echo "Erreur récupération des données SQL : " . $e->getMessage();
            return false;
      }
}

function deleteAppointment($appointmentDateStr, $appointmentTime)
{
      $pdo = getConnexion();
      $sql = "DELETE FROM kghdsi_appointments WHERE appointmentDate = :appointmentDate AND appointmentTime = :appointmentTime";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':appointmentDate', $appointmentDateStr, PDO::PARAM_STR);
            $stmt->bindParam(':appointmentTime', $appointmentTime, PDO::PARAM_STR);
            $stmt->execute();
            return true;
      } catch (PDOException $e) {
            $_SESSION['error'] = "Erreur lors de la suppression du rendez-vous : " . $e->getMessage();
            return false;
      }
}
