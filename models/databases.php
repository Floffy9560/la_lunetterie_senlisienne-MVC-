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
      $sql = "SELECT id, nom FROM users";
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
function getUserById($id)
{
      $pdo = getConnexion();
      $sql = "SELECT * FROM users WHERE id = :id";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
      }
}

// Créer un nouvel utilisateur

// function createUser($nom, $email, $password)
// {
//       $pdo = getConnexion();
//       $sql = "INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)";
//       try {
//             $stmt = $pdo->prepare($sql);
//             $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
//             $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//             $stmt->bindParam(':password', $password, PDO::PARAM_STR);
//             return $stmt->execute();
//       } catch (PDOException $e) {
//             echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
//             return false;
//       }
// }

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

// createUserInfo($mail, $phone, $lastname, $firstname, $address)
// $id_user_infos= SELECT id_user_infos from user_infos WHERE $mail, $phone, $lastname, $firstname, $address;
// createUser(...)


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
function deleteUser($id)
{
      $pdo = getConnexion();
      $sql = "DELETE FROM users WHERE id = :id";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
      } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
            return false;
      }
}
