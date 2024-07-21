<?php require_once '_top.php'; ?>
<?php
require_once 'lib/_functions.php';

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Print all POST data
  //  echo '<pre>';
 //   print_r($_POST);
 //   echo '</pre>';

    // Collect and sanitize form inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT); // Get the password

    // Debugging: Print collected data
 //   echo '<pre>';
 //   echo "Name: $name\n";
 //   echo "Email: $email\n";
 //   echo "Password: $password\n";
 //   echo '</pre>';

    // Validate inputs
    if ($name && $email && $password) {
        // Hash the supplied password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Connect to the database
        $db = connectToDB();

        // Add the user account
        $query = 'INSERT INTO customers (name, email, hash) VALUES (?, ?, ?)';

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$name, $email, $hash]);
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
<?php require_once '_bottom.php'; ?>
