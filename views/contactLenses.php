<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lentilles de contact</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/assets/css/headerFooter.css" />
  <link rel="stylesheet" href="/assets/css/contactLenses.css" />
</head>

<body>
  <?php include __DIR__ . '/../templates/header.php' ?>

  <div class="container">
    <div class="content">
      <h1>Page en Création</h1>
      <p>Désolé, cette page est actuellement en cours de création. Revenez plus tard !</p>
      <div class="spinner"></div>
      <p>Merci de votre patience.</p>
    </div>
  </div>

  <main>
    <div class="img">
      <img
        src="/assets/img/boite-lentille.png"
        alt="Lentilles"
        id="image" />
    </div>
    <div class="container-contactLenses-post-it">
      <div class="contactLenses-post-it-scotch"></div>

      <label for="correctionOD">Correction de l'oeil droit</label>
      <select name="correctionOD" id="correctionOD">
        <option value="1">- 1</option>
        <option value="2">- 2</option>
        <option value="3">- 3</option>
        <option value="4">- 4</option>
        <option value="5">- 5</option>
      </select>

      <label for="correctionOG">Correction de l'oeil gauche</label>
      <select name="correctionOG" id="correctionOG">
        <option value="1">- 1</option>
        <option value="2">- 2</option>
        <option value="3">- 3</option>
        <option value="4">- 4</option>
        <option value="5">- 5</option>
      </select>

      <label for="number">Combien de boîtes voulez-vous ?</label>
      <select name="number" id="number">
        <option value="" Nombres de boîtes></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
      <button type="submit" class="button">Commander</button>
      <button type="submit" class="button">Ajouter au panier</button>
    </div>
  </main>

  <!-- ----------------------------------------footer -------------------------------------------- -->

  <?php include __DIR__ . '/../templates/footer.php' ?>
</body>

</html>