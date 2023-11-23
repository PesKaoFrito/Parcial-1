<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Actividad</title>
    <link rel="stylesheet" href="css/formstyles.css">
</head>

<body>
    <?php
    if (array_key_exists('editar', $_POST)) {
        $response = json_decode(file_get_contents('http://localhost/Proyecto2/api/actividad/leer_uno.php?id='.$_POST["id"]));
        $actividad = $response->records;

                $nfilas = count($actividad);

                foreach($actividad as $items){

        print("<div id='feedback-form'>");
            print("<h2 class='header'>Actualizar actividad:</h2>");
            print("<form action='handler.php' method='post'>");
            print("<input type='text' name='id' id='id' value='".$items->id."'>");

            print("<label for=''>Titulo:</label>");
            print("<input type='text' name='titulo' id='' value='".$items->titulo."' required><br>");

            print("<label for=''>Fecha:</label>");
            print("<input type='date' name='fecha' id='' value='".$items->fecha."' required><br>");

            print("<label for=''>Hora:</label>");
            print("<input type='time' name='hora' id='' value='".$items->hora."' required><br>");

            print("<label for=''>Ubicación</label>");
            print("<input type='text' name='ubicacion' id='' value='".$items->ubicacion."' required><br>");

            print("<label for=''>Correo:</label>");
            print("<input type='email' name='correo' id='' value='".$items->correo."' required><br>");

            print("<label for='feedback-notify'>Repetir todo el día?</label>");
            print("<input type='checkbox' name='repetir' id='feedback-notify' checked><br>");
            print("<br>");
            print("<label for=''>Repetir desde:</label>");
            print("<input type='time' name='repetir_inicio' id='inicio' value='".$items->repetir_inicio."' required><br>");

            print("<label for=''>Repetir hasta:</label>");
            print("<input type='time' name='repetir_final' id='final' value='".$items->repetir_final."' required><br>");

            print("<label for=''>Tipo de actividad:</label>");
            print("<select name='tipo' id=''>");
            print("<option value='Familiar'>Familiar</option>");
            print("<option value='Academia'>Academia</option>");
            print("<option value='Recreacion'>Recreacion</option>");
            print("<option value='Laboral'>Laboral</option>");
            print("</select><br>");
            print("<input type='submit' value='Guardar Cambios' name='editar' />");
            print("</form>");
            print("</div>");
    }
    } else {
    ?>
        <div id="feedback-form">
            <h2 class="header">Registrar nueva actividad:</h2>
            <form action="handler.php" method="post">
                <input type="text" name="id" id="id">

                <label for="">Titulo:</label>
                <input type="text" name="titulo" id="" required><br>

                <label for="">Fecha:</label>
                <input type="date" name="fecha" id="" required><br>

                <label for="">Hora:</label>
                <input type="time" name="hora" id="" required><br>

                <label for="">Ubicación</label>
                <input type="text" name="ubicacion" id="" required><br>

                <label for="">Correo:</label>
                <input type="email" name="correo" id="" required><br>

                <label for="feedback-notify">Repetir todo el día?</label>
                <input type="checkbox" name="repetir" id="feedback-notify"><br>
                <br>
                <label for="">Repetir desde:</label>
                <input type="time" name="repetir_inicio" id="inicio" value="00:00:00" required><br>

                <label for="">Repetir hasta:</label>
                <input type="time" name="repetir_final" id="final" value="23:59:59" required><br>

                <label for="">Tipo de actividad:</label>
                <select name="tipo" id="">
                    <option value="Familiar">Familiar</option>
                    <option value="Academia">Academia</option>
                    <option value="Recreacion">Recreacion</option>
                    <option value="Laboral">Laboral</option>
                </select><br>
                <input type="submit" value="Registrar" name="registrar" />
            </form>
        </div>

    <?php
    }
    ?>
</body>
</html>