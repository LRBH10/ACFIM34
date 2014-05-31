<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="images/acfim.png">
        <title>Contact - Association Culturelle Franco-Iranienne de Montpellier</title>

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
        <!-- Page Content -->

        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Contact <small>Nous aimerions avoir de vos nouvelles!</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Acceuil</a></li>
                        <li class="active">Contact</li>
                    </ol>
                </div>

                <div class="col-lg-12">
                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                    <iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.fr/maps?q=20,+avenue+du+Jeu+de+Mail++34170+Castelnau+le+Lez&amp;ie=UTF8&amp;hq=&amp;hnear=20+Avenue+du+Jeu+de+Mail,+34170+Castelnau-le-Lez&amp;gl=fr&amp;t=m&amp;z=14&amp;ll=43.632185,3.900738&amp;output=embed"></iframe>
                </div>

            </div><!-- /.row -->

            <div class="row">

                <div class="col-sm-8">
                    <h3>Soyons en contact!</h3>
                    <p>Tous Vos Propostions sont la bienvenue </p>
                    <?php
                    // check for a successful form post  
                    if (isset($_GET['s']))
                        echo "<div class=\"alert alert-success\">" . $_GET['s'] . "</div>";

                    // check for a form error  
                    elseif (isset($_GET['e']))
                        echo "<div class=\"alert alert-danger\">" . $_GET['e'] . "</div>";
                    ?>
                    <form role="form" method="POST" action="contact-form-submission.php">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="input1">Nom</label>
                                <input type="text" name="contact_name" class="form-control" id="input1">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input2">Adresse Email </label>
                                <input type="email" name="contact_email" class="form-control" id="input2">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input3">Numero de téléphone</label>
                                <input type="phone" name="contact_phone" class="form-control" id="input3">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label for="input4">Vos Commentaires </label>
                                <textarea name="contact_message" class="form-control" rows="6" id="input4"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-sm-4">
                    <h3>Association Culturelle Franco-Iranienne  </h3>
                    <h4>de  Montpellier</h4>
                    <p>
                        20, avenue du Jeu de Mail<br>
                        Castelnau le Lez, 34000<br>
                        France
                        
                    </p>
                    <p><i class="fa fa-phone"></i> <abbr title="Phone">P</abbr>: 04 -- -- -- -- </p>
                    <p><i class="fa fa-envelope-o"></i> <abbr title="Email">E</abbr>: <a href="mailto:acfim34@gmail.com">acfim34@gmail.com</a></p>
                    <p><i class="fa fa-clock-o"></i> <abbr title="Hours">H</abbr>: Lundi - Vendredi: 9:00 à 12:00 </p>
                    <ul class="list-unstyled list-inline list-social-icons">
                        <li class="tooltip-social facebook-link"><a href="#facebook-page" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
                        <li class="tooltip-social linkedin-link"><a href="#linkedin-company-page" data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
                        <li class="tooltip-social twitter-link"><a href="#twitter-profile" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
                        <li class="tooltip-social google-plus-link"><a href="#google-plus-page" data-toggle="tooltip" data-placement="top" title="Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
                    </ul>
                </div>

            </div><!-- /.row -->

        </div><!-- /.container -->

       <?php
        include './menu/footer.php';
        ?>

        <!-- JavaScript -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/modern-business.js"></script>

    </body>
</html>
