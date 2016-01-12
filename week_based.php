<?php

  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit;
  }
  // unset($_SESSION['display']);
  
  $today = date("F j, Y. l."); 
  $week = date ("W");
  $p_week = $week -1;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>kpn Baan support</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dosis:400,200' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Exo+2:200' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
<!-- Navigation Bar -->

<?php
include 'controller/navigation.php';
?>

<!-- ======================================================================================================== -->

<div class="container conainer-padding">
  <div class="content">

    
    <div class="date">Week <?php echo $week. ", " .$today; ?></div>
    <div class="welcome"><p>Howdy! <?php echo $_SESSION['lastname']. ', '.$_SESSION['firstname']; ?></p></div>

    <div class="ticket-trans"><span class="sepa_black"></span>
    <h4><?php if (isset($_SESSION['message']) && $_SESSION['message'] != "") { echo $_SESSION['message']; unset($_SESSION['message']);} ?></h4>
    </div>
   
  </div>    
</div>

<div class="container">

<form name='week-based' action="" method="POST">
<label for='weeknumber'>Select Week</label>
  <select name='weeknumber'>
  <!-- <option>Select a Week Number</option> -->
  <?php
    $week = intval(date("W"));
    // echo $weeknumber;
     
    for ($i=50; $i <= 53; $i++) {
      echo "<option value='".$i."'>".$i."</option>"; 
    }
    for ($i=1; $i <= $week; $i++) {
      echo "<option value='0".$i."'>".$i."</option>"; 
    }
  
  ?>
</select>

  <input type ="submit" name="submit" value ="Get Data">
</div>

<div class="container">
<?php
   
  include 'controller/week_based.php';

?>
</div>


<!-- ======================================================================================================== -->

<footer class="footer">
    <p>www.jayendra.sharan.com | copyright &copy; 2016</p>
</footer>







    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="../../dist/js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
