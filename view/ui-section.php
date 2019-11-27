<div class="section">
<?php
  if(isset($_GET['abrir_pagina'])){
    switch ($_GET['abrir_pagina']) {
		case 'registro-gestion':
			include('ui-registro-gestion.php');
			break;
		case 'consulta-gestion':
			include('ui-consulta-gestion.php');
			break;
		case 'fundo':
	   		include('ui-fundo.php');
	   		break;
		case 'cultivo':
	   		include('ui-cultivo.php');
	   		break;
		case 'objetivo':
	   		include('ui-objetivo.php');
	   		break;
		case 'problema':
	   		include('ui-problema.php');
	   		break;
		case 'cierre':
	   		include('ui-cierre.php');
	   		break;
		case 'distribuidor':
	   		include('ui-distribuidor.php');
	   		break;
		case 'producto':
	   		include('ui-producto.php');
	   		break;
		case 'usuario':
	   		include('ui-usuario.php');
	   		break;
	    default:
	        include('ui-default.php');
	      	break;
    }
  } 
?>
</div>