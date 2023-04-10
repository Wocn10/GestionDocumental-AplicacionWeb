<!-- Wilmer Castro 22/02/2023 -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app";
try {
    $conn = new PDO("mysql:host=$servername;dbname=app", $username, $password);
  // si hay algun error en la conexion
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected Realizada";
} catch(PDOException $e) { echo "Connection Fallida: " . $e->getMessage();
}
?>