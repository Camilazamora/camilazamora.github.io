<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["video"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Verifica si el archivo es realmente una imagen
    $check = getimagesize($_FILES["video"]["tmp_name"]);
    if($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verifica si el archivo ya existe
    if (file_exists($target_file)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Verifica el tamaño del archivo
    if ($_FILES["video"]["size"] > 500000) {
        echo "Lo siento, el archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permite ciertos formatos de archivo
    if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "wmv" ) {
        echo "Lo siento, solo se permiten archivos MP4, AVI, MOV y WMV.";
        $uploadOk = 0;
    }

    // Verifica si hubo algún error
    if ($uploadOk == 0) {
        echo "Lo siento, tu video no fue subido.";
    // Si todo está bien, sube el archivo
    } else {
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
            echo "El archivo ". htmlspecialchars( basename( $_FILES["video"]["name"])). " ha sido subido.";
            $url = "uploads/" . basename($_FILES["video"]["name"]);
            echo "<br>URL del video: " . $url;
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }
}
?>
