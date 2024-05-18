<?php

$directorio = "vistas/documentos/usuarios/";
$aleatorio = mt_rand(100, 999);
$nombreImagen = isset($_POST['nombreImagen']) ? $_POST['nombreImagen'] : '';
$extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);
$ruta = $directorio . $aleatorio . "." . $extension;

$nombre = $_FILES['nuevaFoto']['name'];
$guardado = $_FILES['nuevaFoto']['tmp_name'];

if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

if (file_exists($directorio)) {
    if (move_uploaded_file($guardado, $ruta)) {
        echo "Archivo guardado con exito en " . $ruta;
    } else {
        echo "Archivo no se pudo guardar";
    }
} else {
    echo "Directorio no existe y no se pudo crear.";
}

?>
