<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validate($param, $minsize) {

  if (!isset($_POST[$param])) {
    return null;
  }
  $chaine = html_entity_decode($_POST[$param]);

  if (count_chars($chaine) < $minsize) {
    return null;
  }

  return $chaine;
}

/**
 * 
 * @param News $news
 */
function show($news) {
  echo '<tr>';

  echo '<td> ' . $news->id . '</td>';
  echo '<td> ' . $news->contenu . '</td>';
  echo '<td> ' . $news->date . '</td>';
  echo '<td> ' . $news->createby . '</td>';
  echo '<td> ' . $news->old . '</td>';
  echo '<td> ';
  // todo Options
  {
    if (!$news->old) {
      echo '<a class="btn btn-primary" href="admin.php?kind=news&archivenews=' . $news->id . '"> Archiver </a>';
    } else {
      echo '<a class="btn btn-primary" href="admin.php?kind=news&archivenews=' . $news->id . '"> Désarchiver </a>';
    }
  }
  echo '</td>';

  echo '</tr>';
}

if (isset($_GET['archivenews'])) {
  $id = $_GET['archivenews'];
  $news = News::FindByID($id);
  $news->old = !$news->old;
  var_dump($news);

  $news->update();
} else if (isset($_GET['createnews'])) {
  
  $contenu = validate('contenu', 512);
  $date = $_POST['date'];
  
  $news = new News();
  $news->contenu = $contenu;
  $news->date = $date;
  $news->createby = $_SESSION['id'];

  $news->save();
  echo '</pre>';
}
?>


<section class="container section">

  <form class="form-signin " role="form"  method="post" action="admin.php?kind=news&createnews" enctype="multipart/form-data">
    <h2 class="form-signin-heading">Créer une nouvelle</h2>

    <div class="row">

      <div class="col-lg-8"> 
        <input name="contenu" class="form-control" placeholder="Description" required autofocus>
      </div>
      <div class="col-lg-4"> 
        <input name="date" type="date" class="form-control"  required >
      </div>
    </div>

    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Créer la nouvelle</button>
  </form>


</section>

<section class="container section ">

  <div class="text-center">
    <table class="table table-bordered table-striped">
      <caption>
        Liste des Nouvelles
      </caption>
      <tr>
        <th> #</th>
        <th> Description</th>
        <th> Date</th>
        <th> Creer par </th>
        <th> Etat</th>
        <th> Options</th>
      </tr>

      <?php
      $news = News::FindAll(true);
      foreach ($news as $value) {
        show($value);
      }
      ?>
    </table>

  </div>
</section>

