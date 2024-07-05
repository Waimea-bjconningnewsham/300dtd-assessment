<?php
require_once 'lib/_session.php';

$_SESSION[order] = [];

header('location: order.php');

