<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panier</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/headerFooter.css" />
    <link rel="stylesheet" href="/assets/css/cart.css" />
</head>
<?php include 'templates/header.php' ?>

<body>

    <main>
        <div class="contenairCart">

            <div class="head">
                <p class="secondColumn">Produits</p>
                <p class="thirdColumn">Prix</p>
            </div>

            <div id="body"></div>


            <div class="footerCart">
                <div class="totalText">
                    <p>total</p>
                </div>
                <div class="thirdColumn">
                    <p id="total">500 €</p>
                </div>
            </div>

        </div>

        <button class="pay"> Commander </button>
    </main>
    <script src="/assets/JS/cart.js" defer></script>
</body>
<?php include 'templates/footer.php' ?>