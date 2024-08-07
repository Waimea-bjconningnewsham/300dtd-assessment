<?php

require_once 'lib/_functions.php';
require_once 'lib/_session.php';

$db = connectToDB();

$query = 'INSERT INTO orders (customer_id) VALUES (?)';

$custID = $_SESSION['customer']['id'];

try {
    $stmt = $db->prepare($query);
    $stmt->execute([$custID]);
    $orderID = $db->lastInsertId(); // Get the last inserted order ID
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB Insert', ERROR);
    die('There was an error adding your order to the list');
}

// Insert order items
$orderItems = $_SESSION['order'];

foreach ($orderItems as $item) {
    $itemQuery = 'INSERT INTO contains (`orders id`, `menu id`, qty) VALUES (?, ?, ?)';
    try {
        $stmt = $db->prepare($itemQuery);
        $stmt->execute([$orderID, $item['id'], $item['qty']]);
    } catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Insert', ERROR);
        die('There was an error adding your order items to the list');
    }
}


/*
0: [id:7, qty:3]
1: [id:3, qty:1]
2: [id:10, qty:1]
3: [id:5, qty:1]
4: [id:1, qty:1]
5: [id:3, qty:1]
*/
   

    // TODO: You need to write complete-order.php
    // It should :
    //  1. INSERT a new record into the ORDERS table, and get the ID  DONE
    //  2. Get all of the items from the SESSION 
    //  3. One by one, INSERT them along with ORDER ID into CONTAINS table
    // 


// Set success message with confirmation in session
$_SESSION['success_message'] = "Your order has been successfully placed. Your order ID is " . $orderID . ".";

// Redirect
header("Location: order.php");
exit();
?>
