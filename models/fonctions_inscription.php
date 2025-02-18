<?php
// --------------------------------------------------------
// nettoyage (sécurisation des données) mot de passe  
// --------------------------------------------------------

$error = [];

if (!empty($_POST['currentPassword'])) {

      // Vérifie si le mot de passe respecte les critères de sécurité
      if ($_POST['currentPassword'] < 9) {
            $error['currentPassword'] = "Erreur : Le mot de passe doit contenir au moins 8 caractères.";
      }

      if (!preg_match('/[A-Z]/', $_POST['currentPassword'])) {
            $error['currentPassword'] = "Erreur : Le mot de passe doit contenir au moins une lettre majuscule.";
      }

      if (!preg_match('/[a-z]/', $_POST['currentPassword'])) {
            $error['currentPassword'] = "Erreur : Le mot de passe doit contenir au moins une lettre minuscule.";
      }

      if (!preg_match('/[0-9]/', $_POST['currentPassword'])) {
            $error['currentPassword'] = "Erreur : Le mot de passe doit contenir au moins un chiffre.";
      }

      if (!preg_match('/[\W]/', $_POST['currentPassword'])) {
            $error['currentPassword'] = "Erreur : Le mot de passe doit contenir au moins un caractère spécial.";
      }
      if ($_POST['currentPassword'] >= 8 || preg_match('/[A-Z]/', $_POST['currentPassword']) || preg_match('/[a-z]/', $_POST['currentPassword']) || preg_match('/[0-9]/', $_POST['currentPassword']) || preg_match('/[\W]/', $_POST['currentPassword'])) {
            // Si le mot de passe est valide ==> le crypter pour l'intégrer à la base de données
            $motDePasseSecurise = password_hash($_POST['currentPassword'], PASSWORD_DEFAULT); // Bcrypt par défaut
      }
} else {
      $error['currentPassword'] = "mdp (min 8 caractères : 1 maj : 1min : 1 chiffre : 1 caractère special)";
}



// --------------------------------------------------------
// nettoyage (sécurisation des données) email
// --------------------------------------------------------

$email_utilisateur = $_POST['email'] ?? ''; // Récupération depuis le formulaire
function nettoyerEmail($email)
{
      // 1. Supprimer les espaces inutiles au début et à la fin
      $email = trim($email);

      // 2. Convertir en minuscules pour éviter les doublons
      $email = strtolower($email);

      // 3. Supprimer les caractères spéciaux malveillants (protection XSS)
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      return $email;
}

function emailValide($email)
{
      return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$email_propre = nettoyerEmail($email_utilisateur);

// --------------------------------------------------------
// nettoyage (sécurisation des données) adresse postale 
// --------------------------------------------------------

$adresse_utilisateur = $_POST['postal_adress'] ?? ''; // Récupération depuis le formulaire
function nettoyerAdresse($adresse)
{
      //var_dump($adresse); // Vérifie la valeur avant traitement
      // 1. Supprimer les espaces inutiles au début et à la fin
      $adresse = trim($adresse);

      // 2. Remplacer plusieurs espaces consécutifs par un seul
      $adresse = preg_replace('/\s+/', ' ', $adresse);

      // 3. Autoriser uniquement lettres, chiffres, espaces et quelques caractères utiles (- , . ')
      $adresse = preg_replace('/[^\p{L}\p{N}\s\-,\'.]/u', '', $adresse);

      // 4. Supprimer les caractères spéciaux indésirables (injection HTML / SQL)
      // $adresse = htmlspecialchars($adresse, ENT_QUOTES, 'UTF-8');

      return $adresse;
}
$adresse_propre = nettoyerAdresse($adresse_utilisateur);
function adresseValide($adresse)
{
      return (strlen($adresse) >= 5 && strlen($adresse) <= 100); // Par exemple, entre 5 et 100 caractères
}
