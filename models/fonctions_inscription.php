<?php

//////////////////////////////////////////////////////
/////////////    nouveau client    ///////////////////
//////////////////////////////////////////////////////


// --------------------------------------------------------
// nettoyage (sécurisation des données) mot de passe  
// --------------------------------------------------------

$error = [];

function cleanPassword($password)
{
      // Vérifie si le mot de passe respecte les critères de sécurité
      if (strlen($password) < 8) {
            $error['$password'] = "Erreur : Le mot de passe doit contenir au moins 8 caractères.";
      }

      if (!preg_match('/[A-Z]/', $password)) {
            $error['$password'] = "Erreur : Le mot de passe doit contenir au moins une lettre majuscule.";
      }

      if (!preg_match('/[a-z]/', $password)) {
            $error['$password'] = "Erreur : Le mot de passe doit contenir au moins une lettre minuscule.";
      }

      if (!preg_match('/[0-9]/', $password)) {
            $error['$password'] = "Erreur : Le mot de passe doit contenir au moins un chiffre.";
      }

      if (!preg_match('/[\W]/', $password)) {
            $error['$password'] = "Erreur : Le mot de passe doit contenir au moins un caractère spécial.";
      }
      if (strlen($password) >= 8 && preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[\W]/', $password)) {
            // Si le mot de passe est valide ==> le crypter pour l'intégrer à la base de données
            return   password_hash($password, PASSWORD_DEFAULT); // Bcrypt par défaut
      } else {
            $error['password'] = "mdp (min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)";
      }
}

// --------------------------------------------------------
// nettoyage (sécurisation des données) email
// --------------------------------------------------------


function nettoyerEmail($email)
{
      // 1. Supprimer les espaces inutiles au début et à la fin
      $email = trim($email);

      // 2. Filtrer les caractères invalides pour un email
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      // 3. Vérifier si l'email reste valide après la sanitation
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; // Retourne false si l'email est invalide
      }

      return $email;
}
if (!empty($_POST['email'])) {
      $email_utilisateur = $_POST['email']; // Récupération depuis le formulaire 
      $email_propre = nettoyerEmail($email_utilisateur);
}

// --------------------------------------------------------
// nettoyage (sécurisation des données) adresse postale 
// --------------------------------------------------------


function nettoyerAdresse($adresse)
{
      // 1. Supprimer les espaces inutiles au début et à la fin
      $adresse = trim($adresse);

      // 2. Remplacer plusieurs espaces consécutifs par un seul
      $adresse = preg_replace('/\s+/', ' ', $adresse);

      // 3. Autoriser uniquement lettres, chiffres, espaces et quelques caractères utiles (- , . ')
      $adresse = preg_replace('/[^\p{L}\p{N}\s\-,\'.]/u', '', $adresse);

      // 4. Supprimer les caractères invisibles (évite des attaques avec des caractères Unicode invisibles)
      $adresse = preg_replace('/[\x00-\x1F\x7F]/u', '', $adresse);

      return $adresse;
}
if (!empty($_POST['postal_adress'])) {
      $adresse_utilisateur = $_POST['postal_adress'];
      $adresse_propre = nettoyerAdresse($adresse_utilisateur);
};

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
      if (strlen($_POST['passwordCustomer']) >= 8 && preg_match('/[A-Z]/', $_POST['passwordCustomer']) && preg_match('/[a-z]/', $_POST['passwordCustomer']) && preg_match('/[0-9]/', $_POST['passwordCustomer']) && preg_match('/[\W]/', $_POST['passwordCustomer'])) {
            // Si le mot de passe est valide ==> le crypter pour l'intégrer à la base de données
            // $motDePasseSecurise = password_hash($_POST['passwordCustomer'], PASSWORD_DEFAULT); // Bcrypt par défaut

      }
} else {
      $error['passwordCustomer'] = "mdp (min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)";
}


// regex firstname/lastname : /^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$/
