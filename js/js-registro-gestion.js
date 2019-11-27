$(document).ready(function(){
	// var data=[];
	// RegistroGestionJQGRID.Tem_gestion(data);
	RegistroGestionJQGRID.Consultar_Gestion();
	//RegistroGestionDAO.QUERYListarCliente();
	
	//RegistroGestionDAO.QUERYListarMotivo();
	// RegistroGestionDAO.QUERYListarActividad();
	// RegistroGestionDAO.QUERYListarFundo();
	// RegistroGestionDAO.QUERYListarCultivo();
	// RegistroGestionDAO.QUERYListarArea();
	RegistroGestionDAO.QUERYListarZona();
	RegistroGestionDAO.QUERYListarTipoCliente();

	$('#idfechgestion').mask("99/99/2099 99:99:99");

	$('#idsearchdesdefechgestion').mask("99/99/2099");
	$('#idsearchhastafechgestion').mask("99/99/2099");

	$("#sproducto").live('keyup',function(){
		RegistroGestionDAO.QUERYListarProductos();
	});


	$("#xinicio,#xfin").live('keypress',function(e){
		var keynum = window.event ? window.event.keyCode : e.which;
		if (document.getElementById("xinicio").value.indexOf('.') != -1 && keynum == 46)
		    return false;
		if ((keynum == 8 || keynum == 48 || keynum == 46))
		    return true;
		if (keynum <= 47 || keynum >= 58) return false;
		return /\d/.test(String.fromCharCode(keynum));
	});

	/*QUITAR ITEM A ARRAY*/
	$("img[id^='quit_']").live("click",function(){

		var xid=$(this).attr("id").replace("quit_","");
		var xprod=$("img#quit_"+xid).parent().parent().find("td:eq(1)").text();

		//alert(xid);

		var arcodprod=[];
		arcodprod=$("#hdcodproduc").val().split(",");
		var codprod=[]; 
		var i = arcodprod.indexOf(xid+'@'+xprod);
		if(i != -1) {
			arcodprod.splice(i, 1);
		}
		//console.log(arcodprod);
		$("#hdcodproduc").val("");
		$("#hdcodproduc").val(arcodprod.toString());
		$("img#quit_"+xid).parent().parent().remove();
	});
	/*QUITAR ITEM A ARRAY*/
	var data=[];
	$("#idagregar").click(function(){

		RegistroGestionDAO.ValidarRegistroCierre(function(obj){
			if (obj.rst) {
				if(obj.dato.length>0){
					
					var idgestion=$('#idgestiones table tbody').find('tr').length+1;
					var xidfechgestion=$("#idfechgestion").val().split(" ");
					var xxidfechgestion=xidfechgestion[0].split("/").reverse().join("-")+" "+xidfechgestion[1];
					var idfechgestion=xidfechgestion[0]+" "+xidfechgestion[1];
					var idcliente=$("#hdidcliente").val();
					var cliente=$("#cliente").val();
					var idfundo=$("#hdidfundo").val();
					var fundo=$("#fundo").val();
					var idzona=$("#idzona").val();
					var zona=$("#idzona option:selected").text();
					var lugarvisita=$("#idlugarvisita").val();
					var idcultivo=$("#hdidcultivo").val();
					var cultivo=$("#cultivo").val();
					var idobjetivo=$("#hdidobjetivo").val();
					var objetivo=$("#objetivo").val();
					var area=$("#area").val();
					var idproblema=$("#hdidproblema").val();
					var problema=$("#problema").val();

					var idtipo_cliente=$("#idtipo_cliente").val();
					var tipo_cliente=$("#idtipo_cliente option:selected").text();

					var aridproduc=[];
					var arproduc=[];
					$('#listproductos tr').each(function(){
			            aridproduc.push($(this).find("td").eq(0).text());
			            arproduc.push($(this).find("td").eq(1).text());
			        });
			        var idproductos=aridproduc.toString();
			        var productos=arproduc.toString();

					var xfchdesde=obj.dato[0]['ini'].split(" ");
					var xfchhasta=obj.dato[0]['fin'].split(" ");
					var fchdesde= xfchdesde[0].split("/").reverse().join("-")+" "+xfchdesde[1];
					var fchhasta= xfchhasta[0].split("/").reverse().join("-")+" "+xfchhasta[1];

					var modo=obj.dato[0]['idcierre_modo'];
					var idobservacion=$("#idobservacion").val().replace(/\n/g, " ");

					if(modo==1){ // 1	ABIERTO
						if(fchdesde<=xxidfechgestion && fchhasta>=xxidfechgestion){ //COMENTAR VALIDACION DE RANGO DE FECHAS FECHAS

								if(xxidfechgestion==""){
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar fecha gestion");
									return false;
								}
								if(idcliente=="" && idfundo==""){
									//alert("Ingresar Distribuidor o Ingresar fundo");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar Distribuidor o fundo");
                					return false;
								}
								// if(idcultivo==""){
								// 	//alert("Ingresar cultivo");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar cultivo");
								// 	return false;
								// }
								if(idobjetivo==""){
									//alert("Ingresar objetivo");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar objetivo");
									return false;
								}
								// if(area==""){
								// 	//alert("Ingresar area");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar area");
								// 	return false;
								// }

								esEntero(area);

								// if(idproblema==""){
								// 	//alert("Ingresar problema");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar problema");
								// 	return false;
								// }
								if(idzona==""){
									//alert("Ingresar zona");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar zona");
									return false;
								}
								if(lugarvisita==""){
									//alert("Ingresar lugar visita");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar lugar visita");
									return false;
								}		
								// if(idproductos==""){
								// 	// alert("Ingresar productos");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar productos");
								// 	return false;
								// }								
								if(idtipo_cliente==""){
									// alert("Ingresar productos");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar tipo cliente");
									return false;
								}

							 	var html="";
							 	html+='';
								html+='<tr >';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idgestion+'">'+idgestion+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:100px;text-align: center;" title="'+idfechgestion+'">'+idfechgestion+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idcliente+'">'+idcliente+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+cliente+'">'+cliente+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idfundo+'">'+idfundo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+fundo+'">'+fundo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idzona+'">'+idzona+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+zona+'">'+zona+'</div></td>';

									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idtipo_cliente+'">'+idtipo_cliente+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+tipo_cliente+'">'+tipo_cliente+'</div></td>';

									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;text-transform: uppercase;" title="'+lugarvisita+'">'+lugarvisita+'</div></td></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idobjetivo+'">'+idobjetivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+objetivo+'">'+objetivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idcultivo+'">'+idcultivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+cultivo+'">'+cultivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:100px;" title="'+area+'">'+area+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idproblema+'">'+idproblema+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+problema+'">'+problema+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:100px;text-align: center;" title="'+idproductos+'">'+idproductos+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+productos+'">'+productos+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;text-transform: uppercase;" title="'+idobservacion+'">'+idobservacion+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;text-align: center;"><img id="idquitarreg" src="../img/Minus.png" style="width:16px;"></td>';
								html+='</tr>';
							 	$("#idgestiones table tbody").append(html);
						}else{ //COMENTAR VALIDACION DE RANGO DE FECHAS FECHAS
						  	alertify.set({ delay: 5000 }); //COMENTAR VALIDACION DE RANGO DE FECHAS FECHAS
                		  	alertify.log("La fecha de gestion debe estar dentro del rango de cierre"); //COMENTAR VALIDACION DE RANGO DE FECHAS FECHAS
						} //COMENTAR VALIDACION DE RANGO DE FECHAS FECHAS
					}else if(modo==2){ // 2	CERRADO
						//console.log(IndexDAO.Fecha_Hoy());					

						if(fchdesde<=xxidfechgestion && fchhasta>=xxidfechgestion){
							var fechahoy=IndexDAO.Fecha_Hoy().split(" ");
							if(fechahoy[0]==xidfechgestion[0].split("/").reverse().join("-")){							

								if(xxidfechgestion==""){
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar fecha gestion");
									return false;
								}
								if(idcliente=="" && idfundo==""){
									//alert("Ingresar Distribuidor o Ingresar fundo");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar Distribuidor o fundo");
                					return false;
								}
								// if(idcultivo==""){
								// 	//alert("Ingresar cultivo");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar cultivo");
								// 	return false;
								// }
								if(idobjetivo==""){
									//alert("Ingresar objetivo");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar objetivo");
									return false;
								}
								// if(area==""){
								// 	//alert("Ingresar area");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar area");
								// 	return false;
								// }

								esEntero(area);

								// if(idproblema==""){
								// 	//alert("Ingresar problema");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar problema");
								// 	return false;
								// }
								if(idzona==""){
									//alert("Ingresar zona");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar zona");
									return false;
								}
								if(lugarvisita==""){
									//alert("Ingresar lugar visita");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar lugar visita");
									return false;
								}		
								// if(idproductos==""){
								// 	// alert("Ingresar productos");
								// 	alertify.set({ delay: 5000 });
								// 	alertify.log("Ingresar productos");
								// 	return false;
								// }

								if(idtipo_cliente==""){
									// alert("Ingresar productos");
									alertify.set({ delay: 5000 });
                					alertify.log("Ingresar tipo cliente");
									return false;
								}

							 	var html="";
							 	html+='';
								html+='<tr >';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idgestion+'">'+idgestion+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:100px;text-align: center;" title="'+idfechgestion+'">'+idfechgestion+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idcliente+'">'+idcliente+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+cliente+'">'+cliente+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idfundo+'">'+idfundo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+fundo+'">'+fundo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idzona+'">'+idzona+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+zona+'">'+zona+'</div></td>';

									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idtipo_cliente+'">'+idtipo_cliente+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+tipo_cliente+'">'+tipo_cliente+'</div></td>';

									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;text-transform: uppercase;" title="'+lugarvisita+'">'+lugarvisita+'</div></td></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idobjetivo+'">'+idobjetivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+objetivo+'">'+objetivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idcultivo+'">'+idcultivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+cultivo+'">'+cultivo+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:100px;" title="'+area+'">'+area+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:36px;text-align: center;" title="'+idproblema+'">'+idproblema+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+problema+'">'+problema+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;display:none;"><div class="contenido_texto"   style="width:100px;text-align: center;" title="'+idproductos+'">'+idproductos+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;" title="'+productos+'">'+productos+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;"><div class="contenido_texto"   style="width:200px;text-transform: uppercase;" title="'+idobservacion+'">'+idobservacion+'</div></td>';
									html+='<td style="font-family: Conv_FuturaNormal;font-size: 11px;text-align: center;"><img id="idquitarreg" src="../img/Minus.png" style="width:16px;"></td>';
								html+='</tr>';
							 	$("#idgestiones table tbody").append(html);
							}else{
								alertify.set({ delay: 5000 });
                				alertify.log("La fecha de gestion debe deber igual al de hoy");
							}
						}else{
							alertify.set({ delay: 5000 });
                			alertify.log("La fecha de gestion debe estar dentro del rango de cierre");
						}

					}
				}else{
					alertify.set({ delay: 5000 });
                    alertify.log("No hay cierre activo");
				}
			}else{
				alertify.set({ delay: 5000 });
                alertify.error("Error al Consultar Cierre");
			}
		});

	});

	$('#dialogrecorrido').dialog({
        height : 300,
        autoOpen : false,
        width : 300,
        title : 'INGRESAR RECORRIDO POR DIA',
        buttons : {
            Cancel : function () {
                $(this).dialog('close');
            },
            Aceptar : function () {
                //$(this).dialog('close');

                var xfechareco=[];
				for(var i=0;i<=$('#dialogrecorrido table').find('tr').length-1;i++){

					var ini=$('#dialogrecorrido table tr:eq('+i+')').find("td:eq("+3+") input").val();
					var fin=$('#dialogrecorrido table tr:eq('+i+')').find("td:eq("+5+") input").val();

					if(ini==""){
						alert("ingresar recorrido inicio");
						return false;
					}
					if(fin==""){
						alert("ingresar recorrido fin");
						return false;
					}

					var data={ 
						"fechgestion": 	$('#dialogrecorrido table tr:eq('+i+')').find("td:eq("+1+")").text(),
						"inicio": 	$('#dialogrecorrido table tr:eq('+i+')').find("td:eq("+3+") input").val(),
						"fin": 	$('#dialogrecorrido table tr:eq('+i+')').find("td:eq("+5+") input").val()
					}
					xfechareco.push(data);
				}

				RegistroGestionDAO.RegistrarRecorrido(xfechareco,function(obj){
					//$("#idgrabar").click();
					//$("#idlimpiar").click();
					//$("#idgestiones table tbody tr").remove();
					if (obj.rst) {
						$("#idgrabar").click();
					}else{
						
					}	
				});

				$(this).dialog('close');

            },
        }
    }); 

	$("#idgrabar").live("click",function(){
		

		var xgestion=[];
		var fecha_gestion=[];
		for(var i=0;i<=$('#idgestiones table tbody').find('tr').length-1;i++){

			var xfecha_gestion=$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+1 +")").text().split(" ");
			fecha_gestion.push(xfecha_gestion[0]);

			var data={ 
				"idgestion": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+0 +")").text(),
				"fechgestion": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+1 +")").text(),
				"idcliente": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+2 +")").text(),
				"cliente": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+3 +")").text(),
				"idfundo": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+4 +")").text(),
				"fundo": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+5 +")").text(),
				"idzona": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+6 +")").text(),
				"zona": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+7 +")").text(),

				"idtipo_cliente": 	$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+8 +")").text(),
				"tipo_cliente":		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+9 +")").text(),

				"lugar": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+10 +")").text(),
				"idobjetivo": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+11 +")").text(),
				"objetivo": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+12+")").text(),
				"idcultivo": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+13+")").text(),
				"cultivo": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+14+")").text(),

				"area": 			$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+15+")").text(),
				"idproblema": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+16+")").text(),
				"problema": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+17+")").text(),
				"idproductos": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+18+")").text(),
				"productos":   		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+19+")").text(),
				"observacion": 		$('#idgestiones table tbody tr:eq('+i+')').find("td:eq("+20+")").text()
			}
			xgestion.push(data);
		}

		var uniquedate = [];
		$.each(fecha_gestion, function(i, el){
			if($.inArray(el, uniquedate) === -1) uniquedate.push(el);
		});

		// console.log(xgestion);
		// return false;

		//RegistroGestionDAO.VerificarRecorrido(uniquedate);
		//$('#dialogrecorrido').dialog('open');

		if ($('#idgestiones table tbody').find('tr').length!=0) {
			RegistroGestionDAO.VerificarRecorrido(uniquedate,function(obj){
				//console.log(obj.fecha_recor);
				//return false;

				if(obj.fecha_recor.length==0){
					// alert(1);			
					RegistroGestionDAO.RegistrarGestion(xgestion); //alert("SE GRABA");
				}else{
					// alert(2);
					var html="";
					html+='<table>';
					for(var j=0;j<=obj.fecha_recor.length-1;j++){
						html+='<tr>';
						html+='<td style="width: 10px;">&nbsp;</td>';
						html+='<td align="left" valign="middle" style="width: 130px;height: 35px;">';
						html+='<span style="font-family: Conv_FuturaNormal;font-size: 14px;">'+obj.fecha_recor[j]+'</span>';
						html+='</td>';
						html+='<td style="width: 10px;">&nbsp;</td>';
						html+='<td align="left" valign="middle" style="width: 200px;height: 35px;">';
						html+='<input class="textbox" name=""  style="width:95px;float:left;text-align:center;" id="xinicio" placeholder="INICIO" step="0.01"  type="number" onkeypress="return onKeyDecimal(event,this);">';
						html+='</td>';
						html+='<td style="width: 10px;">&nbsp;</td>';
						html+='<td align="left" valign="middle" style="width: 200px;height: 35px;">';
						html+='<input class="textbox" name=""  style="width:95px;float:right;text-align:center;" id="xfin" placeholder="FIN" step="0.01"  type="number" onkeypress="return onKeyDecimal(event,this);">';
						html+='</td>';
						html+='<td style="width: 10px;">&nbsp;</td>';
						html+='</tr>';
					}
					html+='</table>';
					$("#dialogrecorrido").html(html);
					$('#dialogrecorrido').dialog('open');
				}

	        });
	    }else if($('#idgestiones table tbody').find('tr').length==0){
	    	alertify.set({ delay: 5000 });
			alertify.log("No hay ningun Registro");
	    }


		//console.log(uniqueNames);
		// if ($('#idgestiones table tbody').find('tr').length!=0) {
		// 	RegistroGestionDAO.RegistrarGestion(xgestion);
		// }else if($('#idgestiones table tbody').find('tr').length==0){
		// 	alert("No hay ningun Registro");
		// }

		// $("#idsearchfechgestion").keyup(function() {
		// 	if(e.keyCode == 13){
		// 		alert("Hola");
		//   //       $("#table_list_gestion").jqGrid('setGridParam',{
		// 		//     datatype : 'json',
		// 		//     url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()
		// 		// }).trigger("reloadGrid");
		// 	}
		// });

		// $('#idsearchfechgestion').live('keypress', function(e) {
		//     if(e.keyCode==13){
		//         alert("Hola");
		//     }
		// });
	});

    $("#idagric_fundo,#idcultivo").change(function(){
		    RegistroGestionDAO.QUERYListarArea();
    });

	$('#idgestiones table tbody tr').live("click",function(){
		var row_index = $(this).index();
		$('#idgestiones table tbody tr:eq('+row_index+')').remove();
	}); 

	$("#idlimpiar").click(function(){
		$("#idfechgestion").val('');
		$("#hdidcliente").val("");
		$("#cliente").val("");
		$("#hdidobjetivo").val("");
		$("#objetivo").val("");
		$("#hdidproblema").val("");
		$("#problema").val("");
		$("#hdidfundo").val("");
		$("#fundo").val("");
		$("#hdidcultivo").val("");
		$("#cultivo").val("");
		$("#area").val('');
		$("#idzona").val('');
		$("#idlugarvisita").val('');
		$("#idobservacion").val('');
		$("#hdcodproduc").val("");
		$("table#listproductos tr").remove();

		$("#idtipo_cliente").val("");

	});

	$("#cliente").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidcliente").val("");
			var dtr=$("#cliente").val();
			if(dtr.length==0){
				html="";
				$("#searchcliente").html(html);
				$("#searchcliente").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarCliente(dtr);
			}
		} else if (event.type == 'click') {
			var dtr=$("#cliente").val();
			if(dtr.length==0){
				html="";
				$("#searchcliente").html(html);
				$("#searchcliente").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarCliente(dtr);
			}
		}	
	});
	$("#fundo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidfundo").val("");
			var fdo=$("#fundo").val();
			if(fdo.length==0){
				html="";
				$("#searchfundo").html(html);
				$("#searchfundo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarFundo(fdo);
			}
		} else if (event.type == 'click') {
			var fdo=$("#fundo").val();
			if(fdo.length==0){
				html="";
				$("#searchfundo").html(html);
				$("#searchfundo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarFundo(fdo);
			}
		}
	});
	$("#cultivo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidcultivo").val("");
			var cvo=$("#cultivo").val();
			if(cvo.length==0){
				html="";
				$("#searchcultivo").html(html);
				$("#searchcultivo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarCultivo(cvo);
			}
		} else if (event.type == 'click') {
			var cvo=$("#cultivo").val();
			if(cvo.length==0){
				html="";
				$("#searchcultivo").html(html);
				$("#searchcultivo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarCultivo(cvo);
			}
		}
	});
	$("#objetivo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidobjetivo").val("");
			var obj=$("#objetivo").val();
			if(obj.length==0){
				html="";
				$("#searchobjetivo").html(html);
				$("#searchobjetivo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarMotivo(obj);
			}
		} else if (event.type == 'click') {
			var obj=$("#objetivo").val();
			if(obj.length==0){
				html="";
				$("#searchobjetivo").html(html);
				$("#searchobjetivo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarMotivo(obj);
			}
		}
	});
	$("#problema").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidproblema").val("");
			var prob=$("#problema").val();
			if(prob.length==0){
				html="";
				$("#searchproblema").html(html);
				$("#searchproblema").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarActividad(prob);
			}
		} else if (event.type == 'click') {
			var prob=$("#problema").val();
			if(prob.length==0){
				html="";
				$("#searchproblema").html(html);
				$("#searchproblema").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarActividad(prob);
			}
		}
	});
	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='cliente'){
			$('#searchcliente').hide();  
		}
		if(idinput!='fundo'){
			$('#searchfundo').hide();  
		}
		if(idinput!='cultivo'){
			$('#searchcultivo').hide();  
		}
		if(idinput!='objetivo'){
			$('#searchobjetivo').hide();  
		}
		if(idinput!='problema'){
			$('#searchproblema').hide();  
		}
	});

	$("#bsqcliente").live('keyup click keydown',function(event){
		if (event.type == 'keyup') {
			$("#hdidbsqcliente").val("");
			var elem=$("#bsqcliente").val();
			if(elem.length==0){
				html="";
				$("#searchbsqcliente").html(html);
				$("#searchbsqcliente").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarBsqCliente(elem);
			}
		} else if (event.type == 'click') {
			var elem=$("#bsqcliente").val();
			if(elem.length==0){
				html="";
				$("#searchbsqcliente").html(html);
				$("#searchbsqcliente").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarBsqCliente(elem);
			}
		} else if (event.type == 'keydown') {
			if( event.which === 90 && event.ctrlKey ){
				$("#hdidbsqcliente").val("");
				var elem=$("#bsqcliente").val();
				
			}
		}

	});

	$("#bsqobjetivo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidbsqobjetivo").val("");
			var elem=$("#bsqobjetivo").val();
			if(elem.length==0){
				html="";
				$("#searchbsqobjetivo").html(html);
				$("#searchbsqobjetivo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarBsqMotivo(elem);
			}
		} else if (event.type == 'click') {
			var elem=$("#bsqobjetivo").val();
			if(elem.length==0){
				html="";
				$("#searchbsqobjetivo").html(html);
				$("#searchbsqobjetivo").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarBsqMotivo(elem);
			}
		}
	});

	$("#bsqproblema").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidbsqproblema").val("");
			var elem=$("#bsqproblema").val();
			if(elem.length==0){
				html="";
				$("#searchbsqproblema").html(html);
				$("#searchbsqproblema").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarBsqActividad(elem);
			}
		} else if (event.type == 'click') {
			var elem=$("#bsqproblema").val();
			if(elem.length==0){
				html="";
				$("#searchbsqproblema").html(html);
				$("#searchbsqproblema").css({'display':'none'});
			}else{
				RegistroGestionDAO.QUERYListarBsqActividad(elem);
			}
		}
	});

	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='bsqcliente'){
			$('#searchbsqcliente').hide();  
		}
		// if(idinput!='fundo'){
		// 	$('#searchfundo').hide();  
		// }
		// if(idinput!='cultivo'){
		// 	$('#searchcultivo').hide();  
		// }
		if(idinput!='bsqobjetivo'){
			$('#searchbsqobjetivo').hide();  
		}
		if(idinput!='bsqproblema'){
			$('#searchbsqproblema').hide();  
		}
	});

	$("#area").keypress(function () {

        //Only allow period and numbers
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }

        //Prevent a period being entered first
        else if (event.which == 46 && $(this).val().length == 0) {
           event.preventDefault();
        }

        //Only two numbers after a decimal
        else if (($(this).val().indexOf('.') != -1) && ($(this).val().substring($(this).val().indexOf('.'), $(this).val().indexOf('.').length).length > 3)) {
           event.preventDefault();
        }
    });

});

/*AGREGAR ITEM A ARRAY*/
function agregarprod(xid){



	var codprod = [];
	a="";
	if($("#hdcodproduc").val()==""){
		$("#hdcodproduc").val(xid+'@'+$("#prod table tr#product_"+xid).find("td:nth-child(3)").text());
		codprod=$("#hdcodproduc").val().split(",");
	}else{
		a=$("#hdcodproduc").val()+","+xid+'@'+$("#prod table tr#product_"+xid).find("td:nth-child(3)").text();
		$("#hdcodproduc").val("");
		$("#hdcodproduc").val(a);
		codprod.length=0; //limpiando el array nuevamente
		codprod=$("#hdcodproduc").val().split(",");
	}
	codprod.sort();

	var uniqueNames = [];
	$.each(codprod, function(i, el){
	    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});

	$("#hdcodproduc").val(uniqueNames.toString());

	// $("#listproductos").empty();
	// for(i=0;i<=uniqueNames.length-1;i++){
	// 	var xhtml="";
	// 	xhtml+='<tr>';
	// 	xhtml+='<td style="width:20px;padding:5px;"><span style="float: right;font-family: open_sansbold;font-size: 10px;">'+uniqueNames[i]+'</span></td>';
	// 	xhtml+='<td style="width:260px;padding:5px;font-family: open_sansbold;font-size: 10px;">';
	// 	xhtml+=$("#prod table tr#product_"+uniqueNames[i]).find("td:nth-child(2)").html();
	// 	xhtml+='</td>';
	// 	xhtml+='<td><img id="quit_'+uniqueNames[i]+'" src="../img/Minus.png" style="width:16px;" ></td>';
	// 	xhtml+='</tr>';
	// 	$("#listproductos").append(xhtml);
	// }

	// console.log(uniqueNames);

	$("#listproductos").empty();
	for(i=0;i<=uniqueNames.length-1;i++){
		// var xhtml="";
		// xhtml+='<tr>';
		// xhtml+='<td style="width:20px;padding:5px;"><span style="float: right;font-family: open_sansbold;font-size: 10px;">'+uniqueNames[i]+'</span></td>';
		// xhtml+='<td style="width:260px;padding:5px;font-family: open_sansbold;font-size: 10px;">';
		// xhtml+=$("#prod table tr#product_"+uniqueNames[i]).find("td:nth-child(2)").html();
		// xhtml+='</td>';
		// xhtml+='<td><img id="quit_'+uniqueNames[i]+'" src="../img/Minus.png" style="width:16px;" ></td>';
		// xhtml+='</tr>';
		// $("#listproductos").append(xhtml);

		// alert(uniqueNames[i]);

		var ar_prod = [];
		ar_prod = uniqueNames[i].split("@")
		// alert(ar_prod[0]+'---'+ar_prod[1]);

		var xhtml="";
		xhtml+='<tr>';
		xhtml+='<td style="width:20px;padding:5px;"><span style="float: right;font-family: open_sansbold;font-size: 10px;">'+ar_prod[0]+'</span></td>';
		xhtml+='<td style="width:260px;padding:5px;font-family: open_sansbold;font-size: 10px;">';
		xhtml+=ar_prod[1];
		xhtml+='</td>';
		xhtml+='<td><img id="quit_'+ar_prod[0]+'" src="../img/Minus.png" style="width:16px;" ></td>';
		xhtml+='</tr>';
		$("#listproductos").append(xhtml);

	}

}
/*AGREGAR ITEM A ARRAY*/

function deleteRow(id){
	$("#table_temp_gestion").jqGrid('delRowData', id);
}

function onKeyDecimal(e,thix) {
	var keynum = window.event ? window.event.keyCode : e.which;
	if (document.getElementById(thix.id).value.indexOf('.') != -1 && keynum == 46)
	    return false;
	if ((keynum == 8 || keynum == 48 || keynum == 46))
	    return true;
	if (keynum <= 47 || keynum >= 58) return false;
	return /\d/.test(String.fromCharCode(keynum));
}

function GetIndex(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if(elem=='idsearchdesdefechgestion' || elem=='idsearchhastafechgestion' || elem=='bsqcliente' || elem=='bsqobjetivo' || elem=='bsqproblema'){
		$("#table_list_gestion").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val()
		}).trigger("reloadGrid");
    }
}

/*function GetIndex_ctrl(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if(elem=='idsearchdesdefechgestion' || elem=='idsearchhastafechgestion' || elem=='bsqcliente' || elem=='bsqobjetivo' || elem=='bsqproblema'){
		$("#table_list_gestion").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val()
		}).trigger("reloadGrid");
    }
}*/

$("#idsearchdesdefechgestion,#idsearchhastafechgestion").live("keypress",function(e){
	if(e.which == '13'){
		$("#table_list_gestion").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val()
		}).trigger("reloadGrid");
    }
});
$("#bsqcliente,#bsqobjetivo,#bsqproblema").live("keyup",function(e){



    if(e.which == '46') {
        $("#table_list_gestion").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val()
		}).trigger("reloadGrid");
    }
});
$("#buscarv").live("click",function(e){
	$("#table_list_gestion").jqGrid('setGridParam',{
		datatype : 'json',
		url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val()
	}).trigger("reloadGrid");
});

function esEntero(numero){
    if (isNaN(numero)){
        //alert ("Ups... " + numero + " no es un número.");
        alertify.set({ delay: 5000 });
		alertify.log("Ingresar en area solo numeros");
		return false;
    }
    else{
        if (numero % 1 == 0) {
            //alert ("Es un numero entero");
        }
        else{
            //alert ("Es un numero decimal");
        }
    }
}