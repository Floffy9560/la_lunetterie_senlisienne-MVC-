<?php

// function getPasswordUser($mail)
// {
//       $pdo = getConnexion();

//       $sql = "SELECT `password` FROM `kghdsi_users`
// LEFT JOIN kghdsi_user_infos ON kghdsi_user_infos.id_user_infos = kghdsi_users.id_users
// WHERE mail = 'auvrayflorian@aol.com'";
// }

// try {
//       $stmt = $pdo->prepare($sql);
//       $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
//       $stmt->execute();
//       $result = $stmt->fetch(PDO::FETCH_ASSOC);
//       echo $result['password'];
// } catch (PDOException $e) {
//       echo "Error: " . $e->getMessage();
// }

echo " votre mail est :" . $_POST['mailtest'];
if (!empty($_POST['mailtest'])) {
      $mail = $_POST['mailtest'];
      echo "l'id de l'utilisateur est :" .  getUserIdByMail($mail);
}
