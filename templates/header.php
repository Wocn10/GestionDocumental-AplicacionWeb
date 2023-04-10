<!-- Wilmer Castro 22/02/2023 
Creacion del header -->
<?php
$url_base="http://localhost/GestionDocumental-AplicacionWeb/";  //url base para que al momento de seleccionar regrese a la seccion
?>
<!doctype html>
<html lang="es">

<head>
    <title>GestoDon</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
p {
    text-align: justify;
    text-justify: inter-word;
    }
</style>

<body>
<header>
    <!-- place navbar here -->
</header>
<nav class="navbar navbar-expand navbar-light bg-primary">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="<?php echo $url_base?>" aria-current="page">Sistema <span class="visually hidden"></span></a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>modulos/alumnos/">Alumnos</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>modulos/cursos/">Cursos</a>
        <a class="nav-item nav-link" href="<?php echo $url_base;?>modulos/usuarios/">Usuarios</a>
        <!-- <a class="nav-item nav-link" href="modulos/registro/">Registros</a> -->
        <a class="nav-item nav-link" href="#">Cerrar Sesion</a>
    </div>
</nav>
<main class="container">

<!-- Faltan Agregar algunas cosas como Carta no esta funcionando en el modulo alumnos y no se a terminado cerrar.php ademas que hay unos errores que corregir-->
