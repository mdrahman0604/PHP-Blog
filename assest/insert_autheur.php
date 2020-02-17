<?php require "db.php"; ?>
<?php

if ($conn) {
    if (isset($_POST["submit"])) {

        // Upload Image
        uploadImage("authImage", "../img/avatar/");

        // PREPARE DATA TO INSERT INTO DB 
        $data = array(
            "autheur_fullname" => $_POST["authName"],
            "autheur_desc" => $_POST["authDesc"],
            "autheur_email" =>  $_POST["authEmail"],
            "autheur_twitter" =>  $_POST["authTwitter"],
            "autheur_github" => $_POST["authGithub"],
            "autheur_link" => $_POST["authLinkedin"],
            "autheur_avatar" =>$_FILES["authImage"]["name"]
        );

        $tableName = 'autheur';

        // Call insert function 
        insertToDB($conn, $tableName, $data);

        // Go to show.php 
        header("refresh:1; url=../autheur.php");
    }

}else {
    echo 'Error: ' . $e->getMessage();
}

function implodeArray($array){
    return implode(", ", $array);
}

function insertToDB($conn, $table, $data){

    // Get keys string from data array 
    $columns = implodeArray(array_keys($data));

    // Get values string from data array with prefix (:) added  
    $prefixed_array = preg_filter('/^/', ':', array_keys($data));
    $values = implodeArray($prefixed_array);

    try {
        // prepare sql and bind parameters
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $conn->prepare($sql);

        // insert row
        $stmt->execute($data);

        echo "New records created successfully";

    } catch (PDOException $error) {
        echo $error;
    }
}

function uploadImage($name, $dest){
    // Upload Image
    $fileName = $_FILES[$name]['name'];
    $fileTmpName = $_FILES[$name]['tmp_name'];
    $fileError = $_FILES[$name]['error'];

    if($fileError === 0){
        $fileDestination = $dest.$fileName;
        move_uploaded_file($fileTmpName, $fileDestination);
        echo "Image Upload Successful";
    }else {
        echo "Image Upload Error";
    }
}

?>