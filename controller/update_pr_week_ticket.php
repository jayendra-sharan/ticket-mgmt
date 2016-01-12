<?php
 session_start();
  if(!isset($_SESSION['username'])){
    header('Location: ../index.php');
    exit;
   }

$category = trim($_POST['category-hidden']);
$category_val = trim($_POST['category']);
$count = trim($_POST['count']);
$cleaning = trim($_POST['cleaning']);
$user = $_SESSION['username'];
$message = "";
// $week = strval(date("W"));
$week = trim($_POST['weeknumber']);
$inc_num = trim($_POST['inc-num']);
$inc_user = trim($_POST['inc-user']);
$inc_desc = trim($_POST['inc-desc']);
$ao_desc = trim($_POST['ao-desc']);
$is_wr_inc = 0;
$ao_inc = 0;
$sql = 1;
// $message .= $category;
if ($category == "sr_cat1" || $category == "sr_cat2" || $category == "sr_cat3"){
	$type = 1;
}else {
	$type = 0;
}

if($category == "cat20" || $category == "cat21" || $category == "cat22" || $category == "cat23"){
	$is_wr_inc = 1;
}else{
	$is_wr_inc = 0;
}

if ($category == "cat13" || $category == "cat18"){
	$ao_inc = 1;
}else {
	$ao_inc = 0;
}

try {
	include 'connection.php';
	
	$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbconn->beginTransaction();
	$stmt = $dbconn->prepare("INSERT INTO TICKET_COUNT (username, weeknumber, last_modified, $category) VALUES('$user', '$week', NOW(), $count) ON DUPLICATE KEY UPDATE $category = $category + $count, last_modified = NOW();");
	$sql = $stmt->execute();
	if ($sql){
		$message .= $count." Ticket(s) added in category: ". $category_val."<br>";
		
	}else {
		$message = "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";

	}
	
	if ($type) {
		$stmt = $dbconn->prepare("INSERT INTO TOTAL_COUNT(weeknumber, sr_count, last_modified, last_modified_by) VALUES('$week', $count, NOW(), '$user') ON DUPLICATE KEY UPDATE sr_count = sr_count + $count, last_modified = NOW()");
		$sql = $stmt->execute();
		if($sql) {
			$message .= $count." Ticket(s) updated in total Service Request count.<br>";
		}else {
			$message = "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";
		}
		if ($cleaning != "0") {
			$stmt = $dbconn->prepare("INSERT INTO CLEANING_COUNT (weeknumber, username, sr_count) VALUES ('$week', '$user', $count) ON DUPLICATE KEY UPDATE sr_count = sr_count + $count;");
			$sql = $stmt->execute();
			if($sql) {
				$message .= $count." Ticket(s) added to cleaning category of Service Request.<br>";
			}else {
				$message = "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";
		}

		}
	}else {

		$stmt = $dbconn->prepare("INSERT INTO TOTAL_COUNT(inc_count, last_modified, last_modified_by, weeknumber) VALUES ($count, NOW(), '$user', '$week') ON DUPLICATE KEY UPDATE inc_count = inc_count + $count, last_modified = NOW(), last_modified_by = '$user';");
		$sql = $stmt->execute();
		if($sql) {
			$message .= $count." Ticket(s) updated in total Incident count.<br>";
		}else {
			$message = "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";
			$dbconn->rollBack();
		}
		if ($cleaning != "0") {
			
			$stmt = $dbconn->prepare("INSERT INTO CLEANING_COUNT(username, weeknumber, inc_count) VALUES('$user', '$week', $count) ON DUPLICATE KEY UPDATE inc_count = inc_count + $count;");
			$sql = $stmt->execute();
			if($sql) {
				$message .= $count." Ticket(s) added to cleaning category of Incident.<br>";
			}else {
				$message = "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";
		}

		}
	}
	
	if ($is_wr_inc){
		
	 	$stmt = $dbconn->prepare("INSERT INTO WR_INCIDENT (username, added_on, inc_num, created_by, short_desc, week) VALUES ('$user', NOW(), '$inc_num', '$inc_user', '$inc_desc', '$week');");
	 	$sql = $stmt->execute();
	 	echo "sql ".$sql;
		if($sql){
			$message .= "Ticket information has been saved.";
		}else{
			echo "here";
			$message .= "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";
		}
	}
	if ($ao_inc){
		
	 	$stmt = $dbconn->prepare("INSERT INTO AO_INCIDENT (username, added_on, short_desc, week) VALUES ('$user', NOW(), '$ao_desc', '$week');");
	 	$sql = $stmt->execute();
		if($sql){
			$message .= "Ticket information has been saved.";
		}else{
			$message = "UHH..OH! SOMETHING WENT WRONG. PLEASE TRY AGAIN.";

		}
	}

	$dbconn->commit();

	$_SESSION['message'] = $message;
	header('location: ../user_home.php');
	exit();

} catch(PDOException $e){
	$dbconn->rollBack();
	$message = "UHH..Oh! Something went wrong!! Please try again.";
	// $message .= $e->getMessage();
	$_SESSION['message'] = $message;
	header('location:../user_home.php');
}

?>