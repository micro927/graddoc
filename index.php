<!DOCTYPE html>
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$search_text= !empty($_GET['s']) ? $_GET['s']:'';
$output ='';
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
                          LEFT JOIN others_fac ON (doc.reg_num = others_fac.reg_num AND doc.year_show = others_fac.year_show)
                          LEFT JOIN staff ON doc.staff_id = staff.staff_id
                          LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
                          WHERE doc.year_show ='$year_show'
                          ORDER BY date DESC,gra_num DESC";
$query = $mysqli -> query($sql);
 ?>
<html>
<head>
  <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- JS CSS -->
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="pagination/paginathing.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/imagehover.min.css">
<title>หนังสือเลขรับ ฝ่ายทะเบียนการศึกษา บัณฑิตศึกษา <?=$year_show?></title>
</head>

<header>
<div class="container-fluid">
  <div class="position-fixed fixed-top">
    <nav class="navbar navbar-primary bg-primary justify-content-center">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="">หน้าแรก</a> <!--index.php?get_year_show=<?=$year_show?>-->
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="#">บันทึก</a> <!-- edit.php -->
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
  </div>
</div>
</header>

<body>
  <div class="container-fluid">
      <br><br><br>
      <h3 align="center">หนังสือรับฝ่ายทะเบียนการศึกษาบัณฑิตศึกษา ปี พ.ศ. <?=$year_show?></h3>
      <br>
     <!-- Search-->
        <div class="d-flex justify-content-center" id="search_group">
          <div class="input-group md-4 col-4">
           <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">ค้นหา</span>
           </div>
           <input type="text" id="search" placeholder="ค้นหาจากเลขสำนัก / เรื่อง / คณะ / ผู้ปฏิบัติ" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
         </div>
       </div>
        <br>
      <!-- Table -->
      <div id="result">
        <div id="pagination-position"></div>
        <h4 align="center">เลขหนังสือรับทั้งหมด <?=$query -> num_rows?> เรื่อง</h4>
        
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
              <th scope="col" colspan='2'>แก้ไข / คืนเรื่อง</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row = $query -> fetch_array()){?>
            <tr <?php if($row[9]==0){ echo"class='text-black-50'";}?>>
            <td><?=sprintf("%05d", $row[0])?></td>
            <td><?=$row[1]?></td>
            <td><?php $doc_num = ($row[18])? $row[18] : $row[14].$row[4]."/".$row[5]; echo $doc_num;?></td>

            <td><?=date("d/m",strtotime($row[2]))?>/<?=$row['10']?></td>
            <td><?php $doc_fac = ($row[17])? $row[17] : $row[12]; echo $doc_fac;?></td>
            <td><?=$row[23]?></td>
            <td><?=$row[7]?></td>
            <td><?=$row[20]?></td>
          <?php if($row[9]==0){ ?><td colspan="2"><button type="button" class="btn btn-outline-secondary btn-sm" disabled>คืนเรื่องแล้ว</button></td><?php } else{ ?>
            <td>
              <!-- <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editModal" data-whatever="<?=$row[1]?>" data-whatever2="<?=$row[2]?>">แก้ไข</button> -->
            </td>         
            <td><button id="return" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" 
                        data-target="#returnModal" 
                        data-reg_num="<?=$row[1]?>"
                        data-gra_num="<?=$row[0]?>"
                        data-fac_title="<?=$row[12]?>"
                        data-doc_title="<?=$row[7]?>">
                        &nbsp;&nbsp;คืน&nbsp;&nbsp;
                 </button>
            </td>
          <?php }?>
          </tr>
          <?php }
          $query->close();
          $mysqli->close();
          ?>
          </tbody>
          </table>
        </div>
  </div>
  <!-- Edit Modal (PopUp) -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไขเรื่องเข้าเลขที่ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                  </div>
                </div>
              </div>
            </div>

  <!--Return Modal -->
  <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="returnModalLabel">ยืนยันการคืนเอกสาร</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="modal-text"></h6>
        </div>
        <div class="modal-footer">
          <a class="btn btn-danger return_confirm" role="button">ยืนยัน</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ย้อนกลับ</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<!-- search -->
<script type="text/javascript">var year_show = "<?=$year_show?>";</script>
<script type="text/javascript" src="search.js"></script>
<!-- Pagination script-->
<script type="text/javascript" src="tablepage.js"></script>
<!-- Modal -->
<script type="text/javascript" src="editmodal.js"></script>