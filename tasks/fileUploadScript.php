<?php
    $currentDirectory = getcwd();
    $uploadDirectory = "../uploads/";

    $fileExtensionsAllowed = ['jpeg','jpg','png','gif','pdf']; 
    $fileName   = time(); 
    $fileExtension  = pathinfo( $_FILES["the_file"]["name"], PATHINFO_EXTENSION );
    $fileName   = $fileName . "." . $fileExtension;

    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 40000000) {
        $errors[] = "File exceeds maximum size (40MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
            include_once("../classes/Db.php");
            $id = $_GET["id"];

            $conn = Db::getInstance();
            $sql = "UPDATE tasks SET uploads = '$fileName' WHERE id = $id";
            $result = $conn->query($sql);   
            header("location: index.php?id=$id");
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
?>
