<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$lastdoc_sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
                        LEFT JOIN others_fac ON (doc.reg_num = others_fac.reg_num AND doc.year_show = others_fac.year_show)
                        LEFT JOIN staff ON doc.staff_id = staff.staff_id
                        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
                        ORDER BY date DESC,gra_num DESC LIMIT 1";
$doc_sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
                        LEFT JOIN others_fac ON (doc.reg_num = others_fac.reg_num AND doc.year_show = others_fac.year_show)
                        LEFT JOIN staff ON doc.staff_id = staff.staff_id
                        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
                        ORDER BY date DESC,gra_num DESC LIMIT 10";
$fac_sql = "SELECT fac_id,fac_name FROM fac ORDER BY fac_id";
$dear_to_sql = "SELECT * FROM dear_to";
$staff_sql = "SELECT * FROM staff";

$query_lastdoc = $mysqli -> query($lastdoc_sql);
$query_doc = $mysqli -> query($doc_sql);
$query_fac = $mysqli -> query($fac_sql);
$query_dear_to = $mysqli -> query($dear_to_sql);
$query_staff = $mysqli -> query($staff_sql);

$row =$query_lastdoc -> fetch_array();
$past_reg_num = $row[0];
$past_gra_num = $row[1];
$past_fac_id = $row[11];
$past_staff_id = $row[19];
$past_fac_doc_code= $row[14];
?>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- JS CSS -->
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="gijgo/gijgo.min.js" type="text/javascript"></script>
<link href="gijgo/gijgo.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="pagination/paginathing.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?></title>
</head>

<header>
<div class="container-fluid">
<div class="position-fixed fixed-top">
  <nav class="navbar navbar-primary bg-primary justify-content-center">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php?get_year_show=<?=$year_show?>">หน้าแรก</a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="edit.php">บันทึก</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#?get_year_show=<?=$year_show?>">รายงาน</a>
      </li>
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ปี <?=$year_show?>
        </button>
        <div class="dropdown-menu">

          <?php for ($i=date("Y")+543; $i > date("Y")+533; $i--) { ?>
          <a class="dropdown-item" href="index.php?get_year_show=<?=$i?>">ปี <?=$i?></a>
                      <?php }?>
        </div>
      </div>
    </ul>
  </nav>
  <?php if(!empty($_GET['saved'])){
    if($_GET['saved']=='ok'){
      echo'<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Saved!</strong> ระบบทำการบันทึกข้อมูลหนังสือรับเลขที่ '.sprintf("%05s",$past_gra_num).' แล้ว'; }
    elseif($_GET['saved']=='error'){ echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>SQL Error!</strong> ไม่สามารถบันทึกข้อมูลได้'; }
    elseif($_GET['saved']=='existed'){ echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Number Existed!</strong> เลขที่ดังกล่าวถูกใช้แล้ว'; } ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="success-alert">
      <span aria-hidden="true">&times;</span>
    </button>
    <script>
    $(document).ready (function(){
                  window.setTimeout(function () {
                              $("#success-alert").alert('close'); }, 10000);
                    });
    </script>
</div>
                  <?php }?>
</div>
</header>

  <body>
    <div class="container-fluid">
      <br><br><br><br>
      <div class="text-center">
        <h3 align="center">บันทึกและแก้ไขข้อมูล</h3>
        <h3 align="center">หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา</h3>
      </div>
      <br>
    <!--Form-->
  <div class="container">
    <form class="needs-validation" novalidate style="margin:auto" action="save.php" method="POST">
    <div class="form-group row">
      <label for="reg_num" class="col-lg-1 col-form-label">เลขรับสำนัก</label>
      <div class="col-lg-5">
        <input name="reg_num" class="form-control" type="text" placeholder="เลขรับสำนัก" value="<?=sprintf("%05s",$past_reg_num+1)?>" required>
        <div class="invalid-feedback">
          กรุณาใส่เลขรับสำนัก
        </div>
      </div>
      <label for="gra_num" class="col-lg-1 col-form-label">เลขรับห้อง</label>
      <div class="col-lg-5">
        <input name ="gra_num" class="form-control" type="text" placeholder="เลขรับห้อง" value="<?=sprintf("%05s",$past_gra_num+1)?>" required>
        <div class="invalid-feedback">
          กรุณาใส่เลขรับห้อง
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="fac" class="col-lg-1 col-form-label">จาก หน่วยงาน</label>
      <div class="col-lg-3">
        <select class="form-control" id="fac" name="fac_id">
        <?php while($row_assoc = $query_fac -> fetch_assoc()){?>
        <option value="<?=$row_assoc['fac_id']?>" <?php if($row_assoc['fac_id']==$past_fac_id){?> selected <?php }?>><?=$row_assoc['fac_id'].' :'.$row_assoc['fac_name']?></option>
        <?php }?>
        </select>
        <div class="invalid-feedback">
          กรุณาเลือกคณะ
        </div>
      </div>
      <label for="fac_code" class="col-lg-1 col-form-label">เลขที่ อว</label>
      <div id="fac_code_show" class="col-lg-2">
        <input name="fac_code" id="fac_code" class="form-control" type="text" placeholder="เลขหน่วยงาน" value="<?=$past_fac_doc_code?>" readonly required>
        <div class="invalid-feedback">
          กรุณากรอกเลขหน่วยงาน
        </div>
      </div>
      <div class="col-lg-2">
        <input id="from_sub_num" name="from_sub_num" class="form-control" type="text" placeholder="เลขหน่วยงานย่อย">
      </div>
      <label for="from_run_num" class="col-lg-auto col-form-label">/</label>
      <div class="col-lg-2">
        <input id="from_run_num" name="from_run_num" class="form-control" type="text" placeholder="เลขเอกสาร" required autofocus>
        <div class="invalid-feedback">
          กรุณากรอกเลขเอกสาร
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="datepicker" class="col-lg-1 col-form-label">ลงวันที่</label>
      <div class="col-lg-5">
        <input name="datepicker" class="form-control" id="datepicker" value="<?=date("d/m/Y")?>" required>
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
      <label for="dear_to" class="col-lg-1 col-form-label">ถึง</label>
      <div class="col-lg-5">
        <select class="form-control" id="dear_to" name="dear_to">
        <?php while($row_dear_to = $query_dear_to -> fetch_assoc()){?>
        <option value="<?=$row_dear_to['dear_to_id']?>" <?php if($row_dear_to['dear_to_id']==1){?> selected <?php }?>><?=$row_dear_to['dear_to_title']?></option>
        <?php }?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="title" class="col-lg-1 col-form-label">หัวข้อ (เรื่อง)</label>
      <div class="col-lg">
        <input name="title" id="title" class="form-control" type="text" placeholder="กรอกเรื่อง.." required>
        <div class="invalid-feedback">
          กรุณากรอกเรื่อง
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="staff_id" class="col-lg-1 col-form-label">การปฏิบัติ</label>
      <div class="col-lg-2">
        <select class="form-control" id="staff_id" name="staff_id">
        <?php while($row_staff = $query_staff->fetch_assoc()){?>
        <option id="staff" value="<?=$row_staff['staff_id']?>" <?php if($row_staff['staff_id']==$past_staff_id){?> selected <?php }?>><?=$row_staff['staff_name']?></option>
        <?php }?>

        </select>
      </div>
      <label for="tips" class="col-lg-1 col-form-label">หมายเหตุ</label>
      <div class="col-lg-8">
        <input name="tips" id="tips" class="form-control" type="text" placeholder="หมายเหตุ(ถ้ามี) / ** กรณีเรื่องจากหน่วยงานอื่น กรุณากรอกชื่อหน่วยงานที่นี่**">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-lg-12 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary ">บันทึกข้อมูล (Save)</button>
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

      <div class="text-center">
        <br><br><br>
        <h3>รายชื่อหนังสือรับ (แสดง 10 เรื่องล่าสุด)</h3>
      </div>
      <!-- Table -->

      <table id="table01" class="table table-hover table-responsive-md">
        <thead>
          <tr class="bg-primary text-light">
            <th scope="col">เลขที่สำนักฯ</th>
            <th scope="col">เลขที่ห้อง</th>
            <th scope="col">ที่</th>
            <th scope="col">ลงวันที่</th>
            <th scope="col">จาก</th>
            <th scope="col">ถึง</th>
            <th scope="col">เรื่อง</th>
            <th scope="col">การปฏิบัติ</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">คืน</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row_doc =$query_doc->fetch_array()){?>
          <tr>
          <td><?=sprintf("%05d", $row_doc[0])?></td>
          <td><?=$row_doc[1]?></td>
          <td><?php $doc_num = ($row_doc[18])? $row_doc[18] : $row_doc[14].$row_doc[4]."/".$row_doc[5]; echo $doc_num;?></td>

          <td><?=date("d/m",strtotime($row_doc[2]))?>/<?=$row_doc['10']?></td>
          <td><?php $doc_fac = ($row_doc[17])? $row_doc[17] : $row_doc[12]; echo $doc_fac;?></td>
          <td><?=$row_doc[23]?></td>
          <td><?=$row_doc[7]?></td>
          <td><?=$row_doc[20]?></td>
          <td></td>
          <td></td>
        </tr>
        <?php }
          $mysqli->close();
        ?>
        </tbody>
        </table>
    </div>
  </body>
</html>
<script type="text/javascript" src="query_fac_code.js"></script>
