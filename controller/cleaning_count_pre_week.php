<?php
 // session_start();
//   if(!isset($_SESSION['username'])){
// header('Location: ../go_back.html');
//     exit;
//   }

$total = array();
$category = "";
$sum = 0;
$no_of_columns = 0;
$no_of_rows = 0;
$week = intval(date("W"))-1;
if ($week == 0){
  $week = 53;
}
if ($week <= 9) {
	$week = strval($week);
	$week = "0".$week;
} else {
	$week = strval($week);
}
$meta = "";
$count = array();

try {
 
	include 'connection.php';
	
$records = $dbconn->prepare("SELECT * FROM CLEANING_COUNT where weeknumber = '$week';");
$records->execute();
// $result = $records->fetch(PDO::FETCH_ASSOC);
$result = $records->fetchAll();
$no_of_columns = $records->columnCount();
$no_of_rows = $records->rowCount();
// $result = $records->fetchAll();
// echo $no_of_rows;
// echo $no_of_columns."<br>";
for($i = 2; $i < $no_of_columns ; $i++){
	for ($j=0; $j <= $no_of_rows-1 ; $j++) { 
		 $sum = $sum + intval($result[$j][$i]);
		// echo "result[".$j."][".$i."]".$result[$j][$i];
	}
	$p = $i-2;
	$count[$p] = $sum;
	$sum = 0;
}
// echo "No of Cols : ".$no_of_columns."<br>";
// for($x = 0; $x < $no_of_columns-2 ; $x++){
// 	echo $count[$x]."<br>";
// 	// echo "count[".$i."]".$count[$i]."<br";
// }

echo "<html><head></head><body>";
echo "<table border = 0>";
	echo "<tr>";
		echo "<td class='name'>Service Requests:</td>";
		echo "<td class='t_count'>".trim($count[0])."</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td class='name'>Incidents:</td>";
		echo "<td class='t_count'>".trim($count[1])."</td>";
	echo "</tr>";
	
echo "</table></body></html>";


}catch(PDOException $e) {
 	echo 'ERROR: ' . $e->getMessage();
}
?>