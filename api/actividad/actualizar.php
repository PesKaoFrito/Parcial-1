
    <?php
    // encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");

    include_once '../configuracion/conexion.php';
    include_once '../objetos/actividad.php';
    $conex = new Conexion();
    $db = $conex->obtenerConexion();
    $actividad = new Actividad($db);
    // obtener los datos
    $data = json_decode(file_get_contents("php://input"));
    // asegurar que los datos no esten vacios
    if(
    !empty($data->id) &&
    !empty($data->titulo) &&
    !empty($data->fecha) &&
    !empty($data->hora) &&
    !empty($data->ubicacion) &&
    !empty($data->correo) &&
    !empty($data->repetir_inicio) &&
    !empty($data->repetir_final) &&
    !empty($data->tipo) 
    ){
        $actividad->id = $data->id;
        $actividad->titulo = $data->titulo;
        $actividad->fecha = $data->fecha;
        $actividad->hora = $data->hora;
        $actividad->ubicacion = $data->ubicacion;
        $actividad->correo = $data->correo;
        $actividad->repetir = $data->repetir;
        $actividad->repetir_inicio = $data->repetir_inicio;
        $actividad->repetir_final = $data->repetir_final;
        $actividad->tipo = $data->tipo;

        if($actividad->actualizar()){
            // asignar codigo de respuesta - 201 creado
            http_response_code(201);
            // informar al usuario
            echo json_encode(array("message" => "La actividad ha sido actualizada."));
           
        }
            // si no puede crear el producto, informar al usuario
        else{
            // asignar codigo de respuesta - 503 servicio no disponible
            http_response_code(503);
            // informar al usuario
            echo json_encode(array("message" => "No se puede actualizar la actividad."));
        }
    }
    // informar al usuario que los datos estan incompletos
    else{
        // asignar codigo de respuesta - 400 solicitud incorrecta
        http_response_code(400);
        // informar al usuario
        echo json_encode(array("message" => "No se puede actualizar la actividad. Los datos
    están incompletos."));
    }
    
  
?>
