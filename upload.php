<?php

session_start();
require_once('database.php');
require_once('way2sms-api.php');


echo "<a href=\"user.php\">Success go back to user home page.</a>";
$cid=$_POST[cid];
$rand = substr(md5(microtime()),rand(0,26),5);
$sql = "SELECT * FROM certificates WHERE cid=$cid" ;
$ref = $result->query($sql);
$row = mysqli_fetch_assoc($ref);
$desc=$row["cname"];
$sql = "SELECT MAX(rid) as id FROM requesta" ;
$ref = $result->query($sql);
$row = mysqli_fetch_assoc($ref);

$reqid=$row["id"]+1;

$sql = "SELECT * FROM employee WHERE role=1  order by todaycount  LIMIT 1" ;
$ref = $result->query($sql);
$row = mysqli_fetch_assoc($ref);
$officer=$row["eid"];

$sql = "UPDATE employee SET todaycount=todaycount+1 WHERE eid=$officer" ;
$ref = $result->query($sql);
$row = mysqli_fetch_assoc($ref);

$sql = "INSERT INTO requesta (rid,officerid,userid,cid,maxdays,deptid,stat,description,code) VALUES($reqid,$officer,$_SESSION[uid],$cid,6,1,0,'$desc','$rand')";
$ref = $result->query($sql);
//echo $sql;
$target_dir = "uploads/";
//APP
$msg=" ";
$msg1=" ";
$filename=basename($_FILES["app"]["name"]);
$msg.= $filename;
$msg.='\n';
$extension = $ext = pathinfo($filename, PATHINFO_EXTENSION);
$msg.= $extension;
$msg.='\n';


$target_file = $target_dir . $_SESSION["uid"] . 'app'.$reqid.'.' . $extension;

$msg.= $target_file;
$msg.='\n';



//echo $target_file;
//echo basename($_FILES["imgupload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["app"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg= "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPEG"
&& $imageFileType != "gif" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt"  && $imageFileType != "pdf") {
    $msg.= "   Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $msg.='\n';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg.= "Sorry, your file was not uploaded.";
    $msg.='\n';
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES['app']['tmp_name'], $target_file)) {
        $msg.= "The file ". basename( $_FILES["app"]["name"]). " has been uploaded.";
        $msg.='\n';
        
    } else {
        $msg.= "Sorry, there was an error uploading your file.";
        $msg.='\n';
    }

}
//echo $msg;

//Ration
$msg=" ";
$msg1=" ";
$filename=basename($_FILES["ration"]["name"]);
$msg.= $filename;
$msg.='\n';
$extension = $ext = pathinfo($filename, PATHINFO_EXTENSION);
$msg.= $extension;
$msg.='\n';


$target_file = $target_dir . $_SESSION["uid"] . 'ration'.$reqid.'.' . $extension;

$msg.= $target_file;
$msg.='\n';



//echo $target_file;
//echo basename($_FILES["imgupload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["ration"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg= "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPEG"
&& $imageFileType != "gif" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt"  && $imageFileType != "pdf") {
    $msg.= "   Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $msg.='\n';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg.= "Sorry, your file was not uploaded.";
    $msg.='\n';
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES['ration']['tmp_name'], $target_file)) {
        $msg.= "The file ". basename( $_FILES["ration"]["name"]). " has been uploaded.";
        $msg.='\n';
        
    } else {
        $msg.= "Sorry, there was an error uploading your". basename( $_FILES["ration"]["name"]). " file.";
        $msg.='\n';
    }

}
//echo $msg;

//land
$msg=" ";
$msg1=" ";
$filename=basename($_FILES["land"]["name"]);
$msg.= $filename;
$msg.='\n';
$extension = $ext = pathinfo($filename, PATHINFO_EXTENSION);
$msg.= $extension;
$msg.='\n';


$target_file = $target_dir . $_SESSION["uid"] . 'land'.$reqid.'.' . $extension;

$msg.= $target_file;
$msg.='\n';



//echo $target_file;
//echo basename($_FILES["imgupload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["land"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg= "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPEG"
&& $imageFileType != "gif" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt"  && $imageFileType != "pdf") {
    $msg.= "   Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $msg.='\n';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg.= "Sorry, your file was not uploaded.";
    $msg.='\n';
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES['land']['tmp_name'], $target_file)) {
        $msg.= "The file ". basename( $_FILES["land"]["name"]). " has been uploaded.";
        $msg.='\n';
        
    } else {
        $msg.= "Sorry, there was an error uploading your". basename( $_FILES["ration"]["name"]). " file.";
        $msg.='\n';
    }

}
//echo $msg;

//Salary
$msg=" ";
$msg1=" ";
$filename=basename($_FILES["salary"]["name"]);
$msg.= $filename;
$msg.='\n';
$extension = $ext = pathinfo($filename, PATHINFO_EXTENSION);
$msg.= $extension;
$msg.='\n';


$target_file = $target_dir . $_SESSION["uid"] . 'salary'.$reqid.'.' . $extension;

$msg.= $target_file;
$msg.='\n';



//echo $target_file;
//echo basename($_FILES["imgupload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["salary"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg= "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPEG"
&& $imageFileType != "gif" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt"  && $imageFileType != "pdf") {
    $msg.= "   Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $msg.='\n';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg.= "Sorry, your file was not uploaded.";
    $msg.='\n';
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES['salary']['tmp_name'], $target_file)) {
        $msg.= "The file ". basename( $_FILES["salary"]["name"]). " has been uploaded.";
        $msg.='\n';
        
    } else {
        $msg.= "Sorry, there was an error uploading your". basename( $_FILES["ration"]["name"]). " file.";
        $msg.='\n';
    }

}
//echo $msg;
header("location:user.php");
?>