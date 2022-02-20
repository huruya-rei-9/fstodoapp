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

    $like_title = $_GET['liketitle'];

    $dsn = 'mysql:dbname=todoapp;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //データ数を取得
    $sql1 = 'SELECT COUNT(*) FROM posts';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    $rec1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $todo_num = $rec1['COUNT(*)'];


    //あいまい検索で入力された値をタイトルに含むデータを全取得
    $sql = 'SELECT * FROM posts WHERE title LIKE ?';
    $stmt = $dbh->prepare($sql);
    $data[] = "%$like_title%";
    $stmt->execute($data);
    foreach ($stmt as $row)
    {
        $todo_ID[] = $row['ID'];
        $todo_title[] = $row['title'];
        $todo_content[] = $row['content'];
        $todo_created_at[] = $row['created_at'];
    }

    
    
    if(isset($todo_ID) == false)
    {
        print '該当するデータはありません。';
    } else
    {

        //(あいまい検索にかかったそれぞれのデータIDの数字 >= 全データID数字) を満たすデータの個数をそれぞれ取得
        foreach($todo_ID as $key => $val)
        {
    
            $sql2 = 'SELECT COUNT(*) FROM posts WHERE ID<=?';
            $stmt2 = $dbh->prepare($sql2);
            $data[0] = $val;
            $stmt2->execute($data);
            $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    
            $onnum[] = $rec2['COUNT(*)'];
            
        }
        

        print '</br>';
        print 'ヒットしたタイトルを表示します。';
        print '</br>';
        print 'リンクから飛んでください。';
        print '</br>';
        print '</br>';
        print '</br>';


        define('MAX','5');

    
        //あいまい検索にかかったタイトルを表示。そのままリンクで飛べる。
        for($i = 0; $i < $todo_num; $i++)
        {
            if(empty($todo_ID[$i]))
            {
                break;
            }
            print '<a href="todoapp_list.php?page_id='.ceil($onnum[$i] / MAX).'">';
            print $todo_title[$i];
            print '</a>';
            print '</br>';
    
        }
    }




    $dbh = null;

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

</br>
<a href="todoapp_list.php">戻る</a>

</body>

</html>