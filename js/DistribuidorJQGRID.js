var DistribuidorJQGRID={
	Consultar_Distribuidor: function(){
		var jqrid="table_list_distribuidor";
		var pager="pager_table_list_distribuidor";
	    $("#"+jqrid).jqGrid({
	    	url:'../controller/ControllerAlfa.php?command=distribuidor&action=ListDistribuidor',
			datatype:'json',
			gridview:true,
			width : 500,
			height:350,
			shrinkToFit:false,
			forceFit:true,
			hidegrid: false,
			colNames:['ID','CLIENTE','TIP.DOC.','NRO.DOC.','ESTADO'],
			colModel:[
				{name:'iddistribuidor',index:'iddistribuidor',align:'center',width:60,hidden:true},
                {name:'distribuidor',index:'distribuidor',align:'left',width:250,editable:true},
                {name:'tipo_documento',index:'tipo_documento',align:'left',width:50,editable:true,edittype:"select",editoptions:{value:":SELECCIONE;DNI:DNI;RUC:RUC"}},
                {name:'codigo',index:'codigo',align:'center',width:90,editable:true},
				{name:'estado',index:'estado',align:'center',width:50,editable:true,edittype:"select",editoptions:{value:"1:ACTIVO;0:INACTIVO"}}
			],
			rowNum:30,
			rowList:[30,35,40],
			rownumbers:true,
			loadonce: false,
			pager:'#'+pager,
			sortname:'distribuidor',
			sortorder:'ASC',
			caption : '',
			recordtext: "View {0} - {1} of {2}",
			emptyrecords: "Cargando...",
			loadtext: "Cargando...",
			pgtext : "P&aacute;gina {0} de {1}"
		});
	


	    $("#"+jqrid).jqGrid('navGrid','#'+pager,
		    {
		    	edit:true,edittitle:"EDITAR DISTRIBUIDOR", editicon: 'ui-icon-pencil',
                add:true,addtitle:"AGREGAR NUEVA DISTRIBUIDOR", addicon:'ui-icon-plus',
                del:true,deltitle:"ELIMINAR DISTRIBUIDOR",delicon:'ui-icon-trash',
		    	view:false,
		    	search:false,
		    	searchtitle:"Search",
		    	refresh: false
		    },
		    {
                url:'../controller/ControllerAlfa.php?command=distribuidor&action=Mant_Distribuidor',
                mtype: 'GET',
                editCaption:"EDITAR DISTRIBUIDOR",
                edittext:"Edit",
                bSubmit: "EDITAR",
                bCancel: "CANCELAR",                
                closeOnEscape:true, 
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"300",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowEdit,
                zIndex:"1003",
                closeAfterEdit: true,
                beforeSubmit: function(postdata, formid){

                        var distribuidor=$("#distribuidor").val();
                        var alphanumeric=/^([a-z]|\d|\s|-|\.|_|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+$/i;

                        var ntd=$( "#tipo_documento option:selected" ).val();
                        var cod=$( "#codigo" ).val();

                        var patron = /^\d*$/; //Expresión regular para aceptar solo números enteros y positivos
                        var numero = $("#codigo").val();

                        if(distribuidor==''){
                            return [false,'POR FAVOR, INGRESE NOMBRE DEL DISTRIBUIDOR']; 
                        }

                        else if(ntd==''){
                            return [false,'POR FAVOR, INGRESE TIPO DOCUMENTO']; 
                        }else if(cod==''){
                            return [false,'POR FAVOR, INGRESE NUMERO DE DOCUMENTO'];
                        }else if(ntd=='DNI' && cod.length!=8){
                            return [false,'POR FAVOR, EL DNI DEBE TENER 8 DIGITOS'];
                        }else if (!patron.test(numero)) {            
                            return [false,'POR FAVOR, INGRESE NUMERO ENTERO SIN DECIMALES NI NEGATIVOS'];
                        }else if(ntd=='RUC' && cod.length!=11){
                            return [false,'POR FAVOR, EL RUC DEBE TENER 11 DIGITOS'];
                        }else if(!patron.test(numero)){
                            return [false,'POR FAVOR, INGRESE NUMERO SIN DECIMALES NI NEGATIVOS'];
                        }

                        else if(!alphanumeric.test(distribuidor)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if($("#verifydup").val()>0){
                            return [false,'POR FAVOR, ESTE DATO YA EXISTE'];
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }
                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        distribuidor:$("#distribuidor").val().trim(),
                        tipo_documento:$("#tipo_documento").val().trim(),
                        codigo:$("#codigo").val(),
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
                    var dato=encodeURIComponent($("#distribuidor").val());
                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=distribuidor&action=ListDistribuidor&iddistribuidor=&distribuidor='+dato
                    }).trigger("reloadGrid");
                    alertify.set({ delay: 5000 });
                    alertify.success("Se actualizo con éxito");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=distribuidor&action=Mant_Distribuidor',
                mtype: 'GET',
                addCaption:"AGREGAR DISTRIBUIDOR",
                bSubmit: "GRABAR",
                bCancel: "CANCELAR",
                closeOnEscape:true,
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"300",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowAdd,
                closeAfterAdd: true,
                beforeSubmit: function(postdata, formid){

                        var distribuidor=$("#distribuidor").val();
                        var alphanumeric=/^([a-z]|\d|\s|-|\.|_|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+$/i;

                        var ntd=$( "#tipo_documento option:selected" ).val();
                        var cod=$( "#codigo" ).val();

                        var patron = /^\d*$/; //Expresión regular para aceptar solo números enteros y positivos
                        var numero = $("#codigo").val();

                        // if (patron.test(numero)) {            
                        //     alert("Número es correcto")
                        // }else {
                        //     alert("El número es incorrecto");
                        // }

                        if(distribuidor==''){
                            return [false,'POR FAVOR, INGRESE NOMBRE DEL DISTRIBUIDOR']; 
                        }else if(ntd==''){
                            return [false,'POR FAVOR, INGRESE TIPO DOCUMENTO']; 
                        }else if(cod==''){
                            return [false,'POR FAVOR, INGRESE NUMERO DE DOCUMENTO'];
                        }else if(ntd=='DNI' && cod.length!=8){
                            return [false,'POR FAVOR, EL DNI DEBE TENER 8 DIGITOS'];
                        }else if (!patron.test(numero)) {            
                            return [false,'POR FAVOR, INGRESE NUMERO ENTERO SIN DECIMALES NI NEGATIVOS'];
                        }else if(ntd=='RUC' && cod.length!=11){
                            return [false,'POR FAVOR, EL RUC DEBE TENER 11 DIGITOS'];
                        }else if(!patron.test(numero)){
                            return [false,'POR FAVOR, INGRESE NUMERO SIN DECIMALES NI NEGATIVOS'];
                        }

                        /*else if(ntd='RUC'){
                            if(cod.length!=11){
                                return [false,'POR FAVOR, EL DNI DEBE TENER 11 DIGITOS'];
                            }else{
                                if (!patron.test(numero)) {            
                                    return [false,'POR FAVOR, INGRESE NUMERO SIN DECIMALES NI NEGATIVOS'];
                                }
                            }
                        }*/

                        else if(!alphanumeric.test(distribuidor)){
                            return [false,'POR FAVOR, INGRESE LETRAS O NUMEROS'];
                        }else if($("#verifydup").val()>0){
                            return [false,'POR FAVOR, ESTE DATO YA EXISTE'];
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }

                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        distribuidor:$("#distribuidor").val().trim(),
                        tipo_documento:$("#tipo_documento").val().trim(),
                        codigo:$("#codigo").val(),
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
                    var dato=encodeURIComponent($("#distribuidor").val());
                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=distribuidor&action=ListDistribuidor&iddistribuidor=&distribuidor='+dato
                    }).trigger("reloadGrid");
                    alertify.set({ delay: 5000 });
                    alertify.success("Se ingreso con éxito");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=distribuidor&action=Mant_Distribuidor',
                mtype: 'GET',
                caption:"BORRAR DISTRIBUIDOR",
                closeOnEscape:true,
                errorTextFormat:commonError,
                my: "center", at: "center", of: window,
                reloadAfterSubmit:true,
                beforeShowForm:beforeShowDelete,
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    // return{
                    //     distribuidor:$("#distribuidor").val(),
                    //     estado:$("#estado").val()
                    // }
                    
                    $('.ui-widget-overlay').css({'z-index':'1001'});

                    selRowId = $("#"+jqrid).jqGrid ('getGridParam', 'selrow');
                    dato = encodeURIComponent($("#"+jqrid).jqGrid ('getCell', selRowId, 'distribuidor'));

                    $("#"+jqrid).jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=distribuidor&action=ListDistribuidor&iddistribuidor=&distribuidor='+dato
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
                    url:'../controller/ControllerAlfa.php?command=distribuidor&action=ListDistribuidor'
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
		        document.getElementById('distribuidor').className += ' textbox';
                document.getElementById('distribuidor').style.width += '200px';
                $('#distribuidor').attr('autocomplete','off');                

                document.getElementById('codigo').className += ' textbox';
                document.getElementById('codigo').style.width += '200px';
                $('#codigo').attr('autocomplete','off');

                // $('#tipo_documento').unwrap();
                // $("#tipo_documento").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

                // $('#estado').unwrap();
                // $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

                $("#tipo_documento").addClass( "select-style-f2" );
                $("#estado").addClass( "select-style-f2" );


		    },50);
            $("#"+jqrid).jqGrid('resetSelection');
        }
        function beforeShowEdit(){
            $("#verifydup").val("");
            $('.ui-widget-overlay').css({'z-index':'1002'});
            setTimeout(function() {
                document.getElementById('distribuidor').className += ' textbox';
                document.getElementById('distribuidor').style.width += '200px';
                $('#distribuidor').attr('autocomplete','off');                

                document.getElementById('codigo').className += ' textbox';
                document.getElementById('codigo').style.width += '200px';
                $('#codigo').attr('autocomplete','off');

                // $('#tipo_documento').unwrap();
                // $("#tipo_documento").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

                // $('#estado').unwrap();
                // $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:198px;'></div>" );

                $("#tipo_documento").addClass( "select-style-f2" );
                $("#estado").addClass( "select-style-f2" );

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