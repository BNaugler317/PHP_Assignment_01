<?php
  require_once('database.php');

  // get data from the form
  $pokemon_id = filter_input(INPUT_POST, 'pokemon_id', FILTER_VALIDATE_INT);

  // get the current pokemon record to check current image name
  $query = '
      SELECT id, name, pokemonNumber, type, weakAgainst, generation, evolvesInto, imageName FROM pokedex WHERE id = :pokemon_id';

  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_id', $pokemon_id);
  $statement->execute();
  $pokedex = $statement->fetch();
  $statement->closeCursor();

  $old_image_name = $pokedex['imageName'];
  $base_dir = 'images/';

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
