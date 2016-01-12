<?php

$total = array();
$category = "";
$sum = 0;
$no_of_columns = 0;
$no_of_rows = 0;
$week = strval(date("W"));
$meta = "";


try {

 include 'connection.php';
 // echo "connected";
$records = $dbconn->prepare("SELECT * FROM WR_INCIDENT where week = '$week';");
$records->execute();
$result = $records->fetchAll();
$no_of_rows = $records->rowCount();
$no_of_columns = $records->columnCount();
// $result = $records->fetch(PDO::FETCH_ASSOC);
// $result = $records->fetchAll();
// echo $no_of_rows;
// print_r($result);
if ($no_of_rows == 0){
  echo "<p class='no-records'>You know what, till now users are doing great job. No Wrongly Reported Incidents, yet ;)</p>";
}else{
  echo "<table border = 0 class='report'>";
  echo "<tr>";
    echo "<td class='wr_report'>Resolved By</td>";
    echo "<td class='wr_report'>Resolved On</td>";
    echo "<td class='wr_report'>Ticket Number</td>";
    echo "<td class='wr_report'>Created By</td>";
    echo "<td class='wr_report'>Short Description</td>";
    echo "<td class='wr_report'>Week Number</td>";
  echo "</tr>";
  for ($i=0; $i < $no_of_rows ; $i++) {
    echo "<tr>";
    for ($j=0; $j < $no_of_columns ; $j++) { 
      echo "<td class='wr_report'>".$result[$i][$j]."</td>";
      # code...
     }
     echo "</tr>";
    # code...
  }
  echo "</table>";
}

// echo "<html><head></head><body>";
// echo "<table border = 0>";
//  echo "<tr>";
//    echo "<td class='name'>Service Requests:</td>";
//    echo "<td class='t_count'>".trim($result['sr_count'])."</td>";
//  echo "</tr>";
//  echo "<tr>";
//    echo "<td class='name'>Incidents:</td>";
//    echo "<td class='t_count'>".trim($result['inc_count'])."</td>";
//  echo "</tr>";
  
// echo "</table></body></html>";
   
/* Hints to get the column name, number of columns, number of rows and all other data from a table.
  // $records->bindParam(':username', $username);
  $records->execute();
  $result = $records->fetchAll(); // Fetches all Data
  $cols = $records->getColumnMeta(8); //based on Index (here 8) stores the column name
  echo $cols['name'];         //displays value of var cols
  print_r($result[0][0]);       //displays first record considering a 2d array
  print_r($result[1][0]);       //displays (1,0)

  echo $records->rowCount();      // displays total number of records
  echo $records->columnCount();   //displays total number of attributes of the table (columns)

*/  
}catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}




function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
  }
    $filename = "ticket_count_" . date('Ymd') . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Type: text/plain");

  $flag = false;
  for ($i = 0; $i < $no_of_columns ; $i += 1) {
    if ($total[$i][1] != 0){
      if(!$flag) {
        
          echo implode("\t", $total[$i][0]) . "\r\n";
          $flag = true;
      }
      array_walk($row, 'cleanData');
      echo implode("\t", $total[$i][0]) . "\r\n";
    }
  }
  exit;

  ?>