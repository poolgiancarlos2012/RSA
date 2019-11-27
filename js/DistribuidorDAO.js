var DistribuidorDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarDistribuidor:function(xdist){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'distribuidor',
	            action:'QUERYListarDistribuidor',
	            dist:xdist
	        },
	        success:function(obj){
	            if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tabledist'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='dist"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdiddistribuidor\",\"sdistribuidor\",\"tabledist\",\"dist\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['iddistribuidor']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['distribuidor']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";              
                    $("#searchdistribuidor").css({'display':'block'});
                    $("#searchdistribuidor").html(html);
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
	            command:'distribuidor',
	            action:'VerificarDuplicado',
	            dist: $("#distribuidor").val()
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