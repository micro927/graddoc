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
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?></title>
</head>
<header>
  <?php include "header.php"?>
</header>
<body class="bg-light mt-5">
    <div class="container-fluid">
      <div class="text-center">
      <h3 class='mt-5 mb-4'>หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา ปี พ.ศ. <?=$year_show?></h3>
      </div>
<!-- Search-->
          <form action="#">
            <div class="container input-group mb-3">
            <input autocomplete="off" type="text" id="search" placeholder="ค้นหา จาก : เลขที่ / เรื่อง / คณะ / ผู้ปฏิบัติ / ปีคศ.-เดือน-วัน , (พิมพ์แล้วกด Enter เพื่อค้นหา)" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">  
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" type="button">ค้นหา</button>
              </div>
            </div>
          </form>   
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
