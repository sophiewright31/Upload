<?php
if($_SERVER["REQUEST_METHOD"] === "POST" ){
    $uploadDir = 'upload/';

    $extension = pathinfo($_FILES['Homer']['name'], PATHINFO_EXTENSION);
    $tmpdirectory = $_FILES ['Homer']['tmp_name'];
    $extensions_ok = ['jpg', 'png', 'webp'];
    $maxFileSize = 1000000;

    if( (!in_array($extension, $extensions_ok ))){
    $errors[] = 'Veuillez sélectionner une image de type Jpg ou Png ou Webp !';
    }
    if( file_exists($_FILES['Homer']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if(empty($errors)) {
        $filename = uniqid('',true) . '.' . $extension;
        $filedestination = $uploadDir . $filename;

        if(move_uploaded_file($tmpdirectory ,$filedestination)) {
            $uploaded = $filedestination;
            $success=true;
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Upload an image of Homer</label>
    <input type="file" name="Homer" id="imageUpload" />
    <button name="send">Send</button>
</form>
