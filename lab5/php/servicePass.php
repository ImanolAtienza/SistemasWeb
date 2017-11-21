<?php
    require_once('../lib/nusoap.php');

    function comprobar($pass) {
        if (strpos(file_get_contents("toppasswords.txt"), $pass) == false){
        	return "VALIDA";
        }
    	return "INVALIDA";
    }
    $server = new soap_server();
    $server->configureWSDL("servicePass", "urn:servicePass");
    $server->register("comprobar",
        array("pass" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:servicePass",
        "urn:servicePass#comprobar",
        "rpc",
        "encoded",
        "");
    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
    $server->service($HTTP_RAW_POST_DATA);
?>