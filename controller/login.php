<?php
session_start();



try {
include 'connection.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
// echo $username;

// echo "a";
// echo $password;
 $errMsg = '';

 if($username == '')
 $errMsg .= 'You must enter your Username<br>';
 
 if($password == '')
 $errMsg .= 'You must enter your Password<br>';
 
 if($errMsg == ''){
	 $records = $dbconn->prepare('SELECT username, password, firstname, lastname FROM user_info WHERE username = :username');
	 $records->bindParam(':username', $username);
	 $records->execute();
	 $results = $records->fetch(PDO::FETCH_ASSOC);
	 // echo $results['password'];
 	if(count($results) > 0 && password_verify($password, $results['password'])){
 		// echo "Case 2";
 		$_SESSION['username'] = $username;
 		$_SESSION['firstname'] = $results['firstname'];
 		$_SESSION['lastname'] = $results['lastname'];
 		header('location:../user_home.php');
 		exit;
 	}else {
 		$errMsg .= 'Username and Password are not found<br>';
 		$_SESSION['error'] = $errMsg;
 		header('location: ../index.php');
 	}
 		
 }else {
 		$_SESSION['error'] = $errMsg;
 		header('location: ../index.php');
 }
 
 }catch(PDOException $e) {
 	echo 'ERROR: ' . $e->getMessage();
}

 ?>