<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
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
<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?></title>
</head>
<header>
  <?php include "header.php"?>
</header>
<body class="bg-light">
  <div class="container-fluid">
      <br><br>
      <h3 align="center">หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา ปี พ.ศ. <?=$year_show?></h3>
      <br>
<!-- Search-->
        <div class="d-flex justify-content-center" id="search_group">
          <div class="input-group md-4 col-4">
           <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">ค้นหา</span>
           </div>
           <input autocomplete="off" type="text" id="search" placeholder="ค้นหาจากเลขที่ / เรื่อง / คณะ / ผู้ปฏิบัติ / ปีคศ.-เดือน-วัน" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
         </div>
       </div>
  <script type="text/javascript">var year_show = "<?=$year_show?>";</script>
  <script type="text/javascript" src="search.js"></script>
<!-- Table -->
      <br>
      <div id="result">
        <?php include "fetch.php"?>
      </div>
  </div>
</body>
</html>
