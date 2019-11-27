$(document).ready(function(){
	CierreDAO.QUERYListarCierreProgramacion(0);
	CierreDAO.QUERYListarCierreModo(0);
	CierreJQGRID.Consultar_Cierre();
	// CierreDAO.Verificar_Activo_Cierre();
	$('#sini,#sfin').mask("99/99/2099 99:99:99");

	// $("#savecierre").click(function(){

	// 	var today = new Date();
	// 	var dd = today.getDate();
	// 	var mm = today.getMonth()+1; //January is 0!
	// 	var yyyy = today.getFullYear();

	// 	if(dd<10) {
	// 	    dd='0'+dd
	// 	} 

	// 	if(mm<10) {
	// 	    mm='0'+mm
	// 	} 

	// 	hoy = yyyy+'-'+mm+'-'+dd;
	// 	//document.write(today);

	// 	var dd1=$('#idcierreini').val().split(" ");
	// 	var dd2=$('#idcierrefin').val().split(" ");
	// 	var xd1=dd1[0]; // Extraigo solo fecha y no hora
	// 	var xd2=dd2[0];

	// 	d1= xd1.split("/").reverse().join("-");
	// 	d2= xd2.split("/").reverse().join("-");

	// 	nw= hoy;

	// 	if(d1<nw){
	// 		//alert("FECHA DESDE DEBE SER MAYOR O IGUAL A HOY");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Fecha desde debe ser mayor o igual a hoy");
	// 		return false;
	// 	}
	// 	if(d2<nw){
	// 		//alert("FECHA HASTA DEBE SER MAYOR O IGUAL A HOY");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Fecha hasta desde der mayor o igual a hoy");
	// 		return false;
	// 	}
	// 	if(d1>d2){
	// 		//alert("FECHA DESDE MENOR O IGUAL FECHA HASTA");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Fecha desde menor o igual fecha hasta");
	// 		return false;
	// 	}

	// 	if($("#idcierreini").val()==""){
	// 		//alert("INGRESAR FECHA INICIO");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Ingresar fecha inicio");
	// 		return false;
	// 	}
	// 	if($("#idcierreprogramacion").val()==""){
	// 		//alert("SELECCIONAR PROGRAMACION");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Seleccionar Programación");
	// 		return false;
	// 	}
	// 	if($("#idcierremodo").val()==""){
	// 		//alert("SELECCIONAR MODO DE CIERRE");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Seleccionar modo de cierre");
	// 		return false;
	// 	}
	// 	if($("#idcierrefin").val()==""){
	// 		//alert("INGRESAR FECHA FIN");
	// 		alertify.set({ delay: 5000 });
	// 		alertify.log("Ingresar fecha fin");
	// 		return false;
	// 	}

	// 	//alert("BIEN");

	// });

// scierreprogramacion
// scierremodo
// sini
// sfin

	function listcierre(){
		$("#table_list_cierre").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=cierre&action=ListCierre&ini='+$('#sini').val()+'&fin='+$('#sfin').val()+'&programacion='+$('#scierreprogramacion').val()+'&modo='+$("#scierremodo").val()
		}).trigger("reloadGrid");
	}

	$('#sini,#sfin').live('keypress',function(e){
		if (e.which == '13') {
			listcierre();
		}
	});
	$('#scierreprogramacion,#scierremodo').live('change',function(e){
		listcierre();
	});


});

	

