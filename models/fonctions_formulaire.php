<?php

//////////////////////////////////////////////////////
/////////////    nouveau client    ///////////////////
//////////////////////////////////////////////////////

// --------------------------------------------------------
// nettoyage (sécurisation des données) nom et prénom  
// --------------------------------------------------------

function clean($name)
{
      $name = trim($name);

      // Mise en forme du texte : première lettre de chaque mot en majuscule
      $name = ucwords(strtolower($name));

      // Filtrer les caractères invalides (autoriser uniquement les lettres, les espaces et les apostrophes)
      $name = preg_replace("/[^a-zA-ZÀ-ÖØ-öø-ÿ' -]/u", "", $name);

      // Vérifier si le nom ou prénom n'est pas vide après nettoyage
      if (empty($name)) {
            return ["Le nom ou prénom ne peut pas être vide."];
      }

      return $name;
}

// --------------------------------------------------------
// Nettoyage et sécurisation du mot de passe
// --------------------------------------------------------
function cleanPassword($password)
{
      $errors = [];

      if (strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
      }
      if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins une majuscule.";
      }
      if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins une minuscule.";
      }
      if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
      }
      if (!preg_match('/[\W]/', $password)) { // \W = caractère spécial
            $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
      }

      // Si le mot de passe respecte les règles, on le hash
      return empty($errors) ? password_hash($password, PASSWORD_DEFAULT) : $errors;
}

// --------------------------------------------------------
// Nettoyage et validation de l'email
// --------------------------------------------------------
function nettoyerEmail($email)
{
      $errors = [];

      // Supprimer les espaces inutiles
      $email = trim($email);

      // Filtrer et valider l'email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide.";
      }

      return empty($errors) ? $email : $errors;
}

// --------------------------------------------------------
// Nettoyage de l'adresse postale
// --------------------------------------------------------
function nettoyerAdresse($address)
{
      $errors = [];

      // Supprimer les espaces inutiles
      $address = trim($address);

      // Remplacer plusieurs espaces consécutifs par un seul
      $address = preg_replace('/\s+/', ' ', $address);

      // Autoriser uniquement lettres, chiffres, espaces et quelques caractères utiles (- , . ')
      $address = preg_replace('/[^\p{L}\p{N}\s\-,\'.]/u', '', $address);

      // Supprimer les caractères invisibles (évite des attaques Unicode)
      $address = preg_replace('/[\x00-\x1F\x7F]/u', '', $address);

      // Si l'adresse est vide après nettoyage
      if (empty($address)) {
            $errors[] = "L'adresse postale est invalide ou vide.";
      }

      return empty($errors) ? $address : $errors;
}


// --------------------------------------------------------
// Nettoyage du numéro de téléphone
// --------------------------------------------------------
function cleanPhone($phone)
{
      // Supprimer les espaces inutiles
      $phone = trim($phone);

      // Retirer tous les caractères non numériques
      $phone = preg_replace("/[^0-9]/", "", $phone);

      // Vérifier si le numéro a une longueur valide (10-20 chiffres)
      if (strlen($phone) < 10 || strlen($phone) > 20) {
            return ["Le numéro de téléphone doit contenir entre 10 et 20 chiffres."];
      }

      return $phone;
}


//////////////////////////////////////////////////////
/////////////    si déjà client    ///////////////////
//////////////////////////////////////////////////////

if (!empty($_POST['passwordCustomer'])) {

      // Vérifie si le mot de passe respecte les critères de sécurité
      if (strlen($_POST['passwordCustomer']) < 8) {
            $error['passwordCustomer'] = "Erreur : Le mot de passe doit contenir au moins 8 caractères.";
      }

      if (!preg_match('/[A-Z]/', $_POST['passwordCustomer'])) {
            $error['passwordCustomer'] = "Erreur : Le mot de passe doit contenir au moins une lettre majuscule.";
      }

      if (!preg_match('/[a-z]/', $_POST['passwordCustomer'])) {
            $error['passwordCustomer'] = "Erreur : Le mot de passe doit contenir au moins une lettre minuscule.";
      }

      if (!preg_match('/[0-9]/', $_POST['passwordCustomer'])) {
            $error['passwordCustomer'] = "Erreur : Le mot de passe doit contenir au moins un chiffre.";
      }

      if (!preg_match('/[\W]/', $_POST['passwordCustomer'])) {
            $error['passwordCustomer'] = "Erreur : Le mot de passe doit contenir au moins un caractère spécial.";
      }
} else {
      $error['passwordCustomer'] = "mdp (min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)";
}


// regex firstname/lastname : /^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$/
