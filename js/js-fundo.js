$(document).ready(function(){
	// FundoDAO.QUERYListarFundo();
	FundoJQGRID.Consultar_Fundo();

	$("#fundo").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidfundo").val("");
			var fdo=$("#fundo").val();
			if(fdo.length==0){
				html="";
				$("#searchfundo").html(html);
				$("#searchfundo").css({'display':'none'});
			}else{
				FundoDAO.QUERYListarFundo(fdo);
			}
		} else if (event.type == 'click') {
			var fdo=$("#fundo").val();
			if(fdo.length==0){
				html="";
				$("#searchfundo").html(html);
				$("#searchfundo").css({'display':'none'});
			}else{
				FundoDAO.QUERYListarFundo(fdo);
			}
		}
	});
	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='fundo'){
			$('#searchfundo').hide();  
		}		
	});

	
	$("#datos").live('keyup',function(event){
		FundoDAO.VerificarDuplicado();
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

    if(elem=='fundo'){
    	$("#table_list_fundo").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=fundo&action=ListFundo&idfundo='+$('#hdidfundo').val()
		}).trigger("reloadGrid");
    }	    

}


