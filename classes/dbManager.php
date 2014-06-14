<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbManager
 *
 * @author Rabah
 */
class dbManager {

  /**
   *
   * @var PDO
   */
  static $connexion = null;

  /**
   * 
   * @return PDO
   */
  public static function getInstance() {
    if (dbManager::$connexion == null){
      dbManager::init();
    }
    return dbManager::$connexion;
  }

  private static function init() {
    /**
     $mysql_host = "mysql3.000webhost.com";
     $mysql_database = "a1690429_acfim34";
     $mysql_user = "a1690429_acfim34";
     $mysql_password = "rabah123";
     */
    
    $PARAM_hote = 'localhost'; // le chemin vers le serveur
    $PARAM_port = '3306';
    $PARAM_nom_bd = 'acfim34'; // le nom de votre base de données
    $PARAM_utilisateur = 'root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe = ''; // mot de passe de l'utilisateur pour se connecter
    dbManager::$connexion = new PDO('mysql:host=' . $PARAM_hote . ';port=' . $PARAM_port . ';dbname=' . $PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
  }
  
  
  public static function testBD(){
    echo dbManager::getInstance()->exec("select * from member");
  }
  
  /**
   * 
   * @param PDOStatement $req
   * @return PDOStatement
   */
  public static function executeReq($req){
    if (!$req->execute()) {
      echo '<pre>';
      var_dump($req);
      echo $req->errorCode() . "<br>";
      print_r($req->errorInfo());
      echo '</pre>';
    }
    return $req;
  }

}


