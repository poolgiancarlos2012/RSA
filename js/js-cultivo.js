$(document).ready(function(){
	CultivoDAO.QUERYListarCultivo();
	CultivoJQGRID.Consultar_Cultivo();


	$("#xcultivo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidcultivo").val("");
			var cvo=$("#xcultivo").val();
			if(cvo.length==0){
				html="";
				$("#searchcultivo").html(html);
				$("#searchcultivo").css({'display':'none'});
			}else{
				CultivoDAO.QUERYListarCultivo(cvo);
			}
		} else if (event.type == 'click') {
			var cvo=$("#xcultivo").val();
			if(cvo.length==0){
				html="";
				$("#searchcultivo").html(html);
				$("#searchcultivo").css({'display':'none'});
			}else{
				CultivoDAO.QUERYListarCultivo(cvo);
			}
		}
	});

	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='cultivo'){
			$('#searchcultivo').hide();  
		}
	});

	$("#cultivo").live('keyup',function(event){
		CultivoDAO.VerificarDuplicado();
	});

});
// $('#xcultivo').live('keypress change',function(e) {
// 	if (e.which == '13') {
// 		$("#table_list_cultivo").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=cultivo&action=ListCultivo&idcultivo='+$('#hdidcultivo').val()
// 		}).trigger("reloadGrid");
// 	}else{
// 		$("#table_list_cultivo").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=cultivo&action=ListCultivo&idcultivo='+$('#hdidcultivo').val()
// 		}).trigger("reloadGrid");
// 	}
// });

function GetIndex(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if(elem=='xcultivo'){
    	$("#table_list_cultivo").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=cultivo&action=ListCultivo&idcultivo='+$('#hdidcultivo').val()
		}).trigger("reloadGrid");
    }

}