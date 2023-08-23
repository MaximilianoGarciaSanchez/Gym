<?php
require_once("../../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>

    <title>Detalle Alumno</title>
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
                <h3 id="lblnomidalumno">Detalle Del Alumno</h3>
                <div id="lblestado"></div>
                <span class="label label-pill label-primary" id="lblnomusuario"></span>
                <span class="label label-pill label-default" id="lblfechcrea"></span>
                <ol class="breadcrumb breadcrumb-simple">
                  
                </ol>
              </div>
            </div>
          </div>
        </header>
        <section class="activity-line" id="lbldetalle">

		
			
		</div>
	</div>

		<!-- Contendido -->


	<?php require_once("../MainJS/js.php");?>
	<script type="text/javascript" src="detallealumno.js"></script>


</body>
</html>
<?php
}else{
	header("Location:".Conectar::ruta()."index.php");
}
?>