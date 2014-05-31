<div class="container top">
  <div class=" row">


    <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-2 col-md-2 col-sm-2">
      <!--img height="70px" src="./images/acfim.png" -->
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
      <!--h4 class="section-colored"> Association Iranienne de Montpellier </h4-->
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3">
      <div class=" navbar-right">  
        <a >Francais</a> / <a  >فارسی</a>
      </div>
    </div>
  </div>


</div>
<div class="container top center-block">

  <img  height="200px" width="280px" src="./images/montpellier1.jpg"  alt=""/> 
  <img  height="200px" width="280px" src="./images/montpellier2.jpg"  alt=""/> 
  <img  height="200px" width="280px" src="./images/montpellier4.jpg"  alt=""/> 
  <img  height="200px" width="287px" src="./images/montpellier3.jpg"  alt=""/> 

</div>



<div class="container">
  <nav class="navbar navbar-custom navbar-inverse " role="navigation">


    <div class="navbar-header ">
      <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
      <a class="navbar-brand" href="index.php">
        <img height="30px" src="./images/acfim_1.png" > Association Culturelle Franco-Iranienne de Montpellier 
      </a>

    </div>



    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./history.php">Histoire</a>
        </li>
        <li><a href="./gallery.php">Gallery</a>
        </li>
        <li><a href="./culture.php">Culture</a>
        </li>

        <li><a href="adress.php"> Adresses utils</a>
        </li>

        <li><a href="contact.php">Contact</a>
        </li>

        <li>
          <div class="vspace5">
            <?php
            if (isset($_SESSION['who'])) {
              $who = Member::FindByEmail($_SESSION['who']);
              ?>
            <span class="badge"><?php echo $who->firstname . " ". $who->lastname;   ?></span><br>
            <a href="#" class=" btn-sm">  Déconnecter </a>
              <?php
            } else {
              ?>
              <a href="./login.php" type="submit" class="btn btn-default">Connexion</a>
              <?php
            }
            ?>
          </div>
        </li>
        <!--li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="portfolio-1-col.html">1 Column Portfolio</a>
                </li>
                <li><a href="portfolio-2-col.html">2 Column Portfolio</a>
                </li>
                <li><a href="portfolio-3-col.html">3 Column Portfolio</a>
                </li>
                <li><a href="portfolio-4-col.html">4 Column Portfolio</a>
                </li>
                <li><a href="portfolio-item.html">Single Portfolio Item</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="blog-home-1.html">Blog Home 1</a>
                </li>
                <li><a href="blog-home-2.html">Blog Home 2</a>
                </li>
                <li><a href="blog-post.html">Blog Post</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="full-width.html">Full Width Page</a>
                </li>
                <li><a href="sidebar.html">Sidebar Page</a>
                </li>
                <li><a href="faq.html">FAQ</a>
                </li>
                <li><a href="404.html">404</a>
                </li>
                <li><a href="pricing.html">Pricing Table</a>
                </li>
            </ul>
        </li-->
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </nav>
</div>
<!-- /.container -->


