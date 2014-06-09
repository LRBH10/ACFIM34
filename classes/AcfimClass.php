<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcfimClass
 *
 * @author Rabah
 */
class AcfimClass {
  
  function generateForm($except, $dates, $files){
    $fields = get_object_vars($this);
    
    $form = "";
    
    foreach ($fields as $name => $value){
      if (in_array($except, $name)) {
        continue;
      }
      
      if (in_array($dates, $name)) {
        $form += '<input name="'.$name.'" type="date" value="'.$value.'" />';
      } else if (in_array($files, $name)) {
        $form += '<input name="'.$name.'" type="file" />';
      } else {
        $form += '<input name="'.$name.'" type="text" value="'.$value.'" />';
      }
    }
    
    return false;
  }
}
