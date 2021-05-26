<?php
require __DIR__ . "/functions.php";
$id = $_GET['id'];
updateVisible($id);
echo "<p><a href='/'>Вернуться</a></p>"


?>