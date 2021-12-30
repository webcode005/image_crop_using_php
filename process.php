<?php



if(isset($_POST["submit"])) {

    if(is_array($_FILES)) {



        $file = $_FILES['img']['tmp_name']; 

        $sourceProperties = getimagesize($file);

        $fileNewName = time();

        $folderPath = "media/";

        $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

        $imageType = $sourceProperties[2];

        // echo '<pre>';

        // print_r($IMAGETYPE_PNG); 
        // echo '</pre>';
        // die();

        switch ($imageType) {



            case IMAGETYPE_PNG:

                $imageResourceId = imagecreatefrompng($file); 

                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);

                imagepng($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);

                break;



            case IMAGETYPE_GIF:

                $imageResourceId = imagecreatefromgif($file); 

                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);

                imagegif($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);

                break;



            case IMAGETYPE_JPEG:

                $imageResourceId = imagecreatefromjpeg($file); 

                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);

                imagejpeg($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);

                break;

            case IMAGETYPE_WEBP:

                $imageResourceId = imagecreatefromwebp($file); 

                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);

                imagewebp($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);

                break;



            default:

                echo "Invalid Image type.";

                exit;

                break;

        }



        move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);

        echo "Image Uploaded with created thumbnail Successfully.";

    }

}



function imageResize($imageResourceId,$width,$height) {



    $targetWidth =250;

    $targetHeight =250;



    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);

    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);



    return $targetLayer;

}

?>