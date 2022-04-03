<?php

class ImageUploader {

    public $imageData;

    /**
     * construct
     *
     * @param  mixed $pictures_folder
     * @param  mixed $check_file
     * @return void
     */
    public function __construct(array $imageData, string $targetFolder) 
    {
        $this->imageData = $imageData;
        $this->targetFolder = $targetFolder;
    }

    public function upload_no_check()
    {
        move_uploaded_file($this->imageData["tmp_name"], $this->targetFolder . basename($this->imageData['name']));
    }
    
    /*
     * Check the uploaded file before uploading it to server
     *
     * @param  mixed $max_size
     * @return void
     
    public function upload_with_check(int $maxSize = 500)
    {
        $imageFileType = strtolower(pathinfo($this->targetFolder, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                } else {
                    echo "File is not an image.";
                    $uploadOk = false;
                }
            }
        // Check if file already exists
            if (file_exists($this->targetFolder)) {
                echo "Sorry, file already exists.";
                $uploadOk = false;
            }
        // Check file size
            if ($_FILES["fileToUpload"]["size"] > $maxSize*1000) {
                echo "Sorry, your file is too large.";
                $uploadOk = false;
            }
        // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = false;
            }
        // Check if $uploadOk is set to 0 by an error
            if (!$uploadOk) {
                    echo "Sorry, your file was not uploaded.";
            } else { // if everything is ok, try to upload file
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $this->targetFolder)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
    }
    */

}