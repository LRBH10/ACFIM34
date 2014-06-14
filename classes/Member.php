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
  var $isAdmin;
  var $events =array();
  /**
   * 
   * @return ArrayObject of Member
   */
  public static function FindAll() {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from member");
    dbManager::executeReq($req);

    $i = 0;
    $members = array();
    if ($req->rowCount() > 0) {
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $members[$i] = new Member();
        Member::GetFromRow($members[$i], $row);
        $i++;
      }
    }
  return $members;
  }

  /**
   * 
   * @param Member $mem
   */
  private static function GetEvents($mem) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from event_user where user_id=$mem->id");
    dbManager::executeReq($req);
    
    
    
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
      $mem->events[]=$row['event_id'];
    }
    
    
    
  }
  /**
   * 
   * @param Member $mem
   * @param type $row
   */
  private static function GetFromRow($mem,$row) {
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
    $mem->isAdmin = $row['isAdmin'];
    Member::GetEvents($mem);
  }

  /**
   * 
   * @param String $email
   * @return Member Description
   */
  public static function FindByEmail($email) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from member where email='$email'");
    dbManager::executeReq($req);
    
    if ($req->rowCount() > 0) {
      $mem = new Member();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        Member::GetFromRow($mem, $row);
      }
      return $mem;
    }
    return null;
  }
  
  
  /**
   * 
   * @param long $id
   * @return Member Description
   */
  public static function FindByID($id) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from member where member_id=$id");
    dbManager::executeReq($req);
    
    if ($req->rowCount() > 0) {
      $mem = new Member();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        Member::GetFromRow($mem, $row);
      }
      return $mem;
    }
    return null;
  }
  
  
  /**
   * 
   * @param long $id
   * @return string
   */
  
  public static function affichage($id) {
    $member = Member::FindByID($id);
    return strtoupper($member->lastname) .' '. ucfirst(strtolower($member->firstname));
  }
   
  /**
   * 
   * @param String $name
   * @return Member Description
   */
  public static function FindByName($name) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from member where concat_ws(' ',lastname,firstname)='$name'");
    dbManager::executeReq($req);
    
    if ($req->rowCount() > 0) {
      $mem = new Member();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        Member::GetFromRow($mem, $row);
      }
      return $mem;
    }
    return null;
  }

  public function save() {
    $con = dbManager::getInstance();
    $savereq = "'','" . $this->firstname . "','" . $this->lastname . "','" . $this->email . "','" . $this->phonenumber . "','" . $this->proffession . "','" . $this->password . "',now(),0,0";
    $req = $con->prepare("insert into member values ($savereq)");

    dbManager::executeReq($req);
  }

  public function update() {
    $con = dbManager::getInstance();
    $req = $con->prepare("update member set firstname='$this->firstname',"
            . " lastname='$this->lastname',"
            . " email='$this->email',"
            . " phone='$this->phonenumber',"
            . " proffession='$this->proffession',"
            . " activated='$this->activated', "
            . " isAdmin='$this->isAdmin' "
            . " where member_id=$this->id");
    dbManager::executeReq($req);
  }
}

