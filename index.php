<?php
   
    require("database.php");
    
    $query = '
      SELECT name, pokemonNumber, type, weakAgainst, generation, evolvesInto FROM pokedex
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
    <link rel="stylesheet" type="text/css" href="css/pokemon.css" />
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
        </tr>

        <?php foreach ($pokedex as $pokemon): ?>
          <tr>
            <td><?php echo htmlspecialchars($pokemon['name']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['pokemonNumber']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['type']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['weakAgainst']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['generation']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['evolvesInto']); ?></td>
          </tr>
        <?php endforeach; ?>  
      </table>
    </main>

    <?php include("footer.php"); ?>

  </body>
</html>