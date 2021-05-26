<?php

$id = $_GET['id'];
require_once __DIR__ . '/connect.php';
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "DELETE FROM news WHERE ID = $id";
if (mysqli_query($conn, $sql))
    echo 'Успешно';
mysqli_close($conn);
echo "<br><a href='/'> Вернуться обратно </a>"
?>