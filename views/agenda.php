<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Agenda Prise de RDV</title>
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet" />
   <link rel="stylesheet" href="/assets/css/headerFooter.css">
   <link rel="stylesheet" href="/assets/css/agenda.css" />
   <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
   <?php include __DIR__ . '/../templates/header.php' ?>

   <h1>Agenda de prise de rendez-vous</h1>

   <section>
      <div class="calendarContainer">
         <div class="header">
            <form action="" method="GET">
               <input type="hidden" name="month" value="<?= $previousMonth ?>">
               <input type="hidden" name="year" value="<?= $previousYear ?>">
               <button type="submit" class="buttonHeader"><i class="bi bi-arrow-left-square-fill arrow"></i></button>
            </form>

            <h2 class='titre'> <?= $months[$month] ?> <?= $year ?> </h2>

            <form action="" method="GET">
               <input type="hidden" name="month" value="<?= $nextMonth ?>">
               <input type="hidden" name="year" value="<?= $nextYear ?>">
               <button type="submit" class="buttonHeader"><i class="bi bi-arrow-right-square-fill arrow"></i></button>
            </form>


         </div>
         <div class="calendar" id="calendar">
            <table>
               <thead class="bg-primary text-white">
                  <tr>
                     <?php foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day): ?>
                        <th class="text-center py-3"><?= $day ?></th>
                     <?php endforeach; ?>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <?php for ($i = 1; $i < $firstDayOfMonth; $i++): ?>
                        <td class="emptyCase"></td>
                     <?php endfor; ?>

                     <?php

                     $dayCount = $firstDayOfMonth - 1;
                     for ($i = 1; $i <= $nbDaysOfMonth; $i++):
                        $currentDate = date('Y-m-d', mktime(0, 0, 0, $month, $i, $year));

                        if ($dayCount == 7) {
                           echo '</tr><tr>';
                           $dayCount = 0;
                        }
                        if ($dayCount == 0) {
                           echo "<td class='monday'>
                                    <form action='' method='GET' class='appointmentForm'>                                     
                                        <input type='hidden' name='date' value='$currentDate'>
                                        <button type='submit' class='mondayBtn'>$i</button>
                                    </form>
                                 </td>";
                        } else {
                           echo "<td class='days'>$i</td>";
                        }
                        $dayCount++;
                     ?>

                     <?php endfor; ?>

                     <?php for ($i = $dayCount; $i < 7; $i++): ?>
                        <td class="emptyDays"></td>
                     <?php endfor; ?>
                  </tr>
               </tbody>
            </table>
         </div>

         <div class="footer">
            <button type="button" class="buttonFooter">Réinitialiser</button>
            <button type="button" class="buttonFooter">Ok</button>
         </div>
      </div>
      <div class="priseDeRendezVous">
         <div class="dateChoisi" id="dateChoisi">

            <p> <?php
                  $dateChoisie = !empty($_GET['date']) ? htmlspecialchars($_GET['date']) : $today;
                  echo $dateChoisie;
                  ?></p>
         </div>
         <div class="hourOfDate">
            <p>Horaires disponibles</p>
            <hr>
            <form action='' method="GET" class="hourOfDateForm">
               <?php
               // Récupérer les date déjà réservées
               $reservations = getAppointmentDate();
               //Identifier les horaires disponibles en comparant les deux listes
               $horairesRestants = array_diff($horairesDisponibles, $reservations);
               if (!empty($horairesRestants)) {
                  foreach ($horairesRestants as $horaire) {

                     $formattedHoraire = (new DateTime($horaire))->format('H:i');

                     $formattedHoraire = (new DateTime($horaire))->format('H:i');

                     // Afficher le champ de texte avec les horaires disponibles
                     echo "<label class='custom-checkbox'>
                           <input type='radio' name='horaire' value='" . htmlspecialchars($horaire, ENT_QUOTES) . "' required>
                           <span>$formattedHoraire</span> 
                           </label>";
                  }
               } else {
                  echo "Aucun horaire disponible ce jour";
               }
               ?>
               <input type="hidden" name="appointmentDate" value="<?php echo $dateChoisie ?>">
               <hr>
               <?php if (!empty($_SESSION['userInfos'])) {
                  if (nbrOfRdvUser($id_users) > 0) {
                     echo "<div class='errorMessage'>
                           <i class='bi bi-x-circle-fill'></i>
                           <p style='text-align: center; font-weight: bold;'> Vous ne pouvez pas avoir plusieurs RDV </p>
                           <i class='bi bi-x-circle-fill'></i>
                           </div>
                           <button type='submit' class='rdv'> Modifier mon rendez-vous </button>";
                  } else {
                     echo "<button type='submit' class='rdv'>Prendre rendez-vous</button>";
                  }
               } else {
                  echo '<a href="inscription" class="rdv" style="display:inline-block; background-color:black; color:red; padding:15px; text-decoration:none;">
                           Veuillez vous inscrire pour prendre rendez-vous
                        </a>';
               }
               ?>

            </form>

         </div>
   </section>



   <?php include __DIR__ . '/../templates/footer.php' ?>
   <script src="/assets/JS/agenda.js"></script>
</body>

</html>