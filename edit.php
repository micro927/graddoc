<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$lastdoc_sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
                        LEFT JOIN others_fac ON (doc.gra_num = others_fac.gra_num AND doc.year_show = others_fac.year_show)
                        LEFT JOIN staff ON doc.staff_id = staff.staff_id
                        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
                        WHERE doc.year_show ='$year_show'
                        ORDER BY date DESC,doc.gra_num DESC LIMIT 1";
$fac_sql = "SELECT fac_id,fac_name FROM fac ORDER BY fac_id";
$dear_to_sql = "SELECT * FROM dear_to";
$staff_sql = "SELECT * FROM staff";

$query_lastdoc = $mysqli -> query($lastdoc_sql);
$query_fac = $mysqli -> query($fac_sql);
$query_dear_to = $mysqli -> query($dear_to_sql);
$query_staff = $mysqli -> query($staff_sql);

$row=$query_lastdoc -> fetch_array();
$past_reg_num = $row[0]+1;
$past_gra_num = $row[1]+1;
$past_fac_id = $row[11];
$past_staff_id = $row[19];
$past_fac_doc_code= $row[14];

$title =''; // $row[6];
$from_sub_num =''; // $row[4];
$from_run_num =''; // $row[5];
$date =date("d/m/Y"); // $row[2];
$dear_to =1; // $row[5];
$tips ='';
$others_fac_name = null;
?>
<script type="text/javascript"> 
    var year_show = parseInt(<?=$year_show?>,10);
    var date_show = "<?=$date?>";
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

<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?> - บันทึกข้อมูล</title>
</head>

<header>
  <?php include "header.php"?>
</header>

  <body class="bg-light mt-5">
    <div class="container-fluid">
      <div class="text-center">
        <h3 class='mt-5 mb-4'>บันทึกข้อมูล หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา</h3>
      </div>
<!--Form-->
  <div class="container">
    <?php $action="save.php";
          include "inputform.php";
    ?>
<!-- End of Form's Input -->
    <div class="form-group row">
      <div class="col-lg-12  mt-1 mb-3  d-flex justify-content-center">
        <button type="submit" class="btn btn-primary px-4">บันทึกข้อมูล (Save)</button>
      </div>
    </div>
    </form>
  </div>
<!-- End of Form -->

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

<!-- table last 10 records -->
      <?php
        $show_in_edit = true; 
        include "fetch.php"?>
    </div>
  </body>
</html>
