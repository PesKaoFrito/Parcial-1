<?php
//encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// incluir archivos de conexion y objetos
include_once '../configuracion/conexion.php';
include_once '../objetos/actividad.php';
// inicializar base de datos y objeto actividad
$conex = new Conexion();
$db = $conex->obtenerConexion();
// inicializar objeto
$actividad = new Actividad($db);
//llamado a los procedimientos
$stmt = $actividad->read();
$num = $stmt->rowCount();
// verificar si hay mas de 0 registros encontrados
if ($num > 0) {
    // arreglo de actividades
    $actividades_arr = array();
    $actividades_arr["records"] = array();
    // obtiene todo el contenido del query
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
    http_response_code(200);
    // mostrar actividades en formato json
    echo json_encode($actividades_arr);
} else {
    // asignar codigo de respuesta - 404 No encontrado
    http_response_code(404);
    // informarle al usuario que no se encontraron actividades
    echo json_encode(
        array("message" => "No se encontraron actividades.")
    );
}
?>