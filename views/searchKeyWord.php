<?php require __DIR__ . '/../models/fonction_search.php'; ?>
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
      <link rel="stylesheet" href="/assets/css/searchKeyWord.css" />
</head>
<?php include 'templates/header.php' ?>
<main>
      <div class="searchResult">

            <?php
            if (!empty($_GET['search'])) {
                  $search = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');

                  //  Définir le répertoire cible (`/views`)
                  $searchDir = realpath(__DIR__ . '/../views');

                  //  Exécuter la recherche uniquement dans `/views`
                  $found = searchInPHPFiles($searchDir, $search);

                  if (!empty($found)) {
                        echo "<h2>Pages contenant le mot-clé :</h2><br>";

                        foreach ($found as $file) {

                              //  Extraire uniquement la partie relative du chemin à partir de `views/`
                              $relativePathShort = strstr($file, '/');

                              // Enlève les 4 derniers caractères (".php")
                              $fileName = substr($relativePathShort, 0, -4);

                              //  Afficher le lien avec l'URL complète
                              echo "<a href='" . $fileName . "'class='result'>" . $fileName . "</a><br>";
                        }
                  } else {
                        echo "<h2>Aucune page trouvée.</h2>";
                  }
            }
            ?>

      </div>




</main>
<?php include 'templates/footer.php' ?>