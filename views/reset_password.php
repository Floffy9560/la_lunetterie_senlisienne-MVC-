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


   <div class="container">
      <?php if (!empty($_SESSION['error'])) {
         echo "<p style='text-align:center'>" . $_SESSION['error'] . "</p>";
      } ?>
      <h2 class="text-center">Réinitialiser votre mot de passe</h2>
      <form action="" method="POST">

         <!-- Champ caché pour le gestionnaire de mots de passe -->
         <input type="hidden" name="username"
            value="<?php echo htmlspecialchars($_POST['checkMail'] ?? ''); ?>"
            autocomplete="username">

         <div class="divPassword">
            <label for="password">Nouveau mot de passe : *</label>
            <input type="password" class="inputFormPassword" id="password" name="password" autocomplete="new-password" required>
            <span class="eye"><i class="bi bi-eye-fill"></i></span>
            <span class="closeEye"><i class="bi bi-eye-slash-fill"></i></span>
            <span class="checkPassword"> <i class="bi bi-check-circle-fill"></i></span>
         </div>

         <div class="divPassword">
            <label for="confirmPassword">Confirmez le mot de passe : *</label>
            <input type="password" class="inputFormConfirmPassword" id="confirmPassword" name="confirmPassword" autocomplete="new-password" required>
            <span class="eye"><i class="bi bi-eye-fill"></i></span>
            <span class="closeEye"><i class="bi bi-eye-slash-fill"></i></span>
            <span class="checkConfirmPassword"><i class="bi bi-check-circle-fill"></i></span>
         </div>

         <div class="consignes">
            <p><b>Attention :</b></p>
            <p>Le mot de passe doit contenir au moins 1 majuscule 1 minuscule 1 caractère spécial (&-+!*$@%_) et 1 nombre </p>

         </div>

         <button type="submit" class="btnForm" id="sendBtn">Réinitialiser le mot de passe</button>
         <button type="submit" class="btnForm"><a href="inscription" class="btnReturn">Retour à la connexion</a></button>
         <p class="text-center">Si vous n'avez pas encore créé de compte, vous pouvez <a href="inscription"><u>vous inscrire</u></a>.</p>
      </form>

   </div>
   <script src="../assets/JS/reset_password.js"></script>
</body>
<?php include 'templates/footer.php'; ?>