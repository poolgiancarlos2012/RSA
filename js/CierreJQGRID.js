var CierreJQGRID={
	Consultar_Cierre: function(){
		var jqrid="table_list_cierre";
		var pager="pager_table_list_cierre";
	    $("#"+jqrid).jqGrid({
	    	url:'../controller/ControllerAlfa.php?command=cierre&action=ListCierre',
			datatype:'json',
			gridview:true,
			width : 760,
			height:350,
			shrinkToFit:false,
			forceFit:true,
			hidegrid: false,
			colNames:['ID','DESDE','HASTA','ESTADO','PROGRAMACION','MODO'],
			colModel:[
                {name:'idcierre',index:'idcierre',align:'center',width:100,hidden:true},
                {name:'ini',index:'ini',align:'center',width:150,hidden:false,editable:true,editoptions:{size:30},editrules:{required:true},formoptions:{elmprefix:""}},
                {name:'fin',index:'fin',align:'center',width:150,hidden:false,editable:true,editoptions:{size:30},editrules:{required:true},formoptions:{elmprefix:""}},
                {name:'estado',index:'estado',align:'center',width:100,hidden:false,editable:true,edittype:"select",editoptions:{value:{},size:30,style: "width:138px"},editrules:{required:true},formoptions:{elmprefix:""}},
                {name:'cierre_programacion',index:'idcierre_programacion',align:'center',width:100,hidden:false,editable:true,edittype:"select",editoptions:{value:{},size:30,style: "width:138px"},editrules:{required:true},formoptions:{elmprefix:""}},
                {name:'cierre_modo',index:'idcierre_modo',align:'center',width:100,hidden:false,editable:true,edittype:"select",editoptions:{value:{},size:30,style: "width:138px"},editrules:{required:true},formoptions:{elmprefix:""}}
			],
			rowNum:30,
			rowList:[30,35,40],
			rownumbers:true,
			loadonce: true,
			pager:'#'+pager,
			sortname:'idcierre',
			sortorder:'ASC',
			caption : '',
			recordtext: "View {0} - {1} of {2}",
			emptyrecords: "Cargando...",
			loadtext: "Cargando...",
			pgtext : "P&aacute;gina {0} de {1}"
		});

        $("#"+jqrid).jqGrid('navGrid','#'+pager,
            {
                edit:true,edittitle:"EDITAR CIERRE", editicon: 'ui-icon-pencil',
                add:true,addtitle:"AGREGAR NUEVA CIERRE", addicon:'ui-icon-plus',
                del:true,deltitle:"ELIMINAR CIERRE",delicon:'ui-icon-trash',
                view:false,
                search:false,
                searchtitle:"Search",
                refresh: false
            },
            {
                url:'../controller/ControllerAlfa.php?command=cierre&action=Mant_Cierre',
                mtype: 'GET',
                editCaption:"EDITAR CIERRE",
                edittext:"Edit",
                bSubmit: "EDITAR",
                bCancel: "CANCELAR",                
                closeOnEscape:true, 
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"410",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowEdit,
                zIndex:"1003",
                closeAfterEdit: true,
                beforeSubmit: function(postdata, formid){
                        var ini=$('#ini').val().split(" ");
                        var fin=$('#fin').val().split(" ");
                        var estado=$('#estado').val();
                        var cierre_programacion=$('#cierre_programacion').val();
                        var cierre_modo=$('#cierre_modo').val();

                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!
                        var yyyy = today.getFullYear();

                        if(dd<10) {
                            dd='0'+dd
                        }
                        if(mm<10) {
                            mm='0'+mm
                        } 

                        hoy = yyyy+'-'+mm+'-'+dd;

                        
                        var xd1=ini[0]; // Extraigo solo fecha y no hora
                        var xd2=fin[0];

                        d1= xd1.split("/").reverse().join("-");
                        d2= xd2.split("/").reverse().join("-");

                        nw= hoy;

                        if(d1<nw){
                            return [false,'FECHA DESDE DEBE SER MAYOR O IGUAL AL ACTUAL']; 
                        }
                        if(d2<nw){
                            return [false,'FECHA HASTA DEBE SER MAYOR O IGUAL A HOY']; 
                        }
                        if(d1>d2){
                            return [false,'FECHA DESDE DEBE SER MENOR O IGUAL A FECHA HASTA']; 
                        }else{
                            return [true,'SE AGREGO CON EXITO...!!!'];
                        }
                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR

                    return{
                        ini:$('#ini').val(),
                        fin:$('#fin').val(),
                        estado:$('#estado').val(),
                        cierre_programacion:$('#cierre_programacion').val(),
                        cierre_modo:$('#cierre_modo').val()
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
                    $("#table_list_cierre").jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=cierre&action=ListCierre'
                    }).trigger("reloadGrid");
                    alertify.set({ delay: 2500 });
                    alertify.success("SE ACTUALIZO REGISTRO EXITOSAMENTE");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=cierre&action=Mant_Cierre',
                mtype: 'GET',
                addCaption:"AGREGAR CIERRE",
                bSubmit: "GRABAR",
                bCancel: "CANCELAR",
                closeOnEscape:true,
                savekey: [true,13],
                errorTextFormat:commonError,
                width:"247",
                reloadAfterSubmit:true,
                bottominfo:"Los campos marcados con (*) son importantes",
                my: "center", at: "center", of: window,
                beforeShowForm:beforeShowAdd,
                closeAfterAdd: true,
                beforeSubmit: function(postdata, formid){

                            

                            //alert($("#hdcierre_estado").val());

                            var ini=$('#ini').val().split(" ");
                            var fin=$('#fin').val().split(" ");
                            var estado=$('#estado').val();
                            var cierre_programacion=$('#cierre_programacion').val();
                            var cierre_modo=$('#cierre_modo').val();

                            var today = new Date();
                            var dd = today.getDate();
                            var mm = today.getMonth()+1; //January is 0!
                            var yyyy = today.getFullYear();

                            if(dd<10) {
                                dd='0'+dd
                            }
                            if(mm<10) {
                                mm='0'+mm
                            } 

                            hoy = yyyy+'-'+mm+'-'+dd;

                            
                            var xd1=ini[0]; // Extraigo solo fecha y no hora
                            var xd2=fin[0];

                            d1= xd1.split("/").reverse().join("-");
                            d2= xd2.split("/").reverse().join("-");

                            nw= hoy;                      
                            
                            if($("#hdcierre_estado").val()>0){
                                return [false,'AUN HAY UN CIERRE ACTIVO']; 
                            }
                            if(d1<nw){
                                return [false,'FECHA DESDE DEBE SER MAYOR O IGUAL AL ACTUAL']; 
                            }
                            if(d2<nw){
                                return [false,'FECHA HASTA DEBE SER MAYOR O IGUAL AL ACTUAL']; 
                            }
                            if(d1>d2){
                                return [false,'FECHA DESDE DEBE SER MENOR O IGUAL A FECHA HASTA']; 
                            }else{
                                return [true,'SE AGREGO CON EXITO...!!!'];
                            }
             

                },
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    return{
                        ini:$('#ini').val(),
                        fin:$('#fin').val(),
                        estado:$('#estado').val(),
                        cierre_programacion:$('#cierre_programacion').val(),
                        cierre_modo:$('#cierre_modo').val()
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
                    $("#table_list_cierre").jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=cierre&action=ListCierre'
                    }).trigger("reloadGrid");

                    alertify.set({ delay: 2500 });
                    alertify.success("SE GRABO REGISTRO EXITOSAMENTE");
                }
            },
            {
                url:'../controller/ControllerAlfa.php?command=cierre&action=Mant_Cierre',
                mtype: 'GET',
                caption:"BORRAR CIERRE",
                closeOnEscape:true,
                errorTextFormat:commonError,
                my: "center", at: "center", of: window,
                reloadAfterSubmit:true,
                beforeShowForm:beforeShowDelete,
                onclickSubmit: function(params, postdata) {//BOTON A GRABAR
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },
                onClose : function(){
                    $('.ui-widget-overlay').css({'z-index':'1001'});
                },      
                afterComplete:function(){
                    $("#table_list_cierre").jqGrid('setGridParam',{
                        datatype : 'json',
                        url:'../controller/ControllerAlfa.php?command=cierre&action=ListCierre'
                    }).trigger("reloadGrid");

                    alertify.set({ delay: 2500 });
                    alertify.success("SE ELIMINO REGISTRO EXITOSAMENTE");

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

            CierreDAO.Verificar_Activo_Cierre(function(obj){
                $("#hdcierre_estado").val(obj.dato);
            });

            $('.ui-widget-overlay').css({'z-index':'1002'});
            setTimeout(function() {
                $('#ini,#fin').unmask("99/99/2099 99:99:99");
                document.getElementById('ini').placeholder= '';
                document.getElementById('fin').placeholder= '';
                $('#estado').unwrap();
                $('#cierre_programacion').unwrap();
                $('#cierre_modo').unwrap();

                $('#ini,#fin').mask("99/99/2099 99:99:99");

                document.getElementById('ini').className += ' textbox';
                document.getElementById('ini').style.width += '140px';
                document.getElementById('ini').style.textAlign += 'center';
                document.getElementById('ini').placeholder += '__/__/20__ __:__:__';
                $("#ini").attr("autocomplete", "off");
                document.getElementById('fin').className += ' textbox';
                document.getElementById('fin').style.width += '140px';
                document.getElementById('fin').style.textAlign += 'center';
                document.getElementById('fin').placeholder += '__/__/20__ __:__:__';
                $("#fin").attr("autocomplete", "off");

                $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:138px;'></div>" );
                $("#cierre_programacion").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:138px;'></div>" );
                $("#cierre_modo").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:138px;'></div>" );



                $("#ini").blur();
                CierreDAO.QUERYListarCierreProgramacion();
                CierreDAO.QUERYListarCierreModo();
                var elem="estado";
                var html = '';
                html+="<option value='1' selected='selected'>ACTIVO</option>";
                html+="<option value='0'>DESACTIVO</option>";                
                $('#'+elem).html(html);

            },50);
        }
        function beforeShowEdit(){

            CierreDAO.Verificar_Activo_Cierre(function(obj){
                $("#hdcierre_estado").val(obj.dato);
            });
            
            $('.ui-widget-overlay').css({'z-index':'1002'});

            setTimeout(function(){
                $('#ini,#fin').unmask("99/99/2099 99:99:99");
                document.getElementById('ini').placeholder= '';
                document.getElementById('fin').placeholder= '';
                $('#estado').unwrap();
                $('#cierre_programacion').unwrap();
                $('#cierre_modo').unwrap();
                
                $('#ini,#fin').mask("99/99/2099 99:99:99");

                document.getElementById('ini').className += ' textbox';
                document.getElementById('ini').style.width += '140px';
                document.getElementById('ini').style.textAlign += 'center';
                document.getElementById('ini').placeholder += '__/__/20__ __:__:__';
                $("#ini").attr("autocomplete", "off");
                document.getElementById('fin').className += ' textbox';
                document.getElementById('fin').style.width += '140px';
                document.getElementById('fin').style.textAlign += 'center';
                document.getElementById('fin').placeholder += '__/__/20__ __:__:__';
                $("#fin").attr("autocomplete", "off");

                $("#estado").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:138px;'></div>" );
                $("#cierre_programacion").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:138px;'></div>" );
                $("#cierre_modo").wrap( "<div class='select-style' style='display: inline-block;font-weight:bold;width:138px;'></div>" );

                $("#ini").blur();

                var myGrid = $('#'+jqrid),
                selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
                estado = myGrid.jqGrid ('getCell', selRowId, 'estado');
                cierreprogramacion = myGrid.jqGrid ('getCell', selRowId, 'cierre_programacion');
                cierremodo = myGrid.jqGrid ('getCell', selRowId, 'cierre_modo');

                CierreDAO.QUERYListarCierreProgramacion(cierreprogramacion);
                CierreDAO.QUERYListarCierreModo(cierremodo);

                var elem="estado";
                var html = '';
                html+="<option value='1'>ACTIVO</option>";
                html+="<option value='0'>DESACTIVO</option>";                
                $('#'+elem).html(html);

                
                $('#estado').find('option[text="'+estado+'"]').attr('selected','selected');

            },50);

        }
        function beforeShowDelete(){
            $('.ui-widget-overlay').css({'z-index':'1002'});
        }
        function commonError(data){     
            return "Error Occured during Operation Durante la operacion a ocurrido un error. Por favor porbar nuevamente";
        }

	}

}