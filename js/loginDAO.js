var loginDAO={
  url:'../controller/ControllerAlfa.php',
  idLayerMessage : 'layerMessage',
  checkUser:function( ){
    $.ajax({
      url:this.url,
      type:'POST',
      dataType:'json',
      data:{
        command:'logeo',
        action:'acceso',
        usuario:$.trim( $('#txtusuario').val() ).toUpperCase(),
        clave:$.trim( $('#txtpassword').val() ).toUpperCase()
      },
      beforeSend:function(){
        $('#layerOverlay,#layerLoading').css('display','block');
      },
      success:function(obj){
        //alert(obj.rst);
        if(obj.rst){
          
          
          if(obj.tipo_usuario=='CLIENTE'){
              window.location.href='../view/ui-index.php?abrir_pagina=cliente';
          }else if(obj.tipo_usuario=='SISTEMAS'){
              window.location.href='../view/ui-index.php';
          }else if(obj.tipo_usuario=='PROMOTOR'){
              window.location.href='../view/ui-index.php';
          }else if(obj.tipo_usuario=='SUPERVISOR'){
              window.location.href='../view/ui-index.php';
          }
          
          //$('#layerOverlay,#layerLoading').hide();
          //$('#'+loginDAO.idLayerMessage).html(templates.lblinfo(obj.msg,'250px'));
          //templates.lblinfoeffect();
        }else{
          $('#layerOverlay,#layerLoading').hide();
          $('#'+loginDAO.idLayerMessage).html(templates.lblalert(obj.msg,'250px'));
          templates.lblalerteffect();
        }
      },
      error:function(){
        $('#layerOverlay,#layerLoading').hide();
      }
    });
  },
  hide_message:function(){
  	$('#'+loginDAO.idLayerMessage).effect('blind',{direction:'vertical'},'slow',function(){ $(this).empty().css('display','block'); });		
  },
  setTimeOut_hide_message:function(){
  	setTimeout("loginDAO.hide_message()",2000);
  }
}