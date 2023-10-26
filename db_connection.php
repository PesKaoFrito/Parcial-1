<?php
$servername = "localhost";
$username = "root"; // usuario predeterminado de XAMPP
$password = ""; // sin contraseña por defecto en XAMPP
$dbname = "task_manager"; // nombre de tu base de datos

// Creando conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $query = "INSERT INTO tasks (user_id, task_name, description, date, priority, status) VALUES ('$user_id', '$task_name', '$description', '$date', '$priority', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "Task Added Successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request Method";
}

?>
