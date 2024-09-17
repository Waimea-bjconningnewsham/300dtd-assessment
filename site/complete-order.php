<?php

require_once 'lib/_functions.php';
require_once 'lib/_session.php';

$db = connectToDB();

$query = 'INSERT INTO orders (customer_id) VALUES (?)';

$custID = $_SESSION['customer']['id'];

try {
    $stmt = $db->prepare($query);
    $stmt->execute([$custID]);
    $orderID = $db->lastInsertId();
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB Indert', ERROR);
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

// Set success message with confirmation in session
$_SESSION['success_message'] = "Your order has been successfully placed. Your order ID is " . $orderID . ".";

// Redirect
header("Location: complete-message.php");
exit();
?>
