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

    $dsn = 'mysql:dbname=todoapp;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT ID, title, content, created_at FROM posts WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print 'todoリスト一覧<br/><br/>';

    print '<form method="post" action="todoapp_branch.php">';
    print '<table border="1">';
    print '<tr>';
    print '<td>';
    print '選択';
    print '</td>';
    print '<td>';
    print 'タイトル';
    print '</td>';
    print '<td>';
    print '内容';
    print '</td>';
    print '<td>';
    print '作成日時';
    print '</td>';
    print '</tr>';
    while(true)
    {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == false)
        {
            break;
        }
        print '<tr>';
        print '<td>';
        print '<input type="radio" name="listcode" value="'.$rec['ID'].'">';
        print '</td>';
        print '<td>';
        print $rec['title'];
        print '</td>';
        print '<td>';
        print $rec['content'];
        print '</td>';
        print '<td>';
        print $rec['created_at'];
        print '</td>';
        print '</tr>';
        // $todo_title = $rec['title'];
        // $todo_content = $rec['content'];
        // $todo_created_at = $rec['created_at'];
        // print '<br/>';
    }
    print '</table>';
    print '<input type="submit" name="add" value="追加">';
    print '<input type="submit" name="edit" value="修正">';
    print '<input type="submit" name="delete" value="削除">';
    print '</form>';

}

catch (Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

</body>

</html>