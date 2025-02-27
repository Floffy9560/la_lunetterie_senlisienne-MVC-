<?php
var_dump($_POST); ?>

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Controlle du mail</title>
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="assets/css/headerFooter.css" />
   <link rel="stylesheet" href="assets/css/mail_controlle.css" />
</head>

<?php include 'templates/header.php'; ?>

<body>
   <div class="containerCheckMail">
      <form method="POST" class="formMailTcheck">
         <div class="checkMail">
            <label for="mail"></label>
            <input type="email" class="inputMailTcheck" name="mail" placeholder="Entrez votre E-MAIL">
            <button type="submit" class="buttonMailTcheck"><b>Vérifier votre mail</b></button>
         </div>

      </form>
      <div class="mailValide">
         <?php
         if (!empty($_POST['mail'])) {
            if (checkMail($mail) == true) {
               echo "<div class='valide'>
                        <p><i class='bi bi-envelope-check-fill'></i></p>
                        <p>MAIL VÉRIFIÉ $mail!</p>
                            <form method='POST' action='reset_password'>
                               <label for='checkMail'></label>
                               <input type='hidden' name='checkMail' id='checkMail' value='" . htmlspecialchars($mail, ENT_QUOTES) . "'>
                               <button class='request'>Demande de réinitialisation</button>
                            </form>
                      </div>";
            } else {
               echo "<i class='bi bi-exclamation-triangle-fill'></i><p>Utilisateur non trouvé.<br>Veuillez ressaissir votre mail.</p><i class='bi bi-exclamation-triangle-fill'></i>";
            }
         }
         ?>
      </div>
   </div>
</body>

<?php include 'templates/footer.php'; ?>

</html>