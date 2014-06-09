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
 * @param Service $eve
 */
function show($eve) {
  echo '<tr>';

  echo '<td> ' . $eve->id . '</td>';
  echo '<td> ' . $eve->title . '</td>';
  echo '<td> ' . $eve->description . '</td>';
  echo '<td> ' . $eve->photopath . '</td>';
  echo '<td> ' . $eve->createby . '</td>';
  echo '<td> ' . $eve->validateby . '</td>';
  echo '<td> ' . $eve->old . '</td>';
  echo '<td> ';
  // todo Options
  {
    if (!$eve->old) {
      echo '<a class="btn btn-primary" href="admin.php?kind=services&archiveservice=' . $eve->id . '"> Archiver </a>';
    } else {
      echo '<a class="btn btn-primary" href="admin.php?kind=services&archiveservice=' . $eve->id . '"> Désarchiver </a>';
    }
  }
  echo '</td>';

  echo '</tr>';
}

if (isset($_GET['archiveservice'])) {
  $id = $_GET['archiveservice'];
  $news = Event::FindByID($id);
  $news->old = !$news->old;
  var_dump($news);

  $news->update();
} else if (isset($_GET['createservice'])) {
  $title = validate('title', 5);
  $des = validate('description', 25);

  $user = validate('user', 128);

  $userid = Member::FindByName($user);


  $uploaddir = 'images/services/';
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


  $news = new Service();
  $news->title = $title;
  $news->description = $des;
  $news->photopath = $uploadfile;
  $news->createby = $userid->id;
  $news->validateby = $_SESSION['id'];
  $news->save();
  echo '</pre>';
}
?>


<section class="container section">

  <form class="form-signin " role="form"  method="post" action="admin.php?kind=services&createservice" enctype="multipart/form-data">
    <h2 class="form-signin-heading">Ajouter un Service</h2>

    <div class="row">

      <div class="col-lg-6"> 
        <input name="title" class="form-control" placeholder="Titre" required autofocus>
        <textarea name="description" class="form-control" rows="6" placeholder="Description" required ></textarea>
      </div>
      <div class="col-lg-6"> 
        <input   name="imageevent" type="file" required>
        <input   name="user" placeholder="Creer Par" type="text" id="user" class="form-control"  required >
      </div>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Créer le Service</button>
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
        <th> Photo</th>
        <th> Creer par </th>
        <th> Valider par </th>
        <th> Etat</th>
        <th> Options</th>
      </tr>

<?php
$news = Service::FindAll(true);
foreach ($news as $value) {
  show($value);
}
?>
    </table>

  </div>
</section>






