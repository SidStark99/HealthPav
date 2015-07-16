<?php
$conn = new mysqli("localhost", "root", "password", "healthp");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT distinct `state` FROM `demdata` ORDER BY state";
$resultnorm = $conn->query($sql);

$cntnorm=array();
$percntn=array();
$statea=array();
if ($resultnorm->num_rows > 0) {
    // output data of each row
    while($row = $resultnorm->fetch_assoc())
    {

        //echo  "- State: " . $row["state"]."<br>";
        $t_state=$row['state'];
        $statea[]=$row['state'];
    }

}


echo json_encode($statea,JSON_NUMERIC_CHECK);
?>
