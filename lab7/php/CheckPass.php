<?php
    require_once('../lib/nusoap.php');
    if(!isset($_SESSION)) 
        session_start();      
    
    $soapclient = new nusoap_client('https://sergiotobalsw.000webhostapp.com/lab5/php/servicePass.php?wsdl',true);
    $result = $soapclient->call('comprobar', array('pass'=>$_POST['pass2']));
    print_r($result);
?>