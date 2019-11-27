var ProductoDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarProducto:function(xprod){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'producto',
	            action:'QUERYListarProducto',
	            prod:xprod
	        },
	        success:function(obj){
	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tableprod'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='prod"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidproducto\",\"sproducto\",\"tableprod\",\"prod\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idproducto']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['producto']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchproducto").css({'display':'block'});
                    $("#searchproducto").html(html);
                }else{                           
                }
	        },
	        complete:function(){
	        },
	        error:function(){
	        } 
	    });
	},
	VerificarDuplicado:function(){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'producto',
	            action:'VerificarDuplicado',
	            prod: $("#producto").val()
	        },
	        success:function(obj){
	            if( obj.rst ){
                    $("#verifydup").val(obj.count);
                }else{                           
                }
	        },
	        complete:function(){
	        },
	        error:function(){
	        } 
	    });
	}
}