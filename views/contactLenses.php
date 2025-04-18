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
        src="/assets/img/creer_moi_une_boite_de_lentille_de_contact_générique-removebg-preview.png"
        alt="Lentilles"
        id="image" />
    </div>
    <form action="" method="GET">
      <div class="container-contactLenses-post-it">
        <div class="contactLenses-post-it-scotch"></div>


        <label for="correctionOD">Correction de l'œil droit</label>
        <select name="correctionOD" id="correctionOD">
          <option value="" disabled selected></option>
          <?php for ($i = 5; $i > -6; $i--) {
            if ($i == 0) {
              echo "<option value='$i' style='color:white;'>$i</option>";
            } else {
              echo "<option value='$i' style='color:black;'>$i</option>";
            }
          } ?>


        </select>

        <label for="correctionOG">Correction de l'œil gauche</label>
        <select name="correctionOG" id="correctionOG">
          <option value="" disabled selected></option>
          <?php for ($i = 5; $i > -6; $i--) {
            if ($i == 0) {
              echo "<option value='$i' style='color:white;'>$i</option>";
            } else {
              echo "<option value='$i' style='color:black;'>$i</option>";
            }
          } ?>
        </select>

        <label for="quantity">Combien de boîtes voulez-vous ?</label>
        <select name="quantity" id="quantity">
          <option value="" disabled selected></option>
          <?php for ($i = 0; $i < 11; $i++) {
            echo "<option value='$i'>$i</option>";
          } ?>
        </select>

        <button type="submit" class="button" name="action" value="order">Commander</button>
        <button type="button" class="button" onclick="addToCart()">Ajouter au panier</button>
      </div>
    </form>

  </main>

  <!-- ----------------------------------------footer -------------------------------------------- -->

  <?php include __DIR__ . '/../templates/footer.php' ?>
  <script>
    function addToCart() {
      // Récupérer les valeurs sélectionnées dans le formulaire
      const correctionOD = document.getElementById("correctionOD").value;
      const correctionOG = document.getElementById("correctionOG").value;
      const quantity = document.getElementById("quantity").value;
      console.log(correctionOD);
      console.log(correctionOG);
      console.log(quantity);

      // Récupérer le panier existant ou créer un tableau vide
      let storedLens = JSON.parse(localStorage.getItem("lensData")) || [];

      // Ajouter la nouvelle sélection au panier
      storedLens.push({
        correctionOD: correctionOD,
        correctionOG: correctionOG,
        quantity: quantity
      });

      // Sauvegarder le panier mis à jour
      localStorage.setItem("lensData", JSON.stringify(storedLens));

      alert("Produit ajouté au panier !");
    }
  </script>
</body>

</html>