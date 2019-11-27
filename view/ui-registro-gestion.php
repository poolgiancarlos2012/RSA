<!-- <div class="datos" style="position:relative;height: 50px;">
	<div class="datoszona" style="position:absolute;left:10px;top:15px;">
		<span style="font-family: 'Conv_futura_md_bt_bold';font-size: 13px;">Zona de Venta : </span><label class="zona" style="font-family: 'Conv_futura_bk_bt_book';font-size: 13px;"> DPTO SAN MARTIN-RIOJA-MOYOBAMBA-TARAPOTO</label>
	</div>
	<div class="cierre" style=";position:absolute;left:500px;top:15px;">
		<span style="font-family: 'Conv_futura_md_bt_bold';font-size: 13px;">Fecha Prox. Cierre : </span><label class="zona" style="font-family: 'Conv_futura_bk_bt_book';font-size: 13px;"> 01/03/2017 12:00pm</label>
	</div>
	<div class="cerrarsession" style=";position:absolute;right:10px;top:15px;">
		<a title="Cerrar Sesi&oacute;n" id="idcerrarsession"  class=" fa fa-sign-out" href="../close.php">  <img src="../img/system_log_out.png" width=20> </a>
	</div>
</div> -->
<div class="registro_gestion" style="width:100%;heigth:50px;">
	<div class="titulo" style="width: 331px;margin: 0 auto;padding: 30px 0;">
		<span style="font-family: 'Conv_futura_md_bt_bold';font-size: 20px;">Registro Semanal de Actividades</span>
	</div>

	<div class="gestion_cliente" style="width: 800px;margin: 0 auto;">
		<fieldset style="min-height:75px;">
			<legend>
				<b><span style="font-family: 'Conv_futura_md_bt_bold';font-size: 13px;">Gestión Cliente</span></b> 
			</legend>
			<table cellspacing=0 cellpadding=0 border=0 style="margin: 0 auto;">
				<!-- <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Fecha Gestión</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	<input type="text" class="textbox" name=""  style="width:100%;text-align: center;" id="idfechgestion" placeholder="">
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Distribuidor</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	<div class="select-style" style="width:200px;font-weight:bold;">
		                    <select id='iddistribuidor' name='iddistribuidor'></select>
		                </div>
		            	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr> -->

		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Fecha Gestión</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;position:relative;">
		            	<input type="text" class="textbox" name=""  style="width:200px;text-align: center;font-weight:bold;" id="idfechgestion" placeholder="__/__/20__ __:__:__">		            	
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Cliente</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;position: relative;">
		            	<input type="text" class="textbox" name=""  style="width:200px;font-weight:bold;" id="cliente" placeholder="CLIENTE">
                		<div id="searchcliente" style="-moz-box-shadow: 1px 1px 5px 2px #4A4A4A;-webkit-box-shadow: 1px 1px 5px 2px #4A4A4A;box-shadow: 1px 1px 5px 2px #4A4A4A;display:none;background-color:white;position: absolute;left: 2px;top: 35px;z-index: 2;width:300px;height:300px;float: left;overflow: auto;"></div>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>

		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Consu.Final</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;position:relative;">
						<input type="text" class="textbox" name=""  style="width:200px;font-weight:bold;" id="fundo" placeholder="CONSUMIDOR FINAL">
                		<div id="searchfundo" style="-moz-box-shadow: 1px 1px 5px 2px #4A4A4A;-webkit-box-shadow: 1px 1px 5px 2px #4A4A4A;box-shadow: 1px 1px 5px 2px #4A4A4A;display:none;background-color:white;position: absolute;left: 2px;top: 35px;z-index: 2;width:300px;height:300px;float: left;overflow: auto;"></div>       	
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Tipo Cliente</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;position: relative;">
		            	<div class="select-style" style="width:200px;font-weight:bold;">
		            		<select  name="" id="idtipo_cliente"></select>
		            	</div>    	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>

			</table>
		</fieldset>
	</div>
	<br>
	<div class="detalle_gestion_cliente" style="width: 800px;margin: 0 auto;">
		<fieldset style="min-height:200px;">
			<legend>
				<b><span style="font-family: 'Conv_futura_md_bt_bold';font-size: 13px;">Detalle Gestión Cliente</span></b> 
			</legend>
			<table cellspacing=0 cellpadding=0 border=0 style="margin: 0 auto;">
				<tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<!-- <span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Agric. o Fundo</span> -->
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Objetivo Visita</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;position:relative;">
						<!-- <div class="select-style" style="width:200px;font-weight:bold;">
		            		<select id='idagric_fundo' name='idagric_fundo'></select>
		            	</div> -->

		            	<input type="text" class="textbox" name=""  style="width:200px;font-weight:bold;" id="objetivo" placeholder="OBJETIVO">
                		<div id="searchobjetivo" style="-moz-box-shadow: 1px 1px 5px 2px #4A4A4A;-webkit-box-shadow: 1px 1px 5px 2px #4A4A4A;box-shadow: 1px 1px 5px 2px #4A4A4A;display:none;background-color:white;position: absolute;left: 2px;top: 35px;z-index: 2;width:300px;height:300px;float: left;overflow: auto;"></div>

		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Cultivo</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;position: relative;">
	            		<!-- <div class="select-style" style="width:200px;font-weight:bold;">
		            	<select id='idcultivo' name='idcultivo'></select>
		            	</div> -->

		            	<input type="text" class="textbox" name=""  style="width:200px;font-weight:bold;" id="cultivo" placeholder="CULTIVO">
                		<div id="searchcultivo" style="-moz-box-shadow: 1px 1px 5px 2px #4A4A4A;-webkit-box-shadow: 1px 1px 5px 2px #4A4A4A;box-shadow: 1px 1px 5px 2px #4A4A4A;display:none;background-color:white;position: absolute;left: 2px;top: 35px;z-index: 2;width:300px;height:300px;float: left;overflow: auto;"></div>


		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Problema/Actividad</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;position: relative;">
						<!-- <div class="select-style" style="width:200px;font-weight:bold;">
		            		<select  name="" id="objetivovisita"></select>
		            	</div> -->
		            	<input type="text" class="textbox" name=""  style="width:200px;font-weight:bold;" id="problema" placeholder="PROBLEMA">
                		<div id="searchproblema" style="-moz-box-shadow: 1px 1px 5px 2px #4A4A4A;-webkit-box-shadow: 1px 1px 5px 2px #4A4A4A;box-shadow: 1px 1px 5px 2px #4A4A4A;display:none;background-color:white;position: absolute;left: 2px;top: 35px;z-index: 2;width:300px;height:300px;float: left;overflow: auto;"></div>

		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Area(HAS)</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;">
	            		<!-- <div class="select-style" style="width:200px;font-weight:bold;">
		                <select  name="" id="idarea"></select>
		                </div> -->

		                <!-- <input type="text" id="area" class="textbox" name=""  style="width:200px;float:left;text-align:left;font-weight:bold;" onkeypress="return onKeyDecimal(event,this);"  placeholder="AREA"> -->
		                <input type='number' id="area" class="textbox" step='0.01'  style="width:200px;float:left;text-align:left;font-weight:bold;" placeholder='0.00' onkeypress="return onKeyDecimal(event,this);" />

		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Zona</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;position: relative;">
						<!-- <div class="select-style" style="width:200px;font-weight:bold;">
		            		<select  name="" id="idproblema"></select>
		            	</div> -->
		            	<div class="select-style" style="width:200px;font-weight:bold;">
		            		<select  name="" id="idzona"></select>
		            	</div>	            	


		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Lugar de Visita</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;">
		                <input type="text" class="textbox" name="" style="width:100%;font-weight:bold;" id="idlugarvisita" placeholder="LUGAR DE VISITA">
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<!-- <span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Recorrido(km)</span> -->
		            	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	<!-- <input type="text" class="textbox" name=""  style="width:95px;float:left;text-align:center;" id="idrecoini" placeholder="INICIO"><input type="text" class="textbox" name=""  style="width:95px;float:right;text-align:center;" id="idrecofin" placeholder="FIN"> -->
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">
	            		
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Producto</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">

		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
		        	<td style="width: 10px;">&nbsp;</td>
<!-- 		        	<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<input type="text" class="textbox" name=""  style="width:100%;float:left;" id="idfechdesde" placeholder="COD. PRODUCTO">
		            </td> -->
		            <!-- <td style="width: 10px;">&nbsp;</td> -->
					<td align="left" valign="middle" style="width: 200px;height: 35px;" colspan="3">
		            	<input type="text" class="textbox" name=""  style="width:100%;float:right;font-weight:bold;" id="sproducto" placeholder="PRODUCTO">
		            </td>
		        	<td style="width: 10px;">&nbsp;</td>
		        	<td style="width: 310px;" colspan="3">
		        		<input type="hidden" value="" id="hdcodproduc">
		        		<input type="hidden" value="" id="hdidcliente">
		        		<input type="hidden" value="" id="hdidobjetivo">
		        		<input type="hidden" value="" id="hdidproblema">
		        		<input type="hidden" value="" id="hdidfundo">
		        		<input type="hidden" value="" id="hdidcultivo">
		        	</td>
		        	<td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
		        	<td style="width: 10px;">&nbsp;</td>
		        	<td style="width: 310px;" colspan="3">
		        		<div id="prod" class="textbox" style="width: 328px;height:100px;overflow: auto;">
	        				
	        			</div>
		        	</td>
		        	<td style="width: 10px;">&nbsp;</td>
		        	<td style="width: 310px;" colspan="3">
		        	<div id="listprod" class="textbox" class="textbox" style="width: 328px;height:100px;overflow: auto;">
	        			<table id="listproductos" cellspacing="0" cellpadding="0" border=0>

	        			</table>		
        			</div>
		        	</td>
		        	<td style="width: 10px;">&nbsp;</td>
		        </tr>		        
		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 15px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;"></span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 15px;">
		            
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 15px;">

		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 15px;">
		            	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
					<td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 130px;height: 35px;">
		            	<span style="font-family: 'Conv_FuturaNormal';font-size: 14px;">Observacion</span>
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
					<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	<textarea id="idobservacion" class="textarea" style="width:200px;max-width:200px;max-height: 100px;" rows="7"  style="border-radius: 4px;overflow:auto;"></textarea>
		            </td>
	            	<td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 130px;height: 35px;">

		            </td>
		            <td style="width: 10px;">&nbsp;</td>
	            	<td align="left" valign="middle" style="width: 200px;height: 35px;">
		            	
		            </td>
		            <td style="width: 10px;">&nbsp;</td>
		        </tr>
		        <tr>
		        	<td colspan="9" style="text-align: center;padding: 10px 0;">
		        		<input type="button" name="" class="btndestacado" value="AGREGAR" style="width: 70px;" id="idagregar"/>
		        		<input type="button" name="" class="btndestacado" value="LIMPIAR" style="width: 70px;" id="idlimpiar" onlick="limpiar();" />
		        	</td>
		        </tr>
			</table>
		</fieldset>
		<div style="">
			<br>
				<div id="idgestiones" style="width: 796px;height:300px;overflow: auto;" class="datagrid">
					<table >
						<thead>
							<tr>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">NRO</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">FECHGESTION</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDCLIENTE</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">CLIENTE</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDFUNDO</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">CONSU.FINAL</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDZONA</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">ZONA</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDTIPO_CLIENTE</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">TIPO_CLIENTE</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">LUGAR</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDOBJETIVO</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">OBJETIVO</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDCULTIVO</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">CULTIVO</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDAREA</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">AREA</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDPROBLEMA</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">PROBLEMA</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;display:none;">IDPRODUCTOS</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">PRODUCTOS</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">OBSERVACION</th>
								<th style="font-family: 'Conv_FuturaNormal';font-size: 12px;text-align: center;">QUITAR</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			<br>
		</div>
		<div style="text-align: center;padding: 10px 0;">
			<input type="button" name="" class="btndestacado" value="GRABAR" style="width: 70px;" id="idgrabar"/>
		</div>
		<div id="dialogrecorrido" style="">
			
		</div>	
	</div>
</div>