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
							<h3>Registro De Entradas/Salidas</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Consultar Alumno</li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			<!-- Registro -->
			<div class="box-typical box-typical-padding">
				<div class="row">
					
					
						<div class="col-lg-4">
							<fieldset class="form-group">
							<small class="text-muted" id ="fecha"></small>
								<label class="form-label" for="" name="">Numero De Control</label> 
								<input type="text" class="form-control" id="no_control" name="no_control"required>
								<!-- <input type="datetime-local" name="fecha">							 -->
						</div>
						<div class="col-lg-12">

						<button id="btn_entrada" class="btn btn-rounded btn-inline btn-success">Entrada</button>
						<button id="btn_salida" class="btn btn-rounded btn-inline btn-danger">Salida</button>
						</div>	
					
 
					</div>
				</div>
			

			</div>
			<!-- Registro -->
			<div class="box-typical box-typical-padding">
			<table id="alumno_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
							    <th style="width: 3%;">No.Control</th>
								<th style="width: 10%;">Nombre</th>
								<th class="d-none d-sm-table-cell" style="width: 10%;">Apellido</th>
								<th class="d-none d-sm-table-cell" style="width: 2%;">Estado</th>				
								<th class="d-none d-sm-table-cell" style="width: 5%;">Fecha</th>		
								<th class="d-none d-sm-table-cell" style="width: 5%;">Entrada</th>	
								<th class="d-none d-sm-table-cell" style="width: 5%;">Salida</th>				
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
			</div>
		</div>
	</div>
		<!-- Contendido -->
		


		<!-- Scirip de hora -->
		<script>

			

			setInterval(() => {

			let fecha = new Date();
			let fechaHora = fecha.toLocaleString();
			document.getElementById("fecha").textContent= fechaHora;

			}, 1000);




		</script>


	<?php require_once("../MainJS/js.php");?>
	<script type="text/javascript" src="entradas.js"></script>


</body>
</html>
<?php
}else{
	header("Location:".Conectar::ruta()."index.php");
}
?>