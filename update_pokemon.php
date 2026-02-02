<?php
  session_start();

  require_once('database.php');

  $pokemon_id = filter_input(INPUT_POST, 'pokemon_id', FILTER_VALIDATE_INT);

  $name = filter_input(INPUT_POST, 'name');
  $pokemon_number = filter_input(INPUT_POST, 'pokemon_number');
  $type = filter_input(INPUT_POST, 'type');
  $weak_against = filter_input(INPUT_POST, 'weak_against');
  $generation = filter_input(INPUT_POST, 'generation');
  $evolves_into = filter_input(INPUT_POST, 'evolves_into');

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

  if ($name == null || $pokemon_number == null || $type == null || $weak_against == null || $generation == null || $evolves_into == null) {
    $_SESSION["add_error"] = "Invalid pokemon data. Check all fields and try again.";
    $url = "error.php";
    header("Location: " . $url);
    die();
  }

  // update the pokemon in the database

  $query = '
    UPDATE pokedex
    SET name = :name,
        pokemonNumber = :pokemonNumber,
        type = :type,
        weakAgainst = :weakAgainst,
        generation = :generation,
        evolvesInto = :evolvesInto
    WHERE id = :pokemon_id
    ';

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':pokemonNumber', $pokemon_number);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':weakAgainst', $weak_against);
  $statement->bindValue(':generation', $generation);
  $statement->bindValue(':evolvesInto', $evolves_into);
  $statement->bindValue(':pokemon_id', $pokemon_id);
  $statement->execute();
  $statement->closeCursor();

  $_SESSION["fullName"] = $name;
  $url = "update_confirmation.php";
      header("Location: " . $url);
      die();

?>