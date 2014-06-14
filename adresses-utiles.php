<?php
session_start();

include './classes/Loader.php';

function printserviceimage($service) {
  echo '<div class = "col-md-6">';
  echo '<center>';
  echo '<a href = "portfolio-item.html">';
  echo '<img height = "350px" width = "100%" src = "' . $service->photopath . '">';
  echo '</a>';
  echo '</center>';
  echo '</div>';
}

/**
 * 
 * @param Service $service
 */
function printserviceinfo($service) {
  echo '<div class = "col-md-6">';
  echo '<h2>' . $service->title . '</h2>';
  echo '<h4>' . $service->description . '</h4>';

  if($service->address != ""){
    echo '<p><strong>Adresse :</strong>' . $service->address . '</p>';
  }
  if($service->phone != ""){
    echo '<p><strong>N° Téléphone :</strong>' . $service->phone . '</p>';
  }
  echo '<p><strong>Contact : </strong> ' . Member::affichage($service->createby) . '</p>';
  
  if($service->url != ""){
    echo '<a class="btn btn-primary" href="' . $service->url . '"> Site Web</a>';
  }
  echo '</div>';
}

/**
 * 
 * @param Service $service
 */
function printservice($service,$what) {

  echo ' <div class = "row">';
  if($what){
    printserviceimage($service);
    printserviceinfo($service);
  } else {
    printserviceinfo($service);
    printserviceimage($service);
  }
  echo '    </div><hr>';
}
?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/acfim.png">

    <title>Adresses Utiles - Association Culturelle Franco-Iranienne de Montpellier</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>

    <?php
    include './menu/menutop.php';
    ?>
    <!-- Page Content -->

    <div class="container">

      <div class="row">

        <div class="col-lg-12">
          <h1 class="page-header">Adresses Utiles 
            <small> pour tous vos besoins </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Acceuil</a>
            </li>
            <li class="active">Adresses Utiles</li>
          </ol>
        </div>

      </div>
      <!-- /.row -->
    </div>

    <section class="section container">
      <?php
      $services = Service::FindAll();
      $i = 0;
      foreach ($services as $value) {
        printservice($value, $i % 2 == 0);
        $i++;
      }
      
      if($i == 0){
        echo "<h1> Pas de Service </h1>";
      }
      ?>
      

    </section>






<?php
include './menu/footer.php';
?>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>

</html>
