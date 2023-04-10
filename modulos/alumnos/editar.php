<!-- Wilmer Castro 22/02/2023  -->
<?php
include ("../../bd.php");

if (isset($_GET['txtId'])) {
    $txtId = $_GET['txtId'];

    $sentencia = $conn->prepare("SELECT * FROM tbl_alumnos WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $id = $registro["id"];
    $nombres = $registro["nombres"];
    $aniolectivo = $registro["aniolectivo"];
    $curso = $registro["curso"];
    $fechanacimiento = $registro["fechanacimiento"];
    $email = $registro["email"];
    $documen = $registro["documen"];
    $foto = $registro["foto"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txtId = $_POST['txtId'];
    $nombres = $_POST["nombres"];
    $aniolectivo = $_POST["aniolectivo"];
    $curso = $_POST["curso"];
    $fechanacimiento = $_POST["fechanacimiento"];
    $email = $_POST["email"];

    if (isset($_FILES["documen"])) {
        $documen = file_get_contents($_FILES["documen"]["tmp_name"]);
    } else {
        $documen = '';
    }

    if (isset($_FILES["foto"])) {
        $foto = $_FILES["foto"]["name"];
        $ruta = $_FILES["foto"]["tmp_name"];
        $destino = "../../alumnos/foto/" . $foto;
        move_uploaded_file($ruta, $destino);
    } else {
        $foto = '';
    }

    $sentencia = $conn->prepare("UPDATE tbl_alumnos SET nombres = :nombres, aniolectivo = :aniolectivo, curso = :curso, fechanacimiento = :fechanacimiento, email = :email, documen = :documen, foto = :foto WHERE id = :id");

    $sentencia->bindParam(":nombres", $nombres);
    $sentencia->bindParam(":aniolectivo", $aniolectivo);
    $sentencia->bindParam(":curso", $curso);
    $sentencia->bindParam(":fechanacimiento", $fechanacimiento);
    $sentencia->bindParam(":email", $email);
    $sentencia->bindParam(":documen", $documen, PDO::PARAM_LOB);
    $sentencia->bindParam(":foto", $foto, PDO::PARAM_LOB);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    header("Location:index.php");
}
?>
<?php include("../../templates/header.php");?>
</br>
<div class="card">
    <div class="card-header">
        Editar datos del Alumno
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data"> <!---Permite subir archivo con esta accion enctype="multipart/form-data" --->
        <div class="mb-3">
                <label for="txtId" class="form-label">Cedula</label>
                <input type="text"
                value="<?php echo $txtId;?>"
                class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <br/>
                <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" value="<?php echo $nombres;?>"
                class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombres">
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" value="<?php echo $curso;?>"
                class="form-control" name="curso" id="curso" aria-describedby="helpId" placeholder="Curso">
            </div>
            <div class="mb-3">
                <label for="aniolectivo" class="form-label">Año Lectivo</label>
                <input type="text" value="<?php echo $aniolectivo;?>"
                class="form-control" name="aniolectivo" id="aniolectivo" aria-describedby="helpId" placeholder="Año Lectivo">
            </div>
            <div class="mb-3">
                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" value="<?php echo $fechanacimiento;?>" class="form-control" name="fechanacimiento" id="fechanacimiento" placeholder="Fecha de Nacimiento" aria-describedby="fileHelpId">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="<?php echo $email;?>" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com">
            </div>
            <div class="mb-3">
                <label for="documen" class="form-label">Documentos del Alumno</label>
                <br/>
                <input type="file"
                class="form-control" name="documen" id="documen" aria-describedby="helpId" placeholder="Documentos">
            </div>
            <button type="submit" class="btn btn-success">Actualizar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php");?>