<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function imageShowAdmin($path) {
  echo "<img  src='$path' />";
}
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
  var $where;
  var $photopath;
  var $nbrmax;
  var $createby;
  var $old;
  var $users = array();

  public function save() {
    $con = dbManager::getInstance();
    $savereq = "'','" . $this->title . "','" . $this->description . "','" . $this->date . "','" . $this->where . "','" . $this->photopath . "','" . $this->nbrmax . "','" . $this->createby . "',0";
    $req = $con->prepare("insert into event values ($savereq)");
    dbManager::executeReq($req);
  }

  /**
   * 
   * @param Event $eve
   */
  private static function GetUsers($eve) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from event_user where event_id=$eve->id");
    dbManager::executeReq($req);



    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
      $eve->users[] = $row['user_id'];
    }
  }

  /**
   * 
   * @return ArrayObject of Event
   */
  public static function FindAll($all = false) {
    $con = dbManager::getInstance();
    if (!$all) {
      $req = $con->prepare("select * from event where old=0");
    } else {
      $req = $con->prepare("select * from event ");
    }
    dbManager::executeReq($req);

    $i = 0;
    $events = array();
    if ($req->rowCount() > 0) {
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $events[$i] = new Event();
        Event::GetFromRow($events[$i], $row);
        $i++;
      }
    }

    return $events;
  }

  /**
   * 
   * @param Event $eve
   * @param type $row
   */
  private static function GetFromRow($eve, $row) {
    //dumber($row);
    $eve->id = $row['event_id'];
    $eve->title = $row['title'];
    $eve->description = $row['description'];
    $eve->date = $row['date'];
    $eve->where = $row['where'];
    $eve->photopath = $row['photopath'];
    $eve->nbrmax = $row['nbrmax'];
    $eve->createby = $row['admin_id'];
    $eve->old = $row['old'];


    Event::GetUsers($eve);
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
      $eve = new Event();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        Event::GetFromRow($eve, $row);
      }
      return $eve;
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
