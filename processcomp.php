<?php
session_start();
require_once('database.php');

if($_POST[act]==1)
{
	$sql = "UPDATE complaints SET stat=1 WHERE comid='$_POST[id]'" ;

              $ref = $result->query($sql);
}
else if($_POST[act]==2)
{
$sql = "UPDATE complaints SET stat=2 WHERE comid='$_POST[id]'" ;

              $ref = $result->query($sql);

}
header("location:viewcomplaint.php");
?>