<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TodoApp</title>
</head>
<body>

<?php

try
{

    $list_code = $_GET['listcode'];

    $dsn = 'mysql:dbname=todoapp;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT title FROM posts WHERE ID=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $list_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $todo_title = $rec['title'];

    $dbh = null;

}
catch (Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

Todo削除<br/>
<br/>
Todoコード<br/>
<?php print $list_code; ?>
<br/>
タイトル<br/>
<?php print $todo_title; ?>
<br/>
このTodoを削除してよろしいですか？<br/>
<br/>
<form method="post" action="todoapp_delete_done.php">
    <input type="hidden" name="listcode" value="<?php print $list_code; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>

</body>

</html>