var CierreDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
	QUERYListarCierreProgramacion:function(cierreprogramacion){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'cierre',
	            action:'QUERYListarCierreProgramacion',
	        },
	        success:function(obj){
	            if( obj.rst ){
	                var xelem="scierreprogramacion";
	                var elem="cierre_programacion";
	                var html = '';
	                html+="<option value=''>.:SELECCIONE:.</option>";
	                for(var i=0;i<obj.datos.fila.length;i++){
	                    html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";                    
	                }
	                $('#'+elem).html(html);
	                $('#'+xelem).html(html);

	                // f_success(obj);


	            }else{                           
	            }
	        },
	        complete:function(){

	        	$('#cierre_programacion').find('option[text="'+cierreprogramacion+'"]').attr('selected','selected');

	        },
	        error:function(){
	        } 
	    });
	},
	QUERYListarCierreModo:function(cierremodo){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'cierre',
	            action:'QUERYListarCierreModo',
	        },
	        success:function(obj){
	            if( obj.rst ){
	                var xelem="scierremodo";
	                var elem="cierre_modo";
	                var html = '';
	                html+="<option value=''>.:SELECCIONE:.</option>";
	                for(var i=0;i<obj.datos.fila.length;i++){
	                    html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";                    
	                }
	                $('#'+elem).html(html);
	                $('#'+xelem).html(html);

	            }else{                           
	            }
	        },
	        complete:function(){
	        	
	        	$('#cierre_modo').find('option[text="'+cierremodo+'"]').attr('selected','selected');

	        },
	        error:function(){
	        } 
	    });
	},
	Verificar_Activo_Cierre:function(f_success){
	    $.ajax({
	        url:this.url,
	        type:'POST',
	        dataType:'json',
	        data:{
	            command:'cierre',
	            action:'Verificar_Activo_Cierre',
	        },
	        success:function(obj){
	            // if( obj.rst ){
	            //     alert(obj.data);

	            // }else{                           
	            // }
	            f_success(obj)
	        },
	        complete:function(){
	        },
	        error:function(){
	        } 
	    });
	}
}