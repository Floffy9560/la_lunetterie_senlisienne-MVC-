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

   <main>
      <button type="button" class="buttonFilter" id="buttonFilter">Afficher les filtres<i class="bi bi-filter-square-fill"></i></button>
      <div class="searchContainer">
         <div class="menuSearch" id="menuSearch">
            <div class="testinput">
               <div class="containerInputSearch">


                  <form action="" method="GET">
                     <p>Marque :</p>
                     <div class="containerCheckbox">
                        <span>
                           <input type="checkbox" id="brett" name="brands[]" value="brett" />
                           <label for="brett">Brett</label>
                        </span>
                        <span>
                           <input type="checkbox" id="minamoto" name="brands[]" value="minamoto" />
                           <label for="minamoto">Minamoto</label>
                        </span>
                        <span>
                           <input type="checkbox" id="cazal" name="brands[]" value="cazal" />
                           <label for="cazal">Cazal</label>
                        </span>
                        <span>
                           <input type="checkbox" id="bali" name="brands[]" value="bali" />
                           <label for="bali">Bali</label>
                        </span>
                     </div>
                     <div>
                        <button type="submit" class="buttonSearch" id="buttonSearch">Filtrer par marque </button>
                     </div>
                  </form>
               </div>

               <div class="containerInputSearch">

                  <form action="" method="GET">
                     <p>Genre :</p>
                     <div class="containerCheckbox">
                        <span>
                           <input type="checkbox" id="men" name="genders[]" value="homme" />
                           <label for="men">Homme</label>
                        </span>
                        <span>
                           <input type="checkbox" id="femme" name="genders[]" value="femme" />
                           <label for="femme">Femme</label>
                        </span>
                        <span>
                           <input type="checkbox" id="enfant" name="genders[]" value="enfant" />
                           <label for="enfant">Enfant</label>
                        </span>
                        <span>
                           <input type="checkbox" id="mixteGender" name="genders[]" value="mixte" />
                           <label for="mixteGender">Mixte</label>
                        </span>
                     </div>
                     <div>
                        <button type="submit" class="buttonSearch"> Filtrer par genre</button>
                     </div>
                  </form>
               </div>



               <div class="containerInputSearch">

                  <form action="" method="GET">
                     <p>Formes :</p>
                     <div class="containerCheckbox">
                        <span>
                           <input type="checkbox" id="carrée" name="shapes[]" value="carrée" />
                           <label for="carrée">Carrée</label>
                        </span>
                        <span>
                           <input type="checkbox" id="ronde" name="shapes[]" value="ronde" />
                           <label for="ronde">Ronde</label>
                        </span>
                        <span>
                           <input type="checkbox" id="pantos" name="shapes[]" value="pantos" />
                           <label for="pantos">Pantos</label>
                        </span>
                        <span>
                           <input type="checkbox" id="originale" name="shapes[]" value="originale" />
                           <label for="original">Originale</label>
                        </span>
                        <span>
                           <input type="checkbox" id="hexagonale" name="shapes[]" value="hexagonale" />
                           <label for="hexagonale">Hexagonale</label>
                        </span>
                        <span>
                           <input type="checkbox" id="papillon" name="shapes[]" value="papillon" />
                           <label for="papillon">Papillon</label>
                        </span>
                        <span>
                           <input type="checkbox" id="octogonale" name="shapes[]" value="octogonale" />
                           <label for="octogonale">Octogonale</label>
                        </span>
                     </div>
                     <div>
                        <button type="submit" class="buttonSearch"> Filtrer par formes</button>
                     </div>
                  </form>
               </div>



               <div class="containerInputSearch">

                  <form action="" method="GET">
                     <p>Couleurs :</p>
                     <div class="containerCheckbox">
                        <span>
                           <input type="checkbox" id="noir" name="colors[]" value="noir" />
                           <label for="noir">Noir</label>
                        </span>
                        <span>
                           <input type="checkbox" id="rouge" name="colors[]" value="rouge" />
                           <label for="rouge">Rouge</label>
                        </span>
                        <span>
                           <input type="checkbox" id="ecaille" name="colors[]" value="ecaille" />
                           <label for="ecaille">Ecaille</label>
                        </span>
                        <span>
                           <input type="checkbox" id="marron" name="colors[]" value="marron" />
                           <label for="marron">Marron</label>
                        </span>
                        <span>
                           <input type="checkbox" id="bleu" name="colors[]" value="bleu" />
                           <label for="bleu">Bleu</label>
                        </span>
                        <span>
                           <input type="checkbox" id="or" name="colors[]" value="or" />
                           <label for="or">Or</label>
                        </span>
                        <span>
                           <input type="checkbox" id="rose" name="colors[]" value="rose" />
                           <label for="rose">Rose</label>
                        </span>
                        <span>
                           <input type="checkbox" id="gris" name="colors[]" value="gris" />
                           <label for="gris">Gris</label>
                        </span>
                        <span>
                           <input type="checkbox" id="vert" name="colors[]" value="vert" />
                           <label for="vert">Vert</label>
                        </span>
                     </div>
                     <div>
                        <button type="submit" class="buttonSearch">Filtrer par couleurs</button>
                     </div>
                  </form>
               </div>



               <div class="containerInputSearch">

                  <form action="" method="get">
                     <p>Matières :</p>
                     <div class="containerCheckbox">
                        <span>
                           <input type="checkbox" id="titane" name="matters[]" value="titane" />
                           <label for="titane">Titane</label>
                        </span>
                        <span>
                           <input type="checkbox" id="acetate" name="matters[]" value="acetate" />
                           <label for="acetate">Acetate</label>
                        </span>
                        <span>
                           <input type="checkbox" id="acier" name="matters[]" value="acier" />
                           <label for="acier">Acier</label>
                        </span>
                        <span>
                           <input type="checkbox" id="metal" name="matters[]" value="metal" />
                           <label for="metal">Métal</label>
                        </span>
                     </div>
                     <div>
                        <button type="submit" class="buttonSearch">Filtrer par matières</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="test">
               <form action="" method="GET">

                  <button class="buttonReset">Réinitialiser</button>
               </form>
            </div>
         </div>
      </div>
      <div class="overlay" id="overlay"></div>


      <div class="containerCards">
         <?php displayCards();   ?>
      </div>


   </main>
   <script src="/assets/JS/frams.js" defer></script>
</body>

<?php include 'templates/footer.php' ?>

</html>