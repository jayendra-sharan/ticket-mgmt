<?php
 // session_start();
  // if(!isset($_SESSION['username'])){
  //   header('Location: ../go_back.html');
  //   exit;
  // }
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
$sr_count = "";
$inc_count = "";


try {

	include 'connection.php';

$records = $dbconn->prepare("SELECT * FROM TOTAL_COUNT where weeknumber = '$week';");
$records->execute();
$result = $records->fetch(PDO::FETCH_ASSOC);
// $result = $records->fetchAll();

$sr_count = trim($result['sr_count']);
$inc_count = trim($result['inc_count']);

if(!is_numeric($sr_count)){
	$sr_count = 0;
}
if(!is_numeric($inc_count)){
	$inc_count = 0;
}

echo "<html><head></head><body>";
echo "<table border = 0>";
	echo "<tr>";
		echo "<td class='name'>Service Requests:</td>";
		echo "<td class='t_count'>".$sr_count."</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td class='name'>Incidents:</td>";
		echo "<td class='t_count'>".$inc_count."</td>";
	echo "</tr>";
	
echo "</table></body></html>";
	 
/* Hints to get the column name, number of columns, number of rows and all other data from a table.
	// $records->bindParam(':username', $username);
	$records->execute();
	$result = $records->fetchAll(); // Fetches all Data
	$cols = $records->getColumnMeta(8); //based on Index (here 8) stores the column name
	echo $cols['name'];					//displays value of var cols
	print_r($result[0][0]);				//displays first record considering a 2d array
	print_r($result[1][0]);				//displays (1,0)

	echo $records->rowCount();			// displays total number of records
	echo $records->columnCount();		//displays total number of attributes of the table (columns)

*/	
}catch(PDOException $e) {
 	echo 'ERROR: ' . $e->getMessage();
}



?>