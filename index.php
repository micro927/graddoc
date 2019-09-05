<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
 ?>
<script type="text/javascript">
  var year_show = "<?=$year_show?>";
</script>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- JS CSS -->
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา
  </title>
</head>
<header>
  <?php include "header.php"?>
</header>
<body class="bg-light mt-5">
    <div class="container-fluid">
      <div class="text-center">
        <h3 class='mt-5 mb-4'>หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา ปี พ.ศ. <script>document.write(year_show)</script></h3>
      </div>
<!-- Search-->
          <div class="d-flex justify-content-center" id="search_group">
              <div class="container input-group mb-3 md-1">
              <input autocomplete="off" type="text" id="search" placeholder="ค้นหา จาก : เลขที่ / เรื่อง / คณะ / ผู้ปฏิบัติ / เดือน-วัน เช่น (05-08 คือ 8 พฤษภาคม) , พิมพ์แล้วกด Enter เพื่อค้นหา" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">  
              <div class="input-group-append">
                  <button type="submit" class="btn btn-primary" type="button">ค้นหา</button>
                </div>
              </div>
          </div>
  <script type="text/javascript" src="search.js"></script>
<!-- Table -->
      <br>
      <div id="result">
        <?php include "fetch.php"?>
      </div>
  </div>
</body>
</html>
