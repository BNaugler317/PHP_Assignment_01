<?php
  session_start();

  $name = filter_input(INPUT_POST, 'name');
  $pokemon_number = filter_input(INPUT_POST, 'pokemon_number');
  $type = filter_input(INPUT_POST, 'type');
  $weak_against = filter_input(INPUT_POST, 'weak_against');
  $generation = filter_input(INPUT_POST, 'generation');
  $evolves_into = filter_input(INPUT_POST, 'evolves_into');

  require_once('database.php');

  $query = '
      SELECT name, pokemonNumber, type, weakAgainst, generation, evolvesInto FROM pokedex
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

  if ($name == null || $pokemon_number == null || $type == null || $weak_against == null || $generation == null || $evolves_into == null) {
    $_SESSION["add_error"] = "Invalid pokemon data. Check all fields and try again.";
    $url = "error.php";
    header("Location: " . $url);
    die();
  }

  // Add the new Pokemon to the database

  // add new contact to database

  $query = 'INSERT INTO pokedex (name, pokemonNumber, type, weakAgainst, generation, evolvesInto)
      VALUES (:name, :pokemonNumber, :type, :weakAgainst, :generation, :evolvesInto)';

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':pokemonNumber', $pokemon_number);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':weakAgainst', $weak_against);
  $statement->bindValue(':generation', $generation);
  $statement->bindValue(':evolvesInto', $evolves_into);
  $statement->execute();
  $statement->closeCursor();

  $_SESSION["fullName"] = $name;
  $url = "add_confirmation.php";
      header("Location: " . $url);
      die();

?>