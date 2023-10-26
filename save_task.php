<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include('db_connection.php');

echo "Archivo PHP ejecutado."; // Verificar si el archivo PHP se está ejecutando

var_dump($_POST); // Verificar los datos recibidos


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    if ($stmt = $conn->prepare('INSERT INTO tasks (user_id, task_name, description, date, priority, status) VALUES (?, ?, ?, ?, ?, ?)')) {
        // Vinculamos los parámetros con los valores reales
        $stmt->bind_param('isssss', $user_id, $task_name, $description, $date, $priority, $status);

        // Ejecutamos la consulta
        if ($stmt->execute()) {
            echo "Task Added Successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerramos la declaración
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Cerramos la conexión
    $conn->close();
} else {
    echo "Invalid Request";
}
?>
