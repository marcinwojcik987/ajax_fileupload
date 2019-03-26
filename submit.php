<?php
if(!empty($_POST['name']) || !empty($_POST['email']) || !empty($_FILES['file']['name'])){
    $uploadedFile = '';
    if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "uploads/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        }
    }
    
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $wszystko_OK = true;
        $name = $_POST['name'];
        $email = $_POST['email'];
       
        //sprawdzenie czy nick sklada sie tylko z liter i cyfr bez polskich znakow
        if (ctype_alnum($name)==false){
            $wszystko_OK=false;            
        }

        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);    
        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)){
            $wszystko_OK = false;            
        }

        if ($wszystko_OK==true) {
            include_once 'dbConfig.php';    
            //insert form data in the database
            $insert = $db->query("INSERT form_data (name,email,file_name) VALUES ('".$name."','".$email."','".$uploadedFile."')");
            
            $db->close();
        }

    }

    // $name = $_POST['name'];
    // $email = $_POST['email'];
    
    // //include database configuration file
    // include_once 'dbConfig.php';
    
    // //insert form data in the database
    // $insert = $db->query("INSERT form_data (name,email,file_name) VALUES ('".$name."','".$email."','".$uploadedFile."')");
    
    // $db->close();
}