<?php
$month = !empty($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$day = date("j");

$months = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

$firstDayOfMonth = date('N', strtotime("$year-$month-01"));
$nbDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$lastDayOfMonth = date('N', strtotime("$year-$month-$nbDaysOfMonth"));

$previousMonth = ($month == 1) ? 12 : $month - 1;
$previousYear = ($month == 1) ? $year - 1 : $year;
$nextMonth = ($month == 12) ? 1 : $month + 1;
$nextYear = ($month == 12) ? $year + 1 : $year;

$today = date('Y-m-d');


// Exemple de réservation pour le 7 mars 2025 à 15:00
// 1. Définir les horaires disponibles
$horairesDisponibles = [
      '10:00',
      '11:00',
      '12:00',
      '15:00',
      '16:00',
      '17:00'
];

function getAppointmentDate()
{
      //Connexion à la base de données
      $pdo = getConnexion();

      // Récupérer les réservations existantes pour une date donnée
      $today = date('Y-m-d');
      $dateChoisie = (!empty($_GET['date'])) ?  $_GET['date'] : $today;
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
            $stmt->bindparam(':appointmentDate', $appointmentDate, PDO::PARAM_STR);
            $stmt->bindparam(':appointmentTime', $appointmentTime, PDO::PARAM_STR);
            $stmt->bindparam(':id_users', $id_users, PDO::PARAM_INT);
            $stmt->execute();
            return true;
      } catch (PDOException $e) {
            echo " ✖️ Erreur lors de la création du rendez-vous : " . $e->getMessage();
            return false;
      }
}
