<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>

    <title>Consultar Alumno</title>
</head>
<body class="with-side-menu">

<?php require_once("../MainHeader/header.php");?> 

	<div class="mobile-menu-left-overlay"></div>
	
    <?php require_once("../MainNav/nav.php");?> 

	<!-- Contendido -->

	<div class="page-content">
		<div class="container-fluid">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Consultar Alumno</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Consultar Alumno</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
    <div class="row">
        <div class="col-lg-12">
            <fieldset class="form-group">
                <label class="form-label" for="alumno_titulo"></label>
            </fieldset>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label class="form-label" for="no_control">Numero de Control</label>
                <input type="text" class="form-control" id="no_control" placeholder="Ingrese No.Control" required>
            </fieldset>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label class="form-label" for="alu_nom">Nombre</label>
                <input type="text" class="form-control" id="alu_nom" placeholder="Ingrese el Nombre" required>
            </fieldset>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label class="form-label" for="alu_ape">Apellido</label>
                <input type="text" class="form-control" id="alu_ape" placeholder="Ingrese el Apellido" required>
            </fieldset>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label class="form-label" for="gen_id">Genero</label>
                <select id="gen_id" name="gen_id" class="form-control" data-placeholder="Seleccionar">
                    <option label="Seleccionar"></option>
                </select>
            </fieldset>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label class="form-label" for="id_carrera">Carrera</label>
                <select id="id_carrera" name="id_carrera" class="form-control" data-placeholder="Seleccionar">
                    <option label="Seleccionar"></option>
                </select>
            </fieldset>
        </div>
        <div class="col-lg-3">
            <fieldset class="form-group">
                <label class="form-label" for="sem_id">Semestre</label>
                <select id="sem_id" name="sem_id" class="form-control" data-placeholder="Seleccionar">
                    <option label="Seleccionar"></option>
                </select>
            </fieldset>
        </div>
        <div class="col-lg-2">
            <fieldset class="form-group">
                <label class="form-label" for="estado">Estado</label>
                <select id="estado" name="estado" class="form-control" data-placeholder="Seleccionar">
                     <option label="Seleccionar"></option>
                     <option value="Activado">Activado</option>
                     <option value="Desactivado">Desactivado</option>
                </select>
            </fieldset>
        </div>
        <div class="col-lg-2">
            <fieldset class="form-group">
                <label class="form-label" for="alumno_titulo">&nbsp;</label>
                <button type="submit" class="btn btn-rounded btn-primary btn-block" id="btnfiltrar">Filtrar</button>
            </fieldset>
        </div>
        <div class="col-lg-2">
            <fieldset class="form-group">
                <label class="form-label" for="alumno_titulo">&nbsp;</label>
                <button type="submit" class="btn btn-rounded btn-danger btn-block" id="desactivar">Desactivar</button>
            </fieldset>
        </div>
    </div>
</div>

					
			
			<div class="box-typical box-typical-padding" id="table">
			<table id="alumno_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
                                <th class="d-none d-sm-table-cell" style="width: 1%;">Estado</th>	
								<th style="width: 5%;">No.Control</th>
								<th class="d-none d-sm-table-cell" style="width: 15%;">Nombre</th>
								<th class="d-none d-sm-table-cell" style="width: 20%;">Apellido</th>
								<th class="d-none d-sm-table-cell" style="width: 10%;">Genero</th>
								<th class="d-none d-sm-table-cell" style="width: 15%;">Carrera</th>
								<th class="d-none d-sm-table-cell" style="width: 10%;">Semestre</th>	
								<th class="d-none d-sm-table-cell" style="width: 1%;"></th>	
								<th class="d-none d-sm-table-cell" style="width: 1%;"></th>
								<th class="d-none d-sm-table-cell" style="width: 1%;"></th>	
			
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
					
			</div>
		</div>
	</div>

		<!-- Contendido -->
		<?php require_once("modalmantenimineto.php");?>
	<?php require_once("../MainJS/js.php");?>

	<script type="text/javascript" src="consultarregistro.js"></script>
</body>
</html>
<?php
}else{
	header("Location:".Conectar::ruta()."index.php");
}
?>