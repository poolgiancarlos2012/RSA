$(document).ready(function(){
	// FundoDAO.QUERYListarFundo();
	DistribuidorJQGRID.Consultar_Distribuidor();

	$("#sdistribuidor").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdiddistribuidor").val("");
			var dist=$("#sdistribuidor").val();
			if(dist.length==0){
				html="";
				$("#searchdistribuidor").html(html);
				$("#searchdistribuidor").css({'display':'none'});
			}else{
				DistribuidorDAO.QUERYListarDistribuidor(dist);
			}
		} else if (event.type == 'click') {
			var dist=$("#sdistribuidor").val();
			if(dist.length==0){
				html="";
				$("#searchdistribuidor").html(html);
				$("#searchdistribuidor").css({'display':'none'});
			}else{
				DistribuidorDAO.QUERYListarDistribuidor(dist);
			}
		}
	});
	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='sdistribuidor'){
			$('#searchdistribuidor').hide();  
		}		
	});

	
	$("#distribuidor").live('keyup',function(event){
		DistribuidorDAO.VerificarDuplicado();
	});

	// //var characterReg = /[`~!@#$%^&*()_°¬|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
	// var characterReg = /[a-z]|[`~!@#$%^&*()_°¬|+\-=¿?;:!¡'",.<>\d\{\}\[\]\\\/]/gi;
 //    $('#datos').live("keyup", function(event){		
	// 	var inputVal = $(this).val();		
	// 	if(characterReg.test(inputVal)) {			
	// 		//$(this).val(inputVal.replace(/[a-z]|[`~!@#$%^&*()_|+\-=¿?;:!¡'",.<>\{\}\[\]\\\/]/gi,''));
	// 	}else{
	// 		$(this).val(inputVal.replace(characterReg,''));
	// 	}

	// 	// var inputVal = $(this).val();		
	// 	// if(characterReg.test(inputVal)) {
	// 	// 	$(this).val(inputVal.replace(/^\d*$/gi,''));			
	// 	// }

	// });

	// $('#datos').live("keyup",function() {
	//     var val = $(this).val();
	//     var is_numeric = /^\d+$/gi.test(val);
	//     if (is_numeric) {
	//         var val = parseInt(val);
	//         var within_range = (val >= 2 && val <= 1827);
	//     }
	//     if  (!is_numeric || !within_range) {
	//         $(this).val("SI");
	//     }
	// });

	// $('#datos').live("keyup",function() {
	// 	const regex = /[abc]+/g;
	// 	const str = $(this).val();
	// 	let m;

	// 	while ((m = regex.exec(str)) !== null) {
	// 	    // This is necessary to avoid infinite loops with zero-width matches
	// 	    if (m.index === regex.lastIndex) {
	// 	        regex.lastIndex++;
	// 	    }
		    
	// 	    // The result can be accessed through the `m`-variable.
	// 	    var acu="";
	// 	    m.forEach((match, groupIndex) => {
	// 	    	acu+=match
	// 	        console.log(`Found match, group ${groupIndex}: ${acu}`);
	// 	    });
	// 	}
	// });


	

});

// $('#fundo').live('keypress change',function(e) {
// 	if (e.which == '13') {
// 		$("#table_list_fundo").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=fundo&action=ListFundo&idfundo='+$('#hdidfundo').val()
// 		}).trigger("reloadGrid");
// 	}else{
// 		$("#table_list_fundo").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=fundo&action=ListFundo&idfundo='+$('#hdidfundo').val()
// 		}).trigger("reloadGrid");
// 	}
// });

function GetIndex(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if(elem=='sdistribuidor'){
    	$("#table_list_distribuidor").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=distribuidor&action=ListDistribuidor&iddistribuidor='+$('#hdiddistribuidor').val()
		}).trigger("reloadGrid");
    }	    

}


