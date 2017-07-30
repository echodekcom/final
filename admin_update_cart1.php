<?php
session_start();

$itemId = isset($_GET['itemId1']) ? $_GET['itemId1'] : "";
if ($_POST)
{
    for ($i = 0; $i < count($_POST['qty1']); $i++)
    {
        $key = $_POST['arr_key_' . $i];
        $_SESSION['qty1'][$key] = $_POST['qty1'][$i];
        header('location:cart.php');
    }
} else
{
    if (!isset($_SESSION['cart1']))
    {
        $_SESSION['cart1'] = array();
        $_SESSION['qty1'][] = array();
    }

    if (in_array($itemId, $_SESSION['cart1']))
    {
        $key = array_search($itemId, $_SESSION['cart1']);
        echo "<script>alert('คุณได้เพิ่มข้อมูลนี้แล้ว');</script>";
        header('location:borrow.php');
    } else
    {
        array_push($_SESSION['cart1'], $itemId);
        $key = array_search($itemId, $_SESSION['cart1']);
        $_SESSION['qty1'][$key] = 1;
        header('location:repair.php');
    }
}
?>
