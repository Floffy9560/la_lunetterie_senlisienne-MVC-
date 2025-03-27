<?php

//////////////////////////////////////////////////////////////
//////////////// FONCTIONS AGENDA ///////////////////////////
////////////////////////////////////////////////////////////

function nbrOfRdvUser($id_users)
{

      //Connexion à la base de données
      $pdo = getConnexion();

      // Récupérer les réservations existantes gràce à l'id
      try {
            $stmt = $pdo->prepare("SELECT count(*) FROM kghdsi_appointments WHERE id_users = :id_users");
            $stmt->execute(['id_users' => $id_users]);

            // Retourne directement la valeur numérique
            return (int) $stmt->fetchColumn();
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération des réservations par l'id : " . $e->getMessage();
            return false;
      }
}

function getAppointmentDate()
{
      //Connexion à la base de données
      $pdo = getConnexion();

      // Récupérer les réservations existantes pour une date donnée
      $today = date('Y-m-d');
      $dateChoisie = (!empty($_GET['date'])) ?  $_GET['date']   : $today;
      try {
            $stmt = $pdo->prepare("SELECT appointmentTime FROM kghdsi_appointments WHERE appointmentDate = :date");
            $stmt->execute(['date' => $dateChoisie]);
            $reservations = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $reservations;
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération des réservations : " . $e->getMessage();
            return false;
      }
}

function createAppointment($appointmentDate, $appointmentTime, $id_users)
{

      $pdo = getConnexion();

      try { // Insertion du moi , de l'année , et de l'heure dans la BDD
            $stmt = $pdo->prepare("INSERT INTO kghdsi_appointments ( appointmentDate, appointmentTime,id_users) VALUES (:appointmentDate, :appointmentTime,:id_users)");
            $stmt->bindParam(':appointmentDate', $appointmentDate, PDO::PARAM_STR);
            $stmt->bindParam(':appointmentTime', $appointmentTime, PDO::PARAM_STR);
            $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['userInfos']['appointmentDate'] = $appointmentDate;
            $_SESSION['userInfos']['appointmentTime'] = $appointmentTime;

            return true;
      } catch (PDOException $e) {
            echo "Erreur lors de la création du RDV : " . $e->getMessage();
            return false;
      }
}



function displayAppointment($id_users)
{

      $pdo = getConnexion();
      $sql = "SELECT appointmentDate, appointmentTime FROM kghdsi_appointments WHERE id_users = :id_users ORDER BY appointmentDate ASC, appointmentTime ASC";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
            $stmt->execute();
            $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $appointments;
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération des rendez-vous : " . $e->getMessage();
            return false;
      }
}

function updateAppointment($appointmentDate, $appointmentTime, $id)
{
      $pdo = getConnexion();
      $sql = "UPDATE kghdsi_appointments SET appointmentDate = :appointmentDate, appointmentTime = :appointmentTime WHERE id_users = :id";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':appointmentDate', $appointmentDate, PDO::PARAM_STR);
            $stmt->bindParam(':appointmentTime', $appointmentTime, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['userInfos']['appointmentDate'] = $appointmentDate;
            $_SESSION['userInfos']['appointmentTime'] = $appointmentTime;
            return true;
      } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du rendez-vous : " . $e->getMessage();
            return false;
      }
}
