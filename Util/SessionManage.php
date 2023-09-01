<?php
class userInformation
{
    public static function setUserInformation($userName)
    {
        if (empty($_SESSION['userInfo'])) {
            // $_SESSION['userName'] = $userName; 
            include("../Util/ConnectDB.php");
            $pdo = ConnectDB::connection();

            $sql = 'SELECT * FROM UserDB WHERE name=:name';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam('name', $userName);
            $stmt->execute();
            $result = $stmt->fetch();
            $userInfo['userName'] = $userName;
            $userInfo['ra'] = $result[2];
            $userInfo['ea'] = $result[3];
            $userInfo['ja'] = $result[4];
            $userInfo['ad'] = $result[5];
            $_SESSION['userInfo'] = $userInfo;
        }
    }
    public static function getUserInformation()
    {
        $userInfo = $_SESSION['userInfo'];
        return $userInfo;
    }
    public static function resetUserInformation()
    {
        unset($_SESSION['userInfo']);
    }
}
?>