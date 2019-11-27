
<?php if($_SESSION['tipo_usuario']=='SUPERVISOR'){ ?>
<div class="nav">
	<div id="cssmenu" style="">
		<ul>
		<li class="has-sub"><a href="#"><i class="fa fa-fw fa-home"></i> CONFIGURACIÓN</a>
			<ul style="z-index:999;">
				<li><a href="ui-index.php?abrir_pagina=cierre">CIERRE</a></li>
			</ul>
		</li>
		<li class="has-sub"><a href="#"><i class="fa fa-fw fa-home"></i> MANTENIMIENTO</a>
			<ul style="z-index:999;">
				<li><a href="ui-index.php?abrir_pagina=fundo">CONSUMIDOR FINAL</a></li>
				<li><a href="ui-index.php?abrir_pagina=cultivo">CULTIVO</a></li>
				<li><a href="ui-index.php?abrir_pagina=objetivo">OBJETIVO</a></li>
				<li><a href="ui-index.php?abrir_pagina=problema">PROBLEMA</a></li>
				<li><a href="ui-index.php?abrir_pagina=distribuidor">CLIENTE</a></li>
				<li><a href="ui-index.php?abrir_pagina=producto">PRODUCTO</a></li>
				<li><a href="ui-index.php?abrir_pagina=usuario">USUARIO</a></li>
			</ul>
		</li>
		<li class="has-sub"><a href="#"><i class="fa fa-fw fa-bars"></i> GESTIÓN</a>
			<ul style="z-index:999;">
				<li><a href="ui-index.php?abrir_pagina=registro-gestion">REGISTRO GESTIÓN</a></li>
				<li><a href="ui-index.php?abrir_pagina=consulta-gestion">CONSULTA GESTIÓN</a></li>
			</ul>
		</li>
		</ul>
	</div>
</div>
<?php } ?>
<?php if($_SESSION['tipo_usuario']=='PROMOTOR'){ ?>
<div class="nav">
	<div id="cssmenu" style="">
		<ul>
		<li class="has-sub"><a href="#"><i class="fa fa-fw fa-home"></i> MANTENIMIENTO</a>
			<ul style="z-index:999;">
				<li><a href="ui-index.php?abrir_pagina=fundo">CONSUMIDOR FINAL</a></li>
				<li><a href="ui-index.php?abrir_pagina=cultivo">CULTIVO</a></li>
				<li><a href="ui-index.php?abrir_pagina=objetivo">OBJETIVO</a></li>
				<li><a href="ui-index.php?abrir_pagina=problema">PROBLEMA</a></li>
				<li><a href="ui-index.php?abrir_pagina=distribuidor">CLIENTE</a></li>
				<li><a href="ui-index.php?abrir_pagina=producto">PRODUCTO</a></li>
			</ul>
		</li>
		<li class="has-sub"><a href="#"><i class="fa fa-fw fa-bars"></i> GESTIÓN</a>
			<ul style="z-index:999;">
				<li><a href="ui-index.php?abrir_pagina=registro-gestion">REGISTRO GESTIÓN</a></li>
				<li><a href="ui-index.php?abrir_pagina=consulta-gestion">CONSULTA GESTIÓN</a></li>
			</ul>
		</li>
		</ul>
	</div>
</div>
<?php } ?>