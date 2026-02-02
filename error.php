<?php
    session_start();
?>
<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Error</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <main>
      <h2>Error</h2>

      
      <p>Error Message: <?php echo $_SESSION["add_error"]; ?>

      <p><a href="add_pokemon_form.php">Return to add Pokemon</a></p>
      <p><a href="index.php">View Pokedex</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>