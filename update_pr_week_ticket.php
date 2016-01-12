<?php

  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit;
  }
  
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
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
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

    <div class="ticket-trans"><span class="sepa_black"></span><h3>So, What are we solving today?</h3>
    <h4><?php if (isset($_SESSION['message']) && $_SESSION['message'] != "") { echo $_SESSION['message']; unset($_SESSION['message']);} ?></h4>
    </div>
    <div class="ticket-count-form">
        <form name="ticket-count" method="post" action="controller/update_pr_week_ticket.php">
        <br>
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
            <br><br><label for="category">TYPE FEW CHARACTERS OF THE CATEGORY YOU WANT TO USE</label><br>
            <!-- <input type="text" id="ajax" list="json-datalist" placeholder="e.g. code error"> -->
            <!-- <datalist id="json-datalist"></datalist> -->
            <input type="text" name="category" class="category" list="types" placeholder="e.g. Code Error">
            <datalist id="types">
              <option data-value ="cat1" value="User Not following Process"></option>
              <option data-value ="cat2" value="Admin Issue : Data added by capacity management"></option>
              <option data-value ="cat3" value="Admin Issue : Data added for Notefield"></option>
              <option data-value ="cat4" value="Webimporten Issue (Telephone not filled & Lopendo)"></option>
              <option data-value ="cat5" value="SLP-KR order Creation"></option>
              <option data-value ="cat6" value="Order stuck without error"></option>
              <option data-value ="cat7" value="Leverstrat 0.3"></option>
              <option data-value ="cat8" value="Interface Issues : At Interface End"></option>
              <option data-value ="cat9" value="Interface Issues : Dropouts"></option>
              <option data-value ="cat10" value="Database : Infra Move"></option>
              <option data-value ="cat11" value="Database : Infra Update"></option>
              <option data-value ="cat12" value="Database : Contractsform"></option>
              <option data-value ="cat13" value="Database : Any Other"></option>
              <option data-value ="cat14" value="Code error : MLINE"></option>
              <option data-value ="cat15" value="Code error : ANNUL/Cancelled order"></option>
              <option data-value ="cat16" value="Code error : SLOOP on running BLINE"></option>
              <option data-value ="cat17" value="Code error : BLINE after ANNUL"></option>
              <option data-value ="cat18" value="Code error : Any other"></option>
              <option data-value ="cat20" value="Wrongly Reported : Forward to MP-Infodesk"></option>
              <option data-value ="cat21" value="Wrongly Reported : SLP-L3"></option>
              <option data-value ="cat22" value="Wrongly Reported : Incorrectly routed"></option>
              <option data-value ="cat23" value="Wrongly Reported : No issue"></option>
              <option data-value ="sr_cat1" value="Application Access"></option>
              <option data-value ="sr_cat2" value="Password Reset"></option>
              <option data-value ="sr_cat3" value="One Time Request"></option>
            </datalist>
            <input type="hidden" name="category-hidden" id="category-hidden">
            <p class="error">Please select at least one category from the drop down!</p>
             <div class="wrong-incident">
              <input type="text" class="inc-num"  name="inc-num" placeholder="INC/INTASK number"><br>
              <p id='error-num'>Please fill the ticket number.</p>
              <input type="text" class="inc-user" name="inc-user" placeholder="created by?"><br>
              <p id='error-user'>Please fill the name of the user who has created this.</p>
              <input type="text" class="inc-desc" name="inc-desc" placeholder="small description">
              <p id='error-desc'>Please fill a small description of the issue.</p>
             </div> 
             <div class="any-other">
              <input type="text" class = "ao-desc" name="ao-desc" placeholder="small description">
              <p id='error-ao-desc'>Please fill a small description of the issue.</p>
             </div>
             <br><br>
            <label for="count">HOW MANY OF THIS KIND?</label><br>
              <div class="modify">
                <div id = "minus" class="minus">
                  <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                </div>
                <div class="count">
                  <input id = "count" type="text" value="1" name="count">
                </div>
                <div id="plus" class="plus">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </div>
              </div>
              <br>

              <label for="cleaning-ticket">IS IT A CLEANING TICKET?</label><br>
                <input type="radio" name="cleaning" value="1"> <label>Yes</label>&nbsp; &nbsp; <input type="radio" name="cleaning" Value="0" checked> <label> No</label>
              <br>
              <input id= "submit" class = "ticket-count-submit" type="submit" value="CLICK TO ADD">
        </form>
      </div>
  </div>    
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
