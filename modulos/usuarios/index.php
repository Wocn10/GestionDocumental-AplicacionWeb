<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");

/* Se trata de un operador ternario. Es una forma abreviada de escribir una sentencia if/else. Me permitira Elminar el registro dentro de la tabla*/
if(isset($_GET['txtId'])){
    $txtId=(isset($_GET['txtId']))?$_GET['txtId']:"";
    $sentencia=$conn->prepare("DELETE FROM tbl_usuario WHERE idusuario=:idusuario");
    $sentencia->bindParam(":idusuario",$txtId);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conn -> prepare("SELECT * FROM `tbl_usuario`");
$sentencia -> execute();
$lista_tbl_usuario = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php");?>
</br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Crear Usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
    <table class="table" id="table_id">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Identificacion</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nombre de Usuario</th>
                <th scope="col">Password</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista_tbl_usuario as $registro) { ?>
            <tr class="">
                <td scope="row"></td>
                <td><?php echo $registro ["idusuario"];?></td>
                <td><?php echo $registro ["nombres"];?></td>
                <td><?php echo $registro ["usuario"];?></td>
                <td><?php echo $registro ["password"];?></td>
                <td><?php echo $registro ["email"];?></td>
                <td>
                    <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $registro ["idusuario"];?>" role="button">Editar</a>
                    |
                    <a name="" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $registro ["idusuario"];?>" role="button">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
    </div>
</div>
<?php include("../../templates/footer.php");?>