<?php


function displayCards()
{

      if (!empty($_GET['brands']) && is_array($_GET['brands'])) {
            $brands = $_GET['brands'];

            foreach ($brands as $brand) {


                  $displayBrand = searchByBrand($brand);

                  foreach ($displayBrand as $lunette) {

                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<div class="footerCards">';
                        echo "<button  class='buttonPushCart'>Ajouter au panier</i></button>";
                        echo "<i class='bi bi-heart-fill'></i>";
                        echo '</div>';
                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['shapes']) && is_array($_GET['shapes'])) {
            $shapes = $_GET['shapes'];

            foreach ($shapes as $shape) {


                  $displayShape = searchByShape($shape);

                  foreach ($displayShape as $lunette) {

                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<div class="footerCards">';
                        echo "<button  class='buttonPushCart'>Ajouter au panier</i></button>";
                        echo "<i class='bi bi-heart-fill'></i>";
                        echo '</div>';
                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['matters']) && is_array($_GET['matters'])) {
            $matters = $_GET['matters'];

            foreach ($matters as $matter) {


                  $displayMatter = searchByMatter($matter);
                  foreach ($displayMatter as $lunette) {
                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<div class="footerCards">';
                        echo "<button  class='buttonPushCart'>Ajouter au panier</i></button>";
                        echo "<i class='bi bi-heart-fill'></i>";
                        echo '</div>';
                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['genders']) && is_array($_GET['genders'])) {
            $genders = $_GET['genders'];

            foreach ($genders as $gender) {

                  $displayGender = searchByGender($gender);
                  foreach ($displayGender as $lunette) {
                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<div class="footerCards">';
                        echo "<button  class='buttonPushCart'>Ajouter au panier</i></button>";
                        echo "<i class='bi bi-heart-fill'></i>";
                        echo '</div>';
                        echo "</div>";
                  }
            }
      } elseif (!empty($_GET['colors']) && is_array($_GET['colors'])) {
            $colors = $_GET['colors'];

            foreach ($colors as $color) {

                  $displayColorGlasses = searchByColor($color);
                  foreach ($displayColorGlasses as $lunette) {
                        echo "<div class='cards' id='lunette'>";
                        echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                        echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                        echo '<p>Prix: ' . intval($lunette['price']) . '€</p>';
                        echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                        echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                        echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                        echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                        echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                        echo '<div class="footerCards">';
                        echo "<button  class='buttonPushCart'>Ajouter au panier</i></button>";
                        echo "<i class='bi bi-heart-fill'></i>";
                        echo '</div>';
                        echo "</div>";
                  }
            }
      } else {

            $afficherLunettes = insertGlasseData();
            foreach ($afficherLunettes as $lunette) {

                  // Utilisation de l'id_glasses comme identifiant unique pour chaque carte ( va être utile pour la suppression de locale storage)
                  $idGlasses = $lunette['id_glasses'];



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

                  echo "<div class='cards' id='lunette' data-id='" . intval($idGlasses) . "'>";
                  echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
                  echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
                  echo '<p id="price">Prix: ' . intval($lunette['price']) . ' €</p>';
                  echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
                  echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
                  echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
                  echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
                  echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
                  echo '<div class="footerCards">';
                  echo "<button  class='buttonPushCart'>Ajouter au panier</i></button>";
                  echo "<i class='bi bi-heart-fill'></i>";
                  echo '</div>';
                  echo "</div>";
            }
      }
}

/////////////////////////////////////////////////////////////////////////
///////////  requetes sql pour afficher toutes les marques    ///////////
/////////////////////////////////////////////////////////////////////////

// Récuperer les diff marques
function displayBrand()
{
      $pdo = getconnexion();
      $sql = "SELECT `brand` FROM `kghdsi_brands`;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $brands;
}



/////////////////////////////////////////////////////////////////////////
/////////// requetes sql pour ajouter des lunnettes à la BDD  ///////////
/////////////////////////////////////////////////////////////////////////

//fonction générale qui prend en paramètres la table sélectionné le nbr et le nom des colonnes ainsi que le nom des valeurs
function insertData($table, $columns, $values)
{
      // Connexion à la base de données
      $pdo = getConnexion();

      // Construction de la requête SQL dynamique en fonction de la table, des colonnes et des valeurs
      $columnStr = implode(", ", $columns);
      $valueStr = ":" . implode(", :", $columns);

      try {
            $stmt = $pdo->prepare("INSERT INTO $table ($columnStr) VALUES ($valueStr)");

            // Lier les paramètres dynamiquement
            foreach ($columns as $index => $column) {
                  $stmt->bindParam(":$column", $values[$index], PDO::PARAM_STR);
            }

            $stmt->execute();

            // Retourner l'ID du dernier élément inséré si nécessaire
            return $pdo->lastInsertId();
      } catch (PDOException $e) {
            echo "⚠️ Erreur insertion dans la table $table SQL : " . $e->getMessage();
            return false;
      }
}
function addItem($name, $price, $stock)
{
      // Définir les colonnes et les valeurs à insérer
      $columns = ['name', 'price', 'stock'];
      $values = [$name, $price, $stock];

      // Appeler la fonction générique d'insertion
      return insertData('kghdsi_items', $columns, $values);
}


//implenter une paire de lunette 

function addGlasses($color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items)
{
      // Définir les colonnes et les valeurs à insérer
      $columns = ['color', 'matter', 'shape', 'image_path', 'image_name', 'id_category', 'id_gender', 'id_brands', 'id_items'];
      $values = [$color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items];

      // Appeler la fonction générique d'insertion
      return insertData('kghdsi_glasses', $columns, $values);
}


// function addItems($name, $price, $stock)
// {
//       $pdo = getConnexion();
//       try {

//             $stmt = $pdo->prepare("INSERT INTO kghdsi_items (name,price,stock) VALUES (:name,:price,:stock)");
//             $stmt->bindParam(':name', $name, PDO::PARAM_STR);
//             $stmt->bindParam(':price', $price, PDO::PARAM_INT);
//             $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
//             $stmt->execute();
//             return $pdo->lastInsertId();
//             echo "Données ITEMS insérées avec succès";
//       } catch (PDOException $e) {
//             // $_SESSION['error'] = "⚠️ Erreur insertion items SQL : " . $e->getMessage();
//             echo "⚠️ Erreur insertion items SQL : " . $e->getMessage();
//             return false;
//       }
// }

// function addGlasses($color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items)
// {
//       $pdo = getConnexion();
//       try {

//             $stmt = $pdo->prepare("
//                         INSERT INTO kghdsi_glasses 
//                         (color, matter, shape, image_path, image_name, id_category, id_gender, id_brands, id_items) 
//                         VALUES 
//                         (:color, :matter, :shape, :image_path, :image_name, :id_category, :id_gender, :id_brands, :id_items)
// ");
//             $stmt->bindParam(':color', $color, PDO::PARAM_STR);
//             $stmt->bindParam(':matter', $matter, PDO::PARAM_STR);
//             $stmt->bindParam(':shape', $shape, PDO::PARAM_STR);
//             $stmt->bindParam(':image_path', $image_path, PDO::PARAM_STR);
//             $stmt->bindParam(':image_name', $image_name, PDO::PARAM_STR);
//             $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
//             $stmt->bindParam(':id_gender', $id_gender, PDO::PARAM_INT);
//             $stmt->bindParam(':id_brands', $id_brands, PDO::PARAM_INT);
//             $stmt->bindParam(':id_items', $id_items, PDO::PARAM_INT);
//             $stmt->execute();
//             echo "Données GLASSES insérées avec succès";
//       } catch (PDOException $e) {
//             // $_SESSION['error'] = "⚠️ Erreur insertion glasses SQL : " . $e->getMessage();
//             echo "⚠️ Erreur insertion glasses SQL : " . $e->getMessage();
//             return false;
//       }
// }


///////////////////////////////////////////////////////////////
// Insérer des lunettes dans la BDD à partir d'un fichier Json
///////////////////////////////////////////////////////////////

// if (isset($_POST['BDD'])) {
//       foreach ($glasses as $glasse) {

//             $brand = strtolower($glasse['brand']);
//             $gender = strtolower($glasse["gender"]);
//             $category = strtolower($glasse["category"]);
//             $name =  strtolower($glasse['name']);
//             $price = $glasse['price'];
//             $color = strtolower($glasse['color']);
//             $matter = strtolower($glasse['matter']);
//             $shape = strtolower($glasse['shape']);
//             $stock = $glasse['stock'];
//             $image_name = strtolower($glasse['image_name']);
//             $image_path = $glasse['image_path'];

//             // attribuer une catégorie à un id 
//             if ($category == 'optique') {
//                   $id_category = 1;
//             } else {
//                   $id_category = 2;
//             }

//             // attribuer un genre à un id 

//             if ($gender == 'homme') {
//                   $id_gender = 1;
//             } elseif ($gender == 'femme') {
//                   $id_gender = 2;
//             } elseif ($gender == 'enfant') {
//                   $id_gender = 3;
//             } elseif ($gender == 'mixte') {
//                   $id_gender = 4;
//             }

//             // attribuer une marque à un id 

//             if ($brand == 'brett') {
//                   $id_brands = 1;
//             } elseif ($brand == 'paprika') {
//                   $id_brands = 2;
//             } elseif ($brand == 'clémence & Margaux') {
//                   $id_brands = 3;
//             } elseif ($brand == 'minamoto') {
//                   $id_brands = 4;
//             } elseif ($brand == 'bali') {
//                   $id_brands = 5;
//             } elseif ($brand == 'demetz') {
//                   $id_brands = 6;
//             } elseif ($brand == 'andy Brook') {
//                   $id_brands = 7;
//             } elseif ($brand == 'friendly Frenchy') {
//                   $id_brands = 8;
//             } elseif ($brand == 'woodys') {
//                   $id_brands = 9;
//             } elseif ($brand == 'la brique et la violette') {
//                   $id_brands = 10;
//             } elseif ($brand == 'sunday somewhere') {
//                   $id_brands = 11;
//             } elseif ($brand == 'malt') {
//                   $id_brands = 12;
//             } elseif ($brand == 'cazal') {
//                   $id_brands = 13;
//             } elseif ($brand == 'aponem') {
//                   $id_brands = 14;
//             }



//             // $id_items = addItems($name, $price, $stock);
//             $id_items = addItem($name, $price, $stock);
//             addGlasses($color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items);
//       }
// }