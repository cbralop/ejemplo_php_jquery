$( document ).ready(function()
{
    dibujarTabla();
});

function limpiarFormularioNuevo(){
    document.getElementById("nuevo_nombre").value = "";
    document.getElementById("nuevo_apellido").value = "";
    document.getElementById("nuevo_email").value = "";
    document.getElementById("nuevo_direccion").value = "";
    document.getElementById("nuevo_rut").value = "";
    document.getElementById("nuevo_perfil").value = 0;
    document.getElementById("nuevo_estado").value = 0;
    document.getElementById("nuevo_mensaje").innerHTML = "";

    quitarObligatorio("nuevo_nombre", 1);
    quitarObligatorio("nuevo_apellido", 1)
    quitarObligatorio("nuevo_email", 1)
    quitarObligatorio("nuevo_direccion", 1)
    quitarObligatorio("nuevo_rut", 1)
    quitarObligatorio("nuevo_perfil", 1)
    quitarObligatorio("nuevo_estado", 1)
}

function quitarObligatorio(elemento, valor){
    if(valor != ""){
        document.getElementById(elemento).classList.remove("is-invalid");
    }
}

function quitarObligatorioSelect(elemento, valor){
    if(valor != 0){
        document.getElementById(elemento).classList.remove("is-invalid");
    }
}

function validarCampos(valor, elemento, checkeo){
    if(valor == "")
    {
        document.getElementById(elemento).classList.add("is-invalid");
        checkeo++;
    }else{
        document.getElementById(elemento).classList.remove("is-invalid");
    }
    return checkeo;
}
function validarCamposSelect(valor, elemento, checkeo){
    if(valor == 0)
    {
        document.getElementById(elemento).classList.add("is-invalid");
        checkeo++;
    }else{
        document.getElementById(elemento).classList.remove("is-invalid");
    }
    return checkeo;
}

function nuevoUsuario(){
    document.getElementById("btn_nuevo").disabled = true;
    setTimeout(() => {
        document.getElementById("btn_nuevo").disabled = false;
    }, 1000);
    const nombre = document.getElementById("nuevo_nombre").value;
    const apellido = document.getElementById("nuevo_apellido").value;
    const email = document.getElementById("nuevo_email").value;
    const direccion = document.getElementById("nuevo_direccion").value;
    const rut = document.getElementById("nuevo_rut").value;
    const perfil = document.getElementById("nuevo_perfil").value;
    const estado = document.getElementById("nuevo_estado").value;
    
    let checkeo = 0;
    checkeo = validarCampos(nombre, "nuevo_nombre", checkeo);
    checkeo = validarCampos(apellido, "nuevo_apellido", checkeo);
    checkeo = validarCampos(email, "nuevo_email", checkeo);
    checkeo = validarCampos(direccion, "nuevo_direccion", checkeo);
    checkeo = validarCampos(rut, "nuevo_rut", checkeo);
    checkeo = validarCamposSelect(perfil, "nuevo_perfil", checkeo);
    checkeo = validarCamposSelect(estado, "nuevo_estado", checkeo);

    if(checkeo == 0){
        $.post("../controller/usu_controlador.php?func=2",
            {nombre: nombre, apellido: apellido, email: email, direccion: direccion, rut: rut, perfil: perfil, estado: estado},
            function(result){
                console.log(result);
                if(result == 200){
                    swal({
                        buttons: false,
                        timer: 1000,
                        title: "Éxito",
                        text: "Se ha guardado con éxito.",
                        icon: "success",
                      });
                    dibujarTabla();
                    $("#modal_agregar").modal("hide");
                }else{
                    swal({
                        buttons: false,
                        timer: 1000,
                        title: "Error",
                        text: "Se ha producido un error al guardar.",
                        icon: "error",
                      });
                    document.getElementById("btn_nuevo").disabled = false;
                }
            }
        );
    }else{
        document.getElementById("nuevo_mensaje").innerHTML = "Debe ingresar todos los campos obligatorios.";
    }
}

function ModUsuario(){
    document.getElementById("btn_mod").disabled = true;
    setTimeout(() => {
        document.getElementById("btn_mod").disabled = false;
    }, 1000);
    const nombre = document.getElementById("mod_nombre").value;
    const apellido = document.getElementById("mod_apellido").value;
    const email = document.getElementById("mod_email").value;
    const direccion = document.getElementById("mod_direccion").value;
    const rut = document.getElementById("mod_rut").value;
    const perfil = document.getElementById("mod_perfil").value;
    const estado = document.getElementById("mod_estado").value;
    const id = document.getElementById("mod_hd_id").value;
    
    let checkeo = 0;
    checkeo = validarCampos(nombre, "mod_nombre", checkeo);
    checkeo = validarCampos(apellido, "mod_apellido", checkeo);
    checkeo = validarCampos(email, "mod_email", checkeo);
    checkeo = validarCampos(direccion, "mod_direccion", checkeo);
    checkeo = validarCampos(rut, "mod_rut", checkeo);
    checkeo = validarCamposSelect(perfil, "mod_perfil", checkeo);
    checkeo = validarCamposSelect(estado, "mod_estado", checkeo);

    if(checkeo == 0){
        $.post("../controller/usu_controlador.php?func=4",
            {nombre: nombre, apellido: apellido, email: email, direccion: direccion, rut: rut, perfil: perfil, estado: estado, id: id},
            function(result){
                if(result == 200){
                    swal({
                        buttons: false,
                        timer: 1000,
                        title: "Éxito",
                        text: "Se ha actualizado con éxito.",
                        icon: "success",
                      });
                    dibujarTabla();
                    $("#modal_mod").modal("hide");
                }else{
                    swal({
                        buttons: false,
                        timer: 1000,
                        title: "Error",
                        text: "Se ha producido un error al actualizar.",
                        icon: "error",
                      });
                }
            }
        );
    }
}

    function dibujarTabla(valor){
        if(valor == undefined){
            valor = "";
        }
		$('#tabla_detalles').DataTable().clear().destroy();
            $('#tabla_detalles').DataTable( {
            "searching": true,
            "ordering": true,
            "bDeferRender": true,
            "sPaginationType": "full_numbers",
            "pageLength": 12,
            "paging": true,
            "ajax": {
                "url": "../controller/usu_controlador.php?func=1&valor="+valor,
                    "type": "POST"
            },
            "columns": [
                { "data": "numero" },
                { "data": "nombre"},
                { "data": "email"},
                { "data": "direccion"},
                { "data": "rut"},
                { "data": "perfil"},
                { "data": "estado"},
                { "data": "accion"},
            ],
            language: {
                processing:     "Traitement en cours...",
                search:         "",
                lengthMenu:    "Mostrar _MENU_ Filas",
                info:           "Mostrando _START_ a _END_ de _TOTAL_ filas",
                infoEmpty:      "Mostrando 0 a 0 de 0 elemento",
                infoFiltered:   "(filtrado de _MAX_ elementos en total)",
                infoPostFix:    "",
                loadingRecords: "Cargando Información...",
                zeroRecords:    "No hay elementos para mostrar",
                emptyTable:     "No hay información para la búsqueda.",
                paginate: {
                    first:      "Primera",
                    previous:   "Anterior",
                    next:       "Siguiente",
                    last:       "&Uacute;ltima"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            },
            });
		}
        function cargaMod(id_usuario){
            $.post("../controller/usu_controlador.php?func=3",
            {id_usuario: id_usuario},
            function(result){
                const resultado = JSON.parse(result);
                document.getElementById("mod_hd_id").value = id_usuario;
                document.getElementById("mod_nombre").value = resultado[0]["nombre"];
                document.getElementById("mod_apellido").value = resultado[0]["apellido"];
                document.getElementById("mod_email").value = resultado[0]["email"];
                document.getElementById("mod_direccion").value = resultado[0]["direccion"];
                document.getElementById("mod_rut").value = resultado[0]["rut"];
                document.getElementById("mod_perfil").value = resultado[0]["perfil"];
                document.getElementById("mod_estado").value = resultado[0]["estado"];
            }
            );
        }

        function cargaEli(id_usuario, estado){
			swal({
                title: "Desactivar/Activar",
                text: "Está seguro de cambiar estado del usuario?",
                icon: "error",
                buttons: ["Cancelar", "Cambiar"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.post("../controller/usu_controlador.php?func=6",
						{id_usuario: id_usuario, estado: estado},
						function(result){
							console.log(result);
							if(result == 300){
                                swal({
                                    buttons: false,
                                    timer: 1000,
                                    title: "Éxito",
                                    text: "Se ha cambiado con éxito.",
                                    icon: "success",
                                  });
								dibujarTabla();
							}else{
                                swal({
                                    buttons: false,
                                    timer: 1000,
                                    title: "Error",
                                    text: "Se ha producido un error al cambiar.",
                                    icon: "error",
                                });
							}
						}
					);
				}
            });
		}

function cerrarModal(){
    swal({
        title: "Cerrar",
        text: "Si cierra perderá los datos no guardados",
        icon: "warning",
        buttons: ["Cancelar", "Cerrar"],
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $('#modal_agregar').modal('hide');
        }
    });
}

function cerrarModalMod(){
    swal({
        title: "Cerrar",
        text: "Si cierra perderá los datos no guardados",
        icon: "warning",
        buttons: ["Cancelar", "Cerrar"],
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $('#modal_mod').modal('hide');
        }
    });
}

function logout(){
    swal({
        title: "Cerrar",
        text: "Está seguro de salir del sistema?",
        icon: "warning",
        buttons: ["Cancelar", "Salir"],
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = "../controller/logout.php";
        }
    });
}

function checkRut(rut) {
    const mensaje = document.getElementById("mensaje_rut");
    const alerta = document.getElementById("nuevo_rut");

    if (rut.value.length <= 1) {
      alerta.classList.remove('alert-success', 'alert-danger');
      alerta.classList.add('alert-info');
      //mensaje.innerHTML = 'Ingrese un RUT en el siguiente campo de texto para validar si es correcto o no';
    }
  
    var valor = clean(rut.value);

    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();
  
    rut.value = format(rut.value);
  
    if (cuerpo.length < 7) {
      rut.setCustomValidity("RUT Incompleto");
      alerta.classList.remove('alert-success', 'alert-danger');
      alerta.classList.add('alert-info');
      //mensaje.innerHTML = 'Ingresó un RUT muy corto, el RUT debe ser mayor a 7 Dígitos. Ej: x.xxx.xxx-x';
      return false;
    }
  
    suma = 0;
    multiplo = 2;
  
    for (i = 1; i <= cuerpo.length; i++) {
      index = multiplo * valor.charAt(cuerpo.length - i);
  
      suma = suma + index;
  
      if (multiplo < 7) {
        multiplo = multiplo + 1;
      } else {
        multiplo = 2;
      }
    }

    dvEsperado = 11 - (suma % 11);
  
    dv = dv == "K" ? 10 : dv;
    dv = dv == 0 ? 11 : dv;
  
    if (dvEsperado != dv) {
      rut.setCustomValidity("RUT Inválido");
  
      alerta.classList.remove('alert-info', 'alert-success');
      alerta.classList.add('alert-danger');
      mensaje.classList.add('alert-danger');
      mensaje.innerHTML = '<small>El RUT ingresado es <strong>INCORRECTO</strong>.</small>';
  
      return false;
    } else {
      rut.setCustomValidity("RUT Válido");
      
        alerta.classList.remove('d-none', 'alert-danger');
        alerta.classList.add('alert-success');
        mensaje.innerHTML = '';
      return true;
    }
  }
  
  function format (rut) {
    rut = clean(rut)
  
    var result = rut.slice(-4, -1) + '-' + rut.substr(rut.length - 1)
    for (var i = 4; i < rut.length; i += 3) {
      result = rut.slice(-3 - i, -i) + '.' + result
    }
  
    return result
  }
  
  function clean (rut) {
    return typeof rut === 'string'
      ? rut.replace(/^0+|[^0-9kK]+/g, '').toUpperCase()
      : ''
  }