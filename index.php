<?php
  $week = date ("W");
  session_start();
  if(isset($_SESSION['username'])){
    header('Location:user_home.php');
    exit;
  }
    $today = date("F j, Y. l."); 
  
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
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="isindex">
  
  <nav class="navbar">
    <div class="container container-padding">
      <div class="logo"><a href="#">kpn Baan support</a></div>
      <div class="links">
         <ul class="nav-links">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#inc">Trends</a></li>
          <li><a href="#team_info">Team</a></li>
          <li><a href="#inc">Reach Us</a></li>
        </ul>
      </div>
    </div>
  </nav>

<!-- ==================================================================== -->
  <div class="container-body">
    <h1>kpn baan support<h2>
    <span class="sepa"></span>
    <h2>MANAGE YOUR TICKET | CHECK AND DOWNLOAD WEEKLY DATA | INCIDENT TRENDS</h2>
                <h2 class="sub-heading">Your one stop solution to keep track of the work you are doing!</h2> 
        <div class="login-box">

      <div class="login-form">
        <p class="error"><?php if ( isset($_SESSION["error"]) && $_SESSION["error"] != '') { echo $_SESSION["error"]; session_destroy(); } ?></p>
        <form name="login-form" method="post" action="controller/login.php">
            <input type="text" placeholder="username" name="username" required="required"><br><br>
            <input type="password" placeholder="password" name="password" required><br><br>
            <input type="submit" value="SIGN IN">
        </form>
        <br>
        <!-- <a href="#"><p>Forgot Password?</p></a> <a href=""><p>Don't have an account?</p></a> -->
      </div>
    </div>
  </div>

  <!-- ==================================================================== -->
  <div class="container page-wrapper" id="inc">
    <div class="row">
      <div class="col-xs-12 col-md-4 columns">
        <!-- <button type="button" class="btn btn-default btn-lg"> -->
          <p><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></p>
        <!-- </button> -->
        <p><span class="heading_text">TOP CATEGORIES OF THIS WEEK</span></p>
        <center><?php include('controller/incident_trend.php'); ?></center>
        </div>

      <div class="col-xs-12 col-md-4 columns mid-column">
      <p><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></p>
      <p><span class="heading_text">TICKETS LOGGED THIS WEEK</span></p>

          <center><?php include('controller/incident_count.php'); ?></center>
      </div>
    <div class="col-xs-12 col-md-4 columns">
      <p><span class="glyphicon glyphicon-erase" aria-hidden="true"></span></p>
        <p><span class="heading_text">CLEANING TICKETS THIS WEEK</span></p>
        <center><?php include('controller/cleaning_count.php'); ?></center>
      </div>

    </div>
  </div>


<!-- ========================================================================================================= -->

  <div class="container page-wrapper" id="team_info">
    <div class="row">
      <div class="col-xs-4 col-md-4">
        <div  class="team_mem_image"><img src=""></div>
        <span>
          <p class="name">Varuni Vaidya</p>
          <p class="desig">Project Lead</p>
        </span>
      </div>
      <div class="col-xs-4 col-md-4">
        <div  class="team_mem_image"><img src="images/jayendra.jpg"></div>
        <span>
          <p class="name">Jayendra Sharan</p>
          <p class="desig">Software Engineer</p>
        </span>
      </div>
      <div class="col-xs-4 col-md-4">
        <div  class="team_mem_image"><img src=""></div>
        <span>
          <p class="name">Sudip Mohanty</p>
          <p class="desig">Software Engineer</p>
        </span>
      </div>
    </div>
    <br><br><br>
    <div class="row">
      <div class="col-xs-4 col-md-4">
        <div  class="team_mem_image"><img src=""></div>
        <span>
          <p class="name">Supriya Kolaskar</p>
          <p class="desig">Software Engineer</p>
        </span>
      </div>
      <div class="col-xs-4 col-md-4">
        <div  class="team_mem_image"><img src=""></div>
        <span>
          <p class="name">Anuspandana Bibhudarshini</p>
          <p class="desig">Software Engineer</p>
        </span>
      </div>
      <div class="col-xs-4 col-md-4">
        <div  class="team_mem_image"><img src=""></div>
        <span>
          <p class="name">Anand Daga</p>
          <p class="desig">Software Engineer</p>
        </span>
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
    <script src="../../dist/js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
