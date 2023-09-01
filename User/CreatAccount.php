<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Login.css" type="text/css">
    <title>アカウント新規作成</title>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div class="header1">
        <h1>会員制掲示板システム</h1>
    </div>

    <div class="header2">
        <form action="" method="post">
            <input class="headerButton" type="submit" value=ログイン name="headerLogin">
            <input class="headerButton" type="submit" value="アップデート情報" name="updateInformation">
        </form>
    </div>
    <?php
    if (isset($_POST['headerLogin'])) {
        header('Location: ./Login.php');
        exit;
    } elseif (!empty($_POST['updateInformation'])) {
        header("Location: ./Update.php");
        exit;
    }
    ?>
    <!-- 上記がヘッダ -->

    <div class="login">
        <h1 class="form">アカウント新規作成</h1>
        <form class="form" action="" method="post">
            <input class="inputString" type="text" placeholder="ユーザ名" name="name"><br>
            <input class="inputString" type="password" placeholder="パスワード" name="password"><br>
            <input class="inputString" type="submit" value="アカウント作成" name="create"><br>

            <?php
            include("../Util/ConnectDB.php");
            $pdo = ConnectDB::connection();

            $sql = "CREATE TABLE IF NOT EXISTS UserDB"
                . "("
                . "name char(32) PRIMARY KEY,"
                . "password TEXT,"
                . "readAuthority TINYINT(1)," //カラムに予約語が含むとエラーになる Readは予約語だった
                . "editAuthority TINYINT(1),"
                . "joinAuthority TINYINT(1),"
                . "administrator TINYINT(1)"
                . ");";
            $stmt = $pdo->query($sql);

            if (isset($_POST['create'])) {
                if (!empty($_POST['name'] && !empty($_POST['password']))) {
                    $name = $_POST['name'];
                    $password = $_POST['password'];
                    $sql = 'SELECT name FROM UserDB WHERE name=:name';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if ($count == 0) {
                        $sql = 'INSERT INTO UserDB (name,password,readAuthority,editAuthority,joinAuthority,administrator) VALUES(:name,:password,1,1,1,0)';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam('name', $name, PDO::PARAM_STR);
                        $stmt->bindParam('password', $password, PDO::PARAM_STR);
                        $stmt->execute();
                        sleep(1);
                        header('Location: ./Login.php');
                        exit;
                    } else {
                        echo "既に使用されているユーザ名です。";
                    }

                } else {
                    echo "ユーザネームとパスワードを入力してください";
                }
            }
            ?>
    </div>
</body>