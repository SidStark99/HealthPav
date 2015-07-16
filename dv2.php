<?php
$conn = new mysqli("127.2.30.2:3306", "adminz4fLHns", "H6ZBH6GLK92Y", "hpav");
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
        $sql1 = "SELECT count(*) AS cnt FROM `demdata` WHERE `state`=\"$t_state\" and `hrate` >90 ";
        $sql2 = "SELECT count(*) AS cnt1 FROM `demdata` WHERE `state`=\"$t_state\"";
        $out = $conn->query($sql1);
        $out1 = $conn->query($sql2);

        while($row1 = $out->fetch_assoc())
        {
          //  echo $row['state']."  ".$row1['cnt']."</br>";
            $cntnorm[]=$row1['cnt'];
            $statea[]=$row['state'];
        }
        while($row2 = $out1->fetch_assoc())
        {
            //echo $row['state']."  ".$row2['cnt1']."</br>";
            $percntn[]=$row2['cnt1'];
        }
        //echo "<br>";
        //$rowsnorm[]=$row;\"Gujarat\"
    }

}
$avg;
$avarray=array();
for($i=0;$i<count($percntn);$i++) {
  if($percntn[$i]==0) {
    $avg=0;
    $avarray[$i]=$avg;
  }
  else {
  $avg=($cntnorm[$i]/$percntn[$i])*100;
  $avarray[$i]=$avg;
  $avg=0;
  }
}

$pusharray=array();
for($o=0;$o<count($statea);$o++) {
  $pusharray[$o]=array($statea[$o],$avarray[$o]);
}

echo json_encode($pusharray,JSON_NUMERIC_CHECK);
//header("Location: 1.html");
/*
$pusharray=array();
array_push($pusharray,$statea);
array_push($pusharray,$avarray);
echo json_encode($pusharray, JSON_NUMERIC_CHECK);//echo json_encode($percntn);
$fp = fopen('data.json', 'w');
fwrite($fp, json_encode($pusharray));
fclose($fp);
*/
?>
