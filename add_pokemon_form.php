<?php
    session_start();
   
    require_once("database.php");

    $query = 'SELECT legendaryID, status FROM Legendary_status';
    $statement = $db->prepare($query);
    $statement->execute();
    $legendary_status = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Add a Pokemon</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <main>
      <h2>Add a Pokemon</h2>

      <form action="add_pokemon.php" method="post" id="add_pokemon_form" enctype="multipart/form-data">

        <div id="data">

          <label>Name:</label>
          <input type="text" name="name" /><br />

          <label>Pokemon Number:</label>
          <input type="text" name="pokemon_number" /><br />

          <label>Type:</label>
          <input type="text" name="type" /><br />

          <label>Weak Against:</label>
          <input type="text" name="weak_against" /><br />

          <label>Generation:</label>
          <input type="text" name="generation" /><br />

          <label>Evolves Into:</label>
          <input type="text" name="evolves_into" /><br />

          <label>status:</label>
          <select name="legendary_id">
            <?php foreach ($legendary_status as $status): ?>
              <option value="<?php echo htmlspecialchars($status['legendaryID']); ?>">
                <?php echo htmlspecialchars($status['status']); ?>
              </option>
            <?php endforeach; ?>
          </select><br />

          <label>Upload Image:</label>
          <input type="file" name="file1" /><br />

        </div>

        <div id="buttons">
              <label>&nbsp;</label>
              <input type="submit" value="Save New Pokemon" /><br />
        </div>


      </form>
     
      <p><a href="index.php">return to Pokedex</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>