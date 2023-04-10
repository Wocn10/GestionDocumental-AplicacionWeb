<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");

if(isset($_GET['txtId'])){
    $txtId=(isset($_GET['txtId']))?$_GET['txtId']:"";

    //Buscar Archivo relacionado
    //eliminar archivo en la ruta 
    $sentencia = $conn -> prepare("SELECT foto, documen FROM `tbl_alumnos` Where id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia ->execute();
    $registro_recuperacion = $sentencia -> fetch(PDO::FETCH_LAZY);
    //print_r($registro_recuperacion);
    if(isset($registro_recuperacion["foto"]) && $registro_recuperacion["foto"]!=""){
        if(file_exists("./foto".$registro_recuperacion["foto"])){
            unlink("./foto".$registro_recuperacion["foto"]);
        }
    }
    if(isset($registro_recuperacion["documen"]) && $registro_recuperacion["documen"]!=""){
        if(file_exists("./documen".$registro_recuperacion["documen"])){
            unlink("./documen/".$registro_recuperacion["documen"]);
        }
    }
    $sentencia=$conn->prepare("DELETE FROM tbl_alumnos WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    header("Location:index.php");
}
$sentencia = $conn -> prepare("SELECT * FROM `tbl_alumnos`");
$sentencia -> execute();
$lista_tbl_alumnos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php");?>
</br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a> <!--Para agregar nuevos Alumnos -->
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Identificacion</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Año Lectivo</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Email</th>
                        <th scope="col">Documentos del Alumno</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_tbl_alumnos as $registro) { ?>
                    <tr class="">
                        <td <?php if (!empty($registro['foto'])): ?>
                            <a href="data:application;base64,<?php echo base64_encode($registro['foto']);?>" download>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($registro['foto']); ?>" alt="" width="55"
                        </a>
                        <?php endif; ?>
                        </td>
                        <td><?php echo $registro ["id"];?></td>
                        <td><?php echo $registro ["nombres"];?></td>
                        <td><?php echo $registro ["curso"];?></td>
                        <td><?php echo $registro ["aniolectivo"];?></td>
                        <td><?php echo $registro ["fechanacimiento"];?></td>
                        <td><?php echo $registro ["email"];?></td>
                        <td><?php if(!empty($registro['documen'])) { 
                    $extension = pathinfo($registro['documen'], PATHINFO_EXTENSION); // obtener la extensión del archivo
                    switch(strtolower($extension)) { // convertir a minúsculas para comparar
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                        case 'gif':
                            $icon = 'image.png'; // imagen para archivos de imagen
                            break;
                        case 'pdf':
                            $icon = 'pdf.png'; // imagen para archivos PDF
                            break;
                        case 'doc':
                        case 'docx':
                            $icon = 'word.png'; // imagen para archivos de Word
                            break;
                        case 'xls':
                        case 'xlsx':
                            $icon = 'excel.png'; // imagen para archivos de Excel
                            break;
                        case 'txt':
                            $icon = 'text.png'; // imagen para archivos de texto
                            break;
                            default:
                            $icon = 'file.png'; // imagen genérica para otros tipos de archivo
                            break;
                    }?><a href="data:application/pdf;base64,<?php echo base64_encode($registro['documen']);?> " download><img src="./icons/<?php echo $icon; ?>" alt="<?php echo $extension; ?>" width="30"></a>
                    <?php } else { ?> 
                        -
                    <?php } ?>
                        </td>
                        <td>
                        <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $registro ["id"];?>" role="button">Editar</a>
                    |
                    <a name="" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $registro ["id"];?>" role="button">Eliminar</a>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<?php include("../../templates/footer.php");?>