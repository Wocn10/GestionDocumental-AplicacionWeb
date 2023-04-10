<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");
if($_POST){
    //print_r($_POST);
    //recolecta datos
    $idusuario = (isset($_POST["idusuario"])?$_POST["idusuario"]:"");
    $nombres = (isset($_POST["nombres"])?$_POST["nombres"]:"");
    $usuario = (isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password = (isset($_POST["password"])?$_POST["password"]:"");
    $email = (isset($_POST["email"])?$_POST["email"]:"");
    //inserta los datos
    $sentencia = $conn->prepare("INSERT INTO tbl_usuario (idusuario, nombres, usuario, password, email)VALUES(:idusuario, :nombres, :usuario, :password, :email)");
    //Asignar valores desde POST (Formulario)
    $sentencia -> bindParam(":idusuario",$idusuario);
    $sentencia -> bindParam(":nombres",$nombres);
    $sentencia -> bindParam(":usuario",$usuario);
    $sentencia -> bindParam(":password",$password);
    $sentencia -> bindParam(":email",$email);
    //sentencia para ejecutar
    $sentencia -> execute();
    header("Location:index.php");
}
?>
<?php include("../../templates/header.php");?>
</br>
<div class="card">
    <div class="card-header">
        Datos del Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data"> <!---Permite subir archivo con esta accion enctype="multipart/form-data" --->
            <div class="mb-3">
                <label for="idusuario" class="form-label">Identificacion</label>
                <input type="text"
                class="form-control" name="idusuario" id="idusuario" aria-describedby="helpId" placeholder="Cedula">
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres y Apellidos</label>
                <input type="text"
                class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombres">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com">
            </div>
            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php");?>