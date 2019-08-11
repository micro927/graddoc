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
          <a class="nav-link text-white" href="#">รายงาน</a>  <!--....php?get_year_show=<?=$year_show?>-->
        </li>
        <div class="btn-group">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
            ปี <?=$year_show?>
          </button>
          <div class="dropdown-menu">
            <?php for($i=date("Y")+543; $i > date("Y")+533; $i--) { ?>
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