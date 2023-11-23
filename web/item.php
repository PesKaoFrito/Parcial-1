<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <link rel="stylesheet" href="css/tablestyles.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="wrapper">

        <div class="table">
            <?php
            if (array_key_exists('id', $_POST)) {
                $response = json_decode(file_get_contents('http://localhost/Proyecto2/api/actividad/leer_uno.php?id='.$_POST["id"]));
                $actividad = $response->records;

                $nfilas = count($actividad);

                foreach($actividad as $items){
                    print("<div class='row header'>");
                    print("<div class='cell'>");
                    print($items->titulo);
                    print("</div>");
                    print("</div>");
                    print("<div class='row'>");
                    print("<div class='cell'>");
                    print($items->fecha);
                    print("</div>");
                    print("</div>");
                    print("<div class='row'>");
                    print("<div class='cell'>");
                    print($items->hora);
                    print("</div>");
                    print("</div>");
                    print("<div class='row'>");
                    print("<div class='cell'>");
                    print($items->ubicacion);
                    print("</div>");
                    print("</div>");
                    print("<div class='row'>");
                    print("<div class='cell'>");
                    print("Desde ".$items->repetir_inicio);
                    print("</div>");
                    print("</div>");
                    print("<div class='row'>");
                    print("<div class='cell'>");
                    print("Hasta: ".$items->repetir_final);
                    print("</div>");
                    print("</div>");
                    print("<div class='row'>");
                    print("<div class='cell'>");
                    print($items->tipo);
                    print("</div>");
                    print("</div>");
                    print("<br>");
                    print("<form action='nuevo.php' method='post'>");
                    print("<input type='text' value='".$items->id."' name='id' hidden />");
                    print("<input type='submit' value='Editar' name='editar' />");
                    print("</form>");
                    print("<form action='handler.php' method='post'>");
                    print("<input type='text' value='".$items->id."' name='id' hidden />");
                    print("<input type='submit' value='Eliminar' name='eliminar' />");
                    print("</form>");
                }
            } else {
            ?>
                <div class="row header">
                    <div class="cell">
                        Detalles de la actividad
                    </div>
                </div>

                <div class="row">
                    <div class="cell" data-title="Name">
                        Id de actividad no especificado
                    </div>
                </div>
            <?php
            }
            ?>




        </div>

    </div>
</body>

</html>