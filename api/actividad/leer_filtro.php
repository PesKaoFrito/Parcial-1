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
$actividad->filtro = isset($_GET['filtro']) ? $_GET['filtro'] : die();
$actividad->valor = isset($_GET['valor']) ? $_GET['valor'] : die();
// query productos
$stmt = $actividad->obtener_actividad_filtro();
$num = $stmt->rowCount();
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

?>