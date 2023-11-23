<?php
//encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
// incluir archivos de conexion y objetos
include_once '../configuracion/conexion.php';
include_once '../objetos/actividad.php';
// inicializar base de datos y objeto actividad
$conex = new Conexion();
$db = $conex->obtenerConexion();
// inicializar objeto
$actividad = new Actividad($db);
$actividad->id = isset($_GET['id']) ? $_GET['id'] : die();
// query productos
$stmt = $actividad->obtener_actividad();
$num = $stmt->rowCount();
// verificar si hay mas de 0 registros encontrados
if ($num > 0) {
    // arreglo de actividades
    $actividades_arr = array();
    $actividades_arr["records"] = array();
    // obtiene todo el contenido de la tabla
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extraer fila
        // esto creara de $row['nombre'] a
        // solamente $nombre
        extract($row);
        $actividad_item = array(
            "id" => $id,
            "titulo" => $titulo,
            "fecha" => $fecha,
            "ubicacion" => $ubicacion,
            "correo" => $correo,
            "repetir" => $repetir,
            "repetir_inicio" => $repetir_inicio,
            "repetir_final" => $repetir_final,
            "tipo" => $tipo,
            "hora" => $hora
        );
        array_push($actividades_arr["records"], $actividad_item);
    }
    // asignar codigo de respuesta - 200 OK
    http_response_code(200);
    // mostrar productos en formato json
    echo json_encode($actividades_arr);
} else {
    // asignar codigo de respuesta - 404 No encontrado
    http_response_code(404);
    // informarle al usuario que no se encontraron productos
    echo json_encode(
        array("message" => "No se encontró la actividad.")
    );
}
?>