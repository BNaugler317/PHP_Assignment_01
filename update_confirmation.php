<?php
    session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Update Pokemon Confirmation</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <main>
      <h2>Update Pokemon confirmation</h2>

      <p>
        Thank you, <?php echo $_SESSION["fullName"]; ?>, has been updated in your Pokedex!
        Gotta catch 'em all!
      </p>

      <p><a href="index.php">return to Pokedex</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>