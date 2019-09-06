<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$report_type = !empty($_GET["report_type"]) ? $_GET["report_type"] : "d";
$query_staff = $mysqli -> query("SELECT * FROM staff");
$date =date("d/m/Y");
?>
<script type="text/javascript"> 
    var year_show = parseInt(<?=$year_show?>,10);
    var date_show = "<?=$date?>";
    var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
    // window.sessionStorage;
    // sessionStorage.setItem("test_ses_year",year_show); ลองดูวิธีจัด session js
  </script>
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
      <h3 class='mt-5 mb-4'>รายงาน<br>หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา ปี พ.ศ. <script>document.write(year_show)</script></h3>
<!-- Type-->
        <div class="d-flex justify-content-center">
          <button type="button" role="button" onClick="window.location.href='report.php?get_year_show='+year_show+'&report_type=d'" class="btn <?php if($report_type=='d'){?>btn-primary <?php } else {?> btn-outline-primary <?php }?> btn-lg mx-3 px-5">รายวัน</button>
          <button type="button" role="button" onClick="window.location.href='report.php?get_year_show='+year_show+'&report_type=m'" class="btn <?php if($report_type=='m'){?>btn-primary <?php } else {?> btn-outline-primary <?php }?> btn-lg mx-3 px-5">รายเดือน</button>
          <button type="button" role="button" onClick="window.location.href='report.php?get_year_show='+year_show+'&report_type=y'" class="btn <?php if($report_type=='y'){?>btn-primary <?php } else {?> btn-outline-primary <?php }?> btn-lg mx-3 px-5">รายปี</button>
          <div id='choose'>
          </div>  
        </div>
      <br>
      <div class='container' id="report_type">
        <form id="report_form" class="needs-validation" novalidate style="margin:auto" action="report_fetch.php" method="POST">
<!-- Selection Form by Type -->
        <div class="form-group row">
        <?php if($report_type=='d'){ ?>
                  <label for="datepicker" class="col-md-2 col-form-label">เลือกวันที่</label>
            <div class="col-md-4">
              <input  maxlength="10" name="datepicker" class="form-control" id="datepicker" required>
              <div class="invalid-feedback">
                กรุณากรอกวันที่เอกสาร
              </div>
              <script src="datepicker.js"></script>
           </div>
        <?php }
            elseif($report_type=='m'){ ?>
                        <label for="datepicker" class="col-md-2 col-form-label">เลือกเดือน</label>
            <div class="col-md-4">
                <select class="form-control" id="datepicker" name="datepicker">
                <script language="javascript" type="text/javascript">
                  for(i=1; i<= monthNames.length; i++) {
                      var mon = ('0'+i).slice(-2)
                      document.write('<option value="'+(year_show-543)+'-'+mon+'">'+monthNames[i-1]+'</option>'); //
                  }
                </script>
              </select>
           </div>
         <?php } 
            elseif($report_type=='y'){ ?>
                        <label for="datepicker" class="col-md-2 col-form-label">เลือกปี</label>
            <div class="col-md-4">
                <select class="form-control" id="datepicker" name="datepicker">
                <script language="javascript" type="text/javascript">
                  for(i=0; i<=15; i++) {
                      s_year = year_show-i;
                      document.write('<option value="'+(s_year-543)+'">'+s_year+'</option>');
                  }
                </script>
              </select>
           </div>
        <?php } ?>  
          <label for="staff_id" class="col-md-2 col-form-label">เลือกผู้ปฏิบัติงาน</label>
            <div class="col-md-4">
              <select class="form-control" id="staff_id" name="staff_id">
                <option id="staff" value="0">ทั้งหมด</option>
                <?php while($row_staff = $query_staff->fetch_assoc()){?>
                <option id="staff" value="<?=$row_staff['staff_id']?>"><?=$row_staff['staff_name']?></option>
              <?php }?>
              </select>
            </div>
          
          <input type="hidden" name="report_type" id="report_type" value="<?=$report_type?>">  
          <div class="col-lg-12  mt-4 mb-3  d-flex justify-content-center">
          <button type="submit" class="btn btn-primary px-4">คลิกที่นี่เพื่อสร้างรายงาน</button>
          </div>
        </div>
      </form>
      </div>
      <script type="text/javascript" src="report.js"></script>
      <div class='container' id="report_result"></div>
      </div>
  </div>
</body>
</html>
