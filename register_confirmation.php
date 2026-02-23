<?php
    session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Registration Confirmation</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <main>
      <h2>Registation confirmation</h2>

      <p class="confirmation-message">
        Thank you for Registering, <?php echo $_SESSION["userName"]; ?>, you may now view your Pokedex!
        Gotta catch 'em all!
      </p>

      <p><a href="index.php">Pokedex</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>