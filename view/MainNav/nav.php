<?php 

     if ($_SESSION["rol_id"]==1){
        ?>
        <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\NuevoRegistro\">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <span class="lbl">Nuevo Alumno</span>
                        </a>
                    </li>
                    
					<li class="blue-dirty">
                        <a href="..\ConsultarRegistro\">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            <span class="lbl">Consultar Alumno</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Entradas\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Registro Entradas/Salidas</span>
                        </a>
                    </li>
                </ul>
            </nav>

        
        <?php 
    }else if($_SESSION["rol_id"]==2){
        ?>

<nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <!-- <li class="blue-dirty">
                        <a href="..\ConsultarRegistro\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Alumno</span>
                        </a>
                    </li> -->
                    
                    <li class="blue-dirty">
                        <a href="..\Entradas\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Registro Entradas/Salidas</span>
                        </a>
                    </li>
                </ul>
            </nav>
        
        <?php 

    }


?>
