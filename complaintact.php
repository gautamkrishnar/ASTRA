<?php
session_start();
require_once('database.php');

$sql = "SELECT MAX(comid) as id FROM complaints";
$ref = $result->query($sql);
$row = mysqli_fetch_assoc($ref);
$comid=$row[id]+1;

if(isset($_POST[spec]))
{
$sql = "INSERT INTO complaints VALUES($comid,$_SESSION[uid],$_POST[rid],'$_POST[desc]',0,'Complaint about Service','$_SESSION[name]')";
$ref = $result->query($sql);

}
else if (isset($_POST[general]))
{
$sql = "INSERT INTO complaints VALUES($comid,$_SESSION[uid],'NULL','$_POST[desc]',0,'$_POST[title]','$_SESSION[name]')";
$ref = $result->query($sql);
echo"gen $sql";
}
header("location:user.php");
?>