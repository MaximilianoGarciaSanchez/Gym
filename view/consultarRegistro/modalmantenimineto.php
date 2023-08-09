<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo">Editar Registro</h4>
            </div>
            <form method="post" id="alumno_form">
               

                    <input type="hidden" id="alu_id" name="alu_id">
                    
                        <div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="no_control">Numero De Control</label>
								<input type="text" class="form-control" id="no_control1" name="no_control1" placeholder="Numero de control" required>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="alu_nom">Nombre</label>
								<input type="text" class="form-control" id="alu_nom1" name="alu_nom1" placeholder="Ingrese su Nombre"required>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="alu_ape">Apellidos</label>
								<input type="text" class="form-control" id="alu_ape1" name="alu_ape1" placeholder="Ingrese sus apellidos"required>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="gen_id">Genero</label>
								<select id="gen_id1" name="gen_id1" class="form-control">
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
								</select>						
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="id_carrera">Carrera</label>
								<select id="id_carrera1" name="id_carrera1" class="form-control">
                                    <option value="1">Ingenieria En Sistemas Computacionales</option>
                                    <option value="2">Ingenieria Industrial</option>
                                    <option value="3">Ingenieria En Materiales</option>
                                    <option value="4">Ingenieria En Electromecánica</option>
                                    <option value="5">Ingenieria En Gestión Empresarial</option>
                                    <option value="6">Administración</option>
                                    <option value="7">Arquitectura</option>
                                    <option value="8">Ingenieria En Informatica</option>
                                    <option value="9">Maestría En Sistemas Computacionales</option>
                                    <option value="10">Maestría En Arquitectura</option>
                                    <option value="11">Maestría En Administración</option>
								</select>						
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="sem_id">Semestre</label>
								<select id="sem_id1" name="sem_id1" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
									
								</select>						
							</fieldset>

                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
        </form>
           
        </div>
    </div>
</div>