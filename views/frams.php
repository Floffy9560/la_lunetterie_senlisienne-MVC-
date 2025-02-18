<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recherche lunettes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/headerFooter.css" />
    <link rel="stylesheet" href="/assets/css/frams.css" />
</head>

<?php include 'templates/header.php' ?>

<body>

    <div class="headerBody">
        <img src="/assets/img/visuel-plv-kb001-homme-pm-friendly-frenchy-mai-2022.jpg" alt="pict-header-lunette" class="headerPict">
    </div>
    <main>
        <button type="button" class="buttonSearch" id="buttonSearch">Afficher les filtres<i class="bi bi-filter-square-fill"></i></button>
        <div class="searchContainer">
            <div class="menuSearch" id="menuSearch">
                <p>Genre :</p>
                <div class="inputSearch">
                    <span>

                        <input type="checkbox" id="men" name="men" value="homme" />
                        <label for="men">Homme</label>
                    </span>
                    <span>
                        <input type="checkbox" id="femme" name="femme" value="femme" />
                        <label for="femme">Femme</label>
                    </span>
                    <span>
                        <input type="checkbox" id="enfant" name="enfant" value="enfant" />
                        <label for="enfant">Enfant</label>
                    </span>
                    <span>
                        <input type="checkbox" id="mixteGender" name="mixteGender" value="mixteGender" />
                        <label for="mixteGender">Mixte</label>
                    </span>
                </div>

                <p>Formes :</p>
                <div class="inputSearch">
                    <span>
                        <input type="checkbox" id="carrée" name="carrée" value="carrée" />
                        <label for="carrée">Carrée</label>
                    </span>
                    <span>
                        <input type="checkbox" id="ronde" name="ronde" value="ronde" />
                        <label for="ronde">Ronde</label>
                    </span>
                    <span>
                        <input type="checkbox" id="pantos" name="pantos" value="pantos" />
                        <label for="pantos">Pantos</label>
                    </span>

                </div>

                <p>Couleurs :</p>
                <div class="inputSearch">
                    <span>
                        <input type="checkbox" id="noir" name="noir" value="noir" />
                        <label for="noir">Noir</label>
                    </span>
                    <span>
                        <input type="checkbox" id="rouge" name="rouge" value="rouge" />
                        <label for="rouge">Rouge</label>
                    </span>
                    <span>
                        <input type="checkbox" id="ecaille" name="ecaille" value="ecaille" />
                        <label for="ecaille">Ecaille</label>
                    </span>
                    <span>
                        <input type="checkbox" id="marron" name="marron" value="marron" />
                        <label for="marron">Marron</label>
                    </span>
                    <span>
                        <input type="checkbox" id="bleu" name="bleu" value="bleu" />
                        <label for="bleu">Bleu</label>
                    </span>
                </div>

                <p>Matières :</p>
                <div class="inputSearch">
                    <span>
                        <input type="checkbox" id="titane" name="titane" value="titane" />
                        <label for="titane">Titane</label>
                    </span>
                    <span>
                        <input type="checkbox" id="acetate" name="acetate" value="acetate" />
                        <label for="acetate">Acetate</label>
                    </span>
                    <span>
                        <input type="checkbox" id="bois" name="bois" value="bois" />
                        <label for="bois">Bois</label>
                    </span>
                    <span>
                        <input type="checkbox" id="mixte" name="mixte" value="mixte" />
                        <label for="mixte">Mixte</label>
                    </span>
                </div>
                <button class="buttonFilter">Valider</button>
                <button class="buttonReset">Réinitialiser</button>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>
        <div class="containerCards">

        </div>

    </main>
    <script src="/assets/JS/frams.js" defer></script>
</body>

<?php include 'templates/footer.php' ?>

</html>