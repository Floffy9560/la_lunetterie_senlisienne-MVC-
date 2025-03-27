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
if (!empty($_SESSION['userInfos'])) {
      $id_users = $_SESSION['userInfos']['user_id'];
}


// Horaires disponibles
$horairesDisponibles = [
      '10:00:00',
      '11:00:00',
      '12:00:00',
      '15:00:00',
      '16:00:00',
      '17:00:00'
];

require_once __DIR__ . '/../models/modelAgenda.php';

include __DIR__ . '/../views/agenda.php';


if (empty($_SESSION['userInfos']['appointmentDate']) && empty($_SESSION['userInfos']['appointmentTime'])) {

      if (!empty($_GET["horaire"]) && !empty($_GET["appointmentDate"])) {
            $appointmentDate = $_GET["appointmentDate"];
            $appointmentTime = $_GET["horaire"];
            $id_users = $_SESSION['userInfos']['user_id'];
            // Créer un formatage pour l'affichage avec le mois en FR
            $appointmentDateFormatted = new DateTime($appointmentDate);
            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            $formattedDate = $formatter->format($appointmentDateFormatted);
            if (createAppointment($appointmentDate, $appointmentTime, $id_users) == false) {
                  echo "<div class='overlay'></div>
                  <div class='error'><p>Erreur lors de la création du rendez-vous</p>
                  <a href='agenda'>Retour sur la page prise de rendez-vous</a>
                  </div>";
            } else {
                  echo "<div class='overlay'></div>
                  <div class='succes'>Votre RDV est bien enregistré pour le <br> " . $formattedDate . '<br> à ' . $appointmentTime . " 
                  <a href='/'>Retour à l'accueil</a></div>";
            }
      }
} else {

      if (!empty($_GET["horaire"]) && !empty($_GET["appointmentDate"])) {
            $appointmentDate = $_GET["appointmentDate"];
            $appointmentTime = $_GET["horaire"];
            $id = $_SESSION['userInfos']['user_id'];
            // Créer un formatage pour l'affichage avec le mois en FR
            $appointmentDateFormatted = new DateTime($appointmentDate);
            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            $formattedDate = $formatter->format($appointmentDateFormatted);
            if (updateAppointment($appointmentDate, $appointmentTime, $id) == false) {
                  echo "<div class='overlay'></div>
                  <div class='error'><p>Erreur lors de la modification du rendez-vous</p>
                  <a href='agenda'>Retour sur la page prise de rendez-vous</a>
                  </div>";
            } else {
                  echo "<div class='overlay'></div>
                  <div class='succes'>Votre RDV à bien été modifié <br> " . $formattedDate . '<br> à ' . $appointmentTime . " 
                  <a href='/'>Retour à l'accueil</a></div>";
            }
      }
}
