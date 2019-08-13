<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["year_show"]) ? $_GET["year_show"] : date("Y")+543;
$gra_num = !empty($_GET["gra_num"]) ? $_GET["gra_num"] : date("Y")+543;
$referer = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
$prev_page = (strstr($referer,"edit"))?"edit":"index";
$lastdoc_sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
                        LEFT JOIN others_fac ON (doc.gra_num = others_fac.gra_num AND doc.year_show = others_fac.year_show)
                        LEFT JOIN staff ON doc.staff_id = staff.staff_id
                        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
                        LEFT JOIN tips ON (doc.gra_num = tips.gra_num AND doc.year_show = tips.year_show)
                        WHERE doc.year_show ='$year_show' AND doc.gra_num ='$gra_num'
                        LIMIT 1";

$fac_sql = "SELECT fac_id,fac_name FROM fac ORDER BY fac_id";
$dear_to_sql = "SELECT * FROM dear_to";
$staff_sql = "SELECT * FROM staff";

$query_lastdoc = $mysqli -> query($lastdoc_sql);
$query_fac = $mysqli -> query($fac_sql);
$query_dear_to = $mysqli -> query($dear_to_sql);
$query_staff = $mysqli -> query($staff_sql);

if(($query_lastdoc-> num_rows)===0){
  echo '<script type="text/javascript">
        window.location.href = "index.php";
        </script>';
};

$row =$query_lastdoc -> fetch_array();
$past_reg_num = $row[0];
$past_gra_num = $row[1];
$past_fac_id = $row[11];
$past_staff_id = $row[19];
$past_fac_doc_code= ($row[14]=='')?$row[18]:$row[14];


$title = $row[7];
$from_sub_num = $row[4];
$from_run_num = $row[5];
$date = date("d/m/Y",strtotime($row[2]));
$dear_to = $row[6];
$tips = $row[25];
$others_fac_name = $row[17];

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

<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?> - บันทึกข้อมูล</title>
</head>

<header>
  <?php include "header.php"?>
</header>

<body class="bg-light mt-5">
    <div class="container-fluid">

      <div class="text-center">
      <h3 class='mx-auto mt-5'>แก้ไขข้อมูล หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา<br>เลขที่ฝ่ายฯ <?=$past_gra_num?>  พ.ศ. <?=$year_show?></h3>
      </div>
      <br>
<!--Form-->
    <div class="container">
        <?php $action="update.php";
            include "inputform.php";
        ?>
<!-- End of Form's Input -->
    <input type="hidden" name="prev_reg_num" id="prev_reg_num" value="<?=$past_reg_num?>">
    <input type="hidden" name="prev_year_show" id="prev_year_show" value="<?=$row[10]?>">
    <input type="hidden" name="prev_page" id="prev_page" value="<?=$prev_page?>">
    <?php if($row[24]!=null){ ?> <input type="hidden" name="prev_tips" id="prev_tips" value="<?=$row[24]?>"> <?php } ?>
    <?php if($row[15]!=null){ ?> <input type="hidden" name="prev_others_fac" id="prev_others_fac" value="<?=$row[15]?>"> <?php } ?>
    
    <div class="form-group row">
      <div class="col-lg-12 mt-3 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mr-2 ">แก้ไขข้อมูล (Update)</button>
        <button type="button" role='button' class="btn btn-secondary mr-2 " onClick="window.location.href='<?=$prev_page.'.php'?>'" >ย้อนกลับ (Back)</button>
        <button type="button" class="btn btn-danger" onclick="window.location.reload()">รีเซ็ตข้อมูล (Reset)</button>
        
      </div>
    </div>
    </form>
  </div>
<!-- End of Form -->

    </div>
  </body>
</html>

<!-- javascript for validation -->
<script>
      var form = document.querySelector('.needs-validation');
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
        form.classList.add('was-validated');
        })
  </script>
