<?php
//////////////////////////////////////////////////////////////////
/////////////    fonctions pour account.php    ///////////////////
//////////////////////////////////////////////////////////////////
$mail = "";
$password = "";

if (empty($_SESSION)) {

      if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $day_of_birth = $_POST['days'];
            $month_of_birth = $_POST['month'];
            $year_of_birth = $_POST['year'];
            $password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // Bcrypt par défaut
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $mail = $_POST['email'];
            $phone = $_POST['tel'];
            $address = $_POST['postal_adress'];
            $id_role = 2;

            $id_user_infos = createUserInfos($mail, $phone, $lastname, $firstname, $address);
            createUser($day_of_birth, $month_of_birth, $year_of_birth, $password, $id_user_infos, $id_role);
            getUser($mail);
      } elseif (!empty($_POST['customerMail']) && !empty($_POST['passwordCustomer'])) {

            $password = $_POST['passwordCustomer'];
            $mail = $_POST['customerMail'];
            echo "LE PASSWORD EST : $password";
            if (verification($mail, $password) == true) {
                  getUser($mail);
            } else {
                  echo "<p> TON PASSWORD N'EST PAS BON</p>";
            }
      }
}

// Envoi de mail afin de changer le mdp
if (!empty($_POST['passwordLost'])) {
      header('location:reset_password');
}

// Se déconnecter
if (!empty($_POST['deconnexion'])) {
      session_destroy();
      header('location: /');
}

// Supprimer le compte
if (!empty($_POST['supprimer'])) {
      $idUser = $_SESSION['user_id'];
      deleteUser($idUser);
      session_destroy();
      header('location: /');
}
