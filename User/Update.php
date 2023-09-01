<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="Update.css" type="text/css">
    <title>アップデート情報</title>

</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div class="header1">
        <h1>会員制掲示板システム</h1>
    </div>
    <div class="header2">
        <form action="" method="post">
            <input class="headerButton" type="submit" value="ログイン" name="headerLogin">
            <input class="headerButton" type="submit" value="ログアウト" name="headerLogout">
            <input class="headerButton" type="submit" value="掲示板ホームへ" name="headerThreadView">
        </form>
        <?php
        if (!empty($_POST['headerLogin'])) {
            header("Location: ./Login.php");
            exit;
        } elseif (!empty($_POST['headerLogout'])) {
            header("Location: ./Logout.php");
            exit;
        } elseif (!empty($_POST['headerThreadView'])) {
            header("Location: ../BBS/BBSHome.php");
            exit;
        }
        ?>
    </div>
    <!-- 上記がヘッダ -->
    <div class="updateText">
        <p><b>ver4.1 2023/8/30</b>
        <ul>
            <li>レス投稿にて他ユーザのプロフィールを閲覧できるようにしました</li>
        </ul>
        </p>
        <hr>
        <!--  -->
        <p><b>ver4.0 2023/8/29</b>
        <ul>
            <li>プロフィール機能追加</li>
        </ul>
        </p>
        <hr>
        <!--  -->
        <p><b>ver3.0 2023/8/26</b>
        <ul>
            <li>画像アップロード機能の追加</li>

        </ul>
        バグ修正
        <ul>
            <li>レス投稿時に画面上部に遷移してしまう問題を解決</li>
        </ul>
        </p>
        <hr>
        <!---->
        <p><b>ver2.4 2023/8/21</b><br>
        <ul>
            <li>レス投稿において複数行の投稿を可能にしました</li>
            <li>アップデート情報フォームの作成</li>
        </ul>
        <br>
        バグ修正
        <ul>
            <li>ログイン時のパスワード表示を黒丸にしました</li>
            <li>ゲストとして掲示板に訪れた後、ログインしてもゲストとして扱われる問題の修正</li>
            <li>スレッド一覧とレス一覧を見やすく修正</li>
        </ul>
        </p>
        <hr>
        <!---->
        <p><b>ver2.3 2023/8/19</b><br>
            ユーザ権限の追加 BANされないようにね笑</p>
        <hr>
        <!---->
        <p><b>ver 2.2 2023/8/16</b><br>
            レス一覧表示とレス投稿機能の追加</p>
        <hr>
        <!---->
        <p><b>ver2.1 2023/8/12</b><br>
            スレッド一覧表示機能の追加</p>
        <hr>
        <!---->
        <p><b>ver2.0 2023/8/8</b><br>
            スレッド投稿追加</p>
        <hr>
        <!---->
        <p><b>ver1.0 2023/8/05</b><br>
            ログインフォーム及びアカウント作成フォームの作成</p>


    </div>

</body>

</html>