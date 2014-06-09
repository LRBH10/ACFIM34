<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

include '../classes/dbManager.php';

$who = filter_input(INPUT_GET, 'who');
$event = filter_input(INPUT_GET, 'event');
$what = filter_input(INPUT_GET, 'what');

if ($who != NULL && $event != NULL && $what != NULL) {
  $bdd = dbManager::getInstance();
  if ($what) {
    $req = $bdd->prepare("insert into event_user values($who,$event,now())");
  } else {
    $req = $bdd->prepare("delete from event_user where user_id=$who and event_id=$event");
  }

  dbManager::executeReq($req);

  header("location: ../index.php");
}
