<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once './classes/Loader.php';


if (isset($_SESSION['who'])) {
  $who = Member::FindByEmail($_SESSION['who']);
  $_SESSION['id'] = $who->id;
  if (!$who->isAdmin) {
    header("location: index.php");
  }
} else {


  header('Location: index.php');
  echo 'redir';
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

    <title>Association Culturelle Franco-Iranienne de Montpellier</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style>
      .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
      .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
      .autocomplete-selected { background: #F0F0F0; }
      .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }

    </style>

  </head>

  <body>

    <?php
    include './menu/menutop.php';
    ?>


    <?php
    if (isset($_GET['kind'])) {
      $kind = $_GET['kind'];
      switch ($kind) {
        case "members":
          include './admin/members.php';
          break;
        case "events":
          include './admin/events.php';
          break;

        case "news":
          include './admin/news.php';
          break;

        case "services":
          include './admin/services.php';
          break;

        default:
          include './admin/chooser.php';
          break;
      }
    } else {
      include './admin/chooser.php';
    }
    ?>




    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery.autocomplete.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#user').autocomplete({
          serviceUrl: 'admin/autocomplete.php',
          dataType: 'json'
        });
      });
    </script>

  </body>

</html>
