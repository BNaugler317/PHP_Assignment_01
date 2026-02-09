<?php
  session_start();

  $name = filter_input(INPUT_POST, 'name');
  $pokemon_number = filter_input(INPUT_POST, 'pokemon_number');
  $type = filter_input(INPUT_POST, 'type');
  $weak_against = filter_input(INPUT_POST, 'weak_against');
  $generation = filter_input(INPUT_POST, 'generation');
  $evolves_into = filter_input(INPUT_POST, 'evolves_into');
  $legendary_id = filter_input(INPUT_POST, 'legendary_id', FILTER_VALIDATE_INT);
  $image = $_FILES['file1'];

  require_once('database.php');
  require_once('image_util.php');

  $base_dir = 'images/';

  $query = '
      SELECT name, pokemonNumber, type, weakAgainst, generation, evolvesInto, imageName FROM pokedex
    ';
    $statement = $db->prepare($query);
    $statement->execute();
    $pokedex = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($pokedex as $pokemon) {
      if ($pokemon['pokemonNumber'] == $pokemon_number || $pokemon['name'] == $name) {
        $_SESSION["add_error"] = "Pokemon number or name already exists. Please use a different name or number.";
        $url = "error.php";
        header("Location: " . $url);
        die();
      }
    }

  if ($name == null || $pokemon_number == null || $type == null || $weak_against == null || $generation == null || $evolves_into == null || $legendary_id == null) {
    $_SESSION["add_error"] = "Invalid pokemon data. Check all fields and try again.";
    $url = "error.php";
    header("Location: " . $url);
    die();
  }

  $image_name = ''; // default empty

  //********Image Upload**********

  if ($image && $image['error'] == UPLOAD_ERR_OK) {
    // process new image
    $original_filename = basename($image['name']);
    $upload_path = $base_dir . $original_filename;
    move_uploaded_file($image['tmp_name'], $upload_path);

    process_image($base_dir, $original_filename);

    // save _100 version in db
    $dot_pos = strpos($original_filename, '.');
    $name_100 = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
    $image_name = $name_100;
  }
  else {
      // use placeholder image
      $placeholder = 'placeholder.jpg';
      $placeholder_100 = 'placeholder_100.jpg';
      $placeholder_400 = 'placeholder_400.jpg';

      if (!file_exists($base_dir . $placeholder_100) || !file_exists($base_dir . $placeholder_400)) {
        process_image($base_dir, $placeholder);
      }
      $image_name = $placeholder_100;
  }


  // Add new Pokemon to the database
  $query = 'INSERT INTO pokedex (name, pokemonNumber, type, weakAgainst, generation, evolvesInto, legendaryID, imageName)
      VALUES (:name, :pokemonNumber, :type, :weakAgainst, :generation, :evolvesInto, :legendaryID, :imageName)';

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':pokemonNumber', $pokemon_number);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':weakAgainst', $weak_against);
  $statement->bindValue(':generation', $generation);
  $statement->bindValue(':evolvesInto', $evolves_into);
  $statement->bindValue(':legendaryID', $legendary_id);
  $statement->bindValue(':imageName', $image_name);
  $statement->execute();
  $statement->closeCursor();

  $_SESSION["fullName"] = $name;
  $url = "add_confirmation.php";
      header("Location: " . $url);
      die();

?>