<?php
// if($_SESSION["perfil"] == "Vendedor" ){
//   echo '<script>
//     window.location = "inicio";
//   </script>';
//   return;
// }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Estudiantes para Simposio</title>
    <!-- Incluyendo CSS de Bootstrap y Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS personalizado -->
    <style>
        .content-wrapper {
            padding: 20px;
        }
        .content-header h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .breadcrumb {
            background: none;
            padding: 8px 15px;
            margin-bottom: 20px;
            list-style: none;
            border-radius: 4px;
        }
        .breadcrumb>li+li:before {
            content: ">";
        }
        .box {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .box-header {
            border-bottom: 1px solid #f4f4f4;
            margin-bottom: 20px;
        }
        .box-header .btn {
            margin-top: -10px;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            background-color: transparent;
        }
        .table-bordered {
            border: 1px solid #f4f4f4;
        }
        .table thead tr {
            background-color: #f9f9f9;
        }
        .table thead th {
            border-bottom: 2px solid #f4f4f4;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="content-wrapper">
  <section class="content-header"> 
    <h1>
      Estudiantes
    </h1>
    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Listado de Estudiantes para Simposio</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEvento">
          Agregar Evento
        </button>
      </div>

      <div class="box-body">       
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">       
        <thead>  
        <tr>          
          <th style="width:10px">#</th>
          <th>Estudiantes</th>
          <th>DPI</th>
          <th>Correo Electronico</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Fecha de nacimiento</th> 
          <th>Departamento (ubicacion)</th> 
        </tr> 
        </thead>
        
        <?php
        // Aquí iría la lógica PHP para rellenar la tabla con datos
        ?>


      </table>
      </div>
    </div>
  </section>
</div>

<!-- Incluyendo scripts de Bootstrap y jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>

