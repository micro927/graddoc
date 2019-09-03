<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$report_type = !empty($_GET["report_type"]) ? $_GET["report_type"] : "none";

$staff_sql = "SELECT * FROM staff";
$query_staff = $mysqli -> query($staff_sql);

$date =date("d/m/Y");
?>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- JS CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="gijgo/gijgo.min.js" type="text/javascript"></script>
<link href="gijgo/gijgo.min.css" rel="stylesheet" type="text/css" />
<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?></title>
</head>
<header>
  <?php include "header.php"?>
</header>
<body class="bg-light mt-3">
    <div class="container-fluid">
      <div class="text-center">
      <h3 class='mt-5 mb-4'>รายงาน<br>หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา ปี พ.ศ. <?=$year_show?></h3>
<!-- Type-->
        <div class="d-flex justify-content-center">
          <button type="button" role="button" onClick="window.location.href='report.php?report_type=d'" class="btn <?php if($report_type=='d' OR $report_type=='none'){?>btn-primary <?php } else {?> btn-outline-primary <?php }?> btn-lg mx-3 px-5">รายวัน</button>
          <button type="button" role="button" onClick="window.location.href='report.php?report_type=m'" class="btn <?php if($report_type=='m'){?>btn-primary <?php } else {?> btn-outline-primary <?php }?> btn-lg mx-3 px-5">รายเดือน</button>
          <button type="button" role="button" onClick="window.location.href='report.php?report_type=y'" class="btn <?php if($report_type=='y'){?>btn-primary <?php } else {?> btn-outline-primary <?php }?> btn-lg mx-3 px-5">รายปี</button>
          <div id='choose'>
          </div>  
        </div>
  <script type="text/javascript">var year_show = "<?=$year_show?>";</script>
      <br>
      <div class='container' id="report_result">
        <form class="needs-validation" novalidate style="margin:auto" action="<?=$action?>" method="POST">
<!-- Selection Form by Type -->
        <div class="form-group row">
        <?php if($report_type=='d' OR $report_type=='none'){ ?>
        
          <label for="datepicker" class="col-md-2 col-form-label">เลือกวันที่</label>
            <div class="col-md-4">
              <input  maxlength="10" name="datepicker" class="form-control" id="datepicker" value="<?=$date?>" required>
              <div class="invalid-feedback">
                กรุณากรอกวันที่เอกสาร
              </div>
              <script>
              $('#datepicker').datepicker({
              uiLibrary: 'bootstrap4',
              format: 'dd/mm/yyyy',
              disableDaysOfWeek: [0, 6]
              });
              </script>
           </div>
        <?php }
            elseif($report_type=='m'){ ?>
              month input
         <?php } 
            elseif($report_type=='y'){ ?>
              year input
        <?php } ?>  
          <label for="staff_id" class="col-md-2 col-form-label">เลือกผู้ปฏิบัติงาน</label>
            <div class="col-md-4">
              <select class="form-control" id="staff_id" name="staff_id">
                <option id="staff" value="all">ทั้งหมด</option>
                <?php while($row_staff = $query_staff->fetch_assoc()){?>
                <option id="staff" value="<?=$row_staff['staff_id']?>"><?=$row_staff['staff_name']?></option>
              <?php }?>
              </select>
            </div>
          <div class="col-lg-12  mt-4 mb-3  d-flex justify-content-center">
          <button type="submit" class="btn btn-primary px-4">คลิกที่นี่เพื่อสร้างรายงาน</button>
          </div>
        </div>
      </form>
      </div>
      </div>
  </div>
</body>
</html>
