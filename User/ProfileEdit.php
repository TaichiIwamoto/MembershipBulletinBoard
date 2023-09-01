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
        <?php
        include("../Util/ProfileJSON.php");
        $userName = $_GET['userName'];
        $userJson = ProfileJSON::ReadUserProfile($userName);

        if (!empty($_POST['submit'])) {
            $tmpUserProfile = [];
            if (($_POST['trueName']) != "未設定") {
                array_push($tmpUserProfile, $_POST['trueName']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['country'] != "未設定") {
                array_push($tmpUserProfile, $_POST['country']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['city'] != "未設定") {
                array_push($tmpUserProfile, $_POST['city']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['bestFood'] != "未設定") {
                array_push($tmpUserProfile, $_POST['bestFood']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['bestMovie'] != "未設定") {
                array_push($tmpUserProfile, $_POST['bestMovie']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['bestGame'] != "未設定") {
                array_push($tmpUserProfile, $_POST['bestGame']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['hobby'] != "未設定") {
                array_push($tmpUserProfile, $_POST['hobby']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['url'] != "未設定") {
                array_push($tmpUserProfile, $_POST['url']);
            } else {
                array_push($tmpUserProfile, null);
            }

            if ($_POST['introduction'] != "未設定") {
                array_push($tmpUserProfile, $_POST['introduction']);
            } else {
                array_push($tmpUserProfile, null);
            }
            ProfileJSON::WriteUserProfile($tmpUserProfile, $userName);
            header("Location:./UserProfile.php?userName=" . $userName . "");
        }
        ?>

        <div class="viewProfile">
            <?php

            if ($userName == "ゲスト") {
                echo "ゲストユーザはプロフィール編集できません<br>ログインしてください<br>";
            } else {
                ?>
                <b>会員情報</b>
                <div class="profileDetail">
                    <p>
                    <form action="" method="post">
                        <b>本名</b>:
                        <input type="text" placeholder="未設定" name="trueName" value="<?php if (isset($userJson->trueName)) {
                            echo $userJson->trueName;
                        } ?>">
                        </p>
                        <p>
                            <b>国籍</b>:
                            <input type="text" placeholder="未設定" name="country" value="<?php if (isset($userJson->country)) {
                                echo $userJson->country;
                            } ?>">
                        </p>
                        <p>
                            <b>出身</b>:
                            <input type="text" placeholder="未設定" name="city" value="<?php if (isset($userJson->city)) {
                                echo $userJson->city;
                            } ?>">
                        </p>
                        <p>
                            <b>好きな食べ物</b>:
                            <input type="text" placeholder="未設定" name="bestFood" value="<?php if (isset($userJson->bestFood)) {
                                echo $userJson->bestFood;
                            } ?>">
                        </p>
                        <p>
                            <b>好きな映画</b>:
                            <input type="text" placeholder="未設定" name="bestMovie" value="<?php if (isset($userJson->bestMovie)) {
                                echo $userJson->bestMovie;
                            } ?>">
                        </p>
                        <p>
                            <b>好きなゲーム</b>:
                            <input type="text" placeholder="未設定" name="bestGame" value="<?php if (isset($userJson->bestGame)) {
                                echo $userJson->bestGame;
                            } ?>">
                        </p>
                        <p>
                            <b>趣味</b>:
                            <input type="text" placeholder="未設定" name="hobby" value="<?php if (isset($userJson->hobby)) {
                                echo $userJson->hobby;
                            } ?>">
                        </p>
                        <p>
                            <b>リンク</b>:
                            <input type="text" placeholder="未設定" name="url" value="<?php if (isset($userJson->url)) {
                                echo $userJson->url;
                            } ?>">
                        </p>
                        <p>
                            <b>自己紹介</b>:
                            <input type="text" placeholder="未設定" name="introduction" value="<?php if (isset($userJson->introduction)) {
                                echo $userJson->introduction;
                            } ?>">
                        </p>

                </div>
                <br>
                <?php
            }
            ?>
        </div>
    </div>
    <input id="editButton" type="submit" value="完了" name="submit">
    </form>


</body>

</html>