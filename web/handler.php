<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrando</title>
</head>

<body>
    <?php

    if (array_key_exists('registrar', $_POST)) {
        $repetir = 0;
        if (array_key_exists('repetir', $_POST)) {
            $repetir = 1;
        }
        $data = array(
            'titulo'      => $_POST['titulo'],
            'fecha'    => $_POST['fecha'],
            'ubicacion'       => $_POST['ubicacion'],
            'correo' => $_POST['correo'],
            'repetir'      => $repetir,
            'repetir_inicio' => $_POST['repetir_inicio'],
            'repetir_final' => $_POST['repetir_final'],
            'tipo' => $_POST['tipo'],
            'hora' => $_POST['hora']
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Proyecto2/api/actividad/registrar.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if( $response){
            echo "Registrada correctamente!";
         }
     } 
    else if (array_key_exists('editar', $_POST)) {
        $repetir = 0;
        if (array_key_exists('repetir', $_POST)) {
            $repetir = 1;
        }
        $data = array(
            'id' => $_POST["id"],
            'titulo'      => $_POST['titulo'],
            'fecha'    => $_POST['fecha'],
            'ubicacion'       => $_POST['ubicacion'],
            'correo' => $_POST['correo'],
            'repetir'      => $repetir,
            'repetir_inicio' => $_POST['repetir_inicio'],
            'repetir_final' => $_POST['repetir_final'],
            'tipo' => $_POST['tipo'],
            'hora' => $_POST['hora']
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Proyecto2/api/actividad/actualizar.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if( $response){
           echo "Actualizado correctamente!";
        }
    } else if (array_key_exists('eliminar', $_POST)) {

        $response = json_decode(file_get_contents('http://localhost/Proyecto2/api/actividad/eliminar.php?id='.$_POST["id"]));

        print("Eliminado!");
    }
    ?>
</body>

</html>