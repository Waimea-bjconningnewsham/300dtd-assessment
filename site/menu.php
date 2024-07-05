<?php require_once '_top.php'; ?>

<?php
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

    echo '<ul>';
    foreach ($items as $item) {

        // get variables from list
    $product = $item['product'] ;
    $price = $item['price'];
    $price = '$'.number_format($price, 2);
    $menuid = $item['id'];

        echo '<li><b>' . $product, "</b>:    " , $price . '</li>';
    }
    echo '</ul>';
?>

<?php require_once '_bottom.php'; ?>


