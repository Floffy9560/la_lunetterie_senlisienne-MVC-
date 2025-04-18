<?php
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
