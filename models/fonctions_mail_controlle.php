<?php

// Récupération des données de la bdd gràce au mail 
if (!empty($_POST['mail'])) {
      $mail = $_POST['mail']; // Récupération depuis le formulaire
      checkMail($mail);
}

//Pour le titre nous allons donc juste envoyer la donner "mail" en psot sur la page de résiliation de mail :




////////////////////////////////////////////////////////////////////////
///////////// envoyer un mail de résiliation au client /////////////////
////////////////////////////////////////////////////////////////////////

// Je ne recois pas le mail (suremenet du au fait que je suis en localhost)

// if (!empty($_POST['checkMail'])) {
//       $mail = $_POST['checkMail']; // Récupération de l'email depuis le formulaire

//       // Génération d'un token sécurisé
//       $token = bin2hex(random_bytes(32)); // Génère un token sécurisé
//       $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expire dans 1 heure
//       // $resetLink = "https://lalunetteriesenlisienne.fr/reset_password_controller.php?token=$token";
//       $resetLink = "localhost/reset_password_controller.php?token=$token";

//       // Connexion à la base de données
//       $pdo = getConnexion();

//       try {
//             // Vérifie si la colonne reset_token existe, sinon l'ajouter
//             $stmt = $pdo->prepare("SHOW COLUMNS FROM kghdsi_user_infos LIKE 'reset_token'");
//             $stmt->execute();
//             if ($stmt->rowCount() == 0) {
//                   // Si la colonne n'existe pas, on l'ajoute
//                   $stmt = $pdo->prepare("ALTER TABLE kghdsi_user_infos ADD COLUMN reset_token VARCHAR(255) NULL");
//                   $stmt->execute();
//             }

//             // Ajout de la colonne reset_token_expiry si elle n'existe pas
//             $stmt = $pdo->prepare("SHOW COLUMNS FROM kghdsi_user_infos LIKE 'reset_token_expiry'");
//             $stmt->execute();
//             if ($stmt->rowCount() == 0) {
//                   $stmt = $pdo->prepare("ALTER TABLE kghdsi_user_infos ADD COLUMN reset_token_expiry DATETIME NULL");
//                   $stmt->execute();
//             }

//             // Mettre à jour le token et son expiration dans la base de données
//             $stmt = $pdo->prepare("UPDATE kghdsi_user_infos SET reset_token = :token, reset_token_expiry = :expiry WHERE mail = :mail");
//             $stmt->bindParam(':token', $token, PDO::PARAM_STR);
//             $stmt->bindParam(':expiry', $expiry, PDO::PARAM_STR);
//             $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
//             $stmt->execute();
//       } catch (PDOException $e) {
//             // Gestion des erreurs en cas d'échec de la requête
//             echo "Erreur lors de la création du token : " . $e->getMessage();
//             return false;
//       }

//       try {
//             // Vérification du token et de sa date d'expiration
//             $stmt = $pdo->prepare("SELECT reset_token, reset_token_expiry FROM kghdsi_user_infos WHERE mail = :mail");
//             $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
//             $stmt->execute();

//             $user = $stmt->fetch(PDO::FETCH_ASSOC);
//       } catch (PDOException $e) {
//             // Gestion des erreurs en cas d'échec de la requête
//             echo "Erreur lors de la vérification du token : " . $e->getMessage();
//             return false;
//       }

//       if (!$user || !$user['reset_token'] || strtotime($user['reset_token_expiry']) < time()) {
//             echo "❌ Token expiré ou invalide.";
//             return false; // Token invalide ou expiré
//       }

//       // Email
//       $to = $mail;
//       $subject = '🔑 Demande de réinitialisation de votre mot de passe';

//       // Message HTML 
//       $message = "
//       <html>
//       <head>
//           <title>Réinitialisation de votre mot de passe</title>
//           <style>
//               .email-container { font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; }
//               .email-header { background-color: #007BFF; color: white; padding: 10px; font-size: 20px; text-align: center; }
//               .email-body { padding: 20px; }
//               .button { display: inline-block; background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
//               .footer { font-size: 12px; color: #777; margin-top: 20px; text-align: center; }
//           </style>
//       </head>
//       <body>
//           <div class='email-container'>
//               <div class='email-header'>🔑 Réinitialisation de votre mot de passe</div>
//               <div class='email-body'>
//                   <p>Bonjour,</p>
//                   <p>Nous avons reçu une demande de réinitialisation de votre mot de passe. Si vous êtes à l'origine de cette demande, veuillez cliquer sur le lien ci-dessous :</p>
//                   <p><a href='" . $resetLink . "' class='button'>Réinitialiser mon mot de passe</a></p>
//                   <p>Si vous n'êtes pas à l'origine de cette demande, ignorez cet email. Votre mot de passe ne sera pas modifié.</p>
//               </div>
//               <div class='footer'>
//                   <p>Merci de faire confiance à notre service.</p>
//                   <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
//               </div>
//           </div>
//       </body>
//       </html>";

//       // Définition des en-têtes
//       $headers = "From: contact@lalunetteriesenlisienne.fr\r\n";
//       $headers .= "Reply-To: contact@lalunetteriesenlisienne.fr\r\n";
//       $headers .= "MIME-Version: 1.0\r\n";
//       $headers .= "Content-type: text/html; charset=UTF-8\r\n";

//       // Envoi du mail
//       if (mail($to, $subject, $message, $headers)) {
//             echo "📩 Email envoyé avec succès.";
//       } else {
//             echo "❌ Erreur lors de l'envoi du mail.";
//       }
// }
