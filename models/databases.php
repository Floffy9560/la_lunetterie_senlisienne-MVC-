<?php



////////////////////////////////////////////////////////
///////////// connexion BDD ///////////////////////////
//////////////////////////////////////////////////////

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
    static $pdo = null; // Stock la connexion pour qu’elle soit réutilisée
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

/////////////////////////////////////////////////////////////////
///////////// FONCTIONS UTILISATEUR /////////////////////////0///
///////////// FONCTIONS UTILISATEUR /////////////////////////0///
///////////////////////////////////////////////////////////////

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

// Récupérer un utilisateur par son Mail ( pour la réinitialisation du MDP)
function getUserInfos($mail)  // penser a mettre password pour vérifier 
{
    $pdo = getConnexion();
    // Utilisation de la jointure 
    // $sql = "SELECT * FROM kghdsi_users                  
    //         INNER JOIN kghdsi_user_infos ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos 
    //         LEFT JOIN kghdsi_appointments ON kghdsi_appointments.id_users = kghdsi_user_infos.id_user_infos       
    //         WHERE kghdsi_user_infos.mail = :mail";

    // Utilisation des "alias" pour différencier les colonnes (car si appointment est vide id_users est vide aussie et cela créer des bugs)
    $sql = "SELECT 
                  kghdsi_users.id_users AS user_id,
                  kghdsi_user_infos.id_user_infos AS user_info_id,
                  kghdsi_appointments.id_users AS appointment_user_id,
                  kghdsi_users.*,
                  kghdsi_user_infos.*,
                  kghdsi_appointments.id_appointment,
                  kghdsi_appointments.appointmentDate,
                  kghdsi_appointments.appointmentTime
                  FROM kghdsi_users
                  INNER JOIN kghdsi_user_infos ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos
                  LEFT JOIN kghdsi_appointments ON kghdsi_appointments.id_users = kghdsi_user_infos.id_user_infos
                  WHERE kghdsi_user_infos.mail = :mail;
";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_ASSOC);
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
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();

        // Récupération de l'ID utilisateur
        $userId = $stmt->fetchColumn();

        return $userId ?: false; // Retourne l'ID ou false si aucun utilisateur trouvé
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
        return false;
    }
}
function getUserById($id)
{
    $pdo = getConnexion();
    $sql = "SELECT * FROM kghdsi_users                  
              JOIN kghdsi_user_infos  ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos 
              INNER JOIN kghdsi_appointments ON kghdsi_appointments.id_users = kghdsi_user_infos.id_user_infos         
              WHERE kghdsi_user_infos.id_user_infos = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Récupérer une seule ligne (un utilisateur)
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si l'utilisateur existe
        if ($user) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Gérer l'erreur si la requête échoue
        $_SESSION['error'] = "⚠️ Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
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
        die();
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

    $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Bcrypt par défaut
    $sql = "INSERT INTO kghdsi_users (day_of_birth, month_of_birth,year_of_birth, password,id_user_infos,id_role)
       VALUES (:day_of_birth, :month_of_birth,:year_of_birth, :passwordHash, :id_user_infos, :id_role)";


    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':day_of_birth', $day_of_birth, PDO::PARAM_INT);
        $stmt->bindParam(':month_of_birth', $month_of_birth, PDO::PARAM_STR);
        $stmt->bindParam(':year_of_birth', $year_of_birth, PDO::PARAM_INT);
        $stmt->bindParam(':passwordHash', $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':id_user_infos', $id_user_infos, PDO::PARAM_INT);
        $stmt->bindParam(':id_role', $id_role, PDO::PARAM_INT);
        $stmt->execute();

        // Récupérer l'ID du nouvel utilisateur
        $id = $pdo->lastInsertId();
        return $id;
    } catch (PDOException $e) {
        $_SESSION['error'] = "<p style='color:white'>Erreur lors de la création de l'utilisateur (users) : " . $e->getMessage() . "</p>";
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
        $_SESSION['error'] = "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

// Supprimer un utilisateur
function deleteUser($idUser)
{
    $pdo = getConnexion();

    // Récupérer id_user_infos et id_role liés à cet utilisateur
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
    // $idRole = $userData['id_role'];

    try {
        $pdo->beginTransaction(); // 🔹 Commencer une transaction pour éviter les erreurs partielles

        //  Supprimer l'utilisateur de `kghdsi_users`
        $sql = "DELETE FROM kghdsi_users WHERE id_users = :idUser";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();

        // Supprimer les informations utilisateur de `kghdsi_user_infos`
        $sql = "DELETE FROM kghdsi_user_infos WHERE id_user_infos = :idUserInfos";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUserInfos', $idUserInfos, PDO::PARAM_INT);
        $stmt->execute();

        // Supprimer les informations utilisateur de `kghdsi_appointment`
        $sql = "DELETE FROM kghdsi_appointments WHERE id_users = :idUserInfos";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUserInfos', $idUserInfos, PDO::PARAM_INT);
        $stmt->execute();

        // Valider toutes les suppressions si tout s'est bien passé
        $pdo->commit();
        return true;
    } catch (PDOException $e) {

        //  Annuler tout en cas d'erreur
        $pdo->rollBack();
        echo "Erreur lors de la suppression : " . $e->getMessage();
        return false;
    }
}

function verification($mail, $password)
{
    $pdo = getConnexion();

    // Requête SQL pour récupérer le mot de passe
    $sql = "SELECT password 
            FROM kghdsi_users 
            JOIN kghdsi_user_infos  ON kghdsi_users.id_users = kghdsi_user_infos.id_user_infos 
            WHERE kghdsi_user_infos.mail = :mail";

    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();

        // Récupération du mot de passe haché
        $hashedPassword = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si un mot de passe a été trouvé et si le mot de passe correspond
        if ($hashedPassword && password_verify($password, $hashedPassword['password'])) {
            // Détruire la variable de session de vérification si elle existe
            if (isset($_SESSION['verificationFalse'])) {
                unset($_SESSION['verificationFalse']);
            }
            return true;
        } else {
            // Mettre une variable de session pour indiquer une erreur de vérification
            $_SESSION['verificationFalse'] = "Mauvais mot de passe!";
            // Retourner false si mot de passe incorrect ou aucun utilisateur trouvé
            return false;
        }
    } catch (PDOException $e) {
        // Gestion des erreurs en cas de problème avec la base de données
        echo "Erreur lors de la vérification : " . $e->getMessage();
        return false;
    }
}

// function checkPassword($mail, $password)
// {
//       $pdo = getConnexion();

//       $sql = "SELECT password 
//             FROM kghdsi_users
//             WHERE mail = :mail";

//       try {
//             // Préparer la requête
//             $stmt = $pdo->prepare($sql);
//             $stmt->bindParam(':mail', $mail, PDO::PARAM_INT);
//             $stmt->execute();

//             // Récupérer le mot de passe stocké
//             $user = $stmt->fetch(PDO::FETCH_ASSOC);

//             // Vérifier si l'utilisateur existe
//             if (!$user) {
//                   echo "Utilisateur non trouvé.";
//                   return false; // Retourne false si l'utilisateur n'existe pas
//             }

//             $hashedPassword = $user['password'];

//             // Vérification du mot de passe
//             if (password_verify($password, $hashedPassword)) {
//                   return true; // ✅ Mot de passe correct
//             } else {
//                   echo "Mot de passe incorrect.";
//                   return false; // Retourne false si le mot de passe est incorrect
//             }
//       } catch (PDOException $e) {
//             // Gestion des erreurs en cas d'échec de la requête
//             echo "Erreur lors de la vérification : " . $e->getMessage();
//             return false;
//       }
// }

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

function changePassword($id, $hashedPassword)
{
    $pdo = getConnexion();

    $sql = "UPDATE kghdsi_users                 
              SET kghdsi_users.password = :password
              WHERE kghdsi_users.id_users = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();


        $_SESSION['success'] = "✅ Mot de passe changé avec succès. Veuillez vous connecter.";
        return true;
    } catch (PDOException $e) {
        $_SESSION['errorChangeMail'] = "⚠️ Impossible de changer le mot de passe.";
        $_SESSION['error'] = "⚠️ Erreur SQL : " . $e->getMessage();
        return false;
    }
}


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



/////////////////////////////////////////////////////////////
///////////// FONCTIONS LUNETTES ///////////////////////////
///////////////////////////////////////////////////////////



function insertGlasseData()
{

    $pdo = getConnexion();
    try {
        $stmt = $pdo->prepare("SELECT * 
                              FROM `kghdsi_glasses`
                              INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                              LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                              INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                              INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        // $_SESSION['error'] = "���️ Erreur insertion image SQL : " . $e->getMessage();
        echo "���️ Erreur insertion image SQL : " . $e->getMessage();
        return false;
    }
}


// Recherche par marque
function searchByBrand($brand)
{

    $pdo = getConnexion();
    try {
        $sql = "SELECT * FROM `kghdsi_glasses`
                            INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                            LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                            INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                            INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender
                            WHERE kghdsi_brands.brand LIKE :brand";

        $stmt = $pdo->prepare($sql);
        $brandSearch = "%" . $brand . "%";
        $stmt->bindParam(':brand', $brandSearch, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } catch (PDOException $e) {
        echo "Erreur récupération des données SQL : " . $e->getMessage();
        return false;
    }
}

// Recherche par genre
function searchByGender($gender)
{

    $pdo = getConnexion();
    try {
        $sql = "SELECT * FROM `kghdsi_glasses`
                            INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                            LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                            INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                            INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender
                            WHERE kghdsi_gender.gender LIKE :gender";

        $stmt = $pdo->prepare($sql);
        $genderSearch = "%" . $gender . "%";
        $stmt->bindParam(':gender', $genderSearch, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } catch (PDOException $e) {
        echo "Erreur récupération des données SQL : " . $e->getMessage();
        return false;
    }
}

// Recherche par couleur
function searchByColor($color)
{

    $pdo = getConnexion();
    try {
        $sql = "SELECT * FROM `kghdsi_glasses`
                            INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                            LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                            INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                            INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender
                            WHERE kghdsi_glasses.color LIKE :color";


        $stmt = $pdo->prepare($sql);
        // Ajouter les caractères % autour de la couleur pour le LIKE
        $colorSearch = "%" . $color . "%";

        // Lier le paramètre :color à la valeur
        $stmt->bindParam(':color', $colorSearch, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        echo "Erreur récupération des données SQL : " . $e->getMessage();
        return false;
    }
}

// Recherche par matière
function searchByMatter($matter)
{

    $pdo = getConnexion();
    try {
        $sql = "SELECT * FROM `kghdsi_glasses`
                            INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                            INNER JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                            INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                            INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender
                            WHERE kghdsi_glasses.matter LIKE :matter";

        $stmt = $pdo->prepare($sql);
        // Ajouter les caractères % autour de la couleur pour le LIKE
        $matterSearch = "%" . $matter . "%";

        // Lier le paramètre :color à la valeur
        $stmt->bindParam(':matter', $matterSearch, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        echo "Erreur récupération des données SQL : " . $e->getMessage();
        return false;
    }
}

// Recherche par forme
function searchByShape($shape)
{

    $pdo = getConnexion();
    try {
        $sql = "SELECT * FROM `kghdsi_glasses`
                            INNER JOIN `kghdsi_items` ON kghdsi_glasses.id_glasses = kghdsi_items.id_items
                            LEFT JOIN `kghdsi_brands` ON kghdsi_brands.id_brands = kghdsi_glasses.id_brands
                            INNER JOIN `kghdsi_category` ON kghdsi_category.id_category = kghdsi_glasses.id_category
                            INNER JOIN `kghdsi_gender` ON kghdsi_gender.id_gender = kghdsi_glasses.id_gender
                            WHERE kghdsi_glasses.shape LIKE :shape";

        $stmt = $pdo->prepare($sql);
        $shapeSearch = "%" . $shape . "%";
        $stmt->bindParam(':shape', $shapeSearch, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } catch (PDOException $e) {
        echo "Erreur récupération des données SQL : " . $e->getMessage();
        return false;
    }
}

///////////////////////////////////////////////////////////////
//////////////// FONCTIONS ACCOUNT ( RDV)  ///////////////////////////
/////////////////////////////////////////////////////////////

// $id = $_SESSION['userInfos']['id_users'];
// $rdvs = displayRdv($id);
function showAppointment()
{
    $id = $_SESSION['userInfos']['id_users'];
    $rdvs = displayRdv($id);
    if (!empty($rdvs)) {
        foreach ($rdvs as $rdv) {
            // Créer un formatage pour l'affichage avec le mois en FR
            $appointmentDate = new DateTime($rdv['appointmentDate']);
            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            $formattedDate = $formatter->format($appointmentDate);
            // Créer un formatage pour l'affichage de l'heure avec le format HH:MM
            $formattedHoraire = (new DateTime($rdv['appointmentTime']))->format('H:i');
            echo "<div class='rdv'>
                              <p>Vous avez rendez-vous le  :<br><span> " . $formattedDate . " à " . $formattedHoraire . "h</span></p>
                                    <div class='rdvBtn'>          
                                           <button class='modify'> <a href='agenda'> Modifier mon rendez-vous </a> </button>
                                          <hr>
                                          <form action='' method='GET'>
                                                <label for='rdv'></label>
                                                <input type='hidden' id='rdv' name='dateRDV' value='" . $rdv['appointmentDate'] . "'>
                                                <input type='hidden' id='rdv' name='timeRDV' value='" . $rdv['appointmentTime'] . "'>
                                                <button type='submit' class='btnDelete'><i class='bi bi-trash3'></i></button>  
                                          </form>
                                    </div>          
                              
                        </div><hr class='hr'>";
        }
    } else echo "<p> Pas de rendez-vous </p>";
    if (!empty($_SESSION['error'])) {
        echo $_SESSION['error'];
    }
}

function displayRdv($id)
{

    $pdo = getConnexion();
    try {
        $sql = "SELECT * FROM `kghdsi_appointments` WHERE id_users = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        echo "Erreur récupération des données SQL : " . $e->getMessage();
        return false;
    }
}

function deleteAppointment($appointmentDateStr, $appointmentTime)
{
    $pdo = getConnexion();
    $sql = "DELETE FROM kghdsi_appointments WHERE appointmentDate = :appointmentDate AND appointmentTime = :appointmentTime";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':appointmentDate', $appointmentDateStr, PDO::PARAM_STR);
        $stmt->bindParam(':appointmentTime', $appointmentTime, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la suppression du rendez-vous : " . $e->getMessage();
        return false;
    }
}





/////////////////////////////////////////////////////////////
//////////////// FONCTIONS ADMIN ///////////////////////////
//////////////// FONCTIONS ADMIN ///////////////////////////
///////////////////////////////////////////////////////////


// <form action='modifyRdv' method='GET'>
// <label for='rdv'></label>
// <input type='hidden' id='rdv' name='modifDateRDV' value='" . $rdv['appointmentDate'] . "'>
// <input type='hidden' id='rdv' name='modifTimeRDV' value='" . $rdv['appointmentTime'] . "'>
// <button type='submit' class='modify'>Modifier mon rendez-vous</button>
// </form>