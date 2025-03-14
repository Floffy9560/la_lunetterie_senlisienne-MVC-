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
      $id_users = $_SESSION['userInfos']['id_users'];
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

include __DIR__ . '/../views/agenda.php';
