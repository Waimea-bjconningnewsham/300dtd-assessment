<?php require_once '_top.php'; ?>

<?php

    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $db = connectToDB();

    // Try to find a user account with the given username
    $query = 'SELECT * FROM customers WHERE email = ?';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$user]);
        $userData = $stmt->fetch();
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Get User', ERROR);
        die('There was an error getting user data from the database');
    }

    // Did we actually get a user account?
    if ($userData) {
        // Yes, we have an account, so check password
        if (password_verify($pass, $userData['hash'])) {
            // We got here, so user and password both ok
            $_SESSION['customer']['loggedIn'] = true;
            // Save user info for later use
            $_SESSION['customer']['admin'] = $userData['admin'];
            $_SESSION['customer']['user'] = $userData['user'];
            $_SESSION['customer']['name'] = $userData['name'];
            $_SESSION['customer']['id'] = $userData['id'];
            // if ($userData['admin'] == 1) {
            //     $_SESSION['customer']['admin'] = true;
            // }
            // else {
            //     $_SESSION['customer']['admin'] = false;
            // }
            

            // Clear out the order ready to start a new one.
            $_SESSION['order'] = null;

            // Head over to the things page
            header('Location: menu.php');
        }
        else {
            echo '<h2>Incorrect password!</h2>';
        }
    }
    else {
        echo '<h2>Customer account does not exist!</h2>';
    }

    echo '<p><a href="index.php">Home</a>';

    
?>

<?php require_once '_bottom.php'; ?>

