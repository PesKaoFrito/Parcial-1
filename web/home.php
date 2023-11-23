<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist - Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Bienvenido a tu Checklist personal!</h1>
    <br>

    <form action="nuevo.php" method="post">
        <div class="center-div">
            <input type="submit" value="Registrar Nueva Actividad" name="registrar">
        </div>
    </form>

    <form action="reporte.php" method="post">
        <div class="center-div">
            <input type="submit" value="Generar reporte" name="reporte">
        </div>
    </form>

    <br>
    <?php
    
    $response=json_decode(file_get_contents ('http://localhost/Proyecto2/api/actividad/leer_dia.php'));
    $actividades = $response->records;
    $nfilas = count($actividades);

    if ($nfilas > 0) {
        $i = 0;
        for ($x = 0; $x < $nfilas; $x++) {
            print("<div class='row'>");
            for ($y = 0; $y < 4; $y++) {
                if ($i >= $nfilas)
                    continue;
                print("<div class='column'>");
                print("<div class='card'>");
                print("<form action='item.php' method='post'>");
                print("<h3>" . $actividades[$i]->titulo . "</h3>");
                print("<p>" . $actividades[$i]->fecha . "</p>");
                print("<input type='text' name='id' value='".$actividades[$i]->id."'hidden />");
                print("<input type='submit' value='Ver detalles' name='detalles'/>");
                print("</div>");
                print("</form>");
                print("</div>");
                $i++;
            }
            print("</div>");
        }
    } else {
        print("No hay actividades disponibles");
    }

    ?>


</body>

</html>