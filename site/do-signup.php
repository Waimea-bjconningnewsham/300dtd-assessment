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


<?php require_once '_top.php'; ?>
<?php require_once 'lib/_functions.php'; ?>

<?php

// Collect and sanitize form inputs
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pass = filter_input(INPUT_POST, 'pass', FILTER_DEFAULT); // Get the password

// Validate inputs
if ($name && $email && $pass) {

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p>Invalid email format. Please enter a valid email address.</p>';
    } else {
        // Connect to the database
        $db = connectToDB();

        // Check if the email is already in use
        $query = 'SELECT id FROM customers WHERE email = ? LIMIT 1';
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo '<p>This email is already registered. Please use a different email address.</p>';
        } else {
            // Hash the supplied password
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // Define the values to be inserted
            $admin = 0; // Default to non-admin

            // Add the user account
            $query = 'INSERT INTO customers (name, email, hash, admin) VALUES (?, ?, ?, ?)';

            try {
                $stmt = $db->prepare($query);
                $stmt->execute([$name, $email, $hash, $admin]);
                echo '<h2>Account created!</h2>';
                echo '<p>You can now login...</p>';
            } catch (PDOException $e) {
                consoleLog($e->getMessage(), 'DB Add User', ERROR);
                die('There was an error adding user data to the database');
            }
        }
    }
} else {
    echo '<p>Please fill in all fields.</p>';
}

?>

<?php require_once '_bottom.php'; ?>
