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

if(isset($_POST['like']) == true)
{

    $like_title = $_POST['liketitle'];
    
    if($like_title == '')
    {
        header('Location: todoapp_ng2.php');
        exit();
    }
    header('Location: todoapp_likesearch.php?liketitle='.$like_title);
    exit();
}

?>