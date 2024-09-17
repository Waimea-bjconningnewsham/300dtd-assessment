<?php require_once '_top.php'; ?>

<?php
// Check if the user is an admin
if (!isset($_SESSION['customer']['admin']) || !$_SESSION['customer']['admin']) {
    // If not an admin, redirect or show a message
    die('You do not have access to this page.');  
}

$db = connectToDB();

$query = '
 SELECT 
    c.`orders id`,
    c.qty,
    m.product,
    m.price,
    cu.name

 FROM contains c 

 JOIN orders o ON o.id = c.`orders id`
 JOIN customers cu ON cu.id = o.customer_id
 JOIN menu m ON m.id = c.`menu id` ';

try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll as an associative array
} catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

consoleLog($items);

if (empty($items)) {
    echo '<p>No items found.</p>';
} else {

      // Start the table
      echo '<table border="1" cellpadding="5" cellspacing="0">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Customer</th>';
      echo '<th>Order ID</th>';
      echo '<th>Product</th>';
      echo '<th>Quantity</th>';
      echo '<th>Price</th>';
      echo '<th>Total Price</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
  
      foreach ($items as $item) {
          $orderid = $item['orders id'];
          $product = $item['product'];
          $qty = $item['qty'];
          $customer = $item['name'];
          $price = '$' . number_format($item['price'], 2);
          $totalPrice = '$' . number_format($item['price'] * $item['qty'], 2);
  
          echo '<tr>';
          echo '<td>' . ($customer) . '</td>';
          echo '<td>' . ($orderid) . '</td>';
          echo '<td>' . ($product) . '</td>';
          echo '<td>' . ($qty) . '</td>';
          echo '<td>' . ($price) . '</td>';
          echo '<td>' . ($totalPrice) . '</td>';
          echo '</tr>';
      }
  
      echo '</tbody>';
      echo '</table>';
  }

echo '<ul>';

// foreach ($items as $item) {
//     $orderid = $item['orders id'];
//     $product = $item['product'];
//     $qty = $item['qty'];
//     $customer = ($item['name']);
//     $price = '$' . number_format($item['price'], 2);
//     $totalPrice = '$' . number_format($item['price'] * $item['qty'], 2);

//     echo '<li>'. $customer . ' <b>' . $product . '</b>: ' . $qty . ' x ' . $price . ' = ' . $totalPrice . '</li>';
// }


// echo '</ul>';
// }

?>

<?php require_once '_bottom.php'; ?>
