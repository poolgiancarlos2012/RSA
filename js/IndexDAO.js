var IndexDAO={
    url:'../controller/ControllerAlfa.php',
    idLayerMessage : 'layerMessage',
    hide_message:function(){
        $('#'+indexDAO.idLayerMessage).effect('blind',{direction:'vertical'},'slow',function(){ $(this).empty().css('display','block'); });		
    },
    setTimeOut_hide_message:function(){
        setTimeout("indexDAO.hide_message()",2000);
    },
    inDays: function(dd1, dd2) { // Solo para formato dd/mm/yyyy

        d1= new Date(dd1.split("/").reverse().join("-"));
        d2= new Date(dd2.split("/").reverse().join("-"));

        var t2 = d2.getTime();
        var t1 = d1.getTime();
        return parseInt((t2-t1)/(24*3600*1000));
    },
    inWeeks: function(dd1, dd2) {

        d1= new Date(dd1.split("/").reverse().join("-"));
        d2= new Date(dd2.split("/").reverse().join("-"));

        var t2 = d2.getTime();
        var t1 = d1.getTime();
        return parseInt((t2-t1)/(24*3600*1000*7));
    },
    inMonths: function(dd1, dd2) {

        d1= new Date(dd1.split("/").reverse().join("-"));
        d2= new Date(dd2.split("/").reverse().join("-"));

        var d1Y = d1.getFullYear();
        var d2Y = d2.getFullYear();
        var d1M = d1.getMonth();
        var d2M = d2.getMonth();
        return (d2M+12*d2Y)-(d1M+12*d1Y);
    },
    inYears: function(dd1, dd2) {

        d1= new Date(dd1.split("/").reverse().join("-"));
        d2= new Date(dd2.split("/").reverse().join("-"));

        return d2.getFullYear()-d1.getFullYear();
    },
    Fecha_Hoy: function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var HH = today.getHours();
        var ii = today.getMinutes();
        var ss = today.getSeconds();

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        } 
        if(mm<10){
            mm='0'+mm;
        } 
        var hoy = yyyy+'-'+mm+'-'+dd+' '+HH+':'+ii+':'+ss;
        return hoy;
    },
    FechaCierre:function(){
        $.ajax({
            url:this.url,
            type:'POST',
            dataType:'json',
            data:{
                command:'index',
                action:'FechaCierre',
            },
            success:function(obj){
                if( obj.rst ){
                    

                    if(obj.dato.length>0){
                        $("#idini").text(obj.dato[0]['ini']);
                        $("#idfin").text(obj.dato[0]['fin']);
                        $("#idprog").text(obj.dato[0]['programacion']);
                        $("#idmodo").text(obj.dato[0]['modo']);
                    }else{
                        $("#idini").text('00/00/0000 00:00:00');
                        $("#idfin").text('00/00/0000 00:00:00');
                        $("#idprog").text('NINGUNO');
                        $("#idmodo").text('NINGUNO');
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
}


