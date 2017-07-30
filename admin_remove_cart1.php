<?php
session_start();

$itemId1 = isset($_GET['itemId1']) ? $_GET['itemId1'] : "";

if (!isset($_SESSION['cart1']))
{
    $_SESSION['cart1'] = array();
    $_SESSION['qty1'][] = array();
}

$key = array_search($itemId1, $_SESSION['cart1']);
$_SESSION['qty1'][$key] = "";

$_SESSION['cart1'] = array_diff($_SESSION['cart1'], array($itemId1));
header('location:repair.php');
?>
