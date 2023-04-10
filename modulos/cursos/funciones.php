<?php
// Conectar a la base de datos
$conn = mysqli_connect("localhost", "root", "", "app");

// Seleccionar la base de datos
mysqli_select_db($conn, "app");

// Llamar a la función y recuperar el valor generado
$resultado = mysqli_query($conn, "SELECT autonum() as nuevo_numero");
$datos = mysqli_fetch_assoc($resultado);
$nuevo_numero = $datos['nuevo_numero'];

// Usar el valor generado en tu código
echo "Nuevo número: " . $nuevo_numero;

?>
