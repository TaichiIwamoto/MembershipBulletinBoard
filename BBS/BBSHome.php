<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="BBSHome.css" type="text/css">
    <title>掲示板ホーム</title>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php
    $dsn = 'mysql:dbname=tb250205db;host=localhost';
    $user = 'tb-250205';
    $password = 'ZyHZaYsz5T';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    include_once("../Util/SessionManage.php");
    if (!empty($_GET["userName"])) {
        userInformation::setUserInformation($_GET["userName"]);
    } else {
        userInformation::setUserInformation("ゲスト");
    }
    $userInfo = userInformation::getUserInformation();
    $userName = $userInfo["userName"];
    ?>

    <div class="header1">
        <h1>会員制掲示板システム</h1>
    </div>
    <div class="header2">
        <a href="../User/UserProfile.php?userName=<?php echo $userName ?>">
            <?php
            echo "ユーザ名：" . $userName;
            ?>
        </a>

        <form action="" method="post">
            <input class="headerButton" type="submit" value="ログイン" name="headerLogin">
            <input class="headerButton" type="submit" value="ログアウト" name="headerLogout">
            <input class="headerButton" type="submit" value=スレッド作成 name="headerThreadCreate">
            <input class="headerButton" type="submit" value="アップデート情報" name="updateInformation">
            <?php
            if ($userInfo['ad'] == 1) {
                ?>
                <input class="headerButton" type="submit" value="管理者ページ" name="administrator">
                <?php
            }
            ?>
        </form>
        <?php
        if (!empty($_POST['headerLogin'])) {
            header("Location: ../User/Login.php");
            exit;
        } elseif (!empty($_POST['headerLogout'])) {
            header("Location: ../User/Logout.php");
            exit;
        } elseif (!empty($_POST['updateInformation'])) {
            header("Location: ../User/Update.php");
            exit;
        }
        ?>
    </div>
    <!-- 上記がヘッダ -->
    <?php
    if (!empty($_POST['administrator'])) {
        header("Location: ../User/UserAuthority.php");
        exit;
    }
    ?>
    <div class="BBS">
        <h1>スレッド一覧</h1>
        <?php
        //スレッド一覧表示処理
        $sql = 'SELECT threadName FROM ThreadDB';
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll();
        foreach ($result as $line) {
            ?>
            <p>
            <form action="" method="post">
                <input type="button" name="threadName" value="<?php echo $line[0]; ?>"
                    onclick="location.href='./BBSView.php?tn=<?php echo $line[0] ?>'">
            </form>
            </p>
            <?php
        }
        ?>
        <h1>スレッド作成</h1>
        <form action="" method="post">
            <input type="text" placeholder="スレッド名" name="threadName"><br>
            <textarea name="threadComment" placeholder="コメント" cols="30" rows="10"></textarea><br>
            <input type="submit" value="スレッド作成" name="threadSubmit">
        </form>

        <?php
        //スレッド作成処理
        if (isset($_POST["threadSubmit"])) {
            if (!empty($_POST["threadName"]) && !empty($_POST["threadComment"])) {
                $threadName = $_POST["threadName"];
                //スレッド作成処理　DB動的生成
                $sql = "CREATE TABLE IF NOT EXISTS " . $threadName . ""
                    . "("
                    . "id INT AUTO_INCREMENT PRIMARY KEY,"
                    . "name char(32),"
                    . "date DATETIME,"
                    . "comment TEXT,"
                    . "resourceName TEXT"
                    . ");";
                $stmt = $pdo->query($sql);

                //スレッドを溜め込むDB
                $sql = "CREATE TABLE IF NOT EXISTS ThreadDB"
                    . "("
                    . "id INT AUTO_INCREMENT PRIMARY KEY,"
                    . "threadName TEXT"
                    . ");";
                $stmt = $pdo->query($sql);

                //スレッドDBにレコード追加処理
                $date = date("Y/m/d H:i:s");
                $threadComment = $_POST["threadComment"];
                $sql = 'INSERT INTO ' . $threadName . '(name,date,comment) VALUES(:name,:date,:comment)';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam('name', $userName, PDO::PARAM_STR);
                $stmt->bindParam('date', $date, PDO::PARAM_STR);
                $stmt->bindParam('comment', $threadComment, PDO::PARAM_STR);
                $stmt->execute();

                //総合スレッドDBにスレッド追加
                $sql = 'INSERT INTO ThreadDB (threadName) VALUES(:threadName)';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam('threadName', $threadName, PDO::PARAM_STR);
                $stmt->execute();

                header("Location: ./BBSHome.php");
                exit;

            } else {
                echo "スレッド名とコメントを入力してください";
            }
        }
        ?>
    </div>
</body>