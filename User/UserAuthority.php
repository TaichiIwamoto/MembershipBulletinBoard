<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="UserAuthority.css" type="text/css">
    <title>ユーザ管理</title>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php
    //データベース接続
    include("../Util/ConnectDB.php");
    $pdo = ConnectDB::connection();
    ////
    
    $sql = 'SELECT * FROM UserDB';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    ?>
    <!-- 以下ユーザ権限テーブル表示 -->
    <div>
        <table>
            <tr>
                <th>ユーザ名</th>
                <th>閲覧権限</th>
                <th>編集権限</th>
                <th>参加権限</th>
            </tr>
            <?php
            foreach ($result as $line) {
                ?>
                <tr>
                    <th>
                        <?php echo $line['name']; ?>
                    </th>
                    <th>
                        <?php echo $line['readAuthority']; ?>
                        <form action="" method="post">
                            <input type="button" value="変更" name="raChange" onclick="<?php echo $line['name']; ?>">
                        </form>

                    </th>
                    <th>
                        <?php echo $line['editAuthority']; ?>
                    </th>
                    <th>
                        <?php echo $line['joinAuthority']; ?>
                    </th>
                </tr>
                <?php
            }

            ?>
        </table>


    </div>
    <!---->

</body>