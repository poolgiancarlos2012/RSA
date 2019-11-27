var ProblemaDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
    QUERYListarProblema:function(xprob){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'problema',
	            action:'QUERYListarProblema',
	            prob:xprob
	        },
	        success:function(obj){
	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tableprob'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='prob"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidproblema\",\"problema\",\"tableprob\",\"prob\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idactividad']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['actividad']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchproblema").css({'display':'block'});
                    $("#searchproblema").html(html);
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
	            command:'problema',
	            action:'VerificarDuplicado',
	            prob: $("#actividad").val()
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