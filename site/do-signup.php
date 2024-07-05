<?php require_once '_top.php'; ?>

<?php

    // Hash the supplied password
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // Connect
    $db = connectToDB();

    // Add the user account
    $query = 'INSERT INTO customers
                (name, email, hash)
                VALUES (?, ?, ?)';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $user, $hash]);
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Add User', ERROR);
        die('There was an error adding user data to the database');
    }


    echo '<h2>Account created!</h2>';

    echo '<p>You can now login...</p>';

?>

<?php require_once '_bottom.php'; ?>


