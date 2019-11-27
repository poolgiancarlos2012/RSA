var FundoDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarFundo:function(xfdo){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'fundo',
	            action:'QUERYListarFundo',
	            fdo:xfdo
	        },
	        success:function(obj){
	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tablefdo'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='fdo"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidfundo\",\"fundo\",\"tablefdo\",\"fdo\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idfundo']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['datos']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchfundo").css({'display':'block'});
                    $("#searchfundo").html(html);
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
	            command:'fundo',
	            action:'VerificarDuplicado',
	            fdo: $("#datos").val()
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