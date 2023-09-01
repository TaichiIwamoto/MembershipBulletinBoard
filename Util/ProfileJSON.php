<?php
class ProfileJSON
{

    //json初期生成関数
    public static function InitUserProfile($userName)
    {
        //json構造
        $userProfileArray = array(
            'trueName' => null,
            'country' => null,
            'city' => null,
            'bestFood' => null,
            'bestMovie' => null,
            'bestGame' => null,
            'hobby' => null,
            'url' => null,
            'introduction' => null
        );
        //json書き出し
        $json = json_encode($userProfileArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $jsonPath = "../Resource/ProfileJSON/" . $userName . ".json";
        if (!file_exists($jsonPath)) {
            file_put_contents($jsonPath, $json);
        }
    }

    //json読み込み関数
    public static function ReadUserProfile($userName)
    {
        $jsonPath = "../Resource/ProfileJSON/" . $userName . ".json";
        if (file_exists($jsonPath)) {
            $json = file_get_contents($jsonPath);
        } else {
            ProfileJSON::InitUserProfile($userName);
            $json = file_get_contents($jsonPath);
        }

        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        // echo var_dump(json_decode($json)) . "<br>";
        $json = json_decode($json);
        return $json;
    }

    public static function viewProfileInfomation($json, $index)
    {
        if (empty($json->$index)) {
            echo "未設定";
        } else {
            echo $json->$index;
        }
    }

    public static function WriteUserProfile($tmpUserProfile, $userName)
    {
        echo var_dump($tmpUserProfile);

        $userProfileArray = array(
            'trueName' => $tmpUserProfile[0],
            'country' => $tmpUserProfile[1],
            'city' => $tmpUserProfile[2],
            'bestFood' => $tmpUserProfile[3],
            'bestMovie' => $tmpUserProfile[4],
            'bestGame' => $tmpUserProfile[5],
            'hobby' => $tmpUserProfile[6],
            'url' => $tmpUserProfile[7],
            'introduction' => $tmpUserProfile[8]
        );
        //json書き出し
        $json = json_encode($userProfileArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $jsonPath = "../Resource/ProfileJSON/" . $userName . ".json";
        file_put_contents($jsonPath, $json);
        echo var_dump($userProfileArray);
    }
}

// ProfileJSON::InitUserProfile("Churritos97");
?>