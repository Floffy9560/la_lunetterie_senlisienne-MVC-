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

      <form method="POST" action="" class="formMailTcheck">
         <div class="checkMail">
            <label for="mail"></label>
            <input type="email" class="inputMailTcheck" id="mail" name="mail" placeholder="Entrez votre e-mail" required autocomplete="email">
            <button type="submit" class="buttonMailTcheck" aria-label="Vérifier votre e-mail"><b>Vérifier votre mail</b></button>
         </div>
      </form>

      <div class="mailValide">
         <?php displayErrorMessage() ?>
      </div>

   </div>
</body>

<?php include 'templates/footer.php'; ?>

</html>