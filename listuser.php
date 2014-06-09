<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './classes/Loader.php';

function translate($param) {
  $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
  $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
  $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Décember');
  $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
  return str_replace($english_months, $french_months, str_replace($english_days, $french_days, $param));
}

$event_id = filter_input(INPUT_GET, 'event');

function printuser($id) {
  $user = Member::FindByID($id);
  echo '<tr>';
  echo '<td>' . $user->lastname . '</td>';
  echo '<td>' . $user->firstname . '</td>';
  echo '</tr>';
}

if ($event_id != NULL) {
  $event = Event::FindByID($event_id);
  ?>
  <!DOCTYPE html>
  <html lang="fr">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="shortcut icon" href="images/acfim.png">

      <title>Association Culturelle Franco-Iranienne de Montpellier</title>

      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.css" rel="stylesheet">



      <!-- Add custom CSS here -->
      <link href="css/modern-business.css" rel="stylesheet">
      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    </head>

    <body>

      <?php
      include './menu/menutop.php';
      ?>


      <section class="container">

        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 ">
            <h2 class="text-center"> <?php echo $event->title ?> </h2>
            <p><strong> C'est Quoi : </strong><?php echo $event->description; ?> </p>
            <p><strong> Quand : </strong><?php echo translate(DateTime::createFromFormat("Y-m-d", $event->date)->format("l, d F Y")); ?></p>
            <p><strong> Où : </strong><?php echo $event->where; ?></p>

          </div>

          <div class = "col-lg-6 col-md-6 col-sm-6">
            <img width="400px" height="250px" class = " img-rounded" src = "<?php echo $event->photopath ?>">
          </div>
        </div>
      </section>

      <section class="container ">

        <div class="row ">
          <div class="col-md-offset-4 col-md-4">
            <table class=" table table-bordered table-striped">

              <tr>
                <th><center> Nom</center> </th>
                <th> <center>Prénom</center></th>
              </tr>
              <?php
              foreach ($event->users as $value) {
                printuser($value);
              }
              ?>
            </table>
          </div>
        </div>
      </section>

    </body>
  </html>




  <?php
}

