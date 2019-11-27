var ObjetivoDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarObjetivo:function(xobj){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'objetivo',
	            action:'QUERYListarObjetivo',
	            obje:xobj
	        },
	        success:function(obj){

	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tableobj'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='obj"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidobjetivo\",\"objetivo\",\"tableobj\",\"obj\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idmotivo']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['motivo']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchobjetivo").css({'display':'block'});
                    $("#searchobjetivo").html(html);
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
	            command:'objetivo',
	            action:'VerificarDuplicado',
	            obje: $("#motivo").val().toUpperCase()
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