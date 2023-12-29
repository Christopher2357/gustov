<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
  <meta name="description"
    content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">

  <!-- LINK DE LA PLANTILLA -->
  <!-- https://themewagon.com/themes/free-modular-bootstrap-4-admin-dashboard-template-vali/ -->
  
  <title>Gustov | Page</title>
  <link rel="shortcut icon" href="../images/gustov.jpg">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/responsive.css">
  <link rel="stylesheet" href="../Public/DataTables/datatables.min.css">
  <!-- Font-icon css-->

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css">
</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="#">G U S T O V</a>
    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <?php include 'menu/app-nav/app-nav.php' ?>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">

    <?php include 'menu/sidebar/sidebar_App.php' ?>
  </aside>
  <main class="app-content">
    <style>
      .swal2-popup {
        font-size: 0.7rem !important;
      }
    </style>

    <div id="Contenido_principal"></div>


    <?php include 'menu/fotter/app-fotter.php' ?>
  </main>

  <!-- Content End -->
  <!-- Essential javascripts for application to work-->
  <script src="../Public/jquery-3.3.1.min.js"></script>
  <script src="../Public/popper.min.js"></script>
  <script src="../Public/bootstrap.min.js"></script>
  <script src="../Public/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="../Public/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="../Public/DataTables/datatables.min.js"></script>
  <script src="../Public/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="../Public/plugins/sweetalert2/sweetalert2.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      cargar_contenido('Contenido_principal', 'personal/view_listar_personal.php');
    });

    function cargar_contenido(contenedor, contenido) {
      $("#" + contenedor).load(contenido);

      detectarTamañoPantalla();

    }

    // Función para detectar el tamaño de la pantalla
    function detectarTamañoPantalla() {
      var anchoPantalla = window.innerWidth;
      var bodyElement = document.querySelector('body');

      // Agregar la clase "sidenav-toggled" en dispositivos móviles
      if (anchoPantalla <= 767) {
        bodyElement.classList.remove('sidenav-toggled');

      } else {
        //bodyElement.classList.add('sidenav-toggled');
      }
    }
    //agregar la clase "active" al elemento <a> sin interferir con la funcionalidad existente
    function toggleActiveClass(elemento) {
      // Obtener todos los elementos relevantes
      var elementos = document.querySelectorAll('.app-menu__item');

      // Eliminar la clase "active" de todos los elementos
      for (var i = 0; i < elementos.length; i++) {
        elementos[i].classList.remove('active');
      }

      // Agregar la clase "active" al elemento actual
      elemento.classList.add('active');
    }

    var idioma_espanol = {
      select: {
        rows: "%d fila seleccionada"
      },
      "sProcessing": "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Procesando....",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
      "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
      "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "<b>No se encontraron datos</b>",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }

  </script>

</body>

</html>