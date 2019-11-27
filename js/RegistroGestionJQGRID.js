var RegistroGestionJQGRID={
	Tem_gestion:function(){
		var jqrid="table_list_gestion";
		    $("#"+jqrid).jqGrid({
				data: data,
				datatype:'local',
				gridview:true,
				width : 760,
				height:600,
				shrinkToFit:false,
				forceFit:true,
				hidegrid: false,
				colNames:['IDGETION','FECH.GESTION','IDDISTRIBUIDOR',"DISTRIBUIDOR","IDFUNDO",'AGRIC./FUNDO','LUGAR DE VISITA','IDOBJETIVOS','OBJETIVOS DE LA VISITA','IDCULTIVO','CULTIVO','IDAREA','AREA(HAS)','IDPROBLEMA','PROBLEMA/ACTIVIDAD','IDPRODUCT','PRODUCTO','OBSERVACION','QUITAR'],
				colModel:[
				{name:'idgestion',index:'idgestion',align:'center',width:50,hidden:true},
				{name:'fechgestion',index:'fechgestion',align:'center',width:60},
				{name:'idcliente',index:'idcliente',align:'center',width:100,hidden:true},
				{name:'cliente',index:'cliente',align:'center',width:100},
				{name:'idfundo',index:'idfundo',align:'center',width:100},
				{name:'fundo',index:'fundo',align:'center',width:100},
				{name:'lugar',index:'lugar',align:'center',width:100},
				{name:'idobjetivo',index:'idobjetivo',align:'center',width:100,hidden:true},
				{name:'objetivo',index:'objetivo',align:'center',width:100},
				{name:'idcultivo',index:'idcultivo',align:'center',width:100},
				{name:'cultivo',index:'cultivo',align:'center',width:100},
				{name:'idarea',index:'idarea',align:'center',width:100},
				{name:'area',index:'area',align:'center',width:100},
				{name:'idproblema',index:'idproblema',align:'center',width:100,hidden:true},
				{name:'problema',index:'problema',align:'center',width:100},
				{name:'idproductos',index:'idproductos',align:'center',width:100,hidden:false},
				{name:'productos',index:'idproductos',align:'center',width:100},
				{name:'observacion',index:'observacion',align:'center',width:100},
				{name:'act',index:'act', width:130,sortable:false}
				],
				rowNum:30,
				rowList:[30,35,40],
				rownumbers:true,
				loadonce: true,
				pager:'#pager_table_list_gestion',
				sortname:'id',
				sortorder:'ASC',
				caption : '',
				recordtext: "View {0} - {1} of {2}",
				emptyrecords: "Cargando...",
				loadtext: "Cargando...",
				pgtext : "P&aacute;gina {0} de {1}",

				onSelectRow: function (id) {
      
			       $("#table_temp_gestion").delRowData(id);
			      	$("#table_temp_gestion").trigger('reloadGrid');
			      
			      }
		    });

			$("#"+jqrid).jqGrid('navGrid','#pager_table_list_gestion',
			    {edit:false,add:false,del:false,view:false,search:false,refresh: true}
			);

		    $("#gbox_"+jqrid).css({'margin':'0 auto'})
		    $("#pager_"+jqrid).height(30);
		    $("#pager_"+jqrid+"_center .ui-pg-input").css({'height':25,'font-size':10});
		    $("#pager_"+jqrid+"_center .ui-pg-selbox").css({'height':25,'font-size':10});

		    var origwidth=$("#gbox_table_temp_gestion").width();
		    $("#gview_"+jqrid).css({'width':origwidth+30});
		    $("#gbox_"+jqrid).css({'width':origwidth+30});
		    $("#gview_"+jqrid+" .ui-jqgrid-hdiv").css({'width':origwidth+30});
		    $("#gview_"+jqrid+" .ui-jqgrid-bdiv").css({'width':origwidth+30});
		    $("#pager_"+jqrid).css({'width':origwidth+30});
	},
	Consultar_Gestion: function(){
		var jqrid="table_list_gestion";
		var pager="pager_table_list_gestion";
	    $("#"+jqrid).jqGrid({
	    	// url:'../controller/ControllerAlfa.php?command=registrogestion&action=ConsultarGestion&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val(),
			datatype:'json',
			gridview:true,
			width : 765,
			height:400,
			shrinkToFit:false,
			forceFit:true,
			hidegrid: false,
			colNames:['IDGESTION','FECH_GESTION','CLIENTE','CONSU.FINAL','LUGAR','OBJETIVOS','CULTIVO','AREA(HAS)','PROBLEMA/ACTIVIDAD','PRODUCTO','INICIO','FIN','OBSERVACION','ZONA','CREACIÓN','RESPONSABLE'],
			colModel:[
				{name:'idvisita_cultivo',index:'idvisita_cultivo',align:'center',width:60,hidden:true},
				{name:'fecha_visita',index:'fecha_visita',align:'center',width:60},
				{name:'razon_social',index:'razon_social',align:'center',width:60},
				{name:'fundo',index:'fundo',align:'center',width:60},
				{name:'lugar',index:'lugar',align:'center',width:60},
				{name:'motivo',index:'motivo',align:'center',width:60},
				{name:'cultivo',index:'cultivo',align:'center',width:60},
				{name:'area',index:'area',align:'center',width:60},
				{name:'actividad',index:'actividad',align:'center',width:60},
				{name:'productos',index:'productos',align:'center',width:60},
				{name:'inicio',index:'inicio',align:'center',width:60},
				{name:'fin',index:'fin',align:'center',width:60},
				{name:'observacion',index:'observacion',align:'center',width:60},
				{name:'zona',index:'zona',align:'center',width:60},
				{name:'creacion',index:'creacion',align:'center',width:60},
				{name:'responsable',index:'responsable',align:'center',width:60}
			],
			rowNum:30,
			rowList:[30,35,40],
			rownumbers:true,
			loadonce: false,
			pager:'#'+pager,
			sortname:'idvisita_cultivo',
			sortorder:'ASC',
			caption : '',
			recordtext: "View {0} - {1} of {2}",
			emptyrecords: "Cargando...",
			loadtext: "Cargando...",
			pgtext : "P&aacute;gina {0} de {1}"
		});

	    $("#"+jqrid).jqGrid('navGrid','#'+pager,
		    {edit:false,add:false,del:false,view:false,search:false,refresh: true}
		);

		$("#"+jqrid).jqGrid("navButtonAdd", "#"+pager, {
		    caption: "",
		    buttonicon : "ui-icon-document",
		    position: "last", 
		    title:"REGISTRO SEMANAL", 
		    cursor: "pointer",
		    id: "myCustomButton",
		    onClickButton: function () {


				var xiddietfechhasta=$("#iddietfechhasta").val();
				// window.location.href='../reporte/excel/rpt_reporte_semanal.php?&idusuario='+$('#hdidusuario').val()+'&fechgestion='+$('#idsearchfechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val();
				window.location.href='../reporte/excel/rpt_reporte_semanal.php?&idusuario='+$('#hdidusuario').val()+'&dfechgestion='+$('#idsearchdesdefechgestion').val()+'&hfechgestion='+$('#idsearchhastafechgestion').val()+'&idcliente='+$('#hdidbsqcliente').val()+'&objetivo='+$("#hdidbsqobjetivo").val()+'&actividad='+$("#hdidbsqproblema").val();
		    
		    }
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

	}
}