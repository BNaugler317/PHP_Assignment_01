<?php
    
    require_once("database.php");

  // get data from the form
  $pokemon_id = filter_input(INPUT_POST, 'pokemon_id', FILTER_VALIDATE_INT); 
  
  $query = '
      SELECT id, name, pokemonNumber, type, weakAgainst, generation, evolvesInto, legendaryID, imageName FROM pokedex WHERE id = :pokemon_id';

  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_id', $pokemon_id);
  $statement->execute();
  $pokedex = $statement->fetch();
  $statement->closeCursor();

// get legendary status options
  $query = 'SELECT legendaryID, status FROM Legendary_status';
    $statement = $db->prepare($query);
    $statement->execute();
    $legendary_status = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Update Pokemon</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <main>
      <h2>Update Pokemon</h2>

      <form action="update_pokemon.php" method="post" id="update_pokemon_form" enctype="multipart/form-data">
        <input type="hidden" name="pokemon_id" value="<?php echo $pokedex['id']; ?>">
        <div id="data">

          <label>Name:</label>
          <input type="text" name="name" value="<?php echo $pokedex['name']; ?>" /><br />

          <label>Pokemon Number:</label>
          <input type="text" name="pokemon_number" value="<?php echo $pokedex['pokemonNumber']; ?>" /><br />

          <label>Type:</label>
          <input type="text" name="type" value="<?php echo $pokedex['type']; ?>" /><br />

          <label>Weak Against:</label>
          <input type="text" name="weak_against" value="<?php echo $pokedex['weakAgainst']; ?>" /><br />

          <label>Generation:</label>
          <input type="text" name="generation" value="<?php echo $pokedex['generation']; ?>"/><br />

          <label>Evolves Into:</label>
          <input type="text" name="evolves_into" value="<?php echo $pokedex['evolvesInto']; ?>" /><br />

          <label>status:</label>
          <select name="legendary_id">
            <?php foreach ($legendary_status as $status): ?>
              <option value="<?php echo htmlspecialchars($status['legendaryID']); ?>"<?php if ($status['legendaryID'] == $pokedex['legendaryID']) echo ' selected'; ?>>
                <?php echo htmlspecialchars($status['status']); ?>
              </option>
            <?php endforeach; ?>
          </select><br />

          <?php if (!empty($pokedex['imageName'])): ?>
              <label>Current Image:</label>
              <img src="images/<?php echo htmlspecialchars($pokedex['imageName']); ?>" height="100"><br />
          <?php endif; ?>

          <label>Update Image:</label>
          <input type="file" name="file1" /><br />

        </div>

        <div id="buttons">
              <label>&nbsp;</label>
              <input type="submit" value="Update Pokemon" /><br />
        </div>


      </form>
     
      <p><a href="index.php">return to Pokedex</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>