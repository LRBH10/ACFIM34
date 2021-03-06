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
class Service {

  var $id;
  var $title;
  var $description;
  var $photopath;
  var $createby;
  var $validateby;
  var $old;
  var $address;
  var $phone;
  var $url;
  
  public function save() {
    $con = dbManager::getInstance();
    $savereq = "'','" . $this->title . "','" . $this->description . "','" . $this->validateby . "','" . $this->photopath . "','" . $this->createby . "',0,'".$this->address . "','".$this->phone . "','".$this->url."'";
    $req = $con->prepare("insert into service values ($savereq)");
    dbManager::executeReq($req);
  }

  /**
   * 
   * @return ArrayObject of Event
   */
  public static function FindAll($all = false) {
    $con = dbManager::getInstance();
    if (!$all) {
      $req = $con->prepare("select * from service where old=0");
    } else {
      $req = $con->prepare("select * from service ");
    }
    dbManager::executeReq($req);

    $i = 0;
    $services = array();
    if ($req->rowCount() > 0) {
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $services[$i] = new Service();
        Service::GetFromRow($services[$i], $row);
        $i++;
      }
      
    }

    return $services;
  }

  /**
   * 
   * @param Service $service
   * @param type $row
   */
  private static function GetFromRow($service, $row) {
    //dumber($row);
    $service->id = $row['service_id'];
    $service->title = $row['title'];
    $service->description = $row['description'];
    $service->validateby = $row['admin_id'];
    $service->photopath = $row['photopath'];
    $service->createby = $row['user_id'];
    $service->old = $row['old'];
    $service->address = $row['address'];
    $service->phone = $row['phone'];
    $service->url = $row['url'];
    
  }

  /**
   * 
   * @param long $id
   * @return Service Description
   */
  public static function FindByID($id) {
    $con = dbManager::getInstance();
    $req = $con->prepare("select * from service where service_id=$id");
    dbManager::executeReq($req);

    if ($req->rowCount() > 0) {
      $eve = new Service();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        Service::GetFromRow($eve, $row);
      }
      return $eve;
    }
    return null;
  }

  public function update() {
    $con = dbManager::getInstance();
    $req = $con->prepare("update service set title='$this->title',"
            . " description='$this->description',"
            . " date='$this->date',"
            . " old='$this->old'," 
            . " address='$this->address',"
            . " phone='$this->phone',"
            . " url='$this->url',"
            . " photopath='$this->photopath' "
            . " where service_id=$this->id");
    dbManager::executeReq($req);
  }

  public function delete() {
    $con = dbManager::getInstance();
    $req = $con->prepare("delete from event where event_id=$this->id");
    dbManager::executeReq($req);
  }

}

