<?php
	if (session_id()==""){
 		session_start();
 	}
	// session_start();
  	// if(!isset($_SESSION['username'])){
   //  	header('Location: index.php');
   //  	exit;
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

	$users = array (
		"shara499" => "Sharan, Jayendra",
		"bibhu499" => "Bibhudarshini, Anuspandana",
		"kolas499" => "Kolaskar, Supriya",
		"mohan498" => "Mohanty, Sudip",
		"daga500"  => "Daga, Anand",
		"vaidy498" => "Vaidya, Varuni"
	);

  	// $week = date ("W");	

	$week="";
	$week = isset($_POST['weeknumber']) ? trim($_POST['weeknumber']) : "";
 // echo "no submit".$week;


	if(isset($_POST['submit']) && isset($week)){
		try {

			 include 'connection.php';
			 
			 $records = $dbconn->prepare("select * from TICKET_COUNT where weeknumber = '$week';");
			 $records->execute();
			 $result = $records->fetchAll();
			 $no_of_rows = $records->rowCount();
			 $no_of_columns = $records->columnCount();
			 // echo "no of rows: ".$no_of_rows;
			 // echo "no of columns".$no_of_columns."<br>";
			 

		if ($no_of_rows != 0){
			echo "<div class='ticket-details'>";
			for ($i=0; $i < $no_of_rows ; $i++) { 
					$name = $result[$i][0];
					$user_name = $users[$name];
		    		echo "<div class='user-details'>";
		      			echo "<div class='user'>";
		        			echo "<p>".$user_name."<span class='glyphicon glyphicon-menu-down icon'></span></p>";
		      			// echo "<p><span class='glyphicon glyphicon-menu-down icon'></span></p>";
		      			echo "</div>";
		    			echo "<div class='count-details'>";
		    				echo "<table border = 0 class='report'>";
		    				$j = 3;
		    				while($j<$no_of_columns){
		    					$x = 0;
		    					echo "<tr>";
		    					while($x <3) {
		    						if($result[$i][$j]){
										echo "<td class='wr_report'>".$cat_desc[$j-3]."</td>";
			      						echo "<td class='wr_report'>".$result[$i][$j]."</td>";
			      						$x++;
			      					}
		      						$j++;
		      						if($j == $no_of_columns)
		      								break;
		      					}
		      					echo "</tr>";
		      				}
		      				echo "</table>";
		      			echo "</div>";
		    		echo "</div>";
			 }
			 echo "</div>";
		}else{
			echo "Uhhoh!! No data to display.";
		}	
		}catch(PDOException $e) {
	 		echo 'ERROR: ' . $e->getMessage();
		}
	}

  ?>