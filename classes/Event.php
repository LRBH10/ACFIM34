<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Event
 *
 * @author Rabah
 */
class Event {
  var $id;
  var $title;
  var $description;
  var $date;
  var $photopath;
  var $nbrmax;
  var $createby;
  var $old;
  
  
   public function save() {
    $con = dbManager::getInstance();
    $savereq = "'','" . $this->title . "','" . $this->description . "','" . $this->date . "','" . $this->photopath . "','" . $this->nbrmax . "','" . $this->createby.",0" ;
    $req = $con->prepare("insert into event values ($savereq)");
    dbManager::executeReq($req);
  }
  
  
  /**
   * 
   * @return ArrayObject of Event
   */
  public static function FindAll() {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from event");
    dbManager::executeReq($req);

    $i = 0;
    $events = array();
    if ($req->rowCount() > 0) {
      $events[$i] = new Event();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        Event::GetFromRow($events[$i], $row);
      }
      $i++;
    }

    return $events;
  }
  
  /**
   * 
   * @param Event $eve
   * @param type $row
   */
   private static function GetFromRow($eve,$row) {
    //var_dump($row);
    $eve->id = $row['event_id'];
    $eve->title = $row['title'];
    $eve->description = $row['description'];
    $eve->date = $row['date'];
    $eve->photopath = $row['photopath'];
    $eve->nbrmax = $row['nbrmax'];
    $eve->createby = $row['admin_id'];
    $eve->old = $row['old'];
    
  }
   /**
   * 
   * @param long $id
   * @return Event Description
   */
  public static function FindByID($id) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from event where event_id=$id");
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
  
  
   public function update() {
    $con = dbManager::getInstance();
    $req = $con->prepare("update event set title='$this->title',"
            . " description='$this->description',"
            . " date='$this->date',"
            . " nbrmax='$this->nbrmax',"
            . " old='$this->old',"
            . " photopath='$this->photopath' "
            . " where event_id=$this->id");
    dbManager::executeReq($req);
  }
  
  public function delete() {
    $con = dbManager::getInstance();
    $req = $con->prepare("delete from event where event_id=$this->id");
    dbManager::executeReq($req);
  }
}



