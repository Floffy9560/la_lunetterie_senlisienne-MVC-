<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Offres</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="assets/css/headerFooter.css" />
    <link rel="stylesheet" href="assets/css/offers.css" />
  </head>
  <?php include('header.php') ?>
  <body>
    <div class="containerOffers">
      <div class="offers">
        <h2>Offre principale</h2>

        <div class="containerOffersImage">
          <a href="mutuelles.php"
            ><img
              src="assets/img/offre-TT-Classique.jpg"
              alt="offre du moment"
              class="offersImage img1"
          /></a>
        </div>
      </div>
      <div class="offers">
        <h2>Le 100% santée</h2>

        <div class="containerOffersImage">
          <img
            src="assets/img/cmu.png"
            alt="100% santée"
            class="offersImage img2"
          />
        </div>
        <a href="mutuelles.php" class="linkSantée">Se renseigner</a>
      </div>
      <div class="offers">
        <h2>Les mutuelles</h2>

        <div class="containerOffersImage">
          <a href="mutuelles.php" class="linkMutuelle">
            <p class="offersP">
              Pour plus de facilitées le 1/3 payant est mit à votre disposition
              (plus amples renseignements en magasin)
            </p>
          </a>
        </div>
      </div>
    </div>

    <?php include('footer.php') ?>
  </body>
</html>
