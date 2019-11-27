<?php
	session_start();
	if( isset($_SESSION['logeo']) AND $_SESSION['activo']==1 ) {
		header('Location: ../view/ui-index.php');
	}	
?>
<!DOCTYPE html>
	<head>
  	<title>GRUPO ANDINA</title>
    <link rel="shortcut icon" href="../img/andina.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="../js/" />
    <link type="text/css" rel="stylesheet" href="../includes/jquery-ui-1.8/themes/redmond/jquery-ui.css" />
    <link rel='stylesheet' href='../css/normalize.css'>
    <link type="text/css" rel="stylesheet" href="../css/css-estilos.css" />

    

    <script type="text/javascript" src="../js/includes/jquery-1.4.2.js" ></script>   


    <script type="text/javascript" src="../js/templates.js" ></script>
    <script type="text/javascript" src="../js/validacion.js" ></script>
    <script type="text/javascript" src="../js/loginDAO.js" ></script>
    <script type="text/javascript" src="../js/js-login.js" ></script>
    <script src="../js/prefixfree.min.js"></script>
  </head>  
  <body>
	<div class="login">    
      <table width="230" height="260" cellpadding="0" cellspacing="0" style="">
          <tr>
              <td height="10" align="center">
                  <span id="lbllogin" class="normal">

                  </span>
              </td>
          </tr>
          <tr>
            <td height="45" align="center">
              <img src="../img/LOGO-CAISAC.png" style="margin: 0px auto; display: block;" width="160">
            </td>
          </tr>
          <tr>
              <td height="10" align="center">
                  <span id="lbllogin" class="normal">

                  </span>
              </td>
          </tr>
          
          <tr>
              <td align="center" height="20">
                  <div id="layerMessage" align="center">&nbsp;</div>
              </td>
          </tr>
        <tr>
          <td height="120" align="center" valign="middle">
              <div class="image_perfil"><span class="icon-user-tie"></span></div>
          </td>
        </tr>
        <tr>
          <td height="93">
              <table style="width:100%;height:100%;" border="0">
                  <tr height="2">
                      <td width="55"></td>
                      <td></td>
                      <td width="10"></td>
                      <td></td>
                      <td width="55"></td>
                  </tr>
                  <tr height="20">
                      <td></td>
                      <td width="20" style="vertical-align:middle;text-align: right"><span class="icon-user"></span></td>
                      <td></td>
                      <td width="90"><input style="width: 150px;" type="text" id="txtusuario" class="textbox" placeholder="USERNAME"/></td>
                      <td></td>
                  </tr>
                  <tr height="2">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr height="20">
                      <td></td>
                      <td style="vertical-align:middle;text-align: right;"><span class="icon-key"></span></td>
                      <td></td>
                      <td><input style="width: 150px;" type="password" id="txtpassword" class="textbox" placeholder="PASSWORD"/></td>
                      <td></td>
                  </tr>                    
                  <tr height="2">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr height="20">
                      <td colspan="5">
                          <!-- <table style="width:100%;height:100%;" border="0">
                              <tr>
                                  <td align="left"><input type="checkbox" id="chkremenber"/><span class="normal">&nbsp;Recordar acceso</span></td>
                              </tr>
                          </table> -->
                      </td>
                  </tr>
              </table>
          </td>
        </tr>          
        <tr>
          <td height="24" align="center" valign="middle" >
              <input type="button" value="INGRESAR" class="btndestacado" style="" onClick="logeo()"/>
          </td>
        </tr>
        <tr>
          <td height="15"></td>
        </tr>
      </table>
      <div id="layerOverlay" class="ui-widget-overlay" style="display: none;"></div>
      <div id="layerLoading" style="position:absolute ;left: 50%;top: 45%; width: 100px; font-weight: bold; font-size: 18px; color: #AFAFAF; z-index: 100;  display: none;">Loading...</div>
  </body>
</html>