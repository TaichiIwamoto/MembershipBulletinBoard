<?php
class ConnectDB
{
    public static function connection()
    {
        $dsn = 'mysql:dbname=tb250205db;host=localhost';
        $user = '*********';
        $password = '*********';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        return $pdo;
    }
}
?>
