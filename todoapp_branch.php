<?php

if(isset($_POST['add']) == true)
{
    header('Location: todoapp_add.php');
    exit();
}

if(isset($_POST['edit']) == true)
{
    if(isset($_POST['listcode']) == false)
    {
        header('Location: todoapp_ng.php');
        exit();
    }
    $list_code = $_POST['listcode'];
    header('Location: todoapp_edit.php?listcode='.$list_code);
    exit();
}

if(isset($_POST['delete']) == true)
{
    if(isset($_POST['listcode']) == false)
    {
        header('Location: todoapp_ng.php');
        exit();
    }
    $list_code = $_POST['listcode'];
    header('Location: todoapp_delete.php?listcode='.$list_code);
    exit();
}

?>