<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");

if(isset($_GET['txtId'])){
    $txtId=(isset($_GET['txtId']))?$_GET['txtId']:"";

    $sentencia=$conn->prepare("SELECT * FROM tbl_usuario WHERE idusuario=:idusuario");
    $sentencia->bindParam(":idusuario",$txtId);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    //$idusuario=$registro["idusuario"];
    $nombres=$registro["nombres"];
    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $email=$registro["email"];
}
if($_POST){
    //print_r($_POST);
    //recolecta datos
    $txtId = (isset($_POST["txtId"])?$_POST["txtId"]:"");
    $nombres = (isset($_POST["nombres"])?$_POST["nombres"]:"");
    $usuario = (isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password = (isset($_POST["password"])?$_POST["password"]:"");
    $email = (isset($_POST["email"])?$_POST["email"]:"");
    //inserta los datos
    $sentencia = $conn->prepare("UPDATE tbl_usuario SET idusuario=:idusuario, nombres=:nombres, usuario:=usuario, password=:password, email=:email WHERE idusuario=:idusuario");
    //Asignar valores desde POST (Formulario)
    $sentencia -> bindParam(":idusuario",$txtId);
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
        Editar Datos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multip/form-data">
            <div class="mb-3">
                <label for="txtId" class="form-label">Identificacion</label>
                <input type="text"
                value="<?php echo $txtId;?>"
                class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="Cedula">
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres y Apellidos</label>
                <input type="text"
                value="<?php echo $nombres;?>"
                class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombres">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text"
                value="<?php echo $usuario;?>"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                value="<?php echo $password;?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" value="<?php echo $email;?>">
            </div>
            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php");?>