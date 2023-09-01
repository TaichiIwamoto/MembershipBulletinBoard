<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="BBSView.css" type="text/css">
    <title>掲示板閲覧</title>
</head>

<body>
    <?php
    include("../Util/ErrorFlag.php");
    require_once("../Util/SessionManage.php");
    if (!empty($_GET["userName"])) {
        userInformation::setUserInformation($_GET["userName"]);
    }
    $userInfo = userInformation::getUserInformation();
    $userName = $userInfo["userName"];
    $threadName = $_GET['tn'];
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
            <input class="headerButton" type="submit" value="掲示板ホームへ" name="headerThreadView">
            <input class="headerButton" type="submit" value=レス投稿 name="headerResCreate">
            <input class="headerButton" type="submit" value="アップデート情報" name="updateInformation">
        </form>
        <?php
        if (!empty($_POST['headerLogin'])) {
            header("Location: ../User/Login.php");
            exit;
        } elseif (!empty($_POST['headerLogout'])) {
            header("Location: ../User/Logout.php");
            exit;
        } elseif (!empty($_POST['headerThreadView'])) {
            header("Location: ./BBSHome.php");
            exit;
        } elseif (!empty($_POST['updateInformation'])) {
            header("Location: ../User/Update.php");
            exit;
        } elseif (!empty($_POST['headerResCreate'])) {
            header("Location:./BBSView.php?tn=" . $threadName . "#view");
            exit;
        }
        ?>
    </div>
    <!-- 上記がヘッダ -->
    <div class="viewThread">
        <?php
        //データベース接続
        include("../Util/ConnectDB.php");
        $pdo = ConnectDB::connection();
        ////
        
        //レス投稿
        if (!empty($_POST['resSubmit'])) {
            if (!empty($_POST['comment']) || !empty($_FILES['imageUpload']['tmp_name'])) {
                $resouceName = "";
                if (!empty($_FILES['imageUpload']['tmp_name'])) {
                    ?>
                    <!-- <script src="../Typescript/dir/imageUpload.js"></script> -->
                    <?php
                    include_once("../Util/SaveImage.php");
                    $image = $_FILES['imageUpload'];
                    $resouceName = SaveImage::save($image);
                }
                $comment = $_POST['comment'];
                $date = date("Y/m/d H:i:s");

                $sql = 'INSERT INTO ' . $threadName . '(name,date,comment,resourceName) VALUES(:name,:date,:comment,:resourceName)';

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam('name', $userName, PDO::PARAM_STR);
                $stmt->bindParam('date', $date, PDO::PARAM_STR);
                $stmt->bindParam('comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam('resourceName', $resouceName, PDO::PARAM_STR);
                $stmt->execute();
                header("Location:./BBSView.php?tn=" . $threadName . "#view");
                exit;
            } else {
                ErrorFlag::errorSet("コメントを入力してください");
                header("Location:./BBSView.php?tn=" . $threadName . "#view");
                exit;
            }
        }
        ////
        
        // レス一覧表示
        ?>
        <h1 class="threadName">
            <?php echo $threadName . "<br>"; ?>
        </h1>
        <?php
        $sql = "SELECT * FROM " . $threadName . "";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll();
        foreach ($result as $line) {
            $line[3] = str_replace("\n", "<br>", $line[3]);
            ?>
            <p>
                <?php
                echo $line[0] . " ";
                ?>
                <a href="../User/UserProfile.php?userName=<?php echo $line[1] ?>&viewUser=<?php echo $userName ?>">
                    <?php
                    echo $line[1];
                    ?></a>
                <?php
                echo " " . $line[2] . "<br>" . $line[3] . "<br>"; ?>
            </p>
            <?php
            if ($line[4] != "") {
                $filePath = "../Resource/Image/" . $line[4];
                ?>
                <img id="loadImage" src="<?php echo $filePath; ?>">
                <?php
            }
        }
        ?>
        <h1 class="threadName">
            レス投稿
        </h1>
        <form id="view" action="" method="post" enctype="multipart/form-data">
            <textarea name="comment" placeholder="コメント" cols="30" rows="10"></textarea><br>
            <input type="file" name="imageUpload" accept="image/*"><br>
            <input type="submit" value="投稿" name="resSubmit">
        </form>
        <?php
        ErrorFlag::errorGet();
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

    </div>
</body>