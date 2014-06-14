<?php


$who= NULL;
if(isset($_SESSION['who'])){
  $email = $_SESSION['who'];
  $who = Member::FindByEmail($email);
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function translate($param) {
  $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
  $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
  $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Décember');
  $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
  return str_replace($english_months, $french_months, str_replace($english_days, $french_days, $param));
}

/**
 * 
 * @param Event $eve
 */
function printimage($eve) {
  echo '<div class = "col-lg-6 col-md-6 col-sm-6">';
  echo '<img width="400px" height="250px" class = " img-rounded" src = "' . $eve->photopath . '">';
  echo '</div>';
}

/**
 * 
 * @param Member $who
 * @param Event $eve
 */
function printtext($who,$eve) {
  echo '<div class="col-lg-6 col-md-6 col-sm-6 ">';
  echo '<h2 class="text-center">' . $eve->title . '</h2>';
  echo '<p><strong> C\'est Quoi : </strong>' . $eve->description . '</p>';
  echo '<p><strong> Quand : </strong>' . translate(DateTime::createFromFormat("Y-m-d", $eve->date)->format("l, d F Y")) . '</p>';
  echo '<p><strong> Où : </strong>' . $eve->where . '</p>';
  
  if($who != NULL){
    echo '<div class="pull-right" >';
    if(in_array($eve->id,$who->events)){
      echo '<a href="index/inscription.php?who='.$who->id.'&event='.$eve->id.'&what=0" class="btn btn-success" > Désinscrire </a>';
    } else {
      echo '<a href="index/inscription.php?who='.$who->id.'&event='.$eve->id.'&what=1" class="btn btn-success" > S\'inscrir à l\'évenement</a>';
    }
    echo '<a href="listuser.php?event='.$eve->id.'" class="btn btn-info" > Liste des participants</a>';
    echo '</div>';
  }
  
  echo '</div>';
}

/**
 * 
 * @param Event $eve
 */
function printter($who,$eve, $test = true) {
  echo '<article class="row ">';
  if ($test) {
    printtext($who,$eve);
    printimage($eve);
  } else {
    printimage($eve);
    printtext($who,$eve);
  }
  echo '</article>';
  echo '<hr>';
}


$events = Event::FindAll();
$i = 0;
foreach ($events as $value) {
  printter($who,$value, $i % 2 == 0);
  $i++;
}

if(count($events) ==0) {
  echo " <h1>Pas d'événement pour le moment :) </h1>";
}



