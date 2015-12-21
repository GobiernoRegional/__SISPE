<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="principal.php" class="navbar-brand">SISPE</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class=""><a href="principal.php">Inicio<span class="sr-only">(current)</span></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestiones <span class="caret"></span></a>
					<ul class="dropdown-menu"  style="color:white; text-align:justify">
                        <li><a href="cargo.php"><i class="fa fa-graduation-cap"></i> Cargos</a></li>
						<hr>
                        <li><a href="dependencia.php"><i class="fa fa-university"></i> Dependencias</a></li>
						<hr>
						<li><a href="area.php"><i class="fa fa-building"></i> &nbsp;Areas</a></li>
						<hr>
                        <li><a href="personal.php"><i class="fa fa-user-plus"></i>&nbsp;Personal</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Plan Perú <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="pnEjeEstrategico.php">Ejes Estratégicos</a></li>
						<hr>
						<li><a href="pnObjetivoNacional.php">Objetivo Nacional</a></li>

						<li><a href="pnLineamientosPolitica.php">Lineamientos de Política</a></li>

						<li><a href="pnPrioridades.php">Prioridades</a></li>

						<li><a href="pnObjetivosEspecificos.php">Objetivos específicos</a></li>
						<hr>
						<li><a href="pnIndicadoresyMetas.php">Indicadores y metas</a></li>
						<li><a href="pnAccionesEstrategicas.php">Acciones estratégicas</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PRDC <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="prEjeEstrategico.php">Ejes Estratégicos</a></li>
						<hr>
						<li><a href="prObjetivosEstrategicos.php">Objetivos Estratégicos</a></li>
						<li><a href="prSector.php">Sector</a></li>
						<hr>
                        <li><a href="politica.php">Políticas</a></li>
                        <hr>
                        <li><a href="prEstrategias.php">Estrategías</a></li>
                        <li><a href="prProgramas.php">Programas/Proyectos</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Usuarios</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>  <?php echo $nombreUsuario; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
                        <li><a href="perfil.php">Configuración</a></li>
						<hr>
                        <li><a href="cambiar-clave.php">Cambiar Clave</a></li>
						<hr>
                        <li><a href="../controlador/cerrarSesion.php">Cerrar Sesión</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>