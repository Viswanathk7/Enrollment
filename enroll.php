<!DOCTYPE html>
<html lang="en-us">
<meta charset="utf-8" />
<head>
<title>Enroll</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
@import url("http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");
@import url("http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700");
*{margin:0; padding:0}
body{background:#294072; font-family: 'Source Sans Pro', sans-serif}
.form{width:400px; margin:0 auto; background:#1C2B4A; margin-top:150px}
.header{height:44px; background:#17233B}
.header h2{height:44px; line-height:44px; color:#fff; text-align:center}
.login{padding:0 20px}
.login span.un{width:10%; text-align:center; color:#0C6; border-radius:3px 0 0 3px}
.text{background:#12192C; width:90%; border-radius:0 3px 3px 0; border:none; outline:none; color:#999; font-family: 'Source Sans Pro', sans-serif} 
.text,.login span.un{display:inline-block; vertical-align:top; height:40px; line-height:40px; background:#12192C;}

.btn{height:40px; border:none; background:#0C6; width:100%; outline:none; font-family: 'Source Sans Pro', sans-serif; font-size:20px; font-weight:bold; color:#eee; border-bottom:solid 3px #093; border-radius:3px; cursor:pointer}
ul li{height:40px; margin:15px 0; list-style:none}
.span{display:table; width:100%; font-size:14px;}
.ch{display:inline-block; width:50%; color:#CCC}
.ch a{color:#CCC; text-decoration:none}
.ch:nth-child(2){text-align:right}
/*social*/
.social{height:30px; line-height:30px; display:table; width:100%}
.social div{display:inline-block; width:42%; color:#eee; font-size:12px; text-align:center; border-radius:3px}
.social div i.fa{font-size:16px; line-height:30px}
.fb{background:#3B5A9A; border-bottom:solid 3px #036} .tw{background:#2CA8D2; margin-left:16%; border-bottom:solid 3px #3399CC}
/*bottom*/
.sign{width:90%; padding:0 5%; height:50px; display:table; background:#17233B}
.sign div{display:inline-block; width:50%; line-height:50px; color:#ccc; font-size:14px}
.up{text-align:right}
.up a{display:block; background:#096; text-align:center; height:35px; line-height:35px; width:50%; font-size:16px; text-decoration:none; color:#eee; border-bottom:solid 3px #006633; border-radius:3px; font-weight:bold; margin-left:50%}
@media(max-width:480px){ .form{width:100%}}
</style>
</head>
<body>
<div class="form">
<div class="header"><h2>Please Wait</h2></div>
<div class="login">
<br/>
<div align="center"><img src="ajax-loader.gif" alt="Searching" /></div>
</div>
<?php
$s1=$_POST["rno"];
$s2=$_POST["name"];
$s3=$_POST["dept"];
$s4=$_POST["yos"];
$s5=$_POST["email"];
$s6=$_POST["ps"];
$s7=mt_rand();
$len=strlen($s6);
$target_dir = "/var/www/html/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
//$s1="circ";
$s="/var/www/html/$s1";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
     if($check !== false) {
        $uploadOk = 1;
    } else {
      
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your Pic was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (copy( $_FILES["fileToUpload"]["tmp_name"],$s)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
if ((!filter_var($s5, FILTER_VALIDATE_EMAIL))||($len < 6))
{
echo "INVALID E-mail Address or Password";
header("Refresh: 1;enroll.html");
}
else
{
$myfile = fopen("/home/viswanath/webserver.cfg", "r") or die("Unable to open file!");
$myyfile = fgets($myfile,filesize("/home/viswanath/webserver.cfg"));
$myyyfile = fopen("/home/viswanath/webserver1.cfg", "r") or die("Unable to open file!");
$myyyyfile=fgets($myyyfile,filesize("/home/viswanath/webserver1.cfg"));
$servername = "localhost";
$username=$myyfile;
$password=$myyyyfile;
// Create connection
$conn = new mysqli($servername, $username, $password);
if(mysql_select_db($conn , 'ENROLL'))
{
$myfile = fopen("/home/viswanath/webserver.cfg", "r") or die("Unable to open file!");
$myyfile = fgets($myfile,filesize("/home/viswanath/webserver.cfg"));
$myyyfile = fopen("/home/viswanath/webserver1.cfg", "r") or die("Unable to open file!");
$myyyyfile=fgets($myyyfile,filesize("/home/viswanath/webserver1.cfg"));
$servername = "localhost";
$username=$myyfile;
$password=$myyyyfile;
// Create connection
$connnn = new mysqli($servername, $username, $password);
// Check connection
if ($connnn->connect_error) {
    
} 
$sqlll= "INSERT INTO enroll1 (Rno, Name,Dept,Year,Email,Password,Uniq)
VALUES ('$s1', '$s2', '$s3','$s4','$s5','$s6','$s7')";
if (mysqli_query($connnn, $sqlll)) {
header("Refresh: 0;enroll1.html");    
} 
else {
     echo "<br>"."Registration Failed Redirecting"."<br>";
    header("Refresh: 2;enroll.html");
}
$connnn->close();
}
else{
// Create database
$sql = "CREATE DATABASE ENROLL";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} 

$conn->close();

$myfile = fopen("/home/viswanath/webserver.cfg", "r") or die("Unable to open file!");
$myyfile = fgets($myfile,filesize("/home/viswanath/webserver.cfg"));
$myyyfile = fopen("/home/viswanath/webserver1.cfg", "r") or die("Unable to open file!");
$myyyyfile=fgets($myyyfile,filesize("/home/viswanath/webserver1.cfg"));
$servername = "localhost";
$username=$myyfile;
$password=$myyyyfile;
$dbname="ENROLL";
// Create connection
$connn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connn->connect_error) {
    die("Connection failed: " . $connn->connect_error);
} 
$sqll = "CREATE TABLE enroll1 (Rno VARCHAR(30) ,Name VARCHAR(30) NOT NULL,
Dept VARCHAR(30),Year INT(5),Email VARCHAR(30),Password VARCHAR(30)NOT NULL,Uniq VARCHAR(30))";
if ($connn->query($sqll) === TRUE) {
    } 
$connn->close();
$myfile = fopen("/home/viswanath/webserver.cfg", "r") or die("Unable to open file!");
$myyfile = fgets($myfile,filesize("/home/viswanath/webserver.cfg"));
$myyyfile = fopen("/home/viswanath/webserver1.cfg", "r") or die("Unable to open file!");
$myyyyfile=fgets($myyyfile,filesize("/home/viswanath/webserver1.cfg"));
$servername = "localhost";
$username=$myyfile;
$password=$myyyyfile;
$dbname="ENROLL";
// Create connection
$co = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($co->connect_error) {
    die("Connection failed: " . $co->connect_error);
} 
$sq= "INSERT INTO enroll1 (Rno, Name,Dept,Year,Email,Password,Uniq)
VALUES ('$s1', '$s2', '$s3','$s4','$s5','$s6','$s7')";
if (mysqli_query($co, $sq)) {
header("Refresh: 0;enroll1.html");    
} 
else {
     echo "<br>"."Registration Failed Redirecting"."<br>";
    header("Refresh: 2;enroll.html");
}
$co->close();
}
}

?>


