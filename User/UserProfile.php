<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="UserProfile.css" type="text/css">
    <title>プロフィール</title>
</head>

<body>
    <div class=" header1">
        <h1>会員制掲示板システム</h1>
    </div>
    <div class="header2">
        <form action="" method="post">
            <input class="headerButton" type="submit" value="ログイン" name="headerLogin">
            <input class="headerButton" type="submit" value="ログアウト" name="headerLogout">
            <input class="headerButton" type="submit" value="掲示板ホームへ" name="headerThreadView">
            <input class="headerButton" type="submit" value="アップデート情報" name="updateInformation">
        </form>
        <?php
        if (!empty($_POST['headerLogin'])) {
            header("Location: ./Login.php");
            exit;
        } elseif (!empty($_POST['headerLogout'])) {
            header("Location: ./Logout.php");
            exit;
        } elseif (!empty($_POST['updateInformation'])) {
            header("Location: ./Update.php");
            exit;
        } elseif (!empty($_POST['headerThreadView'])) {
            header("Location: ../BBS/BBSHome.php");
            exit;
        } elseif (!empty($_POST['updateInformation'])) {
            header("Location: ./Update.php");
            exit;
        }
        ?>
    </div>
    <!-- 上記がヘッダ -->

    <!-- プロフィール取得 -->

    <!-- プロフィール描画 -->
    <div class="editBackground">
        <div class="viewProfile">
            <?php
            include("../Util/ProfileJSON.php");
            $userName = $_GET['userName'];
            $viewUser = "";
            if (!empty($_GET['viewUser'])) {
                $viewUser = $_GET['viewUser'];
            }
            if ($userName == "ゲスト") {
                echo "ゲストユーザはプロフィールが存在しません<br>";
            } else {
                $userJson = ProfileJSON::ReadUserProfile($userName);
                ?>
                <b>会員情報:
                    <?php echo $userName; ?>
                </b>
                <div class="profileDetail">
                    <p>
                        <b>本名</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "trueName");
                        ?>
                    </p>
                    <p>
                        <b>国籍</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "country");
                        ?>
                    </p>
                    <p>
                        <b>出身</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "city");
                        ?>
                    </p>
                    <p>
                        <b>好きな食べ物</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "bestFood");
                        ?>
                    </p>
                    <p>
                        <b>好きな映画</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "bestMovie");
                        ?>
                    </p>
                    <p>
                        <b>好きなゲーム</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "bestGame");
                        ?>
                    </p>
                    <p>
                        <b>趣味</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "hobby");
                        ?>
                    </p>
                    <p>
                        <b>リンク</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "url");
                        ?>
                    </p>
                    <p>
                        <b>自己紹介</b>:
                        <?php
                        ProfileJSON::viewProfileInfomation($userJson, "introduction");
                        ?>
                    </p>
                </div>
                <br>
            </div>
        </div>
        <?php
        if ($viewUser == $userName || empty($viewUser)) {
            ?>
            <button id="editButton"
                onclick="location.href='./ProfileEdit.php?userName=<?php echo $userName; ?>'">プロフィール編集</button>
            <?php
        }
            }
            ?>

</body>

</html>