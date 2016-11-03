<?php
session_start();
//if (!isset($_SESSION["auth"]))
		//header("location:login.php");
print_r($_POST);
		$user=$_POST["username"];
		$pass=$_POST["password"];

		if($user=="user1" && $pass=="user1")
		{

		  $_SESSION["uid"]=1;
		  $_SESSION["role"]=1;
		  	 $_SESSION["name"]="USER 1";
		  $_SESSION["auth"]=1;
		}
		else if($user=="user2" && $pass=="user2")
		{

		  $_SESSION["uid"]=2;
		  $_SESSION["role"]=1;
		  	 $_SESSION["name"]="USER 2";
		  $_SESSION["auth"]=1;
		}
		else if ($user=="officer3" && $pass=="officer3")
		{
		 $_SESSION["uid"]=1;
		 $_SESSION["role"]=3;
		 $_SESSION["name"]="HIGHER OFFICER";
		 $_SESSION["auth"]=1;
		}
		else if ($user=="officer1" && $pass=="officer1")
		{
			$_SESSION["uid"]=1;
			$_SESSION["name"]="OFFICER 1";
		 	$_SESSION["role"]=2;
		 	$_SESSION["auth"]=1;
		}
		else if ($user=="officer2" && $pass=="officer2")
		{
			$_SESSION["uid"]=2;
			$_SESSION["name"]="OFFICER 2";
		 	$_SESSION["role"]=2;
		 	$_SESSION["auth"]=1;
		}
		else if ($user=="admin" && $pass=="password")
		{
			$_SESSION["uid"]=2;
			$_SESSION["name"]="ADMIN";
		 	$_SESSION["role"]=10;
		 	$_SESSION["auth"]=1;
		}
else 
//header("location:login.php");
print_r($_SESSION);
if($_SESSION["role"]==1)
{
	header("location:user.php");
}
else if($_SESSION["role"]==2)
{
	header("location:officer.php");
}
else if($_SESSION["role"]==3)
{
	header("location:officer.php");
}
else if($_SESSION["role"]==10)
{
	header("location:admin.php");
}




?>