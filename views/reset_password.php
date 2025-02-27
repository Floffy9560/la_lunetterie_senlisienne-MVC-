<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Réinitialisation mot de passe</title>
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="assets/css/headerFooter.css" />
   <link rel="stylesheet" href="assets/css/reset_password.css" />
</head>
<?php include 'templates/header.php'; ?>

<body>

   <form action="" method="POST">
      <label for="mailtest">entré votre mail :</label>
      <input type="text" name="mailtest">
      <button>récup l'id</button>
   </form>

   <div class="container">
      <h2 class="text-center">Réinitialiser votre mot de passe</h2>
      <form action="" method="POST">
         <div class="form-group">
            <label for="password">Nouveau mot de passe : *</label>
            <input type="password" class="inputForm" id="password" name="password" required>
         </div>
         <div class="form-group">
            <label for="confirmPassword">Confirmez le nouveau mot de passe : *</label>
            <input type="password" class="inputForm" id="confirmPassword" name="confirmPassword" required>
         </div>
         <div class="consignes">
            <p><b>Attention :</b></p>
            <p>Le mot de passe doit contenir au moins 1 majuscule 1 minuscule 1 caractère spécial (&-+!*$@%_) et 1 nombre </p>

         </div>
         <button type="submit" class="btnForm">Réinitialiser le mot de passe</button>
         <button type="submit" class="btnForm"><a href="login.php" class="btnReturn">Retour à la connexion</a></button>
         <p class="text-center">Si vous n'avez pas encore créé de compte, vous pouvez <a href="inscription"><u>vous inscrire</u></a>.</p>
      </form>

   </div>

</body>
<?php include 'templates/footer.php'; ?>