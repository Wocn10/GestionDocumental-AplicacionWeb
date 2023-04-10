<!-- Wilmer Castro 22/02/2023  -->
<?php
include("../../bd.php");

/* Se trata de un operador ternario. Es una forma abreviada de escribir una sentencia if/else. Me permitira Elminar el registro dentro de la tabla*/
if(isset($_GET['txtId'])){
    $txtId=(isset($_GET['txtId']))?$_GET['txtId']:"";
    $sentencia=$conn->prepare("DELETE FROM tbl_curso WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conn -> prepare("SELECT * FROM `tbl_curso`");
$sentencia -> execute();
$lista_tbl_curso = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_tbl_curso) para saber que esta consultando los registros
?>
<?php include("../../templates/header.php");?>
</br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Informacion</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
    <table class="table" id="table_id">
        <thead>
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Tarea</th>
                <th scope="col">Documentos</th>
                <th scope="col">Fecha de Entrega</th>
                <th scope="col">Fecha y Hora</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista_tbl_curso as $registro) { ?>
            <tr class="">
                <td><?php echo $registro ["id"];?></td>
                <td><?php echo $registro ["tarea"];?></td>
                <!-- Estracto que me permite leer los archivos que se guardan en la base de datos tipo longblob. -->
                <td><?php if(!empty($registro['documento'])) { 
                    $extension = pathinfo($registro['documento'], PATHINFO_EXTENSION); // obtener la extensión del archivo
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
                            $icon = 'pdf.png'; // imagen genérica para otros tipos de archivo
                            break;
                    }?><a href="data:application/pdf;base64,<?php echo base64_encode($registro['documento']);?> " download><img src="./icons/<?php echo $icon; ?>" alt="<?php echo $extension; ?>" width="30"></a>
                    <?php } else { ?> 
                        -
                    <?php } ?>
                </td>
                <td><?php echo $registro ["horario"];?></td>
                <td><?php echo $registro ["fecha"];?></td>
                <td>
                    <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $registro ["id"];?>" role="button">Editar</a>
                    |
                    <a name="" id="" class="btn btn-danger" href="index.php?txtId(<?php echo $registro ["id"];?>" role="button">Eliminar</a>
                </td>
                    </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
    </div>
</div>
<?php include("../../templates/footer.php");?>