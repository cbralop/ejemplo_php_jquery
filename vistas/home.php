<?php
    session_start();
    if($_SESSION['nombre'] == ""){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html>
  <head>
        <meta http-equiv='Content-Type' content='text/html;charset=utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="../fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'/>

        <script src='../js/jquery-3.5.1.min.js'></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script src='../js/home.js'></script>
        <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">
        <script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
    <title>Ejemplo Mantenedor</title>
  </head>
  <body>
    <header> 
        <nav class="navbar navbar-expand-lg bg-metalluz bg-primary text-white">
            <a class="col-md-2 text-center navbar-brand" href="#">
                <img src="/images/im1.png" width="200" height="80" alt="">
            </a>
            <h3 class="mt-2 col-md-8 text-center">Mantenedor Usuarios</h3>
            <strong class="text-capitalize text-white"><?=$_SESSION['nombre']?></strong>
            <span class="navbar-text">
                <a class="btn btn-sm btn-outline-link text-white" onclick="logout()" title="Salir" role="button"><i class="fas fa-power-off text-right"></i></a>
            </span>
        </nav>
    </header>
    <div class="container">
        <div class="row mt-3">
            <div class="col-auto mr-auto">
                <button id="nuevo_usuario" class="btn btn-success" data-toggle="modal" data-target="#modal_agregar" onclick="limpiarFormularioNuevo();" title="Nuevo Usuario"><i class="fas fa-user-plus"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="mt-4 table-responsive">
                <table id="tabla_detalles" class="table table-striped table-bordered text-center table-sm" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Direcci&oacute;n</th>
                            <th>RUT</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    <thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- **Modal Modificar** -->
<div class="modal fade" id="modal_mod" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
                    <div class="modal-header cabecera-tablas">
                        <h5 class="modal-title">Modificar Usuario</h5>
                        <button type="button" class="close" onclick="cerrarModalMod()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<div class="modal-body">
                    <form class="mt-3 mb-2">
							<div class="form-group row">
								<label for="nuevo_mode" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="mod_nombre" placeholder="Ingrese Nombre" onkeyup="quitarObligatorio('mod_nombre', this.value)"/>
								</div>
							</div>
							<div class="form-group row">
								<label for="mod_apellido" class="col-sm-4 col-form-label col-form-label-sm">Apellido</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="mod_apellido" placeholder="Ingrese Apellido" onkeyup="quitarObligatorio('mod_apellido', this.value)" />
								</div>
							</div>
							<div class="form-group row">
								<label for="mod_email" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="mod_email" placeholder="correo@correo.cl" onkeyup="quitarObligatorio('mod_email', this.value)" />
								</div>
							</div>
                            <div class="form-group row">
								<label for="mod_direccion" class="col-sm-4 col-form-label col-form-label-sm">Direcci&oacute;n</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="mod_direccion" placeholder="Direccion" onkeyup="quitarObligatorio('mod_direccion', this.value)" />
								</div>
							</div>
                            <div class="form-group row">
								<label for="mod_rut" class="col-sm-4 col-form-label col-form-label-sm">RUT</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="mod_rut" placeholder="11.111.111-1" oninput="checkRut(this)" onkeyup="quitarObligatorio('mod_rut', this.value)" />
								</div>
							</div>
                            <div class="form-group row">
								<label for="mod_perfil" class="col-sm-4 col-form-label col-form-label-sm">Perfil</label>
								<div class="col-sm-8">
                                    <select type="text" class="form-control form-control-sm" id="mod_perfil" onkeyup="quitarObligatorioSelect('mod_perfil', this.value)">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Normal</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group row">
								<label for="mod_estado" class="col-sm-4 col-form-label col-form-label-sm">Estado</label>
								<div class="col-sm-8">
                                    <select type="text" class="form-control form-control-sm" id="mod_estado" onkeyup="quitarObligatorioSelect('mod_estado', this.value)">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Desactivado</option>
                                    </select>
									<div id="mod_estado_invalido" class="invalid-feedback">
										Debe seleccionar Estado
									</div>
								</div>
							</div>
                            <div class="form-group row">
								<div class="col-sm-12 text-center text-danger" id="mod_mensaje"></div>
							</div>
						</form>
                    </div>
                    <div class="modal-footer">
                        <input id="mod_hd_id" type="hidden" name="mod_hd_id" value="">
                        <button type="button" class="btn btn-secondary" onclick="cerrarModalMod()">Cerrar</button>
                        <button type="button" class="btn btn-success" id="btn_mod" onclick="ModUsuario();">Guardar</button>
                    </div>
				</div>
			</div>
        </div>
        <!-- **Fin Modal Modificar** -->
        <!-- **Modal Agregar** -->
        <div class="modal fade" id="modal_agregar" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
                    <div class="modal-header cabecera-tablas">
                        <h5 class="modal-title">Nuevo Usuario</h5>
                        <button type="button" class="close" onclick="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<div class="modal-body">
                    <form class="mt-3 mb-2">
							<div class="form-group row">
								<label for="nuevo_nombre" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="nuevo_nombre" placeholder="Ingrese Nombre" onkeyup="quitarObligatorio('nuevo_nombre', this.value)"/>
								</div>
							</div>
							<div class="form-group row">
								<label for="nuevo_apellido" class="col-sm-4 col-form-label col-form-label-sm">Apellido</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="nuevo_apellido" placeholder="Ingrese Apellido" onkeyup="quitarObligatorio('nuevo_apellido', this.value)" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nuevo_email" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="nuevo_email" placeholder="correo@correo.cl" onkeyup="quitarObligatorio('nuevo_email', this.value)" />
								</div>
							</div>
                            <div class="form-group row">
								<label for="nuevo_direccion" class="col-sm-4 col-form-label col-form-label-sm">Direcci&oacute;n</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="nuevo_direccion" placeholder="Direccion" onkeyup="quitarObligatorio('nuevo_direccion', this.value)" />
								</div>
							</div>
                            <div class="form-group row">
								<label for="nuevo_rut" class="col-sm-4 col-form-label col-form-label-sm">RUT</label>
								<div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="nuevo_rut" placeholder="11.111.111-1" oninput="checkRut(this)" onkeyup="quitarObligatorio('nuevo_rut', this.value)" />
                                    <span id="mensaje_rut" class=""></span>
								</div>
							</div>
                            <div class="form-group row">
								<label for="nuevo_perfil" class="col-sm-4 col-form-label col-form-label-sm">Perfil</label>
								<div class="col-sm-8">
                                    <select class="form-control form-control-sm" id="nuevo_perfil" onchange="quitarObligatorioSelect('nuevo_perfil', this.value)">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Normal</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group row">
								<label for="nuevo_estado" class="col-sm-4 col-form-label col-form-label-sm">Estado</label>
								<div class="col-sm-8">
                                    <select class="form-control form-control-sm" id="nuevo_estado" onchange="quitarObligatorioSelect('nuevo_estado', this.value)">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Desactivado</option>
                                    </select>
								</div>
							</div>
                            <div class="form-group row">
								<div class="col-sm-12 text-center text-danger" id="nuevo_mensaje"></div>
							</div>
						</form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
                        <button type="button" class="btn btn-success" id="btn_nuevo" onclick="nuevoUsuario();">Guardar</button>
                    </div>
				</div>
			</div>
        </div>
        <!-- **Fin Modal Agregar** -->
  </body>
</html>