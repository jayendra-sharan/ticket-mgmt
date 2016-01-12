<?php
 	if (session_id()==""){
 		session_start();
 	}
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


$week="";

$total = array();
$category = "";
$sum = 0;
$no_of_columns = 0;
$no_of_rows = 0;
// $week = strval(date("W"));
$meta = "";
$flag = 0;

$week = isset($_POST['weeknumber']) ? trim($_POST['weeknumber']) : "";
 // echo "no submit".$week;


if(isset($_POST['submit']) && isset($week)){
	// echo "no";
	
	try {
		include 'connection.php';
	$records = $dbconn->prepare("SELECT * FROM TICKET_COUNT where weeknumber = '$week';");
	$records->execute();
	$result = $records->fetchAll();
	$no_of_columns = $records->columnCount();
	$no_of_rows = $records->rowCount();


	for ($i = 3; $i < $no_of_columns ; $i += 1) {
		$sum = 0;
		$meta = $records->getColumnMeta($i);
		$total[$i-3][0] = $meta['name'];

			for ($j = 0; $j < $no_of_rows ; $j += 1){
				$sum = $sum + $result[$j][$i];
				if ($sum >= 1) {
					$flag = 1;
				}
			$total[$i-3][1] = $sum;
			
		}
	}

	for ($i=0; $i< $no_of_columns -3 ; $i += 1){
		// echo $cat_desc[$i];
		$total[$i][0] = $cat_desc[$i];
	}

	foreach ($total as $key => $row) {
		if(!isset($row[1])){
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

	if ($flag == 1){
		echo "<table class='week-based-table' border = 0>";
		for ($i = 0; $i < $no_of_columns-3 ; $i += 1) {	
						echo "<tr>";
							echo "<td class='week-based-name'>".trim($total[$i][0])."</td>";
							echo "<td class='week-based-count'>".trim($total[$i][1])."</td>";
						echo "</tr>";
						
					
				// }	
		}
		echo "</table>";
		}else{
		$_SESSION['isticket'] = 1;
		echo "Oops! Nobody worked this week ;)";
	}
	// header('Location: ../week_based.php');
	}catch(PDOException $e) {
	 	echo 'ERROR: ' . $e->getMessage();
	}
}

?>