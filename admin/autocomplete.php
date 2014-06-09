<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../classes/dbManager.php';

if (isset($_GET['query'])) {
  // Mot tapé par l'utilisateur
  $q = htmlentities($_GET['query']);

  // Connexion à la base de données
  $bdd = dbManager::getInstance();
  
  // Requête SQL
  $requete = $bdd->prepare("SELECT lastname, firstname FROM member WHERE (lastname LIKE '%" . $q . "%' OR firstname LIKE '%" . $q . "%') ");

  dbManager::executeReq($requete);
 
  // On parcourt les résultats de la requête SQL
  while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
    // On ajoute les données dans un tableau
    $suggestions['suggestions'][] = $donnees['lastname'].' '.$donnees['firstname'];
  }

  // On renvoie le données au format JSON pour le plugin
  echo json_encode($suggestions);    
} 