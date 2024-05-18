<?php
require_once "conexion.php";

try {
    // Preparar la consulta
    $stmt = Conexionsi::conectar()->prepare("SELECT id_evento, nombre_evento FROM eventos");
    $stmt->execute();

    // Obtener los resultados
    $eventos = []; // Creamos un arreglo vacío para almacenar los eventos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $eventos[] = [  // Creamos un objeto por cada evento y lo agregamos al arreglo
            "id_evento" => $row["id_evento"],
            "nombre_evento" => $row["nombre_evento"]
        ];
    }

    // Devolver los resultados en formato JSON
    echo json_encode($eventos);
} catch (PDOException $e) {
    // En caso de error, devolver un mensaje de error en formato JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>