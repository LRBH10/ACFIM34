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
  echo '<td> ' . $eve->nbrmax . '</td>';
  echo '<td> ' . $eve->date . '</td>';
  echo '<td> ' . $eve->photopath . '</td>';
  echo '<td> ' . $eve->createby . '</td>';
  echo '<td> ';
  // todo Options
  {
    if (!$eve->old) {
      echo '<a class="btn btn-primary" href="admin.php?archiveevent=' . $eve->id . '"> Archiver </a>';
    } else {
      echo '<a class="btn btn-primary" href="admin.php?archiveevent=' . $eve->id . '"> Désarchiver </a>';
    }
  }
  echo '</td>';

  echo '</tr>';
}

if (isset($_GET['archiveevent'])) {
  $id = $_GET['archiveevent'];
  $event = Event::FindByID($id);
  $event->old = !$member->old;
  $event->update();
} else if (isset($_GET['createevent'])) {
  $title = validate('title', 5);
  $des = validate('description', 25);
  $date = $_POST['date'];
  $nbrmax = $_POST['nbrmax'];


  $uploaddir = 'images/';
  $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

  echo '<pre>';
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Le fichier est valide, et a été téléchargé
           avec succès. Voici plus d'informations :\n";
  } else {
    echo "Attaque potentielle par téléchargement de fichiers.
          Voici plus d'informations :\n";
  }
}
?>

<section class="container section">

  <form class="form-signin " role="form"  method="post" action="admin.php?createevent">
    <h2 class="form-signin-heading">Créer un nouveau Event</h2>

    <div class="row">

      <div class="col-lg-6"> 
        <input name="title" class="form-control" placeholder="Titre" required autofocus>

        <textarea name="description" class="form-control" rows="6" required > Description
        </textarea>


      </div>
      <div class="col-lg-6"> 
        <input   name="image" type="file" required>
        <input name="date" type="date" class="form-control"  required >
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
        <th> Email</th>
        <th> Prénom</th>
        <th> Nom</th>
        <th> N Téléphone </th>
        <th> Proffession</th>
        <th> Date D'inscription</th>
        <th> Etat</th>
        <th> Options</th>
      </tr>

      <?php
      $members = Member::FindAll();
      foreach ($members as $value) {
        show($value);
      }
      ?>
    </table>

  </div>
</section>

