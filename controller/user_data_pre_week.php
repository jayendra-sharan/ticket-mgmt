<?php
 // session_start();
  // if(!isset($_SESSION['username'])){
  //   header('Location: ../go_back.html');
  //   exit;
  // }
$cat_desc = array (
	"User Not following Process",
	"Admin Issue : Data added by capacity management",
	"Admin Issue : Data added for Notefield",
	"Webimporten Issue (Telephone not filled & Lopendo)",
	"SLP-KR order Creation",
	"Order stuck without error",
	"Leverstrat 0.3",
	"Interface Issues : At Interface End",
	"Interface Issues : Dropouts",
	"Database : Infra Move",
	"Database : Infra Update",
	"Database : Contractsform",
	"Database : Any Other",
	"Code error : MLINE",
	"Code error : ANNUL/Cancelled order",
	"Code error : SLOOP on running BLINE",
	"Code error : BLINE after ANNUL",
	"Code error : Any other",
	"Wrongly Reported : Interface dropouts",
	"Wrongly Reported : Forward to MP-Infodesk",
	"Wrongly Reported : SLP-L3",
	"Wrongly Reported : Incorrectly routed",
	"Wrongly Reported : No issue",
	"Application Access",
	"Password Reset",
	"One Time Request"
);

$user = $_SESSION['username'];
$total = array();
$category = "";
$sum = 0;
$no_of_columns = 0;
$no_of_rows = 0;
$week = strval(intval(date("W")) - 1);
$meta = "";
$flag = 0;


try {
include 'connection.php';

$records = $dbconn->prepare("SELECT * FROM TICKET_COUNT where weeknumber = '$week' and username = '$user';");
$records->execute();
$result = $records->fetchAll();
$no_of_columns = $records->columnCount();
$no_of_rows = $records->rowCount();

// echo $no_of_columns."<br>";
// echo $no_of_rows."<br>";

for ($i = 3; $i < $no_of_columns ; $i += 1) {
	$sum = 0;
//	echo "Column : ".$records->getColumnMeta($i);
	$meta = $records->getColumnMeta($i);
	$total[$i-3][0] = $meta['name'];
//echo "Var Column : ".$total[$i][0];
	// if ($i < 3) {
	// 	$total[$i][1] = 0;
	// }else {
		for ($j = 0; $j < $no_of_rows ; $j += 1){
			$sum = $sum + $result[$j][$i];
			// echo $sum." Sum<br>";
			if ($sum >= 1) {
				$flag = 1;
			}
		// }
		$p = $i-3;
		// echo "p :".$p."<br>";
		$total[$p][1] = $sum;
		// echo "##".$total[$p][1]."<br>";
		
	}
}


// print_r($total);
// var_dump($cat_desc);


for ($i=0; $i< $no_of_columns -3 ; $i += 1){
	// echo $cat_desc[$i];
	$total[$i][0] = $cat_desc[$i];
}

// echo $total;


foreach ($total as $key => $row) {
	if(!isset($row[0])){
		$row[0]=null;
	}
	if(!isset($row[1])){
		$row[1]=null;
	}
    $cat[$key]  = $row[0];
    $val[$key] = $row[1];
}

// // Sort the data with volume descending, edition ascending
// // Add $data as the last parameter, to sort by the common key

array_multisort($cat, SORT_ASC, SORT_NUMERIC, $val, SORT_DESC, SORT_NUMERIC, $total);

 // print_r($total);

// if(!isset($row[1])){
// 		$row[0]=null;
// 	}
// if(!isset($row[1])){
// 		$row[1]=null;
// 	}


for ($i = 0; $i < $no_of_columns ; $i += 1) {
	// echo "total".$total[$i][1]."<br>";
}

// echo $total[0][0];
// echo $total[0][1];
// echo $total[1][0];
// echo $total[1][1];

if ($flag == 1){

	for ($i = 0; $i < $no_of_columns-3 ; $i += 1) {
		// for ($j = 0; $j < $no_of_rows ; $j+= 1){
			// echo $total[$i][$j]. " ";
			if ($total[$i][1] != 0){
				echo "<html><head></head><body>";
				echo "<table border = 0>";
					echo "<tr>";
						echo "<td class='name'>".trim($total[$i][0])."</td>";
						echo "<td class='t_count'>".trim($total[$i][1])."</td>";
					echo "</tr>";
				echo "</table></body></html>";
			}	
	}
}else{
	echo "<html><head></head><body>There are no tickets yet. Solve now :)</body></html>";
}

	 
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