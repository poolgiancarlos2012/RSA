var UsuarioDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarUsuario:function(xusu){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'usuario',
	            action:'QUERYListarUsuario',
	            usu:xusu
	        },
	        success:function(obj){
	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tableusu'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='usu"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidusuario\",\"susuario\",\"tableusu\",\"usu\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idusuario']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['usuario']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchusuario").css({'display':'block'});
                    $("#searchusuario").html(html);
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
	            command:'usuario',
	            action:'VerificarDuplicado',
	            usu: $("#nombre").val().trim()+" "+$("#paterno").val().trim()+" "+$("#materno").val().trim()
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
	},
	VerificarUsuario:function(){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'usuario',
	            action:'VerificarUsuario',
	            usuario:$("#usuario").val().trim()
	        },
	        success:function(obj){
	            if( obj.rst ){
                    $("#verifyusu").val(obj.count);
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