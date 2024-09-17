<?php require_once '_top.php'; 
require_once 'lib/_session.php';

$_SESSION['order'] = [];

// Check if there is a success message
if (isset($_SESSION['success_message'])) {
    // Display the success message
    echo '<p>' . $_SESSION['success_message'] . '</p>';
    echo '<p>Please make sure you quote your order number when picking up your order.</p>';
    
    // Optionally, clear the success message after displaying it
    unset($_SESSION['success_message']);
} else {
    // If no success message is set, display a default message
    echo '<p>There was an issue receiving your order. Please contact us for assistance.</p>';
}


?>

<p><a href="index.php">Return to Home</a></p>
