<?php
include('way2sms-api.php');
$client = new WAY2SMSClient();
$client->login( '9446335048' , 'D2295W' );
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
