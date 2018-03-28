<?php
/**
 * Created by PhpStorm.
 * User: Stu
 */

/** Method for uploading files. Requires the target directory to be supplied
 * // Reference: https://www.w3schools.com/php/php_file_upload.asp
 * @param $targetDirectory: The directory the file is going to be uploaded to. There are different directories for
 * user uploads and administration uploads
 * @return array: An array of the upload result
 */
function fileUpload($targetDirectory){
    // define array to store results
    $uploadArray = array();
    $target_file = $targetDirectory . basename($_FILES["image"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check != False) {
        $uploadOk = true;
    } else {
        $uploadArray['uploadOk'] = false;
        $uploadArray['error'] = "file_not_image: " . print_r($_FILES) . "";
        $uploadArray['fileLocation'] = null;
        $uploadOk = false;
        return $uploadArray;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadArray['uploadOk'] = false;
        $uploadArray['error'] = "file_exists";
        $uploadArray['fileLocation'] = null;
        $uploadOk = false;
        return $uploadArray;
    }
    // Check file size; limit to 6MB
    if ($_FILES["image"]["size"] > 6000000) {
        $uploadArray['uploadOk'] = false;
        $uploadArray['error'] = "file_size";
        $uploadArray['fileLocation'] = null;
        $uploadOk = false;
        return $uploadArray;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG"
        && $imageFileType != "gif" ) {
        $uploadArray['uploadOk'] = false;
        $uploadArray['error'] = "file_format";
        $uploadArray['fileLocation'] = null;
        $uploadOk = false;
        return $uploadArray;
    }
    // Check if $uploadOk is set to false by an error; should not be able to get here but just in case
    if (!$uploadOk) {
        $uploadArray['uploadOk'] = false;
        $uploadArray['error'] = "file_generic";
        $uploadArray['fileLocation'] = null;
        $uploadOk = false;
        return $uploadArray;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $uploadArray['uploadOk'] = true;
            $uploadArray['error'] = null;
            $uploadArray['fileLocation'] = $targetDirectory . basename( $_FILES["image"]["name"]);
            return $uploadArray;
        } else {
            $uploadArray['uploadOk'] = false;
            $uploadArray['error'] = "file_upload";
            $uploadArray['fileLocation'] = null;
            $uploadOk = false;
            return $uploadArray;
        }
    }
} // end fileUpload