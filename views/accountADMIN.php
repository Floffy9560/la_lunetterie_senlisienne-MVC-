<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compte ADMIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/accountADMIN.css" />
</head>

<body>
    <?php include __DIR__ . '/../templates/header.php' ?>
    <main>

        <div class="containerIdentity">
            <h3>Bonjour Mr le directeur : <?= $_SESSION['userInfos']['firstname'] ?></h3>
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
            </div>
        </div>
        <button class="btnAdmin">Gestion des stocks</button>
        <button class="btnAdmin">Gestion de l'agenda</button>
        <button class="btnAdmin">Gestion des offres</button>
        <button class="btnAdmin">Mailling client</button>
        <button class="btnAdmin">Horaire d'ouverture</button>
        <button class="btnAdmin software">Connexion avec votre logiciel</button>
        <button class="btnAdmin">Me désinscrire</button>

    </main>

    <script src="assets/JS/accountADMIN.js"></script>
</body>
<?php include __DIR__ . '/../templates/footer.php' ?>

</html>