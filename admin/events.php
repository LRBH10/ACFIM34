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
 * @param Event $eve
 */
function show($eve) {
  echo '<tr>';

  echo '<td> ' . $eve->id . '</td>';
  echo '<td> ' . $eve->title . '</td>';
  echo '<td> ' . $eve->description . '</td>';
  echo '<td> ' . $eve->date . '</td>';
  echo '<td> ' . $eve->where . '</td>';
  echo '<td> ' . $eve->nbrmax . '</td>';
  echo '<td> ' . '<img width="70px" src="'.$eve->photopath.'" />' . '</td>';
  echo '<td> ' . Member::affichage($eve->createby) . '</td>';
  echo '<td> ' .($eve->old?"Archivée":"En cours") . '</td>';
  echo '<td> ';
  // todo Options
  {
    if (!$eve->old) {
      echo '<a class="btn btn-primary" href="admin.php?kind=events&archiveevent=' . $eve->id . '"> Archiver </a>';
    } else {
      echo '<a class="btn btn-primary" href="admin.php?kind=events&archiveevent=' . $eve->id . '"> Désarchiver </a>';
    }
  }
  echo '</td>';

  echo '</tr>';
}

if (isset($_GET['archiveevent'])) {
  $id = $_GET['archiveevent'];
  $news = Event::FindByID($id);
  $news->old = !$news->old;
  var_dump($news);
  
  $news->update();
} else if (isset($_GET['createevent'])) {
  $title = validate('title', 5);
  $des = validate('description', 25);
  $where = validate('where', 4);
  $date = $_POST['date'];
  $nbrmax = $_POST['nbrmax'];


  $uploaddir = 'images/events/';
  $uploadfile = $uploaddir . basename($_FILES['imageevent']['name']);


  
  echo '<pre>';
  if (!move_uploaded_file($_FILES['imageevent']['tmp_name'], $uploadfile)) {

    echo "Upload: " . $_FILES["imageevent"]["name"] . "<br>";
    echo "Type: " . $_FILES["imageevent"]["type"] . "<br>";
    echo "Size: " . ($_FILES["imageevent"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["imageevent"]["tmp_name"];


    echo "Attaque potentielle par téléchargement de fichiers.
          Voici plus d'informations :\n";
    echo 'Voici quelques informations de débogage :';
    print_r($_FILES);
  }
  
  
  $event = new Event();
  $event->title = $title;
  $event->description = $des;
  $event->date = $date;
  $event->where = $where;
  $event->nbrmax = $nbrmax;
  $event->photopath = $uploadfile;
  $event->createby = $_SESSION['id'];
  
  
  $event->save();
  echo '</pre>';
  
}
?>


<section class="container section">

  <form class="form-signin " role="form"  method="post" action="admin.php?kind=events&createevent" enctype="multipart/form-data">
    <h2 class="form-signin-heading">Créer un nouveau Event</h2>

    <div class="row">

      <div class="col-lg-6"> 
        <input name="title" class="form-control" placeholder="Titre" required autofocus>

        <textarea name="description" class="form-control" rows="6" placeholder="Description de l'évenement" required ></textarea>


      </div>
      <div class="col-lg-6"> 
        <input   name="imageevent" type="file" required>
        <input name="date" type="date" class="form-control"  required >
        <input name="where" type="text" class="form-control" placeholder="L'adresse de l'evenement"  required >
        <input name="nbrmax" type="number" class="form-control" placeholder="Nbr maximum autorisé" required >
      </div>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
  </form>


</section>

<section class="container section ">

  <div class="text-center">
    <table class="table table-bordered table-striped">
      <caption>
        List des event
      </caption>
      <tr>
        <th> #</th>
        <th> Titre</th>
        <th> Description</th>
        <th> Date</th>
        <th> Où</th>
        <th> N Maximum </th>
        <th> Photo</th>
        <th> Creer par </th>
        <th> Etat</th>
        <th> Options</th>
      </tr>

      <?php
      $events = Event::FindAll();
      foreach ($events as $value) {
        show($value);
      }
      ?>
    </table>

  </div>
</section>

