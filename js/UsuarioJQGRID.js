var UsuarioJQGRID={
	Consultar_Usuario: function(){
		var jqrid="table_list_usuario";
		var pager="pager_table_list_usuario";
	    $("#"+jqrid).jqGrid({
	    	url:'../controller/ControllerAlfa.php?command=usuario&action=ListUsuario',
			datatype:'json',
			gridview:true,
			width : 760,
			height:350,
			shrinkToFit:false,
			forceFit:true,
			hidegrid: false,
			colNames:['ID','NOMBRE','PATERNO','MATERNO','USUARIO','CLAVE','ESTADO'],
			colModel:[
				{name:'idusuario',index:'idusuario',align:'center',width:60,hidden:true},
                {name:'nombre',index:'nombre',align:'left',width:200,editable:true},
                {name:'paterno',index:'paterno',align:'left',width:200,editable:true},
                {name:'materno',index:'materno',align:'left',width:200,editable:true},
                {name:'usuario',index:'usuario',align:'left',width:200,editable:true},
                {name:'clave',index:'clave',align:'left',width:200,editable:true},
				{name:'estado',index:'estado',align:'center',width:50,editable:true,edittype:"select",editoptions:{value:"1:ACTIVO;0:INACTIVO"}}
			],
			rowNum:30,
			rowList:[30,35,40],
			rownumbers:true,
			loadonce: false,
			pager:'#'+pager,
			sortname:'nombre',
			sortorder:'ASC',
			caption : '',
			recordtext: "View {0} - {1} of {2}",
			emptyrecords: "Cargando...",
			loadtext: "Cargando...",
			pgtext : "P&aacute;gina {0} de {1}"
		});
	


	    $("#"+jqrid).jqGrid('navGrid','#'+pager,
		    {
		    	edit:true,edittitle:"EDITAR USUARIO", editicon: 'ui-icon-pencil',
                add:true,addtitle:"AGREGAR NUEVA USUARIO", addicon:'ui-icon-plus',
                del:true,deltitle:"ELIMINAR USUARIO",delicon:'ui-icon-trash',
		    	view:false,
		    	search:false,
		    	searchtitle:"Search",
		    	refresh: false
		    },
		    {
                url:'../controller/ControllerAlfa.php?command=usuario&action=Mant_Usuario',
                mtype: 'GET',
                editCaption:"EDITAR USUARIO",
                edittext:"Edit",
                bSubmit: "EDITAR",
                bCancel: "CANCELAR",                
                closeOnEscape:true, 
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"285",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowEdit,
                zIndex:"1003",
                closeAfterEdit: true,
                beforeSubmit: function(postdata, formid){

                        var nombre=$("#nombre").val();
                        var paterno=$("#paterno").val();
                        var materno=$("#materno").val();
                        var usuario=$("#usuario").val();
                        var clave=$("#clave").val();

                        var alphanumeric=/^([a-z]|\d|\s|-|\.|_|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+$/i;

                        if(nombre==''){
                            return [false,'POR FAVOR, INGRESE NOMBRE DEL USUARIO']; 
                        }else if(paterno==''){
                            return [false,'POR FAVOR, INGRESE PATERNO DEL USUARIO'];
                        }else if(materno==''){
                            return [false,'POR FAVOR, INGRESE MATERNO DEL USUARIO'];
                        }else if(usuario==''){
                            return [false,'POR FAVOR, INGRESE USUARIO DEL USUARIO'];
                        }else if(clave==''){
                            return [false,'POR FAVOR, INGRESE CLAVE DEL USUARIO'];
                        }else if(!alphanumeric.test(nombre)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(paterno)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(materno)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(usuario)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(clave)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if($("#verifydup").val()>0){
                            return [false,'POR FAVOR, NOMBRE,PATERNO,MATERNO YA EXISTE'];
                        }else if($("#verifyusu").val()>0){
                            return [false,'POR FAVOR, ESTE USUARIO YA EXISTE'];
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }
                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        nombre:$("#nombre").val().trim(),
                        paterno:$("#paterno").val().trim(),
                        materno:$("#materno").val().trim(),
                        usuario:$("#usuario").val().trim(),
                        clave:$("#clave").val().trim(),
                        estado:$("#estado").val().trim()
                    }
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },
                afterSubmit : function(response, postdata){
                    return [true,"OK"];
                },
                onClose:function(){//BOTON AL CANCELAR O CERRAR
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },
                afterComplete:function(){
                    var dato=encodeURIComponent($("#nombre").val().trim()+" "+$("#paterno").val().trim()+" "+$("#materno").val().trim());
                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=usuario&action=ListUsuario&idusuario=&datos='+dato
                    }).trigger("reloadGrid");
                    alertify.set({ delay: 5000 });
                    alertify.success("Se ingreso con éxito");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=usuario&action=Mant_Usuario',
                mtype: 'GET',
                addCaption:"AGREGAR USUARIO",
                bSubmit: "GRABAR",
                bCancel: "CANCELAR",
                closeOnEscape:true,
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"285",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowAdd,
                closeAfterAdd: true,
                beforeSubmit: function(postdata, formid){

                        var nombre=$("#nombre").val();
                        var paterno=$("#paterno").val();
                        var materno=$("#materno").val();
                        var usuario=$("#usuario").val();
                        var clave=$("#clave").val();

                        var alphanumeric=/^([a-z]|\d|\s|-|\.|_|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+$/i;

                        if(nombre==''){
                            return [false,'POR FAVOR, INGRESE NOMBRE DEL USUARIO']; 
                        }else if(paterno==''){
                            return [false,'POR FAVOR, INGRESE PATERNO DEL USUARIO'];
                        }else if(materno==''){
                            return [false,'POR FAVOR, INGRESE MATERNO DEL USUARIO'];
                        }else if(usuario==''){
                            return [false,'POR FAVOR, INGRESE USUARIO DEL USUARIO'];
                        }else if(clave==''){
                            return [false,'POR FAVOR, INGRESE CLAVE DEL USUARIO'];
                        }else if(!alphanumeric.test(nombre)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(paterno)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(materno)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(usuario)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if(!alphanumeric.test(clave)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if($("#verifydup").val()>0){
                            return [false,'POR FAVOR, ESTE DATO YA EXISTE'];
                        }else if($("#verifyusu").val()>0){
                            return [false,'POR FAVOR, ESTE USUARIO YA EXISTE'];
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }

                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        nombre:$("#nombre").val().trim(),
                        paterno:$("#paterno").val().trim(),
                        materno:$("#materno").val().trim(),
                        usuario:$("#usuario").val().trim(),
                        clave:$("#clave").val().trim(),
                        estado:$("#estado").val().trim()
                    }
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },
                afterSubmit : function(response, postdata){ 
                    return [true,"OK"];
                },
                onClose:function(){//BOTON AL CANCELAR O CERRAR   
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },
                afterComplete:function(){
                    //var dato=encodeURIComponent($("#datos").val());
                    var dato=encodeURIComponent($("#nombre").val().trim()+" "+$("#paterno").val().trim()+" "+$("#materno").val().trim());
                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=usuario&action=ListUsuario&idusuario=&datos='+dato
                    }).trigger("reloadGrid");
                    alertify.set({ delay: 5000 });
                    alertify.success("Se ingreso con éxito");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=usuario&action=Mant_Usuario',
                mtype: 'GET',
                caption:"BORRAR USUARIO",
                closeOnEscape:true,
                errorTextFormat:commonError,
                my: "center", at: "center", of: window,
                reloadAfterSubmit:true,
                beforeShowForm:beforeShowDelete,
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                                        
                    $('.ui-widget-overlay').css({'z-index':'1001'});

                    selRowId = $("#"+jqrid).jqGrid ('getGridParam', 'selrow');
                    idusuario = encodeURIComponent($("#"+jqrid).jqGrid ('getCell', selRowId, 'idusuario'));

                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=usuario&action=ListUsuario&idusuario='+idusuario+'&datos='
                    }).trigger("reloadGrid");

                },
                onClose : function(){
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },      
                afterComplete:function(){
                    alertify.set({ delay: 5000 });
                    alertify.success("Se desactivo con éxito");

                }
            },
            {
                errorTextFormat:commonError,
                Find:"Search",
                closeOnEscape:true,
                caption:"Search Users",
                multipleSearch:true,
                closeAfterSearch:true
            }
		);

        $("#"+jqrid).navButtonAdd('#'+pager, {
            caption: "",
            title: "Refrescar",
            buttonicon: "ui-icon-refresh",
            onClickButton: function() {
                $("#"+jqrid).jqGrid('setGridParam',{
                    datatype : 'json',
                    url:'../controller/ControllerAlfa.php?command=usuario&action=ListUsuario'
                }).trigger("reloadGrid");
            },
            position: "first"
        });

		$("#gbox_"+jqrid).css({'margin':'0 auto'})
	    $("#pager_"+jqrid).height(30);
	    $("#pager_"+jqrid+"_center .ui-pg-input").css({'height':25,'font-size':10});
	    $("#pager_"+jqrid+"_center .ui-pg-selbox").css({'height':25,'font-size':10});

	    var origwidth=$("#gbox_"+jqrid).width();
	    $("#gview_"+jqrid).css({'width':origwidth+30});
	    $("#gbox_"+jqrid).css({'width':origwidth+30});
	    $("#gview_"+jqrid+" .ui-jqgrid-hdiv").css({'width':origwidth+30});
	    $("#gview_"+jqrid+" .ui-jqgrid-bdiv").css({'width':origwidth+30});
	    $("#pager_"+jqrid).css({'width':origwidth+30});

	    function beforeShowAdd(formId) {
            $("#verifydup").val("");
            $("#verifyusu").val("");
            $('.ui-widget-overlay').css({'z-index':'1002'});
            setTimeout(function() {
		        document.getElementById('nombre').className += ' textbox';
                document.getElementById('nombre').style.width += '200px';
                $('#nombre').attr('autocomplete','off');

                document.getElementById('paterno').className += ' textbox';
                document.getElementById('paterno').style.width += '200px';
                $('#paterno').attr('autocomplete','off');

                document.getElementById('materno').className += ' textbox';
                document.getElementById('materno').style.width += '200px';
                $('#materno').attr('autocomplete','off');

                document.getElementById('usuario').className += ' textbox';
                document.getElementById('usuario').style.width += '200px';
                $('#usuario').attr('autocomplete','off');

                document.getElementById('clave').className += ' textbox';
                document.getElementById('clave').style.width += '200px';
                $('#clave').attr('autocomplete','off');

                $('#estado').unwrap();
                $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

		    },50);
            $("#"+jqrid).jqGrid('resetSelection');
        }
        function beforeShowEdit(){
            $("#verifydup").val("");
            $("#verifyusu").val("");
            $('.ui-widget-overlay').css({'z-index':'1002'});
            setTimeout(function() {
                document.getElementById('nombre').className += ' textbox';
                document.getElementById('nombre').style.width += '200px';
                $('#nombre').attr('autocomplete','off');

                document.getElementById('paterno').className += ' textbox';
                document.getElementById('paterno').style.width += '200px';
                $('#paterno').attr('autocomplete','off');

                document.getElementById('materno').className += ' textbox';
                document.getElementById('materno').style.width += '200px';
                $('#materno').attr('autocomplete','off');

                document.getElementById('usuario').className += ' textbox';
                document.getElementById('usuario').style.width += '200px';
                $('#usuario').attr('autocomplete','off');

                document.getElementById('clave').className += ' textbox';
                document.getElementById('clave').style.width += '200px';
                $('#clave').attr('autocomplete','off');

                $('#estado').unwrap();
                $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

            },50);
            $("#"+jqrid).jqGrid('resetSelection');
        }
        function beforeShowDelete(){
            $("#verifydup").val("");
            $("#verifyusu").val("");
            $('.ui-widget-overlay').css({'z-index':'1002'});
        }
        function commonError(data){     
            return "Error Occured during Operation Durante la operacion a ocurrido un error. Por favor porbar nuevamente";
        }
	}

}