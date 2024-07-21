<?php require_once '_top.php'; ?>

<?php

    $db = connectToDB();

    echo '<h2>Items in order</h2>';
    $orderItems = $_SESSION['order'] ?? [];

    consoleLog($orderItems);

    if ($orderItems == []) {
        echo 'None!';
    }
    else {
        
        echo '<ul>';

        // Show what is currently in order
        foreach($orderItems as $orderItem) {

            $query = 'SELECT * FROM menu where id=?';
        
            try {
                $stmt = $db->prepare($query);
                $stmt->execute([$orderItem['id']]);
                $item = $stmt->fetch();
            }
            catch (PDOException $e) {
                consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
                die('There was an error getting data from the database');
            }
        
            echo '<li>' . $item['product'] . ' x ' . $orderItem['qty'];
        }

        echo '</ul>';
    }


    $totalPrice = 0.0; //adding the total price of the order

    foreach ($orderItems as $item) {
    // Fetch the price of the menu item
    $priceQuery = 'SELECT price FROM menu WHERE id = ?';
    try {
        $priceStmt = $db->prepare($priceQuery);
        $priceStmt->execute([$item['id']]);
        $priceResult = $priceStmt->fetch(PDO::FETCH_ASSOC); //gets price for the menu id
        if ($priceResult) {
            $itemPrice = $priceResult['price'];
            $totalPrice += $itemPrice * $item['qty'];
        } else {
            die('Invalid menu item ID.');
        }
    } catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Query', ERROR);
        die('There was an error fetching the item price.');
    }
    }
    if ($orderItems == []) {} //only display total if items in order
    else {
    echo "The total of your order is $" . number_format($totalPrice, 2) . ".";}
    
    echo '<p><a href="reset-order.php">Reset the Order</a>';

    //-------------------------------------------------------------------
    // New item form
    $db = connectToDB();

    $query = 'SELECT * FROM menu';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        $items = $stmt->fetchALL();
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
        die('There was an error getting data from the database');
    }
    consoleLog($items);

    echo '<form action="add-item.php" method="post">';

    echo '<label>Product</label>';
    echo '<select name="item">';

    foreach ($items as $item) {

        // get variables from list
        $product = $item['product'] ;
        $price = $item['price'];
        $price = '$'.number_format($price, 2);
        $id = $item['id'];

        echo '<option value="' . $id . '">' . $product . ' - ' . $price . '</option>';
    }

   
    echo '</select>';

    echo '<label>Quantity</label>
          <input type="number" name="qty" min="1" required>';

    echo '<input type="submit" value="Add to Order">';

    echo '</form>';


    echo '<form action="complete-order.php" method="post">';

        echo '<input type="submit" value="Complete Order">';

    echo '</form>';

?>


<?php require_once '_bottom.php'; ?>