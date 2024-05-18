<?php

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar Simposios
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>     
      <li class="active">Administrar Simposio</li>  
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarestudiante">        
          Agregar Simposio
        </button>
      </div>
      <div class="box-body">  

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">     
       <thead>         
         <tr>           
           <th style="width:10px">#</th>
           <th>Simposio a asistir</th>
           <th>Estudiante</th>
           <?php if($_SESSION["perfil"] == "Administrador"){?>
           <th>Pago del Evento</th>
           <?php }?>

           <th>Fecha/Hora Registrado</th>
           <th>Validar Pago</th>
           
           <?php if($_SESSION["perfil"] == "Administrador"){?>
           <th>Acciones</th>
           <?php }?>

         </tr> 
        </thead>
        
        <?php

$item = null;
$valor = null;

$usuarios = Controladorsimposios::ctrMostrarsimposios($item, $valor);

foreach ($usuarios as $key => $value){

    // Obtener el nombre del estudiante usando el id_estudiante
    $nombreEstudiante = Controladorsimposios::getNombreEstudiante($value["id_estudiante"]);
    // Obtener el nombre del evento usando el id_evento
    $nombreEvento = Controladorsimposios::getNombreEvento($value["id_evento"]);

    echo '<tr>
        <td>'.($key+1).'</td>
        <td>'.$nombreEvento.'</td>
        <td>'.$nombreEstudiante.'</td>';

    // Obtener el nombre del archivo del comprobante
    $nombreComprobante = $value["comprobante"];

    // Construir la ruta completa del archivo
    $rutaCompletaArchivo = "vistas/img/imgcomprobante/" . $nombreComprobante;

    // Verificar la existencia del archivo
    $archivoExiste = file_exists($rutaCompletaArchivo);
    
    if($_SESSION["perfil"] == "Administrador"){
    if ($archivoExiste) {
        echo '<td><img src="' . $rutaCompletaArchivo . '" class="img-thumbnail imagen-comprobante" width="40px"></td>';
    } else {
        echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail imagen-comprobante" width="40px"></td>';
    }
  }


    echo '<td>'.$value["fecha"].'</td>';

    if($value["estado_validacion"] != 0){
        echo '<td><button class="btn btn-success btn-xs btnActivar" idsimposio="'.$value["id"].'" estadosimposio="1">Aceptado</button></td>';
    } else {
        echo '<td><button class="btn btn-danger btn-xs btnActivar" idsimposio="'.$value["id"].'" estadosimposio="0">Enviado</button></td>';
    }

    if($_SESSION["perfil"] == "Administrador"){

    echo '<td>
        <div class="btn-group">
            <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id_evento"].'"><i class="fa fa-pencil"></i></button>';

        echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id_evento"].'"><i class="fa fa-times"></i></button>';
    }

    echo '</div>
    </td>
    </tr>';
}
?>

        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>

<!-- Modal -->
<div id="imagenModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Imagen Del Comprobante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="imagenGrande" src="" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto;">
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Obtener todas las imágenes con la clase "imagen-comprobante"
    var imagenes = document.querySelectorAll('.imagen-comprobante');

    // Iterar sobre cada imagen
    imagenes.forEach(function(imagen) {
        // Agregar un event listener para el clic en cada imagen
        imagen.addEventListener('click', function() {
            // Obtener la ruta de la imagen grande desde el atributo "src" de la imagen pequeña
            var rutaImagenGrande = this.src;
            // Establecer la ruta de la imagen grande en el src del elemento de imagen en el modal
            document.getElementById('imagenGrande').src = rutaImagenGrande;
            // Mostrar el modal
            $('#imagenModal').modal('show');
        });
    });
});
</script>


<!--=====================================
MODAL AGREGAR estudiante
======================================-->
<div id="modalAgregarestudiante" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Asistencia de Simposio</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

         <!-- SELECCIONAR EL EVENTO -->
          <div class="form-group">
            Seleccione al Evento que asistirá:
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <select class="form-control input-lg select2" id="Evento" name="Evento" required>
                <?php
                  require_once "conexion.php";
                  $stmt = Conexionsi::conectar()->prepare("SELECT id_evento, nombre_evento FROM eventos");
                  if ($stmt->execute()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $id_evento = htmlspecialchars($row['id_evento']);
                      $nombre_evento = htmlspecialchars($row['nombre_evento']);
                      echo "<option value='$id_evento'>$nombre_evento</option>";
                    }
                  } else {
                    $error = $stmt->errorInfo();
                    echo "Error: " . htmlspecialchars($error[2]);
                    exit();
                  }
                ?>
              </select>
            </div>
          </div>

    <!-- Incluir jQuery y Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <style>
              
              .select2-container--default .select2-selection--single {
                height: 45px; /* Altura del campo */
                padding: 10px; /* Espaciado interno */
              }

              .select2 {
                width: 100% !important; /* Ocupa el 100% del contenedor padre */
              }

              .select2-dropdown {
                width: auto !important; /* Ajusta el ancho del desplegable automáticamente */
              }
            </style>

            <script>
              $(document).ready(function() {
                $('.select2').select2({
                  dropdownAutoWidth: true,
                  width: '100%' // Ajusta el ancho del select2
                });
              });
            </script>
                      

        <!-- SELECCIONAR EL ESTUDIANTE -->
          <div class="form-group">
            Seleccione su nombre completo: 
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <select class="form-control input-lg select2" id="Estudiante" name="Estudiante" required>
                <?php
                  require_once "conexion.php";
                  $stmt = Conexionsi::conectar()->prepare("SELECT id, nombre, carnet FROM estudiantes");
                  $stmt->execute();  

                  if (!$stmt->execute()) {
                    $error = $stmt->errorInfo();
                    echo "Error: " . $error[2];  
                    exit();
                  }

                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_estudiante = $row['id'];
                    $nombre_estudiante = $row['nombre'];
                    $carnet = $row['carnet'];
                    echo "<option value='$id_estudiante'>$nombre_estudiante-$carnet</option>";
                  }
                ?>
              </select>
            </div>
          </div>

            <style>
              .select2-container--default .select2-selection--single {
                height: 45px; /* Altura del campo */
                padding: 10px; /* Espaciado interno */
              }

              .select2 {
                width: 100% !important; /* Ocupa el 100% del contenedor padre */
              }

              .select2-dropdown {
                width: auto !important; /* Ajusta el ancho del desplegable automáticamente */
              }
            </style>

            <script>
              $(document).ready(function() {
                $('.select2').select2({
                  dropdownAutoWidth: true,
                  width: '100%' // Ajusta el ancho del select2
                });
              });
            </script>

            <!-- SUBIR EL COMPROBANTE DE PAGO -->
            <div class="form-group">
              <div class="panel">SUBIR COMPROBANTE DE PAGO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <input type="hidden" name="nombreImagen" id="nombreImagen"> <!-- Campo oculto para el nombre de la imagen -->
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
          </div>

            <script>
              $(document).ready(function() {
                $('.nuevaFoto').change(function() {
                    var filename = $(this).val().split('\\').pop(); // Obtener solo el nombre del archivo
                    $('#nombreImagen').val(filename); // Asignar el nombre de la imagen al campo oculto
                });
            });
            </script>
                

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar estudiante</button>
        </div>
      </form>
      <?php
        $crearestudiante = new Controladorsimposios();
        $crearestudiante -> ctrCrearsimposio();
      ?>
    </div>
  </div>
</div>


