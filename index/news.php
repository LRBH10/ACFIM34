<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 * @param News $news
 */
function printternews($news) {
  echo $news->contenu . '<br>';
  echo '<div class="pull-right small text-info">' . translate(DateTime::createFromFormat("Y-m-d", $news->date)->format("l, d F Y")) . '</div>';
  echo '<hr>';
}

$news = News::FindAll();

if (count($news) != 0) {
  echo '<div class=" thumbnail ">';

  foreach ($news as $value) {
    printternews($value);
  }
  echo '</div>';
}




