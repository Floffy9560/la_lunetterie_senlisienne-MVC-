<?php

/////////////////////////////////////////////////////////////
///////////// FONCTIONS LUNETTES ///////////////////////////
///////////////////////////////////////////////////////////

function searchGlassesBy($column, $value)
{
      $pdo = getConnexion();
      try {
            $allowedColumns = ['brand', 'shape', 'color', 'matter', 'gender']; // Sécurité basique
            if (!in_array($column, $allowedColumns)) {
                  throw new InvalidArgumentException("Colonne de recherche non valide.");
            }

            $sql = "SELECT * FROM `kghdsi_glasses`
                    INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                    LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                    INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                    INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender
                WHERE ";

            if ($column === 'brand') {
                  $sql .= "kghdsi_brands.brand LIKE :value";
            } elseif ($column === 'gender') {
                  $sql .= "kghdsi_gender.gender LIKE :value";
            } else {
                  $sql .= "kghdsi_glasses.$column LIKE :value";
            }

            $stmt = $pdo->prepare($sql);
            $valueSearch = '%' . $value . '%';
            $stmt->bindParam(':value', $valueSearch, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
            echo "Erreur récupération des données SQL : " . $e->getMessage();
            return false;
      }
}

function searchByBrand($brand)
{
      return searchGlassesBy('brand', $brand);
}

function searchByShape($shape)
{
      return searchGlassesBy('shape', $shape);
}

function searchByColor($color)
{
      return searchGlassesBy('color', $color);
}

function searchByMatter($matter)
{
      return searchGlassesBy('matter', $matter);
}

function searchByGender($gender)
{
      return searchGlassesBy('gender', $gender);
}



function insertGlasseData()
{

      $pdo = getConnexion();
      try {
            $stmt = $pdo->prepare("SELECT * 
                              FROM `kghdsi_glasses`
                              INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                              LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                              INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                              INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
      } catch (PDOException $e) {
            // $_SESSION['error'] = "���️ Erreur insertion image SQL : " . $e->getMessage();
            echo "���️ Erreur insertion image SQL : " . $e->getMessage();
            return false;
      }
}
// function displayCards()
// {
//       // Liste des filtres possibles et des fonctions associées
//       $filters = [
//             'brands' => 'searchByBrand',
//             'shapes' => 'searchByShape',
//             'matters' => 'searchByMatter',
//             'genders' => 'searchByGender',
//             'colors' => 'searchByColor'
//       ];

//       foreach ($filters as $key => $function) {
//             if (!empty($_GET[$key]) && is_array($_GET[$key])) {
//                   $filteredGlasses = [];
//                   foreach ($_GET[$key] as $value) {
//                         $filteredGlasses = array_merge($filteredGlasses, $function($value));
//                   }

//                   displayGlasses($filteredGlasses);
//             }
//             if (!empty($_GET[$key]) && !is_array($_GET[$key])) {
//                   echo "
//                   <div style='
//                       display: flex;
//                       justify-content: center;
//                       align-items: center;
//                       height: 200px;
//                       background-color:rgba(31, 65, 61, 1);
//                       margin: auto;
//                       padding: 20px;
//                       border-radius: 10px;
//                   '>
//                       <h2 style='
//                           color: #c89f36;
//                           font-family: Arial, sans-serif;
//                           font-weight: normal;
//                           text-align: center;
//                       '>
//                           Pas de produits trouvés
//                       </h2>
//                   </div>
//                   ";
//             }
//       }

//       // Si aucun filtre n'est appliqué, afficher toutes les lunettes
//       displayGlasses(insertGlasseData());
// }

function displayCards()
{
      $filters = [
            'brands' => 'searchByBrand',
            'shapes' => 'searchByShape',
            'matters' => 'searchByMatter',
            'genders' => 'searchByGender',
            'colors' => 'searchByColor'
      ];

      $hasFilters = false;
      $results = [];

      foreach ($filters as $key => $function) {
            if (!empty($_GET[$key])) {
                  if (is_array($_GET[$key])) {
                        $hasFilters = true;
                        $subResults = [];
                        foreach ($_GET[$key] as $value) {
                              $subResults = array_merge($subResults, $function($value));
                        }
                        $results[] = $subResults;
                  } else {
                        displayNoProductsFound();
                        return;
                  }
            }
      }

      if ($hasFilters) {
            // Intersect all results (apply AND logic)
            $filteredGlasses = call_user_func_array('array_intersect', array_map('serializeArray', $results));
            $filteredGlasses = array_map('unserialize', $filteredGlasses);

            if (!empty($filteredGlasses)) {
                  displayGlasses($filteredGlasses);
            } else {
                  displayNoProductsFound();
            }
      } else {
            // Aucun filtre, afficher tout
            $all = insertGlasseData();
            if (!empty($all)) {
                  displayGlasses($all);
            } else {
                  displayNoProductsFound();
            }
      }
}

function serializeArray($array)
{
      return array_map('serialize', $array);
}

function displayNoProductsFound()
{
      // echo "
      //     <div style='
      //         display: flex;
      //         justify-content: center;
      //         align-items: center;
      //         height: 200px;
      //         background-color:rgba(31, 65, 61, 1);
      //         margin: auto;
      //         padding: 20px;
      //         border-radius: 10px;
      //     '>
      //         <h2 style='
      //             color: #c89f36;
      //             font-family: Arial, sans-serif;
      //             font-weight: normal;
      //             text-align: center;
      //         '>
      //             Pas de produits trouvés
      //         </h2>
      //     </div>
      //     ";
      echo "
      <script>
  Swal.fire({
    showConfirmButton: false,
    html: `
        <i class=\"bi bi-eye-slash\" style=\"font-size: 60px;color:red\"></i>
        <h2 style=\"color:#c89f36; font-family: Georgia;\">Oops...</h2>
        <p style=\"color:#c89f36;\">Aucun produit ne correspond à votre recherche.</p>
        <a href=\"frams\" style=\"display:inline-block; margin-top:20px; padding:10px 20px; background:#c89f36; color:#1f413d; border-radius:5px; text-decoration:none;\">Retour</a>
    `,
    background: '#1f413d',
    customClass: {
        popup: 'swal2-custom'
    }
});
</script>
      ";
}




function displayGlasses($glasses)
{
      foreach ($glasses as $lunette) {
            $idGlasses = $lunette['id_glasses'];
            echo "<div class='cards' id='lunette' data-id='$idGlasses'>";
            echo '<img src="' . htmlspecialchars($lunette['image_path']) . '" alt="Lunette de marque ' . htmlspecialchars($lunette['image_name']) . '" style="width: 100%; height: 150px;" class="img">';
            echo '<h3>' . ucfirst(htmlspecialchars($lunette['name'])) . '</h3>';
            echo '<p id="price">Prix: ' . intval($lunette['price']) . '€</p>';
            echo '<p>Couleur: ' . ucfirst(htmlspecialchars($lunette['color'])) . '</p>';
            echo '<p>Matière: ' . ucfirst(htmlspecialchars($lunette['matter'])) . '</p>';
            echo '<p>Genre: ' . ucfirst(htmlspecialchars($lunette['gender'])) . '</p>';
            echo '<p>Catégorie: ' . ucfirst(htmlspecialchars($lunette['category'])) . '</p>';
            echo '<p>Marque: ' . ucfirst(htmlspecialchars($lunette['brand'])) . '</p>';
            echo '<div class="footerCards">';
            echo "<button class='buttonPushCart'>Ajouter au panier</button>";
            echo "<i class='bi bi-heart-fill'></i>";
            echo '</div>';
            echo "</div>";
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
