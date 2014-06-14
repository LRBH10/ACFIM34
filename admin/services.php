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
 * @param Service $service
 */
function show($service) {
  echo '<tr>';
  echo '<td> ' . $service->id . '</td>';
  echo '<td> ' . $service->title . '</td>';
  echo '<td> ' . $service->description . '</td>';
  echo '<td> ' . $service->address . '</td>';
  echo '<td> ' . $service->url . '</td>';
  echo '<td> ' . $service->phone . '</td>';
  echo '<td> ' . '<img width="70px" src="' . $service->photopath . '" />' . '</td>';
  echo '<td> ' . Member::affichage($service->createby) . '</td>';
  echo '<td> ' . Member::affichage($service->validateby) . '</td>';
  echo '<td> ' . $service->old . '</td>';
  echo '<td> ';
  if (!$service->old) {
    echo '<a class="btn btn-primary" href="admin.php?kind=services&archiveservice=' . $service->id . '"> Archiver </a>';
  } else {
    echo '<a class="btn btn-primary" href="admin.php?kind=services&archiveservice=' . $service->id . '"> Désarchiver </a>';
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

  $url = validate('url', 10);
  $phonenumber = validate('phonenumber', 25);
  $address = validate('address', 0);
  $user = validate('user', 28);

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


  $service = new Service();
  $service->title = $title;
  $service->description = $des;
  $service->photopath = $uploadfile;
  $service->createby = $userid->id;
  $service->validateby = $_SESSION['id'];
  $service->phone = $phonenumber;
  $service->address = $address;
  $service->url = $url;
  $service->save();
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
        <input   name="address" placeholder="Adresse" type="text" id="user" class="form-control"  required >
        <input   name="phonenumber" placeholder="Numéro de téléphone" type="tel" id="user" class="form-control"  required >
        <input   name="url" placeholder="Site Web du Service" type="url" id="user" class="form-control"  required >
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
        <th> Adresse</th>
        <th> Site Web</th>
        <th> N de Téléphone </th>
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







