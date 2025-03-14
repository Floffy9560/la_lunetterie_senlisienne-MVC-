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



// Horaires disponibles
$horairesDisponibles = [
      '10:00:00',
      '11:00:00',
      '12:00:00',
      '15:00:00',
      '16:00:00',
      '17:00:00'
];

$idUser = $_SESSION['userInfos']['id_users'];
// echo $idUser;
// echo "date RDV : " . $appointmentDateStr . "heure du RDV : " . $appointmentTime;


if (isset($_GET['modifyHoraire']) && isset($_GET['modifTimeRDV'])) {
      $modifyDate = $_GET['modifDateRDV'];
      $modifyTime = $_GET['modifyHoraire'];
      // modifyAppointment($appointmentDateStr, $appointmentTime, $idUser);
}

// Modifier un RDV
function modifyAppointment($appointmentDateStr, $appointmentTime, $modifyDate, $modifyTime, $idUser)
{

      $pdo = getConnexion();
      try {
            $sql = "UPDATE kghdsi_appointments
                        SET appointmentDate = :modifyDate AND appointmentTime = :modifyTime
                        WHERE id_users = :id AND appointmentDate = :appointmentDateStr AND appointmentTime = :appointmentTime";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':appointmentTime', $appointmentTime, PDO::PARAM_STR);
            $stmt->bindParam(':appointmentDate', $appointmentDateStr, PDO::PARAM_STR);
            $stmt->bindParam(':modifyDate', $modifyDate, PDO::PARAM_STR);
            $stmt->bindParam(':modifyTime', $modifyTime, PDO::PARAM_STR);
            $stmt->bindParam(':id_users', $idUser, PDO::PARAM_INT);
            $stmt->execute();
      } catch (PDOException $e) {
            echo "Erreur lors de la modification dans SQL : " . $e->getMessage();
            return false;
      }
}

include __DIR__ . '/../views/modifyRdv.php';
