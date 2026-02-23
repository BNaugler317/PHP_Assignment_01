<?php
    session_start();

    if (!isset($_SESSION['isLoggedIn'])) {
      header("Location: login_form.php");
      die();
    }
   
    require("database.php");

    $search = trim($_GET['search'] ?? '');
    if ($search !== '') {
      $query = '
      SELECT id, name, pokemonNumber, imageName
      FROM pokedex
      WHERE name LIKE :search
        OR pokemonNumber LIKE :search
      ORDER BY pokemonNumber
    ';
    $statement = $db->prepare($query);
    $statement->bindValue(':search', '%' . $search . '%');
    } else {
      $query = '
      SELECT id, name, pokemonNumber, imageName
      FROM pokedex
      ORDER BY pokemonNumber
    ';
    $statement = $db->prepare($query);
    }
  
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
      <h2>Pokedex (<?php echo "Logged In User: " . $_SESSION['userName']; ?>) </h2>
      <form action="index.php" method="get" id="search_form">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search"
                value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" />
        <input type="submit" value="Go">
        <a href="index.php">Clear</a>
      </form>

      <table>
        <tr>
          <th>Photo</th>
          <th>Name</th>
          <th>Pokemon Number</th>
          
          <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <th>&nbsp;</th> <!-- for update button -->
            <th>&nbsp;</th> <!-- for delete button -->
          <?php endif; ?>
          
          <th>&nbsp;</th> <!-- for view details button -->
        </tr>

        <?php foreach ($pokedex as $pokemon): ?>
          <tr>

            <td>
              <img src="<?php echo htmlspecialchars('images/' . $pokemon['imageName']); ?>"
                    alt="<?php echo htmlspecialchars($pokemon['name']); ?>"/>
            </td>

            <td><?php echo htmlspecialchars($pokemon['name']); ?></td>
            <td><?php echo htmlspecialchars($pokemon['pokemonNumber']); ?></td>

            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
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
            <?php endif; ?>
            <td>
              <form action="pokemon_details.php" method="post">
                <input type="hidden" name="pokemon_id" value="<?php echo $pokemon['id']; ?>">
                <input type="submit" value="View Details">
              </form>
            </td>        
          </tr>
        <?php endforeach; ?>  
      </table>

      <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <p><a href="add_pokemon_form.php">Add Pokemon</a></p>
      <?php endif; ?>

      <!-- temprary link to register user form for testing purposes, will remove later -->
      <!-- <p><a href="register_user_form.php">Register User - Temporary</a></p> -->

      <!-- temprary link to login form for testing purposes, will remove later -->
      <!-- <p><a href="login_form.php">Login - Temporary</a></p> -->

      <p><a href="logout.php">Logout</a></p>

    </main>

    <?php include("footer.php"); ?>

  </body>
</html>