<div class="header">
	<div class="logo">
	    <img src="../img/logo-grupo.png" style="width:202px;margin: 20px 0 0 25px;" />
	</div>
	<img src="../img/user.png" width="170" style="margin: 0 0 0 40px;">
	<div class="datouser">
		<table cellspacing=0 cellpadding=0 border=0>
			<tr>
				<td style="width:55px;">&nbsp;</td>
				<td style="padding:6px;width:23px;font-family: open_sansbold;font-size: 10px;">DATOS</td>
				<td style="width:7px;">:&nbsp;</td>
				<td style="padding:5px;width:80px;text-align:left;font-family: open_sansbold;font-size: 10px;">
					<?php 
	                   if($_SESSION['tipo_usuario']=='SISTEMAS'){
	                       echo utf8_encode($_SESSION['nombre'].", ".$_SESSION['paterno']." ".$_SESSION['materno']);
	                   }elseif($_SESSION['tipo_usuario']=='SUPERVISOR' OR $_SESSION['tipo_usuario']=='PROMOTOR'){
	                       echo utf8_encode($_SESSION['nombre'].", ".$_SESSION['paterno']." ".$_SESSION['materno']);
	                   }elseif($_SESSION['tipo_usuario']=='CLIENTE'){
	                       echo utf8_encode($_SESSION['datos']);
	                   }
	                ?>
				</td>
				<td style="width:50px;">&nbsp;</td>
			</tr>
			<!-- <tr>
				<td style="">&nbsp;</td>
				<td style="padding:6px;font-family: open_sansbold;font-size: 10px;">ZONA</td>
				<td style="width:7px;">:&nbsp;</td>
				<td style="padding:5px;font-family: 'Conv_FuturaNormal';"></td>
				<td style="">&nbsp;</td>
			</tr>
			<tr>
				<td style="">&nbsp;</td>
				<td style="padding:6px;font-family: open_sansbold;font-size: 10px;">CIERRE</td>
				<td style="width:7px;">:&nbsp;</td>
				<td style="padding:5px;font-family: 'Conv_FuturaNormal';"><span style="font-family: open_sansbold;font-size: 10px;" id="idfechacierre"></span></td>
				<td style="">&nbsp;</td>
			</tr> -->
		</table>
	</div>
</div>