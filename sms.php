<?php
include('way2sms-api.php');
$client = new WAY2SMSClient();
$client->login( 'NO' , 'PASS' );
$num=$_GET['num'];
$msg=$_GET['msg'];
if($_GET['key']=="apple") {
    echo "Sending sms to " . $num . " Msg:" . $msg;
    $client->send($num, $msg);
}
else{
    exit(0);
}
?>
