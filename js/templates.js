var count=0;
var time=0;
var templates={
  combo:function(obj,id){
    var combo='';
    combo+='<option value="0">--Seleccione--</option>';
    $.each(obj,function ( key,data ) {
    combo+='<option value='+data.id+'>'+data.nombre+'</option>';
    } );
    $('#'+id).html(combo);
  },
  MsgError:function(message,width){
    var html='';
    html+='<div>';
        html+='<div class="ui-state-error ui-corner-all paddingMsg" style="width:'+width+'  ">'
            html+='<p>';
                html+='<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 0.3em;"></span>';
                html+='<strong>Alert:</strong>';
                html+=message;
            html+='</p>';
        html+='</div>';
    html+='</div>';
    return html;
  },
  MsgInfo:function(message,width){
    var html='';
    html+='<div>';
        html+='<div class="ui-state-highlight ui-corner-all paddingMsg" style=" width:'+width+' ">'
            html+='<p>';
                html+='<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 0.3em;"></span>';
                html+='<strong>Alert:</strong>';
                html+=message;
            html+='</p>';
        html+='</div>';
    html+='</div>';
    return html;
  },
  IMGloadingContentTable:function(){
    var html='';
    html+='<tr>';
      html+='<td align="center"><img src="../img/loading_.gif" /></td>';
    html+='</tr>';
    return html;
  },
  IMGloadingContentLayer:function(){
    var html='';
      html+='<div align="center"><img src="../img/loading_.gif" /></div>';
    return html;	
  },
  LoadingCombo:function(){
    var html='';
      html+='<option value="0">Cargando...</option>';
    return html;
  },
  IMGloadingContent:function(){
    var html='';
    html+='<img src="../img/loading.gif">';
    return html;
  },
  lblalert:function(message,width){
    var html='';
    html+='<span class="alert" style=" width:'+width+'"">'+message+'</span>';
    return html;
  },
  lblinfo:function(message,width){
    var html='';
    html+='<span class="info" style=" width:'+width+'"">'+message+'</span>';
    return html;
  },
  lblalerteffect:function(){
    count = count+1;
    var spanalert=document.getElementsByClassName('alert')[0];
    if(count==9){
      clearTimeout(time);
      count=0;
      spanalert.style.color = "red";
      spanalert = setTimeout(function(){
        var spanalert=document.getElementsByClassName('alert')[0];
        spanalert.style.opacity=0;
        //spanalert.remove();
      },3000);
    }else{
      time = setTimeout("templates.lblalerteffect()",200);
      spanalert.style.textShadow = spanalert.style.textShadow == "0px 0px 30px red" ? "none" :"0px 0px 30px red";
      spanalert.style.color = spanalert.style.color == "red" ? "white" :"red";
    }
  },
  lblinfoeffect:function(){
    count = count+1;
    var spanalert=document.getElementsByClassName('info')[0];
    if(count==9){
      clearTimeout(time);
      count=0;
      spanalert.style.color = "green";
      spanalert = setTimeout(function(){
        var spanalert=document.getElementsByClassName('info')[0];
        spanalert.style.opacity=0;
        //spanalert.remove();
      },3000);
    }else{
      time = setTimeout("templates.lblinfoeffect()",200);
      spanalert.style.textShadow = spanalert.style.textShadow == "0px 0px 30px green" ? "none" :"0px 0px 30px green";
      spanalert.style.color = spanalert.style.color == "green" ? "white" :"green";
    }
  }
}


