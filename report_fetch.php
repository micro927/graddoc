<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$report_type = $_POST["report_type"];
$staff_id = $_POST["staff_id"]=='0'?'':$_POST["staff_id"];
$report_date = $_POST["datepicker"];
$no_result = "<h4>ไม่พบข้อมูลที่ท่านต้องการสร้างรายงาน</h4>";
if($report_type=='d'){
    $doc_year = substr($report_date,6,4);
    $doc_month = substr($report_date,3,2);
    $doc_day = substr($report_date,0,2);
    $report_date = $doc_year.'-'.$doc_month.'-'.$doc_day;
    if($staff_id==""){
      $sql= "SELECT staff_name AS 'พนักงาน',count(*) AS 'จำนวนเรื่องที่รับ' FROM doc JOIN staff ON doc.staff_id=staff.staff_id  WHERE date = '$report_date' GROUP BY staff.staff_name
              UNION ALL SELECT 'รวม',count(*) FROM doc WHERE date = '$report_date'";
      $query = $mysqli -> query($sql);
      if($query -> num_rows>1){
    ?>
        <table id="report_table" class="table table-bordered">
    <?php
        
        while($row = $query -> fetch_array()){
    ?>
              <tr>
                <td><?=$row[0]?></td>
                <td><?=$row[1]?></td>
              </tr>
    <?php
        }
      }
      else{
        echo($no_result);
      }
    }
    else{
      $sql= "SELECT count(*) FROM doc JOIN staff ON doc.staff_id=staff.staff_id WHERE date = '$report_date' AND staff_id ='$staff_id'";
      /////////////

      echo($no_result);
    }
} 
elseif($report_type=='d'){
    $report_date = $_POST["datepicker"];
}
$query = $mysqli -> query($sql);

echo($staff_id);
echo($report_date);
echo($report_type);