<?php
session_start();

$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
if ($_POST)
{
    for ($i = 0; $i < count($_POST['qty']); $i++)
    {
        $key = $_POST['arr_key_' . $i];
        $_SESSION['qty'][$key] = $_POST['qty'][$i];
        header('location:cart.php');
    }
} else
{
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['qty'][] = array();
    }

    if (in_array($itemId, $_SESSION['cart']))
    {
        $key = array_search($itemId, $_SESSION['cart']);
        echo "<script>alert('คุณได้เพิ่มข้อมูลนี้แล้ว');</script>";
        header('location:borrow.php');
    } else
    {
        array_push($_SESSION['cart'], $itemId);
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['qty'][$key] = 1;
        header('location:borrow.php');
    }
}
?>
