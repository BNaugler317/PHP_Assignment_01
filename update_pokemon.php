<?php
  session_start();

  require_once('database.php');
  require_once('image_util.php');

  $pokemon_id = filter_input(INPUT_POST, 'pokemon_id', FILTER_VALIDATE_INT);

  $name = filter_input(INPUT_POST, 'name');
  $pokemon_number = filter_input(INPUT_POST, 'pokemon_number');
  $type = filter_input(INPUT_POST, 'type');
  $weak_against = filter_input(INPUT_POST, 'weak_against');
  $generation = filter_input(INPUT_POST, 'generation');
  $evolves_into = filter_input(INPUT_POST, 'evolves_into');
  $legendary_id = filter_input(INPUT_POST, 'legendary_id', FILTER_VALIDATE_INT);

  // get the uploaded image if there is one
  $image = $_FILES['file1'];

  // get the current pokemon record to check current image name
  $query = '
      SELECT id, name, pokemonNumber, type, weakAgainst, generation, evolvesInto, legendaryID, imageName FROM pokedex WHERE id = :pokemon_id';

  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_id', $pokemon_id);
  $statement->execute();
  $pokedex = $statement->fetch();
  $statement->closeCursor();

  $old_image_name = $pokedex['imageName'];
  $base_dir = 'images/';
  $image_name = $old_image_name;

  // checks for duplicate pokemon name or number
  $query = '
      SELECT id, name, pokemonNumber, type, weakAgainst, generation, evolvesInto FROM pokedex
    ';
    $statement = $db->prepare($query);
    $statement->execute();
    $pokedex = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($pokedex as $pokemon) {
      if (($pokemon['pokemonNumber'] == $pokemon_number || $pokemon['name'] == $name) && $pokemon["id"] != $pokemon_id) {
        $_SESSION["add_error"] = "Pokemon number or name already exists. Please use a different name or number.";
        $url = "error.php";
        header("Location: " . $url);
        die();
      }
    }

  // validate input

  if ($name == null || $pokemon_number == null || $type == null || $weak_against == null || $generation == null || $evolves_into == null || $legendary_id == null) {
    $_SESSION["add_error"] = "Invalid pokemon data. Check all fields and try again.";
    $url = "error.php";
    header("Location: " . $url);
    die();
  }

  // if new image is uploaded

  if ($image && $image['error'] == UPLOAD_ERR_OK) {
    // process new image
    $original_filename = basename($image['name']);
    $upload_path = $base_dir . $original_filename;
    move_uploaded_file($image['tmp_name'], $upload_path);

    process_image($base_dir, $original_filename);

    // save _100 version in db
    $dot_pos = strpos($original_filename, '.');
    $new_image_name = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
    $image_name = $new_image_name;

    if($old_image_name != 'placeholder_100.jpg') {
      $old_base = substr($old_image_name, 0, strpos($old_image_name, '_100'));
      $old_ext = substr($old_image_name, strrpos($old_image_name, '.'));
      $original = $old_base . $old_ext;
      $img100 = $old_base . '_100' . $old_ext;
      $img400 = $old_base . '_400' . $old_ext;

      foreach ([$original, $img100, $img400] as $file) {
        $path = $base_dir . $file;
        if(file_exists($path)) {
          unlink($path);
        }
      }

    }
  }

  // update the pokemon in the database

  $query = '
    UPDATE pokedex
    SET name = :name,
        pokemonNumber = :pokemonNumber,
        type = :type,
        weakAgainst = :weakAgainst,
        generation = :generation,
        evolvesInto = :evolvesInto,
        legendaryID = :legendary_id,
        imageName = :imageName
    WHERE id = :pokemon_id
    ';

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':pokemonNumber', $pokemon_number);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':weakAgainst', $weak_against);
  $statement->bindValue(':generation', $generation);
  $statement->bindValue(':evolvesInto', $evolves_into);
  $statement->bindValue(':legendary_id', $legendary_id);
  $statement->bindValue(':imageName', $image_name);
  $statement->bindValue(':pokemon_id', $pokemon_id);
  $statement->execute();
  $statement->closeCursor();

  $_SESSION["fullName"] = $name;
  $url = "update_confirmation.php";
      header("Location: " . $url);
      die();

?>