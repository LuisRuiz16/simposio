<?php
// if($_SESSION["perfil"] == "Vendedor" ){
//   echo '<script>
//     window.location = "inicio";
//   </script>';
//   return;
// }

?>

<div class="content-wrapper">
  <section class="content-header"> 
    <h1>
      Administrar Eventos
    </h1>
    <ol class="breadcrumb"> 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Eventos</li>
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
          <th>Nombre del Evento</th>
          <th>Hora de Inicio</th>
          <th>Hora finalizacion</th>
          <th>Fecha del Evento</th>
          <th>Direccion del Evento</th>
          <th>Nombre del Expositor</th> 
          <th>Datos del Expositor</th> 
          <th>OP</th>
        </tr> 
        </thead>
        
        <?php

          $item = null;
          $valor = null;

          $clientes = Controladoreventos::ctrMostrareventos($item, $valor);

          foreach ($clientes as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>
                      <td>'.$value["nombre_evento"].'</td>
                      <td>'.$value["hora_inicio"].'</td>
                      <td>'.$value["hora_finalizacion"].'</td>
                      <td>'.$value["fecha_evento"].'</td>
                      <td>'.$value["direccion_evento"].'</td>
                      <td>'.$value["nombre_expositor"].'</td>             
                      <td>'.$value["datos_expositor"].'</td>


                    <td>
                      <div class="btn-group">                      
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id_evento"].'"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){
                        echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id_evento"].'"><i class="fa fa-times"></i></button>';
                      }
                      echo '</div>  
                    </td>

                  </tr>';
            }

        ?>
      </table>
      </div>
    </div>
  </section>
</div>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarEvento" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Evento</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DEL EVENTO--> 
            <div class="form-group">   
              <div class="input-group">      
                <span class="input-group-addon"><i class="fa fa-calendar"></i></i></span> 
                <input type="text" class="form-control input-lg" name="eventogeneral" placeholder="Ingresar nombre del evento" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i>HI</i></span>
                <input type="time" class="form-control input-lg" name="horadeinicio" placeholder="Ingresar hora de inicio" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA HORA FINAL-->           
            <div class="form-group">            
              <div class="input-group">            
                <span class="input-group-addon"><i>HF</i></span> 
                <input type="time" class="form-control input-lg" name="horafinal" placeholder="Ingresar hora de finalizacion" required>
              </div>
            </div>


            <!-- ENTRADA PARA LA FECHA -->    
            <div class="form-group">            
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="date" class="form-control input-lg" name="fechaevento" placeholder="Fecha del evento" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->           
            <div class="form-group">     
              <div class="input-group">     
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="direccionevento" placeholder="Ingresar dirección" required>
              </div>
            </div>

             <!-- ENTRADA PARA NOMBRE EXPOSITOR-->     
            <div class="form-group">          
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="textarea" class="form-control input-lg" name="nombreexpositor" placeholder="Nombre del Expositor" required>
              </div>
            </div>

            
             <!-- ENTRADA INFORMACION DEL EXPOSITOR-->     
             <div class="form-group">          
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="textarea" class="form-control input-lg" name="informacionexpositor" placeholder="Informacion del Expositor" required>
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Eveneto</button>
        </div>
      </form>
      <?php
        $crearEvento = new Controladoreventos();
        $crearEvento -> ctrCrearEvento();
      ?>
    </div>
  </div>
</div>


<!--=====================================
MODAL EDITAR CLIENTE
======================================-->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar cliente</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->    
            <div class="form-group">
              <div class="input-group">           
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarevento" id="editarevento" required>
                <input type="hidden" id="idCliente" name="idCliente">
              </div>
            </div>

                <!-- ENTRADA PARA EL NOMBRE DEL EVENTO--> 
            <div class="form-group">   
              <div class="input-group">      
                <span class="input-group-addon"><i class="fa fa-calendar"></i></i></span> 
                <input type="text" class="form-control input-lg" name="editareventogeneral" id="editareventogeneral" placeholder="Ingresar nombre del evento" required>
              </div>
            </div>

                <!-- ENTRADA PARA LA HORA INICIAL -->           
                <div class="form-group">            
              <div class="input-group">            
                <span class="input-group-addon"><i>HI</i></span> 
                <input type="time" class="form-control input-lg" name="edithoradeinicio" id="edithoradeinicio" placeholder="Ingresar hora de inicio" required>
              </div>
            </div>

             <!-- ENTRADA PARA LA HORA FINAL-->           
             <div class="form-group">            
              <div class="input-group">            
                <span class="input-group-addon"><i>HF</i></span> 
                <input type="time" class="form-control input-lg" name="edithorafianl" id="edithorafianl" placeholder="Ingresar hora de finalizacion" required>
              </div>
            </div>


             <!-- ENTRADA PARA LA FECHA -->    
             <div class="form-group">            
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="date" class="form-control input-lg" name="editfechaevento" id="editfechaevento" placeholder="Fecha del evento" required>
              </div>
            </div>

             <!-- ENTRADA PARA LA DIRECCIÓN -->           
             <div class="form-group">     
              <div class="input-group">     
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="editdireccionevento" id="editdireccionevento" placeholder="Ingresar dirección" required>
              </div>
            </div>



              <!-- ENTRADA PARA NOMBRE EXPOSITOR-->     
            <div class="form-group">          
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="textarea" class="form-control input-lg" name="editnombreexpositor" id="editnombreexpositor" placeholder="Nombre del Expositor" required>
              </div>
            </div>

            <!-- ENTRADA INFORMACION DEL EXPOSITOR-->     
            <div class="form-group">          
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="textarea" class="form-control input-lg" name="editinformacionexpositor" id="editinformacionexpositor" placeholder="Informacion del Expositor" required>
              </div>
            </div>


          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
      <?php
        $editarEveneto = new Controladoreventos();
        $editarEveneto -> ctrEditarevento();
      ?>
    </div>
  </div>
</div>

<?php
  $eliminarEveneto = new Controladoreventos();
  $eliminarEveneto -> ctrEliminareventos();
?>



