<!-- <?php require_once '_top.php'; ?>
<?php require_once 'lib/_functions.php'; ?>

<?php

    // Collect and sanitize form inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_DEFAULT); // Get the password

    // Validate inputs
    if ($name && $email && $pass) {

    // Hash the supplied password
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // Connect
    $db = connectToDB();
    
    // Define the values to be inserted
    $admin = 0; // Default to non-admin 

    // Add the user account
    $query = 'INSERT INTO customers
                (name, email, hash, admin)
                VALUES (?, ?, ?, ?)';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $email, $hash, $admin]);
        echo '<h2>Account created!</h2>';
        echo '<p>You can now login...</p>';
    } catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Add User', ERROR);
        die('There was an error adding user data to the database');
    }
} else {
    echo '<p>Please fill in all fields.</p>';
}




?>

<?php require_once '_bottom.php'; ?> -->

