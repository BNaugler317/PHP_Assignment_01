<?php
  require_once('database.php');

  // get data from the form
  $pokemon_id = filter_input(INPUT_POST, 'pokemon_id', FILTER_VALIDATE_INT);

  // code to delete contact from database
  // validate inputs

  if ($pokemon_id != false) {
    // delete the contact from the database
    $query = 'DELETE FROM pokedex WHERE id = :pokemon_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':pokemon_id', $pokemon_id);
    $statement->execute();
    $statement->closeCursor();
  }

  // reload the index page
  $url = "index.php";
  header("Location: " . $url);
  die();

?>
