<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Compte utilisateur</title>
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="assets/css/headerFooter.css" />
   <link rel="stylesheet" href="assets/css/account.css" />
</head>

<?php include 'templates/header.php'; ?>

<body>


   <main>
      <section>
         <div class="containerIdentity">
            <h3>Identitée</h3>
            <div class="identity">
               <div class="nameAccount">
                  <div class="divName">
                     <label for="accountLastname" id="labelLastname">Nom</label>
                     <div class='accountIdentity' id="accountLastname">
                        <?= "<input type='text'  value=" . htmlspecialchars($_POST['lastname']) . " readonly> " ?></div>

                  </div>
                  <div class="divName">
                     <label for="accountFirstname" id="labelFirstname">Prénom</label>
                     <div class='accountIdentity' id="accountFirstname">
                        <?= "<input type='text'  value=" . htmlspecialchars($_POST['firstname']) . " readonly> " ?>
                     </div>

                  </div>
               </div>
               <label for="accountAdress">Adresse</label>
               <div class='accountIdentity' id="accountAdress">
                  <?= "<input type='text'  value=" . $adresse_propre . " readonly> " ?>
               </div>

               <label for="accountEmail">Mail</label>
               <div class='accountIdentity' id="accountEmail">
                  <?= "<input type='text'  value=" . $email_propre . " readonly> " ?>
               </div>

               <label for="accountTel">Numéro de téléphone</label>
               <div class='accountIdentity' id="accountTel">
                  <?= "<input type='tel'  value=" . $_POST['tel'] . " readonly> " ?>
               </div>

               <label for="accountPassword">Mot de passe</label>
               <div class='accountIdentity' id="accountPassword">
                  <?= "<input type='password'  value=" . $motDePasseSecurise . " readonly> " ?>
               </div>
            </div>
            <a href="#" id="passwordLost">Modifier vos coordonnées</a>
         </div>
         <div class="crush">
            <h3>Coup de coeur</h3>

            <div class="framsChoice" id="framsChoice">

            </div>
         </div>
      </section>

      <h2>Vos commandes :</h2>

      <section>

         <div class="containerOrder">

            <h4><u>Commandes en cour :</u></h4>

            <div class="order">
               <div>
                  <p>nom de la commande</p>
               </div>
               <div class="container-img-follow-order">
                  <div class="container-img-order">
                     <img src="assets/img/affiche-lunettes1.webp" alt="img de la commande" class="img-order">
                  </div>
                  <a href="">Suivie de ma commande</a>
               </div>
            </div>


         </div>


         <div class="containerOrder">
            <h4><u>Vos commandes déja livrées :</u></h4>


            <div class="order">
               <div>
                  <p>nom de la commande</p>
               </div>
               <div class="container-img-follow-order">
                  <div class="container-img-order">
                     <img src="assets/img/affiche-lunettes1.webp" alt="img de la commande" class="img-order">
                  </div>
               </div>
            </div>


            <div class="orderPlaced">

            </div>
         </div>
      </section>
   </main>
   <script src="assets/JS/account.js"></script>
</body>
<?php include 'templates/footer.php'; ?>

</html>