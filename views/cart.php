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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/headerFooter.css" />
    <link rel="stylesheet" href="/assets/css/kart.css" />
</head>
<?php include 'templates/header.php' ?>

<body>

    <main>
        <div class="contenairKart">

            <div class="head">
                <p class="secondColumn">Produits</p>
                <p class="thirdColumn">Prix</p>
            </div>

            <div class="bodyKart">
                <div class="secondColumn produits">
                    <img src="/assets/img/affiche-lunettes2.webp" alt="img article" class="img">
                    <div class="article">
                        <span>description de l'article</span>
                        <div class="choiceQuantity">
                            <button class="less">-</button>
                            <p class="quantity">1</p>
                            <button class="more">+</button>
                            <i class="bi bi-trash-fill trash"></i>
                        </div>
                    </div>
                </div>
                <div class="thirdColumn">
                    <p class="price">400 € </p>
                </div>
            </div>


            <div class="bodyKart">
                <div class="secondColumn produits">
                    <img src="/assets/img/affiche-lunettes2.webp" alt="img article" class="img">
                    <div class="article">
                        <span>description de l'article</span>
                        <div class="choiceQuantity">
                            <button class="less">-</button>
                            <p class="quantity">1</p>
                            <button class="more">+</button>
                            <i class="bi bi-trash-fill trash"></i>
                        </div>
                    </div>
                </div>
                <div class="thirdColumn">
                    <p class="price">400 €</p>
                </div>
            </div>

            <div class="footerKart">
                <div class="totalText">
                    <p>total</p>
                </div>
                <div class="thirdColumn">
                    <p id="total">500 €</p>
                </div>
            </div>

        </div>
    </main>
    <script src="/assets/JS/kart.js" defer></script>
</body>
<?php include 'templates/footer.php' ?>