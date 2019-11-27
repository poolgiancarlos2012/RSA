var CultivoDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarCultivo:function(xcvo){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'cultivo',
	            action:'QUERYListarCultivo',
	            cvo:xcvo
	        },
	        success:function(obj){
	            // if( obj.rst ){
	            //     var fundo="idmansearchcultivo";
	            //     var html = '';
	            //     html+="<option value=''>.:SELECCIONE:.</option>";
	            //     for(var i=0;i<obj.datos.fila.length;i++){
	            //         html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";                    
	            //     }
	            //     $('#'+fundo).html(html);
	            // }else{                           
	            // }

	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tablecvo'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='cvo"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidcultivo\",\"xcultivo\",\"tablecvo\",\"cvo\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idcultivo']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['cultivo']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchcultivo").css({'display':'block'});
                    $("#searchcultivo").html(html);
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
	            command:'cultivo',
	            action:'VerificarDuplicado',
	            cvo: $("#cultivo").val().toUpperCase()
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