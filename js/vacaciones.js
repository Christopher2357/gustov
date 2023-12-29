var tlb_vaciones;
function Listar_Personas_vacaiones() {
  tlb_vaciones = $("#tabla_vacacione_emp").DataTable({
    ordering: false,
    bLengthChange: false,
    scrollCollapse: true,
    searching: {
      regex: true,
    },
    lengthMenu: [
      [10, 20, 50, 100, -1],
      [10, 20, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../Controller/vacaciones/controllerVacacionsGetPersona.php",
      type: "POST",
    },
    columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
      },
      { data: "idpersona" },
      {
        data: null,
        render: function (data, type, row) {
          return row.Nombre + " " + row.Apellidos;
        },
      },
      { data: "Ci" },
      { data: "diasvacacionales" },
      {
        data: "estadovacaciones",
        render: function (data, type, row) {
          if (data == "Trabajo") {
            return (
              "<span class='badge badge-pill badge-primary'>" + data + "</span>"
            );
          } else {
            return (
              "<span class='badge badge-pill badge-warning'>" + data + "</span>"
            );
          }
        },
      },

      {
        defaultContent:
          "<button  class='accionar btn btn-primary btn-sm'><i class='fa fa-plus-circle' aria-hidden='true'></i></button>",
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("tabla_vacacione_emp_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  tlb_vaciones.column(1).visible(false);
}

function filterGlobal() {
  $("#tabla_vacacione_emp")
    .DataTable()
    .search($("#global_filter").val())
    .draw();
}

function Black_MenuAsis() {
  $("#diatotalesselectd").html("");
  $("#fechainicio").val("");
  $("#fechafinal").val("");
  $("#section_vacaciones").hide();
  $("#section_tabale").show();
}

$("#tabla_vacacione_emp").on("click", ".accionar", function () {
  var data = tlb_vaciones.row($(this).parents("tr")).data();

  if (tlb_vaciones.row(this).child.isShown()) {
    var data = tlb_vaciones.row(this).data();
  }
  var idpersona = data.idpersona;
  Show_Personal(idpersona);
});

function Show_Personal(idpersona) {
  $("#section_vacaciones").show();
  $("#section_tabale").hide();
  $.ajax({
    url: "../Controller/vacaciones/ControllerShowPersona.php",
    type: "POST",
    data: { idpersona: idpersona },
  }).done(function (resultado) {
    var data = JSON.parse(resultado);
    if (data != null) {
      $("#Idpersona").val(data[0]["idpersona"]);
      $("#NombrePersona").val(data[0]["Nombre"] + "," + data[0]["Apellidos"]);
      $("#txt_ciPersonas").val(data[0]["Ci"]);
      $("#diasrestantes").val(data[0]["diasvacacionales"]);
      $("#dialadisponiblelabel").html(data[0]["diasvacacionales"]);
    } else {
      return Swal.fire("Mensaje de error", errorThrown, "error");
    }
  });
}

function fechaCambiada() {
  const fechaInicio = document.getElementById("fechainicio").value;
  const fechaFinal = document.getElementById("fechafinal").value;

  const fechaInicioObjeto = new Date(fechaInicio);
  const fechaFinalObjeto = new Date(fechaFinal);

  let diferencia = 0;
  while (fechaInicioObjeto <= fechaFinalObjeto) {
    if (
      fechaInicioObjeto.getDay() !== 0 && // Domingo
      !esFeriado(fechaInicioObjeto)
    ) {
      diferencia++;
    }

    fechaInicioObjeto.setDate(fechaInicioObjeto.getDate() + 1);
  }

  console.log("Días hábiles entre las fechas:", diferencia);
  $("#diatotalesselectd").html(diferencia);
  $("#totaldias").val(diferencia);
}
// Función para verificar si una fecha es un feriado
function esFeriado(fecha) {
  var fechasFeriados = obtenerFechasFeriados();
  // Compara la fecha con las fechas feriadas
  for (let i = 0; i < fechasFeriados.length; i++) {
    if (
      fecha.getFullYear() === fechasFeriados[i].getFullYear() &&
      fecha.getMonth() === fechasFeriados[i].getMonth() &&
      fecha.getDate() === fechasFeriados[i].getDate()
    ) {
      return true;
    }
  }
  return false;
}


function obtenerFechasFeriados() {
  const fechasFeriados = [
    new Date("2024-01-01"), // Año Nuevo
    new Date("2024-01-22"), // Día del Estado Plurinacional
    new Date("2024-02-12"), // Carnaval
    new Date("2024-02-13"), // Carnaval
    new Date("2024-03-29"), // Viernes Santo
    new Date("2024-05-01"), // Día del Trabajo
    new Date("2024-05-30"), // Corpus Christi
    new Date("2024-06-21"), // Año Nuevo Aymara
    new Date("2024-08-06"), // Día de la Independencia
    new Date("2024-11-02"), // Día de Todos los Difuntos
    new Date("2024-12-25"), // Navidad
  ];

  return fechasFeriados;
}


function Registrarvacaciones() {
  var idempleado = $("#Idpersona").val();
  var diasdisponibles = $("#diasrestantes").val();
  var diasselecionados = $("#totaldias").val();
  var fechainicio = $("#fechainicio").val();
  var fechafinal = $("#fechafinal").val();
  var descrition = $("#descritionTextarea").val();

  if (
    !idempleado ||
    !diasdisponibles ||
    !diasselecionados ||
    !fechainicio ||
    !fechafinal ||
    !descrition
  ) {
    return Swal.fire(
      "Mensaje de advertencia",
      "Llene los campos vacíos.",
      "warning"
    );
  }

  if (parseInt(diasdisponibles) < parseInt(diasselecionados)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "Los días seleccionados no deben exceder los días disponibles.",
      "warning"
    );
  }

  // Verificar si las fechas están presentes

  // Convertir las fechas en objetos Date
  var inicio = new Date(fechainicio);
  var final = new Date(fechafinal);

  // Verificar si las fechas son válidas
  if (isNaN(inicio) || isNaN(final)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "Fechas inválidas. Verifique el formato.",
      "warning"
    );
  } else if (inicio > final) {
    return Swal.fire(
      "Mensaje de advertencia",
      "La fecha de inicio debe ser menor a la fecha final.",
      "warning"
    );
  } else {
  }

  if (parseInt(diasdisponibles) === 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El colaborador no tiene días pendientes de vacaciones.",
      "warning"
    );
  }

  var diadisponibleactual = diasdisponibles - diasselecionados;

  if (diadisponibleactual < 0) {
    return;
  }

  $.ajax({
    url: "../Controller/vacaciones/ControllerRegisterVacations.php",
    type: "POST",
    data: {
      idempleado: idempleado,
      diadisponibleactual: diadisponibleactual,
      fechainicio: fechainicio,
      fechafinal: fechafinal,
      descrition: descrition,
      diasselecionados: diasselecionados,
    },
  })
    .done(function (resultado) {
      var request = JSON.parse(resultado);
      if (request.data == 1) {
        limpiarFrom();
        tlb_vaciones.ajax.reload();
        Swal.fire({
          icon: "success",
          title: "Éxito !!",
          text: "" + request.msg,
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        return Swal.fire(
          "Mensaje de error",
          "No se pudo completar el registro." + request.msg,
          "error"
        );
      }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        return Swal.fire("Mensaje de error");
      } else {
        return Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
}

function Cancelar_Vacaciones() {
  limpiarFrom();
}

function limpiarFrom() {
  $("#Idpersona").val("");
  $("#diasrestantes").val("");
  $("#totaldias").val("");
  $("#fechainicio").val("");
  $("#fechafinal").val("");
  $("#descritionTextarea").val("");
  $("#diatotalesselectd").html("");
  $("#section_vacaciones").hide();
  $("#section_tabale").show();
}

function backgroundRunn_ChangeStateVacaciones() {
  $.ajax({
    url: "../Controller/vacaciones/ControllerbackgroundRunn.php",
    type: "POST",
  }).done(function (resultado) {
    if (resultado) {

    } else {
  
    }
  });
}

//SECCION DE REPORTES

var tablevacationreport;
function Listar_Empleados_vacaiones() {
  var fechainicio = $("#FechaInicio").val();
  var fechafin = $("#FechaFin").val();

  console.log(fechainicio);
  console.log(fechafin);

  tablevacationreport = $("#table_reporte_vacation").DataTable({
    ordering: false,
    bLengthChange: false,
    scrollCollapse: true,
    searching: {
      regex: true,
    },
    responsive: true,
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "pdfHtml5",
        text: '<i class="fa fa-file-text" aria-hidden="true"></i>',
        title: "REPORTE DE VACACIONES",
        titleAttr: "Exportar a PDF"
      },
    ],
    lengthMenu: [
      [10, 20, 50, 100, -1],
      [10, 20, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../Controller/vacaciones/ControllerGetReportVacacion.php",
      type: "POST",
      data: { fechainicio: fechainicio, fechafin: fechafin },
    },
    columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
      },
      { data: "FechaInicio" },
      {
        data: null,
        render: function (data, type, row) {
          return row.Nombre + " " + row.Apellidos;
        },
      },
      { data: "Ci" },
      
      { data: "fechinicio" },
      { data: "fechafinal" },
      { data: "diasvacaciones" },
      { data: "diasvacacionales" },
    ],
    language: idioma_espanol,
    select: true,
  });

  document.getElementById("table_reporte_vacation_filter").style.display =
    "none";
  $("input.global_filter").on("keyup click", function () {
    filterreportvacations();
  });

  tablevacationreport.column(1).visible(false);
  $("#btn-place").html(tablevacationreport.buttons().container());
}

function filterreportvacations() {
  $("#table_reporte_vacation")
    .DataTable()
    .search($("#global_filter").val())
    .draw();
}
