var RegistroGestionDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
    QUERYListarCliente:function(xdtr){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarCliente',
                dtr:xdtr
            },
            success:function(obj){
                if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tabledtr'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='dtr"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidcliente\",\"cliente\",\"tabledtr\",\"dtr\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idcliente']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['razon_social']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";
                    $("#searchcliente").css({'display':'block'});
                    $("#searchcliente").html(html);
                }else{
                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarProductos:function(){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarProductos',
                prod:$("#sproducto").val().trim()
            },
            success:function(obj){
                if( obj.rst ){

                    var html="";
                    html+='<table cellspacing="0" cellpadding="0" border=0>';
                    for (var i = 0; i <= obj.data.length-1; i++) {
                        // html+='<tr id="product_'+obj.data[i]['idproducto']+'">';
                        // html+='<td style="width:20px;padding:5px;"><span style="float: right;font-family: open_sansbold;font-size: 10px;">'+obj.data[i]['idproducto']+'</span></td>';
                        // html+='<td style="width:280px;padding:5px;font-family: open_sansbold;font-size: 10px;">'+obj.data[i]['producto']+'</td>';
                        // html+='<td><img id="'+obj.data[i]['idproducto']+'" src="../img/Plus.png" style="width:16px;" onclick="agregarprod(this.id);"></td>';
                        // html+='</tr>';

                        html+='<tr id="product_'+obj.data[i]['idproducto']+'">';
                        html+='<td><input type="hidden" id="'+obj.data[i]['idproducto']+'@'+obj.data[i]['producto']+'" /></td>'
                        html+='<td style="width:20px;padding:5px;"><span style="float: right;font-family: open_sansbold;font-size: 10px;">'+obj.data[i]['idproducto']+'</span></td>';
                        html+='<td style="width:280px;padding:5px;font-family: open_sansbold;font-size: 10px;">'+obj.data[i]['producto']+'</td>';
                        html+='<td><img id="'+obj.data[i]['idproducto']+'" src="../img/Plus.png" style="width:16px;" onclick="agregarprod(this.id);"></td>';
                        html+='</tr>';

                    }
                    html+='</table>';
                    $("#prod").html(html);

                }else{
                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarMotivo:function(xobj){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarMotivo',
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
    QUERYListarActividad:function(xprob){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarActividad',
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
    QUERYListarFundo:function(xfdo){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarFundo',
                fdo:xfdo
            },
            success:function(obj){
                // if( obj.rst ){
                //     var fundo="idagric_fundo";
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
    QUERYListarCultivo:function(xcvo){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarCultivo',
                cvo:xcvo
            },
            success:function(obj){
                // if( obj.rst ){
                //     var cultivo="idcultivo";
                //     var html = '';
                //     html+="<option value=''>.:SELECCIONE:.</option>";
                //     for(var i=0;i<obj.datos.fila.length;i++){
                //         html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";
                //     }
                //     $('#'+cultivo).html(html);
                // }else{
                // }

                if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tablecvo'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='cvo"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidcultivo\",\"cultivo\",\"tablecvo\",\"cvo\")'>";
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
    QUERYListarArea:function(){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarArea',
                idfundo:$("#idagric_fundo").val(),
                idcultivo:$("#idcultivo").val()
            },
            success:function(obj){
                if( obj.rst ){

                    var area="idarea";
                    if(obj.datos.fila.length!=0){
                        var html = '';
                        html+="<option value=''>.:SELECCIONE:.</option>";
                        for(var i=0;i<obj.datos.fila.length;i++){
                            html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";
                        }
                        $('#'+area).html(html);
                    }else{
                        $('#'+area+' option').remove();
                        html+="<option value=''>.:SELECCIONE:.</option>";
                        $('#'+area).html(html);
                    }

                }else{

                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarZona:function(){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarZona'
            },
            success:function(obj){
                if( obj.rst ){
                    var zona="idzona";
                    var html = '';
                    html+="<option value=''>.:SELECCIONE:.</option>";
                    for(var i=0;i<obj.datos.fila.length;i++){
                        html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";
                    }
                    $('#'+zona).html(html);
                }else{

                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarTipoCliente:function(){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarTipoCliente'
            },
            success:function(obj){
                if( obj.rst ){
                	var tipo_cliente="idtipo_cliente";
                    var html = '';
                    html+="<option value=''>.:SELECCIONE:.</option>";
                    for(var i=0;i<obj.datos.fila.length;i++){
                        html+="<option value='"+obj.datos.fila[i]['cell'][0]+"'>"+obj.datos.fila[i]['cell'][1]+"</option>";
                    }
                    $('#'+tipo_cliente).html(html);
                }else{

                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    RegistrarGestion:function(xgestion){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'RegistrarGestion',
                gestion:xgestion,
                idusuario: $("#hdidusuario").val()
            },
            beforeSend : function(){
                $('#layerOverlay,#layerLoading').html("Espere Por favor, Cargando Archivo");
                $('.ui-widget-overlay').css({'opacity':'0.7','background':'#000000'});
                $("#layerOverlay").height($(document).height());
                $('#layerOverlay,#layerLoading').css('display','block');
            },
            success:function(obj){
                if (obj.rst) {
                    alertify.set({ delay: 2500 });
                    alertify.success(obj.rpta);
                }else{
                    alertify.set({ delay: 2500 });
                    alertify.error(obj.rpta);
                };
            },
            complete:function(){
                $('#layerOverlay,#layerLoading').hide();
                $("#idlimpiar").click();
                $("#idgestiones table tbody tr").remove();
            },
            error:function(){
            }
        });
    },
    VerificarRecorrido:function(uniquedate,f_success){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'VerificarRecorrido',
                fecha_gestion:uniquedate,
                idusuario: $("#hdidusuario").val()
            },
            success:function(obj){
               f_success(obj);
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    RegistrarRecorrido:function(xfechareco,f_success){
    	$.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'RegistrarRecorrido',
                fechareco:xfechareco,
                idusuario: $("#hdidusuario").val()
            },
            success:function(obj){
               //$("#idgrabar").click();
               // alert("hola");
               f_success(obj);
               // if (obj.rst) {
               //  alert("hola");
               // };
            },
            complete:function(){

            },
            error:function(){
            }
        });
    },
    QUERYListarBsqCliente:function(xdtr){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarCliente',
                dtr:xdtr
            },
            success:function(obj){
                if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tabledtr'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='dtr"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidbsqcliente\",\"bsqcliente\",\"tabledtr\",\"dtr\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idcliente']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['razon_social']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";
                    $("#searchbsqcliente").css({'display':'block'});
                    $("#searchbsqcliente").html(html);
                }else{
                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarBsqCliente_ctrl:function(xdtr){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarCliente',
                dtr:xdtr
            },
            success:function(obj){
                if( obj.rst ){

                }else{

                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarBsqMotivo:function(xobj){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarMotivo',
                obje:xobj
            },
            success:function(obj){
                if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tableobj'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='obj"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidbsqobjetivo\",\"bsqobjetivo\",\"tableobj\",\"obj\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idmotivo']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['motivo']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";
                    $("#searchbsqobjetivo").css({'display':'block'});
                    $("#searchbsqobjetivo").html(html);
                }else{
                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    QUERYListarBsqActividad:function(xprob){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'QUERYListarActividad',
                prob:xprob
            },
            success:function(obj){
                if( obj.rst ){
                    var html="";
                    html+="<table style='width:500px;' id='tableprob'>";
                    for (var i = 0; i <= obj.dato.length-1; i++) {
                        html+="<tr id='prob"+i+"' style='cursor: pointer;' class='changecolor' onclick='GetIndex(this,\"hdidbsqproblema\",\"bsqproblema\",\"tableprob\",\"prob\")'>";
                        html+="<td align='right' style='height: 30px;padding:0 10px 0 10px;color:red;display:none'>"+obj.dato[i]['idactividad']+"</td>";
                        html+="<td class='changed' align='left' style='height: 30px;padding:0 10px 0 10px;'>"+obj.dato[i]['actividad']+"</td>";
                        html+="</tr>";
                    };
                    html+="</table>";
                    $("#searchbsqproblema").css({'display':'block'});
                    $("#searchbsqproblema").html(html);
                }else{
                }
            },
            complete:function(){
            },
            error:function(){
            }
        });
    },
    ValidarRegistroCierre:function(f_success){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'registrogestion',
                action:'ValidarRegistroCierre'
            },
            success:function(obj){
               f_success(obj);
            },
            complete:function(){

            },
            error:function(){
            }
        });
    },

}
