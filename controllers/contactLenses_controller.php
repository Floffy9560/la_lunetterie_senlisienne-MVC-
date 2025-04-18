<?php

require_once __DIR__ . '/../models/databases.php';
include __DIR__ . '/../views/contactLenses.php';

if (isset($_post['correctionOD']) && isset($_post['correctionOG']) && isset($_post['quantity'])) {
      $correctionOD = $_post['correctionOD'];
      $correctionOG = $_post['correctionOG'];
      $quantity = $_post['quantity'];
      $id = $_SESSION['id'];
}

// function insertContactLens ($correctionOD, $correctionOG, $quantity){

//       getConnexion();

//       $sql = "INSERT INTO kghdsi_contact_lens (correctionOD, correctionOG,quantity) VALUES (:correctionOD,:correctionOG,:quantity) 
//       WHERE 
    
// }