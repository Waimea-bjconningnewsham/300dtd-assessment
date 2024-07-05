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

$orderItems = $_SESSION['order'];



    // TODO: You need to write complete-order.php
    // It should :
    //  1. INSERT a new record into the ORDERS table, and get the ID
    //  2. Get all of the iitems from the SESSION 
    //  3. One by one, INSERT them along with ORDER ID into CONTAINS table
    // 