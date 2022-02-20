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
    
    //データ数を取得
    $sql1 = 'SELECT COUNT(*) FROM posts';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    $rec1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    
    define('MAX','5');
    
    $todo_num = $rec1['COUNT(*)'];
    $max_page = ceil($todo_num / MAX);

    //すべてのデータをカラムごとにそれぞれの変数に格納
    $sql2 = 'SELECT * FROM posts';
    $stmt2 = $dbh->query($sql2);
    foreach ($stmt2 as $row)
    {
        $todo_ID[] = $row['ID'];
        $todo_title[] = $row['title'];
        $todo_content[] = $row['content'];
        $todo_created_at[] = $row['created_at'];
    }
    
    //ページング機能
    if(!isset($_GET['page_id'])){
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    
    $start_no = ($now - 1) * MAX;

    $dbh = null;
    

    print 'todoリスト一覧<br/><br/>';
    
    print '<form method="post" action="todoapp_branch.php">';
    print '<p>';
    print '検索したいタイトルを入力してください';
    print '</p>';
    print '<input placeholder="キーワードを入力" name="liketitle">';
    print '<input type="submit" name="like" value="検索">';
    print '</form>';
    print '</br>';


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

    //データを5こずつ表示
    for($i = $start_no; $i < $start_no + 5; $i++)
    {
        if(empty($todo_ID[$i]))
        {
            break;
        }
        print '<tr>';
        print '<td>';
        print '<input type="radio" name="listcode" value="'.$todo_ID[$i].'">';
        print '</td>';
        print '<td>';
        print $todo_title[$i];
        print '</td>';
        print '<td>';
        print $todo_content[$i];
        print '</td>';
        print '<td>';
        print $todo_created_at{$i};
        print '</td>';
        print '</tr>';

    }
    print '</table>';

    print '<input type="submit" name="add" value="追加">';
    print '<input type="submit" name="edit" value="修正">';
    print '<input type="submit" name="delete" value="削除">';
    print '</form>';

    
    if($now > 1){ // リンクをつけるかの判定
        echo '<a href="./todoapp_list.php?page_id='.($now - 1).'">前へ</a>'. '　';
    } elseif ($now == 1) {
        echo '';
    } else {
        echo '前へ'. '　';
    }
 
    for($i = 1; $i <= $max_page; $i++){
        if ($i == $now) {
            echo $now. '　'; 
        } else {
            echo '<a href="./todoapp_list.php?page_id='.$i.'">'.$i.'</a>'. '　';
        }
    }
 
    if($now < $max_page){ // リンクをつけるかの判定
        echo '<a href="./todoapp_list.php?page_id='.($now + 1).'">次へ</a>'. '　';
    } elseif ($now == $max_page) {
        echo '';
    } else {
        echo '次へ';
    }

}



catch (Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

</body>

</html>