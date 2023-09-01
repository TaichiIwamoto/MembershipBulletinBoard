<?php
session_start();
?>
<?php
require_once("../Util/SessionManage.php");
userInformation::resetUserInformation();
sleep(1);
header("Location: ./Login.php");
exit;
?>