<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">
		<?php
		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Estudiante"){
			echo '<li class="active">
			<a href="inicio">
				<i class="fa fa-home"></i>
				<span>Inicio</span>
			</a>
		</li>
			
			<li>
			<a href="estudiante">
					<i class="fa fa-users"></i>
					<span>Estudiantes</span>
				</a>
			</li>
			<li>
				<a href="simposio">
					<i class="fa fa-product-hunt"></i>
					<span>Asistir al simposio</span>
				</a>
			</li>';

		}
		
		if($_SESSION["perfil"] == "Administrador"){
			echo '
			<li>
				<a href="usuarios">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
				</a>
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador"){
			echo '<li>
				<a href="eventos">
					<i class="fa fa-th"></i>
					<span>Evento</span>
				</a>
			</li>';

		}


		

		?>

		</ul>

	 </section>

</aside>