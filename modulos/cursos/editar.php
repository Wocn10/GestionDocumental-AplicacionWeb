<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");

if(isset($_GET['txtId'])){
    $txtId=(isset($_GET['txtId']))?$_GET['txtId']:"";

    $sentencia=$conn->prepare("SELECT * FROM tbl_curso WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $tarea=$registro["tarea"];
    $documento=$registro["documento"];
    $horario=$registro["horario"];
    $fecha=$registro["fecha"];
}
if($_POST){
    // print_r($_POST);
    //recolecta datos
    $txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
    $tarea = (isset($_POST["tarea"])?$_POST["tarea"]:"");
    $documento = (isset($_FILES["documento"])?$_FILES["documento"]:"");
    $horario = (isset($_POST["horario"])?$_POST["horario"]:"");
    $fecha = (isset($_POST["fecha"])?$_POST["fecha"]:"");
    //inserta los datos
    $sentencia = $conn->prepare("UPDATE tbl_curso SET tarea=:tarea, documento=:documento, horario=:horario, fecha=:fecha WHERE id=:id");

    $allowed_types = array('pdf');
        $doc_extension = pathinfo($documento['name'], PATHINFO_EXTENSION);
        if (!in_array($doc_extension, $allowed_types)) {
            echo "<script>alert('El archivo de documento debe estar en formato PDF');</script>";
            exit;
        }
        
    //Asignar valores desde POST (Formulario)
    $sentencia -> bindParam(":tarea",$tarea);
    $sentencia -> bindParam(":documento", $documento, PDO::PARAM_LOB);
    $sentencia -> bindParam(":horario",$horario);
    $sentencia -> bindParam(":fecha",$fecha);
    $sentencia -> bindParam(":id",$txtId);
    //sentencia para ejecutar
    $sentencia -> execute();
    header("Location:index.php");
}
?>
<?php include("../../templates/header.php"); ?>
<?php
date_default_timezone_set('America/Bogota');
$fecha_actual=date("Y-m-d H:i:s");
?>
</br>
<div class="card">
    <div class="card-header">
        Editar Informacion
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtId" class="form-label">Numero</label>
                <input type="text"
                value="<?php echo $txtId;?>"
                class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="">
            </div>
            <div class="mb-3">
                <label for="tarea" class="form-label">Tarea</label>
                <input type="text"
                value="<?php echo $tarea;?>"
                class="form-control" name="tarea" id="tarea" aria-describedby="helpId" placeholder="Tarea">
            </div>
            <div class="mb-3">
                <label for="documento" class="form-label">Documento</label>
                <br/>
                <a href="data:application/pdf;base64,<?php echo base64_encode($registro['documento']);?> " download><img src="./icons/<?php echo $icon; ?>" alt="" width="30"></a>
                <input type="file"
                class="form-control" name="documento" id="documento" aria-describedby="helpId" placeholder="Documento">
            </div>
            <div class="mb-3">
                <label for="horario" class="form-label">Horario</label>
                <input type="date"
                value="<?php echo $horario;?>"
                class="form-control" name="horario" id="horario" aria-describedby="helpId" placeholder="Horario">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="datetime" value="<?php echo $fecha;?>" class="form-control" readonly name="fecha" id="fecha" aira-describedby="helpId" value="<?=$fecha_actual?>">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php"); ?>