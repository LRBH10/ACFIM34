<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 * @param Member $member
 */
function show($member) {
  echo '<tr>';

  echo '<td> ' . $member->id . '</td>';
  echo '<td> ' . $member->email . '</td>';
  echo '<td> ' . $member->firstname . '</td>';
  echo '<td> ' . $member->lastname . '</td>';
  echo '<td> ' . $member->phonenumber . '</td>';
  echo '<td> ' . $member->proffession . '</td>';
  echo '<td> ' . $member->dateinscription . '</td>';
  echo '<td> ' . $member->activated . '</td>';
  echo '<td> ';
  // todo Options
  {
    if (!$member->activated) {
      echo '<a class="btn btn-primary" href="admin.php?activatemember=' . $member->id . '"> Activer </a>';
    } else {
      echo '<a class="btn btn-primary" href="admin.php?activatemember=' . $member->id . '"> Désactiver </a>';
    }
  }
  echo '</td>';

  echo '</tr>';
}

if (isset($_GET['activatemember'])) {
  $id = $_GET['activatemember'];
  $member = Member::FindByID($id);
  $member->activated = !$member->activated;
  $member->update();
}
?>


<section class="container section ">

  <div class="text-center">
    <table class="table table-bordered table-striped">
      <caption>
        List des membres
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

