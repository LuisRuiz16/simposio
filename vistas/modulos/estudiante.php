<?php

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar estudiantes
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>     
      <li class="active">Administrar estudiantes</li>  
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarestudiante">        
          Agregar estudiante
        </button>
      </div>
      <div class="box-body">  

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>         
         <tr>           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Carnet</th>
           <th>Documento DPI</th>
           <th>Email</th>
           <th>Teléfono</th>
           <th>Edad</th>
           <th>Dirección</th>

           <?php if($_SESSION["perfil"] == "Administrador"){?>
           <th>Acciones</th>
           <?php }?>
         </tr> 
        </thead>
        <tbody>

        <?php
          $item = null;
          $valor = null;
          $estudiantes = Controladorestudiantes::ctrMostrarestudiantes($item, $valor);
          foreach ($estudiantes as $key => $value) {  
            echo '<tr>';
            echo '<td>'.($key+1).'</td>';
            echo '<td>'.$value["nombre"].'</td>';
            echo '<td>'.$value["carnet"].'</td>';
            echo '<td>'.$value["DPI"].'</td>';
            echo '<td>'.$value["email"].'</td>';
            echo '<td>'.$value["telefono"].'</td>';
            echo '<td>'.$value["edad"].'</td>';
            echo '<td>'.$value["direccion"].'</td>';
            if($_SESSION["perfil"] == "Administrador"){

            echo '<td>';

                     echo '<div class="btn-group">';                  
                        echo '<button class="btn btn-warning btnEditarestudiante" data-toggle="modal" data-target="#modalEditarestudiante" idestudiante="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                        echo '<button class="btn btn-danger btnEliminarestudiante" idestudiante="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                      }

                      echo '</div>';  

                    echo '</td>';
                  echo '</tr>';     
            }
        ?>
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR estudiante
======================================-->
<div id="modalAgregarestudiante" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar estudiante</h4>
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
                <input type="text" class="form-control input-lg" name="nuevoEstudiante" placeholder="Ingresar Nombre Completo" required>
              </div>
            </div>

             <!-- ENTRADA PARA EL DOCUMENTO ID -->           
             <div class="form-group">            
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="carnet" placeholder="Ingresar su Carnet" maxlength="15" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->           
            <div class="form-group">            
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoDPI" placeholder="Ingresar DPI" maxlength="13" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL EMAIL -->     
            <div class="form-group">        
              <div class="input-group">  
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Correo Electronico" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL TELÉFONO --> 
            <div class="form-group">     
              <div class="input-group">   
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 9999-9999'" data-mask required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->      
            <div class="form-group">         
              <div class="input-group">         
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaEdad" placeholder="Ingresar su Edad" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->   
            <div class="form-group">    
              <div class="input-group">  
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Musicipio" required>
              </div>
            </div>

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
        $crearestudiante = new Controladorestudiantes();
        $crearestudiante -> ctrCrearestudiante();
      ?>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR estudiante
======================================-->

<div id="modalEditarestudiante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar estudiante</h4>

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

                <input type="text" class="form-control input-lg" name="editarestudiante" id="editarestudiante" required>
                <input type="hidden" id="idestudiante" name="idestudiante">
              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion"  required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento"  data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

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

        $editarestudiante = new Controladorestudiantes();
        $editarestudiante -> ctrEditarestudiante();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarestudiante = new Controladorestudiantes();
  $eliminarestudiante -> ctrEliminarestudiante();

?>


