<?php
$serverName = "DESKTOP-4MP2AHJ\SQLEXPRESS";
$connectionInfo = array( "Database"=>"4Kids","UID"=>"Khoa", "PWD"=>"daduthankhach2");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>