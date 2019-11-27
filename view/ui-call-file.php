<?php
if(isset($_GET['abrir_pagina'])){
    switch ($_GET['abrir_pagina']) {
    	case 'registro-gestion':    		
    		$call_file='<script type="text/javascript" src="../js/RegistroGestionJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/RegistroGestionDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-registro-gestion.js" ></script>';
    		break;
        case 'consulta-gestion':
            $call_file='<script type="text/javascript" src="../js/RegistroGestionJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/RegistroGestionDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-registro-gestion.js" ></script>';
            break;
        case 'fundo':
            $call_file='<script type="text/javascript" src="../js/FundoJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/FundoDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-fundo.js" ></script>';
            break;
        case 'cultivo':
            $call_file='<script type="text/javascript" src="../js/CultivoJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/CultivoDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-cultivo.js" ></script>';
            break;
        case 'objetivo':
            $call_file='<script type="text/javascript" src="../js/ObjetivoJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/ObjetivoDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-objetivo.js" ></script>';
            break;
        case 'problema':
            $call_file='<script type="text/javascript" src="../js/ProblemaJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/ProblemaDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-problema.js" ></script>';
            break;
        case 'cierre':
            $call_file='<script type="text/javascript" src="../js/CierreJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/CierreDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-cierre.js" ></script>';
            break;
        case 'distribuidor':
            $call_file='<script type="text/javascript" src="../js/DistribuidorJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/DistribuidorDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-distribuidor.js" ></script>';
            break;
        case 'producto':
            $call_file='<script type="text/javascript" src="../js/ProductoJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/ProductoDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-producto.js" ></script>';
            break;
        case 'usuario':
            $call_file='<script type="text/javascript" src="../js/UsuarioJQGRID.js" ></script>
                        <script type="text/javascript" src="../js/UsuarioDAO.js" ></script>
                        <script type="text/javascript" src="../js/js-usuario.js" ></script>';
            break;
        default:
            $call_file='';
        break;
    }
}
?>