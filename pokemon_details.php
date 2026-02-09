<?php
    
    session_start();
    require_once("database.php");

  // get id of pokemon to view details for
  $pokemon_id = filter_input(INPUT_POST, 'pokemon_id', FILTER_VALIDATE_INT); 

  if (!$pokemon_id) {
    header("Location: index.php");
    exit;
  }

  // fetch pokemon details
  $query = '
      SELECT p.id, p.name, p.pokemonNumber, p.type, p.weakAgainst, p.generation, p.evolvesInto, p.legendaryID, p.imageName, 
      l.status FROM pokedex p LEFT JOIN Legendary_status l ON p.legendaryID = l.legendaryID WHERE p.id = :pokemon_id';

  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_id', $pokemon_id);
  $statement->execute();
  $pokedex = $statement->fetch();
  $statement->closeCursor();

  if (!$pokedex) {
    echo "Pokemon not found.";
    exit;
  }

  // convert _100 image to _400 for details page
  $imageName = $pokedex['imageName'];
  $dotposition = strrpos($imageName, '.');
  $baseName = substr($imageName, 0, $dotposition);
  $extension = substr($imageName, $dotposition);

  if (str_ends_with($baseName, '_100')) {
    $baseName = substr($baseName, 0, -4);
  }

  $imageName = $baseName . '_400' . $extension;

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Pokemon Details</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <div class="container">
      <h2>Pokemon Details</h2>

      <img class="details-image" src="<?php echo htmlspecialchars('images/' . $imageName); ?>"
            alt="<?php echo htmlspecialchars($pokedex['name']); ?>"/>

      <div class="pokemon-info">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($pokedex['name']); ?></p>
        <p><strong>Pokemon Number:</strong> <?php echo htmlspecialchars($pokedex['pokemonNumber']); ?></p>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($pokedex['type']); ?></p>
        <p><strong>Weak Against:</strong> <?php echo htmlspecialchars($pokedex['weakAgainst']); ?></p>
        <p><strong>Generation:</strong> <?php echo htmlspecialchars($pokedex['generation']); ?></p>
        <p><strong>Evolves Into:</strong> <?php echo htmlspecialchars($pokedex['evolvesInto']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($pokedex['status']); ?></p>
      </div>      
            
      <p><a class="back-link" href="index.php">return to Pokedex</a></p>
      
    </div>

    <?php include("footer.php"); ?>

  </body>
</html>