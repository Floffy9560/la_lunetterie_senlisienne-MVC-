<?php
////////////////////////////////////////////////////////
///////////// connexion BDD ///////////////////////////
//////////////////////////////////////////////////////

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



// ===================================================================
// ===================================================================
// ===================================================================
// ===================================================================

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
//////////////////////////////////////////////////////////////
///////////// FONCTIONS LENTILLES ///////////////////////////
////////////////////////////////////////////////////////////

function insertContactLens() {}




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