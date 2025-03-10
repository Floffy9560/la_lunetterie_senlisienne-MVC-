<!DOCTYPE html>
<html lang="fr">

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
                <h3>Bonjour : <?= $_SESSION['userInfos']['firstname'] ?></h3>
                <div class="identity">
                    <div class="nameAccount">
                        <div class="divName">
                            <label for="accountLastname" id="labelLastname">Nom</label>
                            <div class="accountIdentity">
                                <input type="text" id="accountLastname" value="<?= $_SESSION['userInfos']['lastname'] ?>" readonly>
                            </div>
                        </div>
                        <div class="divName">
                            <label for="accountFirstname" id="labelFirstname">Prénom</label>
                            <div class="accountIdentity">
                                <input type="text" id="accountFirstname" value="<?= htmlspecialchars($_SESSION['userInfos']['firstname'], ENT_QUOTES) ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <label for="accountAdress">Adresse</label>
                    <div class="accountIdentity">
                        <input type="text" id="accountAdress" value="<?= htmlspecialchars($_SESSION['userInfos']['address'], ENT_QUOTES) ?>" readonly>
                    </div>

                    <label for="accountEmail">Mail</label>
                    <div class="accountIdentity">
                        <input type="email" id="accountEmail" value="<?= htmlspecialchars($_SESSION['userInfos']['mail'], ENT_QUOTES) ?>" readonly>
                    </div>

                    <label for="accountTel">Numéro de téléphone</label>
                    <div class="accountIdentity">
                        <input type="tel" id="accountTel" value="<?= htmlspecialchars($_SESSION['userInfos']['phone'], ENT_QUOTES) ?>" readonly>
                    </div>
                </div>
                <div class="modification">
                    <form method="POST">
                        <label for="modify"></label>
                        <input type="submit" id="modify" name="modify" value="Modifier vos coordonnées" class='modification_user' />
                    </form>

                    <form method='POST'>
                        <label for='deconnexion'></label>
                        <input type='submit' id='deconnexion' name='deconnexion' value='Se deconnecter' class='modification_user' />
                    </form>

                    <form method='POST'>
                        <label for='supprimer'></label>
                        <input type='submit' id='supprimer' name='supprimer' value='Supprimer mon compte' class='modification_user' />
                    </form>
                    <!-- <form method='POST'>
                        <label for='deleteRdv'></label>
                        <input type='submit' id='deleteRdv' name='deleteRdv' value='Supprimer mon/mes rendez-vous' class='modification_user' />
                    </form> -->
                </div>
            </div>
            <div class="containerRdv">
                <h2>Vos rendez-vous</h2>
                <?php

                $id = $_SESSION['userInfos']['id_users'];
                $rdvs = displayRdv($id);
                if (!empty($rdvs)) {
                    foreach ($rdvs as $rdv) {

                        // Créer un formatage pour l'affichage avec le mois en FR
                        $appointmentDate = new DateTime($rdv['appointmentDate']);
                        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $formattedDate = $formatter->format($appointmentDate);
                        // Créer un formatage pour l'affichage de l'heure avec le format HH:MM
                        $formattedHoraire = (new DateTime($rdv['appointmentTime']))->format('H:i');
                        echo "<div class='rdv'>
                            <p>Vous avez rendez-vous le  : " . $formattedDate . " à : " . $formattedHoraire . "h</p>
                            <form action='' method='GET'>
                                <label for='rdv'></label>
                                    <input type='hidden' id='rdv' name='dateRDV' value='" . $rdv['appointmentDate'] . "'>
                                    <input type='hidden' id='rdv' name='timeRDV' value='" . $rdv['appointmentTime'] . "'>
                                 <button type='submit'><i class='bi bi-trash3'></i></button>
                                
                            </form>
                        </div>";
                    }
                } else echo "<p> Pas de rendez-vous </p>";
                if (!empty($_SESSION['error'])) {
                    echo $_SESSION['error'];
                }
                ?>


            </div>
        </section>

        <div class="crush">
            <h3>Coup de coeur</h3>

            <div class="framsChoice" id="framsChoice">

            </div>
        </div>

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