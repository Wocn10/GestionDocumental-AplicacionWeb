<!-- Wilmer Castro 22/02/2023  -->
<?php include("../../templates/header.php");?>
<?php
include("../../bd.php");
function generar_numero() {
    global $conn; // obtener la conexión a la base de datos

    $sentencia = $conn->query("SELECT IFNULL(MAX(id), 0) as max_id FROM tbl_curso");
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
    $siguiente_numero = $resultado['max_id'] + 1;

    return $siguiente_numero;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarea = $_POST['tarea'];
    
    //Verifica si se subió un archivo
    if(isset($_FILES['documento'])) {
        $documento = $_FILES['documento'];
        
        //Las extensiones que se permiten
        $allowed_types = array('pdf');
        $doc_extension = pathinfo($documento['name'], PATHINFO_EXTENSION);
        if (!in_array($doc_extension, $allowed_types)) {
            echo "<script>alert('El archivo de documento debe estar en formato PDF');</script>";
            exit;
        }

        //Tamaño máximo del archivo (5MB)
        $max_size = 5 * 1024 * 1024;
        if ($documento['size'] > $max_size) {
            echo "<script>alert('El tamaño máximo del archivo permitido es de 5MB.');</script>";
            exit;
        }

        // Subir el archivo al servidor
        $doc_temp = $_FILES['documento']['tmp_name'];
        $doc_destino = "documento/" . $documento['name'];
        move_uploaded_file($doc_temp, $doc_destino);

        $documento = file_get_contents($doc_destino);
    } else {
        $documento = null;
    }

    $horario = $_POST['horario'];
    $fecha = date('Y-m-d H:i:s');

    // obtener el siguiente número secuencial
    $autonum = generar_numero();

    //inserta los datos
    $sentencia = $conn->prepare("INSERT INTO tbl_curso (id, tarea, documento, horario, fecha) VALUES (:id, :tarea, :documento, :horario, :fecha)");

// insertar el nuevo registro en la base de datos
    $sentencia->bindParam(":id", $autonum);
    $sentencia->bindParam(":tarea", $tarea);
    $sentencia->bindParam(":documento", $documento, PDO::PARAM_LOB);
    $sentencia->bindParam(":horario", $horario);
    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->execute();
    header("Location: index.php");
}
?>
<?php
date_default_timezone_set('America/Bogota');
$fecha_actual=date("Y-m-d H:i:s");
?>
</br>
<div class="card">
    <div class="card-header">
        Registrar Informacion
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id" class="form-label">Numero</label>
                <input readonly type="text"
                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Numero">
            </div>
            <div class="mb-3">
                <label for="tarea" class="form-label">Tarea</label>
                <input type="text"
                class="form-control" name="tarea" id="tarea" aria-describedby="helpId" placeholder="Tarea">
            </div>
            <div class="mb-3">
                <label for="documento" class="form-label">Documento</label>
                <input type="file"
                class="form-control" name="documento" id="documento" aria-describedby="helpId" placeholder="Documento">
            </div>
            <div class="mb-3">
                <label for="horario" class="form-label">Horario</label>
                <input type="date"
                class="form-control" name="horario" id="horario" aria-describedby="helpId" placeholder="Horario">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="datetime" class="form-control" readonly name="fecha" id="fecha" aira-describedby="helpId" value="<?=$fecha_actual?>">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php");?>