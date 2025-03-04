<?php

// Insérer des lunettes dans la BDD à partir d'un fichier Json
if (isset($_POST['BDD'])) {
      foreach ($glasses as $glasse) {

            $brand = strtolower($glasse['brand']);
            $gender = strtolower($glasse["gender"]);
            $category = strtolower($glasse["category"]);
            $name =  strtolower($glasse['name']);
            $price = $glasse['price'];
            $color = strtolower($glasse['color']);
            $matter = strtolower($glasse['matter']);
            $shape = strtolower($glasse['shape']);
            $stock = $glasse['stock'];
            $image_name = strtolower($glasse['image_name']);
            $image_path = $glasse['image_path'];

            // attribuer une catégorie à un id 
            if ($category == 'optique') {
                  $id_category = 1;
            } else {
                  $id_category = 2;
            }

            // attribuer un genre à un id 

            if ($gender == 'homme') {
                  $id_gender = 1;
            } elseif ($gender == 'femme') {
                  $id_gender = 2;
            } elseif ($gender == 'enfant') {
                  $id_gender = 3;
            } elseif ($gender == 'mixte') {
                  $id_gender = 4;
            }

            // attribuer une marque à un id 

            if ($brand == 'brett') {
                  $id_brands = 1;
            } elseif ($brand == 'paprika') {
                  $id_brands = 2;
            } elseif ($brand == 'clémence & Margaux') {
                  $id_brands = 3;
            } elseif ($brand == 'minamoto') {
                  $id_brands = 4;
            } elseif ($brand == 'bali') {
                  $id_brands = 5;
            } elseif ($brand == 'demetz') {
                  $id_brands = 6;
            } elseif ($brand == 'andy Brook') {
                  $id_brands = 7;
            } elseif ($brand == 'friendly Frenchy') {
                  $id_brands = 8;
            } elseif ($brand == 'woodys') {
                  $id_brands = 9;
            } elseif ($brand == 'la brique et la violette') {
                  $id_brands = 10;
            } elseif ($brand == 'sunday somewhere') {
                  $id_brands = 11;
            } elseif ($brand == 'malt') {
                  $id_brands = 12;
            } elseif ($brand == 'cazal') {
                  $id_brands = 13;
            } elseif ($brand == 'aponem') {
                  $id_brands = 14;
            }


            $id_items = addItems($name, $price, $stock);
            addGlasses($color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items);
      }
}


function displayCards()
{

      if (!empty($_GET['brands']) && is_array($_GET['brands'])) {
            $brands = $_GET['brands'];

            foreach ($brands as $brand) {


                  $displayBrand = searchByBrand($brand);

                  foreach ($displayBrand as $lunette) {

                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="lunette ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<p>Form: ' . ucfirst(htmlspecialchars($lunette['shape'])) . '</p>';
                        echo '<button class="buttonPushKart">Ajouté au panier</button>';
                        echo '<i class="bi bi-heart-fill"></i>';

                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['shapes']) && is_array($_GET['shapes'])) {
            $shapes = $_GET['shapes'];

            foreach ($shapes as $shape) {


                  $displayShape = searchByShape($shape);

                  foreach ($displayShape as $lunette) {

                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="lunette ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<p>Form: ' . ucfirst(htmlspecialchars($lunette['shape'])) . '</p>';
                        echo '<button class="buttonPushKart">Ajouté au panier</button>';
                        echo '<i class="bi bi-heart-fill"></i>';

                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['matters']) && is_array($_GET['matters'])) {
            $matters = $_GET['matters'];

            foreach ($matters as $matter) {


                  $displayMatter = searchByMatter($matter);
                  foreach ($displayMatter as $lunette) {
                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="lunette ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<button class="buttonPushKart">Ajouté au panier</button>';
                        echo '<i class="bi bi-heart-fill"></i>';

                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['genders']) && is_array($_GET['genders'])) {
            $genders = $_GET['genders'];

            foreach ($genders as $gender) {

                  $displayGender = searchByGender($gender);
                  foreach ($displayGender as $lunette) {
                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="lunette ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<button class="buttonPushKart">Ajouté au panier</button>';
                        echo '<i class="bi bi-heart-fill"></i>';

                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['colors']) && is_array($_GET['colors'])) {
            $colors = $_GET['colors'];

            foreach ($colors as $color) {

                  $displayColorGlasses = searchByColor($color);
                  foreach ($displayColorGlasses as $lunette) {
                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="lunette ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<button class="buttonPushKart">Ajouté au panier</button>';
                        echo '<i class="bi bi-heart-fill"></i>';

                        echo "</div>";
                  }
            }
      } else {

            $afficherLunettes = insertGlasseData();
            foreach ($afficherLunettes as $lunette) {

                  // echo "<pre>";
                  // print_r($lunette);
                  // echo "</pre>";

                  // Cela nous donne :
                  // (
                  //    [id_glasses] => 27
                  //    [color] => noir-or
                  //    [shape] => pantos
                  //    [matter] => acier inoxydable
                  //    [image_path] => /../assets/img/marques/Cazal/lunettes/solaires/hommes/MOD 683-cazal.webp
                  //    [image_name] => mod 683
                  //    [id_category] => 2
                  //    [id_gender] => 1
                  //    [id_brands] => 13
                  //    [id_items] => 27
                  //    [name] => mod 683
                  //    [price] => 500.00
                  //    [stock] => 1
                  //    [brand] => Cazal
                  //    [category] => solaire
                  //    [gender] => homme
                  // )

                  echo "<div class='cards' id='lunette'>";
                  echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="lunette ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                  echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                  echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                  echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                  echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                  echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                  echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                  echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                  echo '<button class="buttonPushKart">Ajouté au panier</button>';
                  echo '<i class="bi bi-heart-fill"></i>';

                  echo "</div>";
            }
      }
}
