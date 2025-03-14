<?php

//////////////////////////////////////////////////////////////////
/////////////    fonctions pour account.php    ///////////////////
//////////////////////////////////////////////////////////////////



if (!empty($_POST['email']) && !empty($_POST['password'])) {

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

      $id_user_infos = createUserInfos($mail, $phone, $lastname, $firstname, $address);
      // Vérification si l'ID d'utilisateur infos est valide avant de créer l'utilisateur
      if ($id_user_infos) {
            // Création de l'utilisateur avec les informations précédemment créées
            $id = createUser($day_of_birth, $month_of_birth, $year_of_birth, $password, $id_user_infos, $id_role);

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
            header('location: account');
      } else {
            echo "<p> TON PASSWORD N'EST PAS BON</p>";
      }
}



// Envoi de mail afin de changer le mdp( dans notre cas redirection vers la page pour changer le mdp)
if (!empty($_POST['passwordLost'])) {
      header('location:reset_password');
}

// Se déconnecter
if (!empty($_POST['deconnexion'])) {
      session_unset();
      session_destroy();
      header('location: /');
}

// Supprimer le compte
if (!empty($_POST['supprimer'])) {
      $idUser = $_SESSION['userInfos']['id_users'];
      deleteUser($idUser);
      session_unset();
      session_destroy();
      header('location: /');
}


// SUPPRIMER UN RRENDEZ VOUS   :

if (!empty($_GET['dateRDV']) && !empty($_GET['timeRDV'])) {

      $appointmentDateStr = $_GET['dateRDV'];
      $appointmentTime = $_GET['timeRDV'];
      deleteAppointment($appointmentDateStr, $appointmentTime);
}


// Vérifié si l'utilisateur est déjà connecté si oui (que rôle à t'il) et le dirigé vers la page de son compte sinon le dirigé sur inscription
if (!empty($_SESSION['userInfos'])) {
      if ($_SESSION['userInfos']['id_role'] == 2) {

            // Si l'utilisateur est connecté, rediriger vers la page de compte
            include __DIR__ . '/../views/account.php';
            exit();
      } else {

            // Si l'admin est connecté, rediriger vers la page de compte admin
            include __DIR__ . '/../views/accountADMIN.php';
            exit();
      }
} else {
      include_once __DIR__ . '/../controllers/inscription_controller.php';
      exit();
}
