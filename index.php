<?php
require 'connec.php';

$pdo = new PDO(DSN, USER, PASS);

// A exécuter afin d'afficher vos lignes déjà insérées dans la table friends
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
   <?php foreach ($friends as $friend):?>
    <ul>
    <li><?= $friend['firstname'] . ' ' . $friend['lastname'] ?></li>
    </ul>
    <?php endforeach; ?>
    <br>

    <form action="result.php" method="post">
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname">
        </div>
        <br>
        <div>
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname">
        </div>
        <br>
        <button>Envoyer</button>
    </form>
</body>
</html>

<?php

?>