<?php
   
    require("database.php");
    
    $query = '
      SELECT p.id, p.name, p.pokemonNumber, p.type, p.weakAgainst, p.generation, p.evolvesInto, p.imageName, p.legendaryID, l.status 
      FROM pokedex p LEFT JOIN Legendary_status l ON p.legendaryID = l.legendaryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $pokedex = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Pokemon Info - Home</title>
    <link rel="stylesheet" type="text/css" href="pokemon.css" />
  </head>

  <body>
    <?php include("header.php"); ?>

    <main>
      <h2>Pokedex</h2>
      <table>
        <tr>
          <th>Name</th>
          <th>Pokemon Number</th>
          <th>Type</th>
          <th>Weak Against</th>
          <th>Generation</th>
          <th>Evolves Into</th>
          <th>status</th>
          <th>Photo</th>
          <th>&nbsp;</th> <!-- for update button -->
          <th>&nbsp;</th> <!-- for delete button -->
          <th>&nbsp;</th> <!-- for view details button -->
        </tr>

        <?php foreach ($pokedex as $pokemon): ?>
          <tr>
            <td><?php echo htmlspecialchars($pokemon['name']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['pokemonNumber']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['type']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['weakAgainst']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['generation']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['evolvesInto']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['status']); ?></td>
            <td>
              <img src="<?php echo htmlspecialchars('images/' . $pokemon['imageName']); ?>"
                    alt="<?php echo htmlspecialchars($pokemon['name']); ?>"/>
            </td>
            <td>
              <form action="update_pokemon_form.php" method="post">
                <input type="hidden" name="pokemon_id" value="<?php echo $pokemon['id']; ?>">
                <input type="submit" value="Update">
              </form>
            </td>    
            <td>
              <form action="delete_pokemon.php" method="post">
                <input type="hidden" name="pokemon_id" value="<?php echo $pokemon['id']; ?>">
                <input type="submit" value="Delete">
              </form>
            </td>
            <td>
              <form action="pokemon_details.php" method="post">
                <input type="hidden" name="pokemon_id" value="<?php echo $pokemon['id']; ?>">
                <input type="submit" value="View Details">
              </form>
            </td>        
          </tr>
        <?php endforeach; ?>  
      </table>

      <p><a href="add_pokemon_form.php">Add Pokemon</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>