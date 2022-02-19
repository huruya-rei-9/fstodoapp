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

    $list_code = $_POST['listcode'];
    $todo_title = $_POST['title'];
    $todo_contents = $_POST['contents'];

    $todo_title = htmlspecialchars($todo_title, ENT_QUOTES, 'UTF-8');
    $todo_contents = htmlspecialchars($todo_contents, ENT_QUOTES, 'UTF-8');

    $dsn = 'mysql:dbname=todoapp;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 日本時間を取得し、後に必要な'$date'を作成
    $date = new DateTime();
    $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));
    $date = $date->format('Y-m-d H:i:s');

    $sql = 'UPDATE posts SET title=?, content=?, updated_at=? WHERE ID=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $todo_title;
    $data[] = $todo_contents;
    $data[] = $date;
    $data[] = $list_code;
    $stmt->execute($data);

    $dbh = null;

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

修正しました。<br/>
<br/>
<a href="todoapp_list.php">戻る</a>

</body>

</html>