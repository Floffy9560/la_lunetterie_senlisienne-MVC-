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
    <?php include('header.php') ?>
    <main>

        <div class="containerIdentity">
            <h3>Identitée</h3>
            <div class="identity">
                <div class="nameAccount">
                    <div class="divName">
                        <label for="accountLastname" id="labelLastname">Nom</label>
                        <div class='accountIdentity' id="accountLastname"></div>

                    </div>
                    <div class="divName">
                        <label for="accountFirstname" id="labelFirstname">Prénom</label>
                        <div class='accountIdentity' id="accountFirstname"></div>

                    </div>
                </div>
                <label for="accountAdress">Adresse</label>
                <div class='accountIdentity' id="accountAdress"></div>

                <label for="accountEmail">Mail</label>
                <div class='accountIdentity' id="accountEmail"></div>

                <label for="accountTel">Numéro de téléphone</label>
                <div class='accountIdentity' id="accountTel"></div>

                <label for="accountPassword">Mot de passe</label>
                <div class='accountIdentity' id="accountPassword"></div>
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
<?php include('footer.php') ?>

</html>