$(document).ready(function () {

    var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = 'http://191.98.186.82:8080/SFW/favicon.ico';
    document.getElementsByTagName('head')[0].appendChild(link);
    
    $('#txtusuario').focus();
    $("#txtusuario").keyup(function (e) {
        if (e.keyCode == 13) {
            if ($("#txtusuario").val() == "") {
                $('#layerMessage').html(templates.lblalert('Por favor, Ingrese Usuario', '250px'));
                templates.lblalerteffect();
                $('#txtusuario').focus();
            } else {
                $('#txtpassword').focus();
            }
        }
        ;
    });
    $("#txtpassword").keyup(function (e) {
        if (e.keyCode == 13) {
            if ($("#txtusuario").val() == "") {
            } else {
                logeo();
            }
        }
        ;
    });
    logeo = function () {
        var rs = validacion.check([
            {
                id: 'txtusuario', required: true, errorRequiredFunction: function ( ) {
                    $('#' + loginDAO.idLayerMessage).html(templates.lblalert('Por favor, Ingrese Usuario', '250px'));
                    templates.lblalerteffect();


                }
            },
            {
                id: 'txtpassword', required: true, errorRequiredFunction: function ( ) {
                    $('#' + loginDAO.idLayerMessage).html(templates.lblalert('Por favor, Ingrese Password', '250px'));
                    templates.lblalerteffect();
                }
            }
        ]);
        if (rs) {
            loginDAO.checkUser();
        }
    }
});