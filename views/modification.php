<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modifier coordonnées</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/modification.css" />
</head>

<?php include 'templates/header.php'; ?>

<body>

    <div class="containerIdentity">
        <h3>Bonjour : <?= $_SESSION['userInfos']['firstname'] ?></h3>

        <div class="identity">

            <form action="" method="POST" class="formModify">

                <label for="accountLastname" id="labelLastname">Nom</label>
                <input type="text" id="accountLastname" name="modifyLastname" value="<?= htmlspecialchars($_SESSION['userInfos']['lastname'], ENT_QUOTES) ?>" pattern="^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$" minlength="2" required>

                <label for="accountFirstname" id="labelFirstname">Prénom</label>
                <input type="text" id="accountFirstname" name="modifyFirstname" value="<?= htmlspecialchars($_SESSION['userInfos']['firstname'], ENT_QUOTES) ?>" pattern="^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$" minlength="2" required>



                <label for="accountAddress">Adresse</label>
                <input type="text" id="accountAddress" name="modifyAddress" value="<?= htmlspecialchars($_SESSION['userInfos']['address'], ENT_QUOTES) ?>">



                <label for="accountEmail">Mail</label>
                <input type="email" id="accountEmail" name="modifyMail" value="<?= htmlspecialchars($_SESSION['userInfos']['mail'], ENT_QUOTES) ?>" autocomplete="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>



                <label for="accountTel">Numéro de téléphone</label>
                <input type="tel" id="accountTel" name="modifyPhone" value="<?= htmlspecialchars($_SESSION['userInfos']['phone'], ENT_QUOTES) ?>" pattern="^(?:\+33|0)(?:\s|-|\.)?[1-9](?:\s|-|\.|\d){8}$" required>

                <button type="submit" class="btnModify" id="btnModify">Valider modification</button>
            </form>
        </div>
    </div>
    <?php
    if (!empty($_POST)) {
        if (!empty($_SESSION['errorModify'])) {
            echo '<div id="overlayModify"></div>
            <div id="popupModify">'
                . showMessage() .
                '<a href="modification">Retour</a>         
            </div>';
        } else {
            echo '<div id="overlayModify"></div>
            <div id="popupModify">'
                . showMessage() .
                '<a href="/">Retour à l\'accueil</a>
           <a href="account">Retour sur votre compte</a>
            </div>';
        }
    }
    ?>

</body>

<?php include 'templates/footer.php'; ?>

</html>