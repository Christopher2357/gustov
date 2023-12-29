var tablepersona;

function Listar_Personas() {
  tablepersona = $("#tabla_personas").DataTable({
    ordering: true,
    bLengthChange: false,
    scrollCollapse: true,
    searching: {
      regex: true,
    },
    responsive: true,
 
    lengthMenu: [
      [10, 20, 50, 100, -1],
      [10, 20, 50, 100, "All"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../Controller/Persona/ControllerGetPersonas.php",
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
      { data: "FechaInicio" },
      { data: "diasvacacionales" },
      { data: "Telefono" },
      {
        data: "Estado ",
        render: function (data, type, row) {
          return (
            "<span class='badge badge-pill " +
            (row.Estado == "Activo" ? "badge-primary" : "badge-warning") +
            "'>" +
            row.Estado +
            "</span>"
          );
        },
      },
      {data: "Correo"},
      {
        data: "estadoinicio",
        render: function (data, type, row) {
          if (data == "On") {
            return (
              "<button type='button' class='editar btn btn-primary btn-sm'><i class='fa fa-edit' title='editar'></i></button>"
            );
          } else {
            return "<button type='button' class='editar btn btn-primary btn-sm'><i class='fa fa-edit' title='editar'></i></button>";
          }
        },
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  document.getElementById("tabla_personas_filter").style.display = "none";
  $("input.global_filter").on("keyup click", function () {
    filterGlobal();
  });
  $("input.column_filter").on("keyup click", function () {
    filterColumn($(this).parents("tr").attr("data-column"));
  });
  tablepersona.column(1).visible(false);
  $("#btn-place").html(tablepersona.buttons().container());
}

function filterGlobal() {
  $("#tabla_personas").DataTable().search($("#global_filter").val()).draw();
}

$("#tabla_personas").on("click", ".editar", function () {
  var data = tablepersona.row($(this).parents("tr")).data();

  if (tablepersona.row(this).child.isShown()) {
    var data = tablepersona.row(this).data();
  }
  $("#Contenido_principal").load(
    "personal/view_crear_editar_persona.php?idpersona=" +
      data.idpersona +
      "&estado=" +
      true
  );
});


function Show_Personas(idpersona) {
  $.ajax({
    url: "../Controller/Persona/ControllerShowPersona.php",
    type: "POST",
    data: { idpersona: idpersona },
  })
    .done(function (resp) {
      IterarDataPersona(resp);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        return Swal.fire(
          "Mensaje de error"
        );
      } else {
        return Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
}

function IterarDataPersona(result) {
  var request = JSON.parse(result);

  var request = request.data;

  $("#Idpersona").val(request[0]["idpersona"]);
  $("#NombrePersona").val(request[0]["Nombre"]);
  $("#ApellidoPersona").val(request[0]["Apellidos"]);
  $("#correoPersona").val(request[0]["Correo"]);
  $("#CiPersona").val(request[0]["Ci"]);
  $("#telefonoPersona").val(request[0]["Telefono"]);
  $("#direccionPersona").val(request[0]["Direccion"]);
  $("#SexoPersona").val(request[0]["Sexo"]);

}

function Registrar_personas(editando) {
  console.log(editando);
  editando = editando ?? false;

  console.log(editando);
  if (validation()) {
    var idPersona = $("#Idpersona").val();
    // var nombres = $("#NombrePersona").val().toUpperCase();
    // var apellidos = $("#ApellidoPersona").val().toUpperCase();
    var nombres = $("#NombrePersona").val();
    var apellidos = $("#ApellidoPersona").val();
    var correo = $("#correoPersona").val();
    var ci = $("#CiPersona").val();
    var telefono = $("#telefonoPersona").val();
    var direccion = $("#direccionPersona").val();
    var sexo = $("#SexoPersona").val();
    var formData = new FormData();

    //los demas atributos
    formData.append("idPersona", idPersona);
    formData.append("nombres", nombres);
    formData.append("apellidos", apellidos);
    formData.append("correo", correo);
    formData.append("ci", ci);
    formData.append("telefono", telefono);
    formData.append("direccion", direccion);
    formData.append("sexo", sexo);

    $.ajax({
      url:
        editando === ""
          ? "../Controller/Persona/ControllerRegisterPersona.php"
          : "../Controller/Persona/ControllerActualizarPersona.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var request = JSON.parse(respuesta);

        if (request.data == 1) {
          Swal.fire({
            icon: "success",
            title: "Éxito !!",
            text: "Se registro con éxito.",
            showConfirmButton: false,
            timer: 1500,
          });
          $("#Contenido_principal").load("personal/view_listar_personal.php");
        } else {
          return Swal.fire(
            "Mensaje de error",
            "No se pudo " + request.msg,
            "error"
          );
        }
      },
    }).fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        return Swal.fire(
          "Mensaje de error"
        );
      } else {
        return Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
  } else {
    return Swal.fire(
      "Mensaje de advertencia",
      "Llene los campos vácios, son obligatorios (*)",
      "warning"
    );
  }
}

function validation() {
  $("#from input").each(function (index, element) {
    var input = element;
    var id = input.getAttribute("id");

    if ($("#" + id).val() == "") {
      if (
        input.id != "Idpersona"
      ) {
        input.classList.add("form-control", "is-invalid"); 
      }
    }
  });

  $("#from select").each(function (index, element) {
    var select = element;
    var id = select.getAttribute("id");

    if ($("#" + id).val() == "") {
      select.classList.add("form-control", "is-invalid"); 
    }
  });

  var chkAsientos = document.getElementsByClassName("is-invalid");

  var asientos = [];
  for (i = 0; i < chkAsientos.length; i++) {
    asientos.push(chkAsientos[i]);
  }

  if (asientos.length == 0) {
    return true;
  } else {
    return false;
  }
}

function ValidadSelect(e) {
  var select = e.target;
  textContent = e.target.value;
  if (textContent == "") {
    select.classList.add("form-control", "is-invalid");
  } else {
    select.classList.replace("is-invalid", "form-control");
    select.classList.add("form-control", "is-valid");
  }
}
