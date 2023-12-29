<script type="text/javascript" src="../js/vacaciones.js?rev=<?php echo time(); ?>"></script>


<div class="row" id="section_tabale">
  <div class="col-md-12">
    <div class="tile" style="border-radius: 5px;padding: 10px;">
      <div class="tile-body">
        <ul class="nav nav-pills flex-column mail-nav">
          <li class="nav-item active">
            <i class="fa fa-home fa-lg"></i> / Lista del pesonal para vacaciones.

          </li>
        </ul>
      </div>

    </div>
  </div>

  <div class="col-md-12">
    <div class="tile" style="border-top: 3px solid #0720b7;border-radius: 5px;">

      <div class="row invoice-info">
        <div class="col-sm-6">
          <h5 class=""><strong>Personal - vacacionales
              <?php echo date("Y"); ?>
            </strong></h5>
        </div>
        <div class="col-sm-2">

        </div>
        <div class="col-sm-4">
          <div class="input-group">
            <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px;">
            <span class="input-group-addon"></span>
          </div>
        </div>
      </div>
      <table id="tabla_vacacione_emp" class="display responsive nowrap table table-sm" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Id</th>
            <th>Nombre y Apellido</th>
            <th>CI</th>
            <th>Días Disponibles</th>
            <th>Estado</th>
            <th>Acci&oacute;n</th>

          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

          </tr>
        </tfoot>

      </table>
    </div>
  </div>
</div>


<div class="row" id="section_vacaciones" style="display: none;">
  <div class="col-md-12">
    <div class="tile" style="border-radius: 5px;padding: 10px;">
      <div class="tile-body">
        <ul class="nav nav-pills flex-column mail-nav">
          <li class="nav-item active">
            <i class="fa fa-home fa-lg"></i> / Solicitud de vacaciones.
            <a class="btn btn-secondary btn-sm float-right" type="button" onclick="Black_MenuAsis()"><em class="fa fa-arrow-left"></em>Atras</a>

          </li>
        </ul>
      </div>

    </div>
  </div>

  <div class="col-md-12">
    <div class="tile" style="border-top: 3px solid #ed1f69;border-radius: 5px;">


      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="inputDefault"><strong>Nombre y Apellido</strong></label>
            <input class="form-control" id="Idpersona" type="text" hidden>
            <input class="form-control" id="NombrePersona" type="text" placeholder="Nombre" autocomplete="false" disabled>
          </div>
          <div class="form-group">
            <label for="inputDefault"><strong>Ci</strong></label>
            <input class="form-control" id="txt_ciPersonas" type="text" disabled>
          </div>
          <div class="form-group">
            <div class="inline-labels">
              <label for="inputDefault"><strong>Dias Disponibles: </strong></label>
              <label for="inputDefault" id="dialadisponiblelabel"><strong>(0)</strong></label>
              <input type="text" name="" id="diasrestantes" hidden>
              <input type="text" name="" id="totaldias" hidden>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <label for="inputDefault"><strong>Fecha Inicio</strong></label>
            <input class="form-control" id="fechainicio" type="date" autocomplete="false" onchange="fechaCambiada()">
          </div>

          <div class="form-group">
            <label for="inputDefault"><strong>Descripcion</strong></label>
            <div class="inline-container">
              <textarea class="form-control" id="descritionTextarea" rows="3" style="height: 60px;"></textarea>

            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <div class="inline-labels">
              <label for="inputDefault"><strong>Fecha Final | Días:</strong></label>
              <label for="inputDefault" id="diatotalesselectd"><strong>(0)</strong></label>
            </div>
            <input class="form-control" id="fechafinal" type="Date" autocomplete="false" onchange="fechaCambiada()">
          </div>

        </div>
      </div>

      <div class="tile-footer" style="text-align: right;">
        <button class="btn btn-primary btn-sm" type="button" onclick="Registrarvacaciones();"><em class="fa fa-fw fa-lg fa-check-circle"></em>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary btn-sm" onclick="Cancelar_Vacaciones();"><em class="fa fa-fw fa-lg fa-times-circle"></em>Cancel</a>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    backgroundRunn_ChangeStateVacaciones();
    Listar_Personas_vacaiones();

  });
</script>