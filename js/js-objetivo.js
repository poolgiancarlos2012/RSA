$(document).ready(function(){
	// ObjetivoDAO.QUERYListarObjetivo();
	ObjetivoJQGRID.Consultar_Objetivo();

	$("#objetivo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidobjetivo").val("");
			var obj=$("#objetivo").val();
			if(obj.length==0){
				html="";
				$("#searchobjetivo").html(html);
				$("#searchobjetivo").css({'display':'none'});
			}else{
				ObjetivoDAO.QUERYListarObjetivo(obj);
			}
		} else if (event.type == 'click') {
			var obj=$("#objetivo").val();
			if(obj.length==0){
				html="";
				$("#searchobjetivo").html(html);
				$("#searchobjetivo").css({'display':'none'});
			}else{
				ObjetivoDAO.QUERYListarObjetivo(obj);
			}
		}
	});

	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='objetivo'){
			$('#searchobjetivo').hide();  
		}
	});

	$("#motivo").live('keyup',function(event){
		ObjetivoDAO.VerificarDuplicado();
	});
	
});
// $('#objetivo').live('keypress change',function(e) {
// 	if (e.which == '13') {
// 		$("#table_list_objetivo").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo&idmotivo='+$('#hdidobjetivo').val()
// 		}).trigger("reloadGrid");
// 	}else{
// 		$("#table_list_objetivo").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo&idmotivo='+$('#hdidobjetivo').val()
// 		}).trigger("reloadGrid");
// 	}
// });
function GetIndex(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if(elem=='objetivo'){
    	$("#table_list_objetivo").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo&idmotivo='+$('#hdidobjetivo').val()
		}).trigger("reloadGrid");
    }
		

}