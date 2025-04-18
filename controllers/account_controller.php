<?php

require_once __DIR__ . '/../models/databases.php';
require_once __DIR__ . '/../models/fonctions_formulaire.php';
require_once __DIR__ . '/../models/fonctions_account.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

      // Récupération des données du formulaire
      $day_of_birth = $_POST['days'];
      $month_of_birth = $_POST['month'];
      $year_of_birth = $_POST['year'];
      $password  = $_POST['password'];
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $mail = $_POST['email'];
      $phone = $_POST['tel'];
      $address = $_POST['postal_adress'];
      $id_role = 2;

      // Nettoyage des données
      $cleanedPassword = cleanPassword($password);
      $cleanedEmail = nettoyerEmail($mail);
      $cleanedAddress = nettoyerAdresse($address);
      $cleanedLastname = clean($lastname);
      $cleanedFirstname = clean($firstname);
      $cleanedPhone = cleanPhone($phone);

      $id_user_infos = createUserInfos($cleanedEmail, $cleanedPhone, $cleanedLastname, $cleanedFirstname, $cleanedAddress);
      // Vérification si l'ID d'utilisateur infos est valide avant de créer l'utilisateur
      if ($id_user_infos) {

            // Création de l'utilisateur avec les informations précédemment créées
            $id = createUser($day_of_birth, $month_of_birth, $year_of_birth, $cleanedPassword, $id_user_infos, $id_role);
            echo $id;
            // Vérification si l'ID de l'utilisateur a été retourné
            if ($id) {
                  // Récupération des informations de l'utilisateur par son ID
                  $user = getUserById($id);

                  if ($user) {
                        $_SESSION['userInfos'] = $user;
                        header('location: account');
                  } else {
                        $_SESSION['error'] = "⚠️ Aucune donnée trouvée pour cet utilisateur.";
                  }
            }
      }
} elseif (!empty($_POST['customerMail']) && !empty($_POST['passwordCustomer'])) {

      if (!empty($_SESSION['success_message'])) {
            unset($_SESSION['success_message']);
      }

      $password = $_POST['passwordCustomer'];
      $mail = $_POST['customerMail'];

      if (verification($mail, $password) === true) {
            // Récupération de toutes les informations utilisateur via le mail  :
            $_SESSION['userInfos'] = getUserInfos($mail);
      } else {
            echo "<p> TON PASSWORD N'EST PAS BON</p>";
      }
}



// Envoi de mail afin de changer le mdp( dans notre cas redirection vers la page pour changer le mdp)
//====================================================================================================
if (!empty($_POST['passwordLost'])) {
      header('location:reset_password');
      exit();
}

// Se déconnecter
//====================
if (!empty($_POST['deconnexion'])) {
      session_unset();
      session_destroy();
      header('location: /');
      exit();
}

// Supprimer le compte
//=======================
if (isset($_POST['supprimer'])) {
      $idUser = $_SESSION['userInfos']['id_users'];
      deleteUser($idUser);
      $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Votre compte a été supprimé avec succès.'
      ];
      unset($_SESSION['userInfos']);
      // Redirige vers la page d'accueil (ou autre)
      header('location: /');
      exit();
}


//////////////////////////////////////////////////////////////////
/////////////    SUPPRIMER UN RRENDEZ VOUS    ///////////////////
////////////////////////////////////////////////////////////////

if (!empty($_GET['dateRDV']) && !empty($_GET['timeRDV'])) {

      $appointmentDateStr = $_GET['dateRDV'];
      $appointmentTime = $_GET['timeRDV'];
      deleteAppointment($appointmentDateStr, $appointmentTime);
      $_SESSION['userInfos']['appointmentDate'] = "";
      $_SESSION['userInfos']['appointmentTime'] = "";
}

///////////////////////////////////////////////////////////////////////////////////////////
////////// Vérifié si l'utilisateur est déjà connecté si oui (quel rôle à t'il) ///////////
////////// et le dirigé vers la page de son compte sinon le dirigé sur inscription ///////
///////////////////////////////////////////////////////////////////////////////////////////

if (!empty($_SESSION['userInfos'])) {
      if ($_SESSION['userInfos']['id_role'] == 2) {

            // Si l'utilisateur est connecté, rediriger vers la page de compte
            include __DIR__ . '/../views/account.php';
            exit();
      } else {

            // Si l'admin est connecté, rediriger vers la page de compte admin
            require_once __DIR__ . '/../models/fonctions_farms.php';
            include __DIR__ . '/../views/accountADMIN.php';

            exit();
      }
} else {
      include_once __DIR__ . '/../controllers/inscription_controller.php';
      exit();
}


//////////////////////////////////////////////////////////////////
/////////////    fonctions pour accountADMIN   ///////////////////
//////////////////////////////////////////////////////////////////

// if (!empty($_POST['glasseData'])) {
//       // Vérifier si un fichier a été téléchargé
//       if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//             // Dossier où stocker les images
//             $upload_dir = '/assets/img/marques/' . $brand . '/lunettes/' . $category . '/' . $gender . '/';
//             $filename = basename($_FILES['image']['name']);
//             $filepath = $upload_dir . $filename;

//             // Déplacer le fichier téléchargé dans le répertoire des images
//             if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {

//                   $name = htmlspecialchars($_POST['name']);
//                   $price = floatval($_POST['price']);
//                   $stock = intval($_POST['stock']);
//                   $id_brands = intval($_POST['brand']);
//                   $id_category = intval($_POST['category']);
//                   $id_gender = intval($_POST['gender']);
//                   $color = htmlspecialchars($_POST['color']);
//                   $matter = htmlspecialchars($_POST['matter']);
//                   $shape = htmlspecialchars($_POST['shape']);


//                   addItem($name, $price, $stock);
//                   addGlasses($color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items);
//             }
//       }
// }

function ajoutLunette()
{


      if (!empty($_POST['glasseData'])) {

            // Vérifier la présence des variables
            $brand = isset($_POST['brand']) ? $_POST['brand'] : 'Non défini';
            $category = isset($_POST['category']) ? $_POST['category'] : 'Non défini';
            $gender = isset($_POST['gender']) ? $_POST['gender'] : 'Non défini';

            if ($category == 'optique') {
                  $id_category = 1;
            } else {
                  $id_category = 2;
            }

            // attribuer un genre à un id 

            if ($gender == 'hommes') {
                  $id_gender = 1;
            } elseif ($gender == 'femmes') {
                  $id_gender = 2;
            } elseif ($gender == 'enfants') {
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

            // Vérifier si un fichier a été téléchargé
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                  // Dossier où stocker les images
                  $upload_dir =  'assets/img/marques/' . $brand . '/lunettes/' . $category . '/' . $gender . '/';

                  // Récupérer le nom du fichier et sécuriser son nom
                  $image_name = basename($_FILES['image']['name']);
                  $image_path = $upload_dir . $image_name;

                  // Vérification du type de fichier (ex. images .jpg, .png)
                  $allowed_extensions = ['jpg', 'jpeg', 'png'];
                  $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                  if (!in_array($file_extension, $allowed_extensions)) {
                        die('Erreur : fichier non autorisé (seuls .jpg, .jpeg, .png sont acceptés)');
                  }

                  // Déplacer le fichier téléchargé dans le répertoire des images
                  if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {

                        // Afficher un message de succès
                        echo 'Fichier déplacé avec succès : ' . $image_path;
                        // Sécuriser et valider les autres données du formulaire
                        $name = htmlspecialchars($_POST['name']);
                        $price = floatval($_POST['price']);
                        $stock = intval($_POST['stock']);

                        $color = htmlspecialchars($_POST['color']);
                        $matter = htmlspecialchars($_POST['matter']);
                        $shape = htmlspecialchars($_POST['shape']);



                        // Ajouter l'item
                        $id_items = addItem($name, $price, $stock);
                        echo $id_items;

                        // Vérifier si l'ID a été récupéré
                        if ($id_items) {
                              // Ajouter les lunettes en utilisant l'ID récupéré
                              if (!addGlasses($color, $matter, $shape, $image_path, $image_name, $id_category, $id_gender, $id_brands, $id_items)) {
                                    die('Erreur lors de l\'ajout des lunettes dans la base de données');
                              } else {
                                    echo '<h2 style="color:"green"">Lunettes ajoutées avec succès</h2>';
                              }
                        } else {
                              die('Erreur lors de l\'ajout de l\'item dans la base de données');
                        }
                  } else {
                        die('Aucune image téléchargée ou erreur dans le téléchargement.');
                  }
            }
      }
}
//trouver comment récupérer l'id de additems pour mercredi  19/03/2025