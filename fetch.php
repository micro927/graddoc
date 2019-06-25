<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="pagination/paginathing.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$search_text= !empty($_GET['s']) ? $_GET['s']:'';
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
$sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
        LEFT JOIN others_fac ON (doc.reg_num = others_fac.reg_num AND doc.year_show = others_fac.year_show)
        LEFT JOIN staff ON doc.staff_id = staff.staff_id
        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
        WHERE doc.year_show ='$year_show' AND (doc.reg_num LIKE '%$search_text%'
        OR doc.title LIKE '%$search_text%'
        OR fac.fac_name LIKE '%$search_text%'
        OR staff.staff_name LIKE '%$search_text%')
        ORDER BY doc.reg_num DESC";
$query = $mysqli -> query($sql);
if($query -> num_rows>0){
  $limitpage = $query -> num_rows;?>
  <!-- Show Result -->
    <h4 align="center">ผลการค้นหาทั้งหมด <?=$limitpage?> เรื่อง</h4>

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
      <?php while($row = $query -> fetch_array()){?>
        <tr>
            <td><?=sprintf("%05d", $row[0])?></td>
            <td><?=$row[1]?></td>
            <td><?php $doc_num = ($row[18])? $row[18] : $row[14].$row[4]."/".$row[5]; echo $doc_num;?></td>

            <td><?=date("d/m",strtotime($row[2]))?>/<?=$row['10']?></td>
            <td><?php $doc_fac = ($row[17])? $row[17] : $row[12]; echo $doc_fac;?></td>
            <td><?=$row[23]?></td>
            <td><?=$row[7]?></td>
            <td><?=$row[20]?></td>
            <td><button type="button" class="btn btn-outline-primary btn-sm">แก้ไข</button></td>
            <td><button type="button" class="btn btn-outline-danger btn-sm">ปกติ</button></td>
          </tr>
      <?php }?>
      </tbody>
      </table>


<?php }
else {?>
<h4 align="center">ผลการค้นหาทั้งหมด 0 เรื่อง</h4>
<?php };?>
<!-- Pagination script-->
<script type="text/javascript" src="tablepage.js"></script>
