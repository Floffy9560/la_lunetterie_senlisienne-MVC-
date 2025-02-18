<?php
// model/user.model.php

// Configuration de la connexion à la base de données
function getConnexion()
{
      try {
            $dsn = "mysql:host=localhost;dbname=la_lunetterie_senlisienne;charset=utf8";
            $user = "root";
            $pass = "";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            die();
      }
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
function createUser($nom, $email, $password)
{
      $pdo = getConnexion();
      $sql = "INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)";
      try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            return $stmt->execute();
      } catch (PDOException $e) {
            echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
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
