<?php
if ($_FILES['nuevaFoto']['error'] === UPLOAD_ERR_OK) { // Verificar que no haya errores en la carga
    $nombreTemporal = $_FILES['nuevaFoto']['tmp_name']; // Obtener el nombre temporal del archivo
    $nombreArchivo = $_FILES['nuevaFoto']['name']; // Obtener el nombre original del archivo
    $destino = $_SERVER['DOCUMENT_ROOT'] . '/vistas/img/imgcomprobante/' . $nombreArchivo;

    if (move_uploaded_file($nombreTemporal, $destino)) { // Mover el archivo al destino
        echo "¡La imagen se ha subido correctamente!";
    } else {
        echo "Hubo un error al subir la imagen.";
    }
} else {
    echo "Error al cargar la imagen.";
}
?>