<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");

if ($_POST) {
    //print_r($_POST);
    //print_r($_FILES);

    $id = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
    $nombres = isset($_POST["nombres"]) ? $_POST["nombres"] : "";
    $aniolectivo = isset($_POST["aniolectivo"]) ? $_POST["aniolectivo"] : "";
    $curso = isset($_POST["curso"]) ? $_POST["curso"] : "";
    $fechanacimiento = isset($_POST["fechanacimiento"]) ? $_POST["fechanacimiento"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $documen = isset($_FILES["documen"]["name"]) ? $_FILES["documen"]["name"] : "";
    $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";

    //Archivo es una imagen o un documento
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt');
    $doc_extension = pathinfo($documen, PATHINFO_EXTENSION);
    if (!in_array($doc_extension, $allowed_types)) {
        die("El archivo de documento debe estar en formato PDF, DOC, DOCX, TXT, XLS o XLSX.");
    }

    $foto_extension = pathinfo($foto, PATHINFO_EXTENSION);
    if (!in_array($foto_extension, $allowed_types)) {
            echo "<script>alert('El archivo de documento debe estar en formato PDF, DOC, DOCX, TXT, XLS o XLSX.');</script>";
            exit;
        }

    //Tamaño máximo del archivo (5MB)
    $max_size = 5 * 1024 * 1024;
    if ($_FILES['documen']['size'] > $max_size || $_FILES['foto']['size'] > $max_size) {
            echo "<script>alert('El tamaño máximo del archivo permitido es de 5MB.');</script>";
            exit;
        }

    // Subir el archivo al servidor
    $doc_temp = $_FILES['documen']['tmp_name'];
    $doc_destino = "documen/" . $documen;
    move_uploaded_file($doc_temp, $doc_destino);

    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = "foto/" . $foto;
    move_uploaded_file($foto_temp, $foto_destino);

    // Inserta los datos
    $sentencia = $conn->prepare("INSERT INTO tbl_alumnos (id, nombres, aniolectivo, curso, fechanacimiento, email, documen, foto) VALUES (:id, :nombres, :aniolectivo, :curso, :fechanacimiento, :email, :documen, :foto)");

    $documen = file_get_contents($doc_destino);
    $foto = file_get_contents($foto_destino);

    // Asignar valores desde POST (Formulario)
    $sentencia->bindParam(":id", $id);
    $sentencia->bindParam(":nombres", $nombres);
    $sentencia->bindParam(":aniolectivo", $aniolectivo);
    $sentencia->bindParam(":curso", $curso);
    $sentencia->bindParam(":fechanacimiento", $fechanacimiento);
    $sentencia->bindParam(":email", $email);
    $sentencia->bindParam(":documen", $documen);
    $sentencia->bindParam(":foto", $foto);
    $sentencia->execute();
    header("Location:index.php");
}
?>

<?php include("../../templates/header.php");?>
</br>
<div class="card">
    <div class="card-header">
        Datos del Alumno
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data"> <!---Permite subir archivo con esta accion enctype="multip/form-data" --->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>
            <div class="mb-3">
                <label for="cedula" class="form-label">Cedula</label>
                <input type="text"
                class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="Cedula">
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text"
                class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombres">
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text"
                class="form-control" name="curso" id="curso" aria-describedby="helpId" placeholder="Curso">
            </div>
            <div class="mb-3">
                <label for="aniolectivo" class="form-label">Año Lectivo</label>
                <input type="text"
                class="form-control" name="aniolectivo" id="aniolectivo" aria-describedby="helpId" placeholder="Año Lectivo">
            </div>
            <div class="mb-3">
                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento" placeholder="Fecha de Nacimiento" aria-describedby="fileHelpId">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com">
            </div>
            <div class="mb-3">
                <label for="documen" class="form-label">Documentos del Alumno</label>
                <input type="file"
                class="form-control" name="documen" id="documen" aria-describedby="helpId" placeholder="Documentos">
            </div>
            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php");?>