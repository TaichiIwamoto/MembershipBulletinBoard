<?php
class SaveImage
{
    public static function save($image)
    {
        $imageName = "";
        if (move_uploaded_file($image['tmp_name'], "../Resource/Image/" . $image['name'])) {
            echo "アップロード成功!";
            $imageName = $image['name'];
            return $imageName;
        } else {
            echo "アップロード失敗";
            return $imageName;
        }


    }
}
?>