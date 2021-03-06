<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News
 *
 * @author Rabah
 */
class News {

  var $id;
  var $contenu;
  var $date;
  var $createby;

  public function save() {
    $con = dbManager::getInstance();
    $savereq = "'','" . $this->date . "','" . $this->contenu . "','" . $this->createby . "',0";
    $req = $con->prepare("insert into news values ($savereq)");
    dbManager::executeReq($req);
  }

  /**
   * 
   * @return ArrayObject of Event
   */
  public static function FindAll($all = false) {
    $con = dbManager::getInstance();
    if(!$all){
      $req = $con->prepare("select * from news where old=0");
    } else {
      $req = $con->prepare("select * from news ");
    }
    dbManager::executeReq($req);

    $i = 0;
    $news = array();
    if ($req->rowCount() > 0) {
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $news[$i] = new News();
        News::GetFromRow($news[$i], $row);
        $i++;
      }
      
    }

    return $news;
  }

  /**
   * 
   * @param Event $eve
   * @param type $row
   */
  private static function GetFromRow($eve, $row) {
    //dumber($row);
    $eve->id = $row['news_id'];
    $eve->date = $row['date'];
    $eve->contenu = $row['contenu'];
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
    $req = $con->prepare("select * from news where news_id=$id");
    dbManager::executeReq($req);

    if ($req->rowCount() > 0) {
      $news = new News();
      while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        News::GetFromRow($news, $row);
      }
      return $news;
    }
    return null;
  }

  public function update() {
    $con = dbManager::getInstance();
    $req = $con->prepare("update news set "
            . " contenu='$this->contenu',"
            . " date='$this->date',"
            . " old='$this->old' "
            . " where news_id=$this->id");
    dbManager::executeReq($req);
  }

  public function delete() {
    $con = dbManager::getInstance();
    $req = $con->prepare("delete from news where news_id=$this->id");
    dbManager::executeReq($req);
  }

}
