<?php
   
    require("database.php");
    
    $query = '
      SELECT id, name, pokemonNumber, type, weakAgainst, generation, evolvesInto FROM pokedex
    ';
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
          <th>&nbsp;</th> <!-- for update button -->
          <th>&nbsp;</th> <!-- for delete button -->
        </tr>

        <?php foreach ($pokedex as $pokemon): ?>
          <tr>
            <td><?php echo htmlspecialchars($pokemon['name']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['pokemonNumber']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['type']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['weakAgainst']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['generation']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['evolvesInto']); ?></td>
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
          </tr>
        <?php endforeach; ?>  
      </table>

      <p><a href="add_pokemon_form.php">Add Pokemon</a></p>
      
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>