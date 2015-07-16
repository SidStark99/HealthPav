<?php


if(isset($_POST['age']) && !empty($_POST['age']) && isset($_POST['gen']) && !empty($_POST['gen'])
      && isset($_POST['state']) && !empty($_POST['state']) && isset($_POST['city']) && !empty($_POST['city'])
      && isset($_POST['height']) && !empty($_POST['height']) && isset($_POST['weight']) && !empty($_POST['weight'])
      && isset($_POST['hrate']) && !empty($_POST['hrate']) && isset($_POST['bp']) && !empty($_POST['bp'])
      && isset($_POST['tmp']) && !empty($_POST['tmp']) && isset($_POST['oxim']) && !empty($_POST['oxim'])
      && isset($_POST['hrv']) && !empty($_POST['hrv']))
{
  $age=$_POST['age'];
  $genn=$_POST['gen'];
  $state=$_POST['state'];
  $city=$_POST['city'];
  $height=$_POST['height'];
  $weight=$_POST['weight'];
  $hrate=$_POST['hrate'];
  $bp=$_POST['bp'];
  $temperature=$_POST['tmp'];
  $ecg=$_POST['ecg'];
  $oxim=$_POST['oxim'];
  $hrv=$_POST['hrv'];
}

$conn = new mysqli('127.2.30.2:3306', 'adminz4fLHns', 'H6ZBH6GLK92Y', 'hpav');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cityf="\"".$city."\"";
$statef="\"".$state."\"";
$gennf="\"".$genn."\"";

$sql="INSERT INTO demdata (location, state,age,gender,height,weight,hrate,bp,temperature,oximetry,hrv)
VALUES ($cityf, $statef,$age,$gennf,$height,$weight,$hrate,$bp,$temperature,$oxim,$hrv)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
sleep(1);
header("Location: index.html");
?>
