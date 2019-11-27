$(document).ready(function(){
	// ProductoDAO.QUERYListarProducto();
	ProductoJQGRID.Consultar_Producto();

	$("#sproducto").live('keyup click',function(event){
		if (event.type == 'keyup') {
			$("#hdidproducto").val("");
			var prod=$("#sproducto").val();
			if(prod.length==0){
				html="";
				$("#searchproducto").html(html);
				$("#searchproducto").css({'display':'none'});
			}else{
				ProductoDAO.QUERYListarProducto(prod);
			}
		} else if (event.type == 'click') {
			var prod=$("#sproducto").val();
			if(prod.length==0){
				html="";
				$("#searchproducto").html(html);
				$("#searchproducto").css({'display':'none'});
			}else{
				ProductoDAO.QUERYListarProducto(prod);
			}
		}
	});
	$("body").click(function(event){
		var idinput=event.target.id;
		if(idinput!='sproducto'){
			$('#searchproducto').hide();  
		}		
	});

	
	$("#producto").live('keyup',function(event){
		ProductoDAO.VerificarDuplicado();
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

// $('#producto').live('keypress change',function(e) {
// 	if (e.which == '13') {
// 		$("#table_list_producto").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=producto&action=ListProducto&idproducto='+$('#hdidproducto').val()
// 		}).trigger("reloadGrid");
// 	}else{
// 		$("#table_list_producto").jqGrid('setGridParam',{
// 			datatype : 'json',
// 			url:'../controller/ControllerAlfa.php?command=producto&action=ListProducto&idproducto='+$('#hdidproducto').val()
// 		}).trigger("reloadGrid");
// 	}
// });

function GetIndex(index,hdelem,elem,table,symb){
    $("#"+hdelem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(0)").text());
    $("#"+elem).val($('#'+table+' tr#'+symb+index.rowIndex).find("td:eq(1)").text());

    if(elem=='sproducto'){
    	$("#table_list_producto").jqGrid('setGridParam',{
			datatype : 'json',
			url:'../controller/ControllerAlfa.php?command=producto&action=ListProducto&idproducto='+$('#hdidproducto').val()
		}).trigger("reloadGrid");
    }	    

}


