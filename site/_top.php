<?php

require_once 'lib/_session.php';
require_once 'lib/_functions.php';

// Site info
define('SITE_NAME', 'BurgerTown');
define('SITE_AUTHOR', 'Brianna');

// Check if we user is logged in and get their details
$loggedIn = $_SESSION['customer']['loggedIn'] ?? false;
$customername = $_SESSION['customer']['name'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <img src="images/BurgerTownLogo.png" alt="BurgerTown">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://unpkg.com/htmx.org"> </script>
 </head>

 <body>
  
   <header>
        <nav>
            <ul hx-boost="true"> <!-- puts it in a row-->
            
                <a href="index.php">Home</a>
                <a href="menu.php">Menu</a>
                
                <?php if ($loggedIn): ?>
                    <a href="order.php">Place an Order</a>
                    <a href="do-logout.php">Logout</a>
                
                <?php else: ?>
                    <a href="signup.php">Sign up</a>
                    <a href="login.php">Login</a>
                
                <?php endif ?>
                
                <a href="contact.php">Contact Us</a>

            </ul> 
        </nav>
    </header>

    <main>