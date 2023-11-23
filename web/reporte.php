<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="css/tablestyles.css">
</head>
<body>
<h1>Reporte de actividades</h1>
    <form name="FormFiltro" action="reporte.php" method="post">
        <br/>
        Filtrar por: <select name="campos">
            <option value="tipo" selected>Tipo
            <option value="dia">Día
            <option value="año">Año
        </select>
        con el valor
        <input type="text" name="valor">
        <input type="submit" value="Filtrar Datos" name="ConsultarFiltro"/>
        <input type="submit" value="Ver todos" name="ConsultarTodos">
        <button><a href='home.php'>Regresar al inicio</a></button>
    </form>
    <?php
        $response = json_decode(file_get_contents('http://localhost/Proyecto2/api/actividad/leer.php'));
        $actividad_new = $response->records;

        if(array_key_exists('ConsultarTodos', $_POST)){
            $response = json_decode(file_get_contents('http://localhost/Proyecto2/api/actividad/leer.php'));
            $actividad_new = $response->records;
        }

        if(array_key_exists('ConsultarFiltro', $_POST)){
            $response = json_decode(file_get_contents('http://localhost/Proyecto2/api/actividad/leer_filtro.php?filtro='.$_REQUEST["campos"].'&&valor='.$_REQUEST["valor"]));
            $actividad_new = $response->records;
        }

        $nfilas = count($actividad_new);

        if($nfilas > 0){
            print ("<TABLE>\n");
            print ("<TR class='row header'>\n");
            print ("<TH class='cell'>Titulo</TH>\n");
            print ("<TH class='cell'>Fecha</TH>\n");
            print ("<TH class='cell'>Hora</TH>\n");
            print ("<TH class='cell'>Ubicación</TH>\n");
            print ("<TH class='cell'>Tipo</TH>\n");
            print ("</TR>\n");

            foreach($actividad_new as $resultado){
                print ("<TR class='row'>\n");
                print ("<TD class='cell'>". $resultado->titulo ."</TD>\n");
                print ("<TD class='cell'>". $resultado->fecha ."</TD>\n");
                print ("<TD class='cell'>". $resultado->hora ."</TD>\n");
                print ("<TD class='cell'>". $resultado->ubicacion ."</TD>\n");
                print ("<TD class='cell'>". $resultado->tipo ."</TD>\n");
                print ("</TR>\n");
            }
            print ("</TR>\n");
        }
        else{
            print("No hay actividades disponibles para su seleccion");
        }
    ?>
</body>
</html>