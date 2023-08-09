<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>

    <title>Nuevo Alumno</title>
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
							<h3>Nuevo Alumno</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Nuevo Alumno</li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			<div class="box-typical box-typical-padding">
				<p>
					Desde esta ventana podra agregar un nuevo alumno.
				</p>

				<div class="row">
					<form method="post" id="alumno_form">

				    <input type="hidden" id="usu_id" name="usu_id" value= "<?php echo $_SESSION["usu_id"] ?>">

						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="no_control">Numero De Control</label>
								<input type="text" class="form-control" id="no_control" name="no_control" required>
							</fieldset>
						</div>
						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="alu_nom">Nombre</label>
								<input type="text" class="form-control" id="alu_nom" name="alu_nom" placeholder="Ingrese su Nombre"required>
							</fieldset>
						</div>
						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="alu_ape">Apellidos</label>
								<input type="text" class="form-control" id="alu_ape" name="alu_ape" placeholder="Ingrese sus apellidos"required>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="gen_id">Genero</label>
								<select id="gen_id" name="gen_id" class="form-control">
									
								</select>						
							</fieldset>
						</div>
						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="id_carrera">Carrera</label>
								<select id="id_carrera" name="id_carrera" class="form-control">
									
								</select>						
							</fieldset>
						</div>
						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="sem_id">Semestre</label>
								<select id="sem_id" name="sem_id" class="form-control">
									
								</select>						
							</fieldset>
						</div>
						<div class="col-lg-12">
						<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
						</div>	
					</form>
 
					</div>
				</div>
				<!-- <div class="summernote-theme-1" id="exMedico">
					<textarea class="summernote" name="name">Examen Medico</textarea>
				</div> -->
				


			</div>
		</div>
	</div>

		<!-- Contendido -->


	<?php require_once("../MainJS/js.php");?>
	<script type="text/javascript" src="nuevoregistro.js"></script>
	


</body>
</html>
<?php
}else{
	header("Location:".Conectar::ruta()."index.php");
}
?>