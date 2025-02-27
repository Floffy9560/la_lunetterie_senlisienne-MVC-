<?php
// model/user.model.php

//////// Configuration de la connexion à la base de données qui créer un nouveau handler à chaque fois ////////

// function getConnexion()
// {
//       try {
//             $dsn = "mysql:host=localhost;dbname=la_lunetterie_senlisienne;charset=utf8";
//             $user = "root";
//             $pass = "";
//             $pdo = new PDO($dsn, $user, $pass);
//             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             return $pdo;
//       } catch (PDOException $e) {
//             echo "Erreur de connexion : " . $e->getMessage();
//             die();
//       }
// }

///// Configuration de la connexion à la base de données qui vérifie si un handler existe /////

function getConnexion()
{
      static $pdo = null; // Stocke la connexion pour qu’elle soit réutilisée
      if ($pdo === null) {
            try {
                  $dsn = "mysql:host=localhost;dbname=la_lunetterie_senlisienne;charset=utf8";
                  $user = "root";
                  $pass = "";
                  $pdo = new PDO($dsn, $user, $pass);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                  echo "Erreur de connexion : " . $e->getMessage();
                  die();
            }
      }
      return $pdo;
}

// Récupérer tous les utilisateurs (id et nom uniquement)
function getAllUsers()
{
      $pdo = getConnexion();
      $sql = "SELECT id, lastname FROM user_infos";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
            return false;
      }
}

// Récupérer un utilisateur par son ID
function getUser($mail)  // penser a mettre password pour vérifier 
{
      $pdo = getConnexion();
      // Utilisation de la jointure 
      $sql = " SELECT 
      u.id_users,
      u.day_of_birth,
      u.month_of_birth,
      u.year_of_birth,
      u.password,
      ui.id_user_infos,
      ui.mail,
      ui.phone,
      ui.lastname,
      ui.firstname,
      ui.address,
      r.id_role,
      r.name AS role_name
  FROM kghdsi_users u
  INNER JOIN kghdsi_user_infos ui ON u.id_user_infos = ui.id_user_infos
  INNER JOIN kghdsi_role r ON u.id_role = r.id_role
  WHERE ui.mail = :mail";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
            $users = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($users) {
                  // Enregistrer les informations utilisateur dans la session
                  $_SESSION['user_id'] = $users['id_user_infos'];  // ID de l'utilisateur
                  $_SESSION['user_role'] = $users['id_role']; // Rôle de l'utilisateur (optionnel)
                  $_SESSION['user_mail'] = $users['mail'];    // Email de l'utilisateur (optionnel)
                  $_SESSION['user_phone'] = $users['phone']; // Rôle de l'utilisateur (optionnel)
                  $_SESSION['user_address'] = $users['address'];    // Email de l'utilisateur (optionnel)
                  $_SESSION['user_firstname'] = $users['firstname']; // Rôle de l'utilisateur (optionnel)
                  $_SESSION['user_lastname'] = $users['lastname'];    // Email de l'utilisateur (optionnel)


                  return $users;
            } else {
                  return false;
            }
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
      }
}

// Récupérer l'ID  un utilisateur par son mail
function getUserIdByMail($mail)
{
      $pdo = getConnexion();
      $sql = "SELECT id_user_infos FROM kghdsi_user_infos WHERE mail = :mail";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR); // Correction du type
            $stmt->execute();

            // Récupération de l'ID utilisateur
            $userId = $stmt->fetchColumn();

            return $userId ?: false; // Retourne l'ID ou false si aucun utilisateur trouvé
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
      }
}


// Créer un nouvel utilisateur

function createUserInfos($mail, $phone, $lastname, $firstname, $address)
{
      $pdo = getConnexion();

      // Vérifier si l'utilisateur existe déjà
      $sql_check = "SELECT id_user_infos FROM kghdsi_user_infos WHERE mail = :mail OR phone = :phone";
      $stmt = $pdo->prepare($sql_check);
      $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->execute();

      $result_check = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result_check) {
            echo "<p style='color:white'>Le mail : " . $mail . " est déjà utilisé </p>";
            return false; // Empêche l'insertion
      }

      // Insérer un nouvel utilisateur
      $sql_insert = "INSERT INTO kghdsi_user_infos (mail, phone, lastname, firstname, address) 
                   VALUES (:mail, :phone, :lastname, :firstname, :address)";
      try {
            $stmt = $pdo->prepare($sql_insert);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR); // Toujours en STR
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer l'ID du nouvel utilisateur
            $id = $pdo->lastInsertId();
            return $id;

            // Récupérer l'ID via un SELECT
            // $sql_select = "SELECT id_user_infos FROM kghdsi_user_infos 
            // WHERE mail = :mail AND phone = :phone AND lastname = :lastname 
            // AND firstname = :firstname AND address = :address";
            // $stmt = $pdo->prepare($sql_select);
            // $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            // $stmt->execute();
            // $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // if ($result) {
            //       return $result['id']; // Retourne l'ID de l'utilisateur inséré
            // }
            // return false;
      } catch (PDOException $e) {
            echo "<p style='color:white'>Erreur lors de la création de l'utilisateur (user infos) : " . $e->getMessage() . "</p>";
            return false;
      }
}


function createUser($day_of_birth, $month_of_birth, $year_of_birth, $password, $id_user_infos, $id_role)
{
      $pdo = getConnexion();
      $sql = "INSERT INTO kghdsi_users (day_of_birth, month_of_birth,year_of_birth, password,id_user_infos,id_role)
       VALUES (:day_of_birth, :month_of_birth,:year_of_birth, :password, :id_user_infos, :id_role)";


      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':day_of_birth', $day_of_birth, PDO::PARAM_INT);
            $stmt->bindParam(':month_of_birth', $month_of_birth, PDO::PARAM_STR);
            $stmt->bindParam(':year_of_birth', $year_of_birth, PDO::PARAM_INT);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':id_user_infos', $id_user_infos, PDO::PARAM_INT);
            $stmt->bindParam(':id_role', $id_role, PDO::PARAM_INT);


            return $stmt->execute();
      } catch (PDOException $e) {
            echo "<p style='color:white'>Erreur lors de la création de l'utilisateur (users) : " . $e->getMessage() . "</p>";
            return false;
      }
}



// Mettre à jour un utilisateur
function updateUser($id, $nom, $email, $password)
{
      $pdo = getConnexion();
      $sql = "UPDATE users SET nom = :nom, email = :email, password = :password WHERE id = :id";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            return $stmt->execute();
      } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
            return false;
      }
}

// Supprimer un utilisateur
function deleteUser($idUser)
{
      $pdo = getConnexion();

      // 1️ Récupérer id_user_infos et id_role liés à cet utilisateur
      $sql = "SELECT id_user_infos, id_role FROM kghdsi_users WHERE id_users = :idUser";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
      $stmt->execute();
      $userData = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$userData) {
            echo "Utilisateur introuvable.";
            return false;
      }

      $idUserInfos = $userData['id_user_infos'];
      $idRole = $userData['id_role'];

      try {
            $pdo->beginTransaction(); // 🔹 Commencer une transaction pour éviter les erreurs partielles

            // 2️ Supprimer l'utilisateur de `kghdsi_users`
            $sql = "DELETE FROM kghdsi_users WHERE id_users = :idUser";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $stmt->execute();

            // 3️ Supprimer les informations utilisateur de `kghdsi_user_infos`
            $sql = "DELETE FROM kghdsi_user_infos WHERE id_user_infos = :idUserInfos";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUserInfos', $idUserInfos, PDO::PARAM_INT);
            $stmt->execute();

            // 4️ Vérifier si le rôle est toujours utilisé par d'autres utilisateurs
            // $sql = "SELECT COUNT(*) FROM kghdsi_users WHERE id_role = :idRole";
            // $stmt = $pdo->prepare($sql);
            // $stmt->bindParam(':idRole', $idRole, PDO::PARAM_INT);
            // $stmt->execute();
            // $roleCount = $stmt->fetchColumn();

            // // Si aucun utilisateur n'utilise ce rôle, on peut le supprimer
            // if ($roleCount == 0) {
            //       $sql = "DELETE FROM kghdsi_role WHERE id_role = :idRole";
            //       $stmt = $pdo->prepare($sql);
            //       $stmt->bindParam(':idRole', $idRole, PDO::PARAM_INT);
            //       $stmt->execute();
            //}

            $pdo->commit(); // 🔹 Valider toutes les suppressions si tout s'est bien passé
            return true;
      } catch (PDOException $e) {
            $pdo->rollBack(); // 🔹 Annuler tout en cas d'erreur
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
      }
}

// function verification($mail, $password)
// {
//       // Connexion à la base de données
//       $pdo = getConnexion();

//       // Requête pour récupérer le mot de passe haché associé à l'email
//       $sql = "SELECT u.password 
//             FROM kghdsi_users u 
//             JOIN kghdsi_user_infos ui ON u.id_user_infos = ui.id_user_infos 
//             WHERE ui.mail = :mail";

//       try {
//             // Préparation de la requête
//             $stmt = $pdo->prepare($sql);
//             $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
//             $stmt->execute();

//             // Récupération du mot de passe haché
//             $hashedPassword = $stmt->fetchColumn();

//             if ($hashedPassword) {
//                   // Vérifier si le mot de passe correspond au hachage
//                   if (password_verify($password, $hashedPassword)) {
//                         return true; // Mot de passe correct
//                   } else {
//                         return false; // Mot de passe incorrect
//                   }
//             } else {
//                   return false; // Email introuvable
//                   die();
//             }
//       } catch (PDOException $e) {
//             echo "Erreur lors de la vérification : " . $e->getMessage();
//             return false;
//       }
// }

function verification($mail, $password)
{
      $pdo = getConnexion();

      $sql = "SELECT u.password 
            FROM kghdsi_users u 
            JOIN kghdsi_user_infos ui ON u.id_user_infos = ui.id_user_infos 
            WHERE ui.mail = :mail";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            // Récupération de la ligne complète pour voir ce que MySQL retourne
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $hashedPassword = $user['password'];


            if (password_verify($password, $hashedPassword)) {
                  return true; // ✅ Mot de passe correct
            } else {
                  header('location:inscription');
                  return false;
            }
      } catch (PDOException $e) {
            echo "Erreur lors de la vérification : " . $e->getMessage();
            return false;
      }
}

// avec $id=$_SESSION['user_id'] 
function checkPassword($mail, $password)
{
      $pdo = getConnexion();

      $sql = "SELECT password 
            FROM kghdsi_users
            WHERE mail = :mail";

      try {
            // Préparer la requête
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_INT);
            $stmt->execute();

            // Récupérer le mot de passe stocké
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe
            if (!$user) {
                  echo "Utilisateur non trouvé.";
                  return false; // Retourne false si l'utilisateur n'existe pas
            }

            $hashedPassword = $user['password'];

            // Vérification du mot de passe
            if (password_verify($password, $hashedPassword)) {
                  return true; // ✅ Mot de passe correct
            } else {
                  echo "Mot de passe incorrect.";
                  return false; // Retourne false si le mot de passe est incorrect
            }
      } catch (PDOException $e) {
            // Gestion des erreurs en cas d'échec de la requête
            echo "Erreur lors de la vérification : " . $e->getMessage();
            return false;
      }
}

function checkMail($mail)
{
      $pdo = getConnexion();

      $sql = "SELECT mail 
            FROM kghdsi_user_infos
            WHERE mail = :mail";

      try {
            // Préparer la requête
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer le mot de passe stocké
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe
            if (!$user) {

                  return false; // Retourne false si l'utilisateur n'existe pas
            } else {
                  return true; // Retourne true si l'utilisateur existe
            }
      } catch (PDOException $e) {
            // Gestion des erreurs en cas d'échec de la requête
            echo "Erreur lors de la vérification : " . $e->getMessage();
            return false;
      }
}


// changer le mdp dans la bdd 

function changePassword($id, $newPassword)
{ // avec $id=$_SESSION['user_id'] et $newpassword= nouveau pass renseigné par le client 

      $pdo = getConnexion();

      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      $sql = "UPDATE kghdsi_users
      SET password = :newPassword WHERE id_users = :id";

      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':newPassword', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Ajout de la liaison pour l'ID

            $stmt->execute();
            return true;
      } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
            return false;
      }
}
