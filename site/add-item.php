<?php require_once '_top.php'; ?>

<?php

    $id = $_POST['item'];
    $qty = $_POST['qty'];

    $_SESSION['order'][] = [
        'id' => $id,
        'qty' => $qty
    ];

    header('location: order.php');

?>

