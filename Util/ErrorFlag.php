<?php

class ErrorFlag
{
    public static function errorSet($errorMessage)
    {
        if (empty($_SESSION['errorFlag'])) {
            $_SESSION['errorFlag'] = 1;
            $_SESSION['errorMessage'] = $errorMessage;
        }
    }

    public static function errorGet()
    {
        if (!empty($_SESSION['errorFlag'])) {
            echo $_SESSION['errorMessage'];
            unset($_SESSION['errorFlag']);
            unset($_SESSION['errorMessage']);
        }
    }
}

?>