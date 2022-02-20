<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TodoApp</title>
</head>
<body>

<?php

$todo_title = $_POST['title'];
$todo_contents = $_POST['contents'];

$todo_title = htmlspecialchars($todo_title, ENT_QUOTES, 'UTF-8');
$todo_contents = htmlspecialchars($todo_contents, ENT_QUOTES, 'UTF-8');

if($todo_title == '')
{
    print 'タイトルが入力されていません。<br/>';
} elseif(strlen($todo_title) > 255)
{
    print 'タイトルは255字以内にしてください。';
}
else
{
    print 'タイトル';
    print '<br/>';
    print $todo_title;
    print '<br/>';
}

if($todo_contents == '')
{
    print '内容が入力されていません。<br/>';
}
else
{
    print '内容';
    print '<br/>';
    print $todo_contents;
    print '<br/>';
}

if($todo_title == '' || $todo_contents == '')
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}
else
{
    print '<form method="post" action="todoapp_add_done.php">';
    print '<input type="hidden" name="title" value="'.$todo_title.'">';
    print '<input type="hidden" name="contents" value="'.$todo_contents.'">';
    print '<br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
}

?>

</body>

</html>