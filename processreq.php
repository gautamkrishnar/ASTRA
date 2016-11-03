<?php
session_start();
require_once('database.php');

if (isset($_POST[approve]))
{
	$sql = "UPDATE requesta SET stat=1 WHERE code=$_POST[code]" ;

              $ref = $result->query($sql);
}
else if (isset($_POST[reject]))
{
$sql = "UPDATE requesta SET stat=2 WHERE code=$_POST[code]" ;

              $ref = $result->query($sql);

}
header("location:officer.php");


?>