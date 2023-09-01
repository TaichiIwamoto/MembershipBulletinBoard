<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Login.css" type="text/css">
    <title>会員制掲示板システムへようこそ</title>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div class="header1">
        <h1>会員制掲示板システム</h1>
    </div>

    <div class="header2">
        <form action="" method="post">
            <input class="headerButton" type="submit" value=掲示板ホームへ name="headerBBS">
            <input class="headerButton" type="submit" value="アップデート情報" name="updateInformation">
        </form>
    </div>
    <?php
    if (isset($_POST['headerBBS'])) {
        header("Location: ../BBS/BBSHome.php");
        exit;
    } elseif (!empty($_POST['updateInformation'])) {
        header("Location: ./Update.php");
        exit;
    }
    ?>
    <!-- 上記がヘッダ -->


    <div class="login">
        <h1 class="form">ログイン画面</h1>
        <form class="form" action="" method="post">
            <input class="inputString" type="text" placeholder="ユーザ名" name="name"><br>
            <input class="inputString" type="password" placeholder="パスワード" name="password"><br>
            <input class="inputString" type="submit" value="ログイン" name="login"><br>
            <input id="creatAccount" type="submit" value="アカウント作成" name="create"><br>
        </form>
        <?php
        // データベースへの接続
        include_once("../Util/ConnectDB.php");
        $pdo = ConnectDB::connection();
        ////
        
        //アカウント新規作成フォームへ移動
        if (isset($_POST['create'])) {
            header('Location: ./CreatAccount.php');
            exit;
            //ログイン処理
        } elseif (isset($_POST['login'])) {
            include_once("../Util/SessionManage.php");
            if ((userInformation::getUserInformation()['userName'] == "ゲスト")) {
                userInformation::resetUserInformation();
            }
            if (!empty($_POST['name'] && !empty($_POST['password']))) {
                $userName = ($_POST['name']);
                $password = $_POST['password'];
                $sql = 'SELECT name,password FROM UserDB WHERE name=:name';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam('name', $userName, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                //プロフィールJSON初期生成(一回のみ)
                include("../Util/ProfileJSON.php");
                ProfileJSON::InitUserProfile($userName);

                if ($result["password"] == $password) {
                    header('Location: ../BBS/BBSHome.php?userName=' . $userName . '');
                    exit;
                } else {
                    echo "ユーザー名又はパスワードが間違っています。";
                }

            } else {
                echo "ユーザ名とパスワードを入力してください。";
            }
        }
        ////
        
        ?>
    </div>
</body>