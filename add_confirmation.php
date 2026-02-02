<?php
    session_start();
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
      <h2>Add a Pokemon confirmation</h2>

      <p>
        Thank you for adding, <?php echo $_SESSION["fullName"]; ?>,  to your Pokedex!
        Gotta catch 'em all!
      </p>

      <p><a href="index.php">return to Pokedex</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>