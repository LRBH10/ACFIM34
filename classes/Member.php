<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Members
 *
 * @author Rabah
 */
include_once './classes/Loader.php';

class Admin {

  var $pseudo;
  var $password;

}

class Member {

  var $id;
  var $firstname;
  var $lastname;
  var $email;
  var $phonenumber;
  var $proffession;
  var $password;
  var $dateinscription;
  var $activated;

  /**
   * 
   * @param String $email
   * @return Member Description
   */
  public static function FindByEmail($email) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from member where email='$email'");

    if(!$req->execute()){
       var_dump($req);
      echo $req->errorCode()."<br>";
      print_r($req->errorInfo());
    }

    
    
    if ($req->rowCount() > 0) {
      $mem = new Member();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        //var_dump($row);
        $mem->id = $row['member_id'];
        $mem->firstname = $row['firstname'];
        $mem->lastname = $row['lastname'];
        $mem->email = $row['email'];
        $mem->phonenumber = $row['phone'];
        $mem->proffession = $row['proffession'];
        $mem->password = $row['password'];
        $mem->dateinscription = $row['dateinscription'];
        $mem->activated = $row['activated'];
      }
      return $mem;
    }
    return null;
  }

  public function save() {
    $con = dbManager::getInstance();
    $savereq = "'','" . $this->firstname . "','" . $this->lastname . "','" . $this->email . "','" . $this->phonenumber . "','" . $this->proffession . "','" . $this->password . "',now(),0";
    
    
    $req = $con->prepare("insert into Member values ($savereq)");
        
    if(!$req ->execute()){
      var_dump($req);
      echo $req->errorCode()."<br>";
      print_r($req->errorInfo());
      
    }
    
    
    
    
    
    
    
  }
  
  
  

}
