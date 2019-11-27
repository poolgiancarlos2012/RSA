var ObjetivoJQGRID={
	Consultar_Objetivo: function(){
		var jqrid="table_list_objetivo";
		var pager="pager_table_list_objetivo";
	    $("#"+jqrid).jqGrid({
	    	url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo',
			datatype:'json',
			gridview:true,
			width : 400,
			height:350,
			shrinkToFit:false,
			forceFit:true,
			hidegrid: false,
			colNames:['ID','OBJETIVO','ESTADO'],
			colModel:[
				{name:'idmotivo',index:'idmotivo',align:'center',width:60,hidden:true},
                {name:'motivo',index:'motivo',align:'left',width:200,editable:true},
				{name:'estado',index:'estado',align:'center',width:50,editable:true,edittype:"select",editoptions:{value:"1:ACTIVO;0:INACTIVO"}}
			],
			rowNum:30,
			rowList:[30,35,40],
			rownumbers:true,
			loadonce: false,
			pager:'#'+pager,
			sortname:'motivo',
			sortorder:'ASC',
			caption : '',
			recordtext: "View {0} - {1} of {2}",
			emptyrecords: "Cargando...",
			loadtext: "Cargando...",
			pgtext : "P&aacute;gina {0} de {1}"
		});
	
	    $("#"+jqrid).jqGrid('navGrid','#'+pager,
		    {
		    	edit:true,edittitle:"EDITAR OBJETIVO", editicon: 'ui-icon-pencil',
                add:true,addtitle:"AGREGAR NUEVA OBJETIVO", addicon:'ui-icon-plus',
                del:true,deltitle:"ELIMINAR OBJETIVO",delicon:'ui-icon-trash',
		    	view:false,
		    	search:false,
		    	searchtitle:"Search",
		    	refresh: false
		    },
		    {
                url:'../controller/ControllerAlfa.php?command=objetivo&action=Mant_Objetivo',
                mtype: 'GET',
                editCaption:"EDITAR OBJETIVO",
                edittext:"Edit",
                bSubmit: "EDITAR",
                bCancel: "CANCELAR",                
                closeOnEscape:true, 
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"268",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowEdit,
                zIndex:"1003",
                closeAfterEdit: true,
                beforeSubmit: function(postdata, formid){


                        var motivo=$("#motivo").val();
                        var alphanumeric=/^([a-z]|\d|\s|-|\.|_|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+$/i;

                        if(motivo==''){
                            return [false,'POR FAVOR, INGRESE NOMBRE DEL OBJETIVO']; 
                        }else if(!alphanumeric.test(motivo)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if($("#verifydup").val()>0){
                            return [false,'POR FAVOR, ESTE DATO YA EXISTE'];
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }
                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        motivo:$('#motivo').val().trim(),
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
                    var motivo=encodeURIComponent($("#motivo").val());
                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo&idmotivo=&motivo='+motivo
                    }).trigger("reloadGrid");
                    alertify.set({ delay: 5000 });
                    alertify.success("Se actualizo con éxito");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=objetivo&action=Mant_Objetivo',
                mtype: 'GET',
                addCaption:"AGREGAR OBJETIVO",
                bSubmit: "GRABAR",
                bCancel: "CANCELAR",
                closeOnEscape:true,
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"410",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowAdd,
                closeAfterAdd: true,
                beforeSubmit: function(postdata, formid){
                        var motivo=$("#motivo").val();
                        var alphanumeric=/^([a-z]|\d|\s|-|\.|_|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+$/i;

                        if(motivo==''){
                            return [false,'POR FAVOR, INGRESE NOMBRE DEL OBJETIVO']; 
                        }else if(!alphanumeric.test(motivo)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if($("#verifydup").val()>0){
                            return [false,'POR FAVOR, ESTE DATO YA EXISTE'];
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }

                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        motivo:$('#motivo').val().trim(),
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
                	var motivo=encodeURIComponent($("#motivo").val());

                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo&idmotivo=&motivo='+motivo
                    }).trigger("reloadGrid");

                    alertify.set({ delay: 5000 });
                    alertify.success("Se ingreso con éxito");

                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=objetivo&action=Mant_Objetivo',
                mtype: 'GET',
                caption:"BORRAR OBJETIVO",
                closeOnEscape:true,
                errorTextFormat:commonError,
                my: "center", at: "center", of: window,
                reloadAfterSubmit:true,
                beforeShowForm:beforeShowDelete,
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    $('.ui-widget-overlay').css({'z-index':'1001'});

                    selRowId = $("#"+jqrid).jqGrid ('getGridParam', 'selrow');
                    motivo = encodeURIComponent($("#"+jqrid).jqGrid ('getCell', selRowId, 'motivo'));

                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo&idmotivo=&motivo='+motivo
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
                    url:'../controller/ControllerAlfa.php?command=objetivo&action=ListObjetivo'
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
            $('.ui-widget-overlay').css({'z-index':'1002'});
            setTimeout(function() {
		        document.getElementById('motivo').className += ' textbox';
                document.getElementById('motivo').style.width += '200px';
                $('#motivo').attr('autocomplete','off');
                $('#estado').unwrap();
                $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

		    },50);
            $("#"+jqrid).jqGrid('resetSelection');
        }
        function beforeShowEdit(){
            $("#verifydup").val("");
            $('.ui-widget-overlay').css({'z-index':'1002'});
            setTimeout(function() {
                document.getElementById('motivo').className += ' textbox';
                document.getElementById('motivo').style.width += '200px';
                $('#motivo').attr('autocomplete','off');
                $('#estado').unwrap();
                $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

            },50);
            $("#"+jqrid).jqGrid('resetSelection');
        }
        function beforeShowDelete(){
            $("#verifydup").val("");
            $('.ui-widget-overlay').css({'z-index':'1002'});
        }
        function commonError(data){     
            return "Error Occured during Operation Durante la operacion a ocurrido un error. Por favor porbar nuevamente";
        }
	}

}