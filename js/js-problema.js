$(document).ready(function(){
	ProblemaDAO.QUERYListarProblema();
	ProblemaJQGRID.Consultar_Problema();

	$("#problema").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidproblema").val("");
			var prob=$("#problema").val();
			if(prob.length==0){
				html="";
				$("#searchproblema").html(html);
				$("#searchproblema").css({'display':'none'});
			}else{
				ProblemaDAO.QUERYListarProblema(prob);
			}
		} else if (event.type == 'click') {
			var prob=$("#problema").val();
			if(prob.length==0){
				html="";
				$("#searchproblema").html(html);
				$("#searchproblema").css({'display':'none'});
			}else{
				ProblemaDAO.QUERYListarProblema(prob);
			}
		}
	});

	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='problema'){
			$('#searchproblema').hide();  
		}
	});

	$("#actividad").live('keyup',function(event){
		ProblemaDAO.VerificarDuplicado();
	});

});

function GetIndex(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if (elem == 'problema') {
		$("#table_list_problema").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=problema&action=ListProblema&idactividad='+$('#hdidproblema').val()
		}).trigger("reloadGrid");
	}
    
}