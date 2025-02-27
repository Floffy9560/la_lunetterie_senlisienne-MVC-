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
   <section>
      <div class="calendarContainer">
         <div class="header">

            <i class="bi bi-arrow-left-circle buttonHeader" id="prevMonth"></i>

            <span id="currentMonth" class="currentMonth"></span>

            <i class="bi bi-arrow-right-circle buttonHeader" id="nextMonth"></i>

         </div>
         <div class="calendar" id="calendar">
            <table>
               <thead id="thead"></thead>
               <tbody id="tbody"></tbody>
            </table>
         </div>

         <div class="footer">
            <button type="button" class="buttonFooter">Réinitialisé</button>
            <button type="button" class="buttonFooter">Ok</button>
         </div>
      </div>
      <div class="priseDeRendezVous">
         <div class="dateChoisi" id="dateChoisi">
            <p> <?= date('j-m-Y') ?></p>
         </div>
         <div class="hourOfDate">
            <span>10h00</span>
            <span>11h00</span>
            <span>12h00</span>
            <span>15h00</span>
            <span>16h00</span>
            <span>17h00</span>
         </div>
         <button class="rdv">Prendre rendez-vous</button>
      </div>
   </section>
   <?php include __DIR__ . '/../templates/footer.php' ?>
   <script src="/assets/JS/agenda.js"></script>
</body>

</html>