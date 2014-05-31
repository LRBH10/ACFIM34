<?php
session_start();

include_once './classes/Loader.php';


?>

<!DOCTYPE html>
<html lang="en">

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


    <section class=" container" role="main">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
<?php
include './index/events.php';
?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
<?php
include './index/news.php';
?>
        </div>

      </div> 
    </section>
    <!-- /.section -->

    <hr/>

    <section class=" container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h2>OLD Event </h2>
          <p>
            ...........
          </p>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">
          <img class="img-responsive img-rounded" src="http://placehold.it/600x400">
        </div>

        <div class="  col-lg-3 col-md-3 col-sm-3">

        </div>
      </div>
    </section>






<?php
include './menu/footer.php';
?>




    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>

</html>
