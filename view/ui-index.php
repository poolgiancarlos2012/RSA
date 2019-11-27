<?php
session_start();
if (!isset($_SESSION['logeo'])) {header('Location:../index.php');}
else if(!$_SESSION['activo']) {header('Location:../index.php');}
include('ui-call-file.php');
?>
<!DOCTYPE html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Sistem">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="shortcut icon" href="../img/andina.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="../includes/jquery-ui-1.8/themes/smoothness/jquery-ui.css"/>
    <link rel='stylesheet' href='../css/normalize.css'/>
    <link type="text/css" rel="stylesheet" href="../css/css-estilos.css" />
    <link type="text/css" rel="stylesheet" media="screen" href="../includes/jqgrid-3.8.2/css/ui.jqgrid.css" />	
    <script type="text/javascript" src="../js/includes/jquery-1.4.2.js" ></script>

    <script type="text/javascript" src="../includes/jquery-ui-1.8.1/development-bundle/ui/minified/jquery.ui.effects.menu.js" ></script>
    <script type="text/javascript" src="../includes/jquery-ui-1.8.1/development-bundle/ui/minified/jquery.ui.menu.js" ></script>
    <script type="text/javascript" src="../includes/jquery-ui-1.8/ui/jquery.ui.datepicker.js" ></script>
    <script type="text/javascript" src="../includes/jquery-ui-1.8/ui/jquery-ui.js" ></script>
    <script type="text/javascript" src="../includes/jqgrid-3.8.2/js/i18n/grid.locale-es.js" ></script>
    <script type="text/javascript" src="../includes/jqgrid-3.8.2/js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="../js/includes/jquery.maskedinput-1.2.2.js" ></script>
    <!--CARGA ARCHIVOS-->
    <link type="text/css" rel="stylesheet" href="../css/jquery.fileupload-ui.css" />
    <script type="text/javascript" src="../js/includes/jquery.upload-1.0.2.js" ></script>
    <script type="text/javascript" src="../js/includes/jquery.fileupload.js" ></script>
    <script type="text/javascript" src="../js/includes/jquery.fileupload-ui.js" ></script>
    <!--COMBOBOX JQUERY FILTER-->
    <link type="text/css" rel="stylesheet" href="../css/jquery.multiselect.css" />
    <script type="text/javascript" src="../includes/jquery-ui-1.8.1/development-bundle/ui/minified/jquery.multiselect.js" ></script>
    <script type="text/javascript" src="../includes/jquery-ui-1.8.1/development-bundle/ui/minified/jquery.multiselect.filter.js" ></script>
    <link type="text/css" rel="stylesheet" media="screen" href="../includes/jquery-ui-1.8.1/development-bundle/ui/minified/jquery.multiselect.filter.css"/>
    <!--COMBOBOX JQUERY FILTER-->
    <script type="text/javascript" src="../js/templates.js" ></script>
    <script type="text/javascript" src="../js/validacion.js" ></script>
    <script type="text/javascript" src="../js/IndexDAO.js" ></script>
    <script type="text/javascript" src="../js/js-index.js" ></script>
    <script src="../js/prefixfree.min.js"></script>

    <!--ALERT-->
    <link type="text/css" rel="stylesheet" media="screen" href="../includes/alertify.core.css" />
    <link type="text/css" rel="stylesheet" media="screen" href="../includes/alertify.default.css" />  
    <script type="text/javascript" src="../includes/alertify.min.js" ></script>
    
    <!--VALIDATION-->
    <script type="text/javascript" src="../js/validacion.js" ></script>

    <?php echo (isset($call_file)==TRUE) ? $call_file : "";?>
    </head>
<body>
    <input type="hidden" name="" id="hdidusuario" value="<?php echo $_SESSION['idusuario'];?>">
    <input type="hidden" name="" id="hdcierre_estado" value="">
    <div class="content">       
        <div id="principal" style="width:250px;height:100%;float:left;">
                <header><?php include('ui-header.php');?></header>
                <nav><?php include('ui-nav.php');?></nav>
        </div>
        <div id="secundario" style="width:830px;height:100%;float:left;">
            <div class="datos" style="position:relative;height: 50px;">
                <div style=";position:absolute;left:20px;top:15px;">[ <span id="idini"></span> - <span id="idfin"></span> ]</div>
                <div style=";position:absolute;left:240px;top:15px;">[ <span id="idprog"></span> - <span id="idmodo"></span> ]</div>
                <div style=";position:absolute;right:90px;top:15px;">Soporte al: 942660672 (Movistar)</div>

                <div class="cerrarsession" style=";position:absolute;right:10px;top:15px;">
                    <a title="Cerrar Sesi&oacute;n" id="idcerrarsession"  class=" fa fa-sign-out" href="../close.php">  <img src="../img/system_log_out.png" width=20> </a>
                </div>
            </div>
            <section><?php include('ui-section.php');?></section>
        </div>
        <div id="terciario" style="float:left;width:100%;">
            <footer><?php include('ui-footer.php');?></footer>
        </div>
    </div>
    <div id="layerOverlay" class="ui-widget-overlay" style="display: none;">Espere Por Favor</div>
    <div id="layerLoading" style="position:absolute ;left: 50%;top: 50%; width: 400px;height: 100px;margin-left: -200px;margin-top: -50px;text-align: center;font-weight: bold; font-size: 18px; color: #AFAFAF; z-index: 100;  display: none;">Loading...</div>
</body>
</html>