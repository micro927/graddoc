<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$year_show = !empty($_GET["get_year_show"]) ? $_GET["get_year_show"] : date("Y")+543;
if(isset($_GET['s']) && $_GET['s']!=''){
  $search_text = $_GET['s'];
  $sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
        LEFT JOIN others_fac ON (doc.gra_num = others_fac.gra_num AND doc.year_show = others_fac.year_show)
        LEFT JOIN staff ON doc.staff_id = staff.staff_id
        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
        LEFT JOIN tips ON (doc.gra_num = tips.gra_num AND doc.year_show = tips.year_show)
        WHERE doc.year_show ='$year_show' AND (doc.reg_num LIKE '%$search_text%'
        OR doc.date LIKE '%$search_text%'
        OR doc.title LIKE '%$search_text%'
        OR doc.gra_num LIKE '%$search_text%'
        OR fac.fac_name LIKE '%$search_text%'
        OR staff.staff_name LIKE '%$search_text%'
        OR others_fac.fac_name LIKE '%$search_text%')
        ORDER BY doc.gra_num DESC,doc.year_show DESC";
  $table_h = "ผลการค้นหาทั้งหมด";
}
elseif(isset($show_in_edit)){
  $sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
        LEFT JOIN others_fac ON (doc.gra_num = others_fac.gra_num AND doc.year_show = others_fac.year_show)
        LEFT JOIN staff ON doc.staff_id = staff.staff_id
        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
        LEFT JOIN tips ON (doc.gra_num = tips.gra_num AND doc.year_show = tips.year_show)
        WHERE doc.year_show ='$year_show'
        ORDER BY doc.gra_num DESC,doc.year_show DESC LIMIT 10";
  $table_h = "รายการที่บันทึกล่าสุด";
}
else{
  $sql = "SELECT * FROM doc LEFT JOIN fac ON doc.fac_id = fac.fac_id
        LEFT JOIN others_fac ON (doc.gra_num = others_fac.gra_num AND doc.year_show = others_fac.year_show)
        LEFT JOIN staff ON doc.staff_id = staff.staff_id
        LEFT JOIN dear_to ON doc.dear_to_id = dear_to.dear_to_id
        LEFT JOIN tips ON (doc.gra_num = tips.gra_num AND doc.year_show = tips.year_show)
        WHERE doc.year_show ='$year_show'
        ORDER BY doc.gra_num DESC,doc.year_show DESC";
  $table_h = "หนังสือรับทั้งหมด";
}
$query = $mysqli -> query($sql);
if($query -> num_rows>0){
  $num_rows = $query -> num_rows;
  $limitpage = $num_rows>190 ? 20 : ceil($num_rows/10);?>

<!-- Show Result -->
    <h4 id="table_title" align="center"> <?=$table_h." ".$num_rows?> เรื่อง</h4>
<!-- Table -->

    <table id="table01" class="table table-hover ">
      <thead>
        <tr class="bg-primary text-light">
          <th scope="col">เลขที่สำนักฯ</th>
          <th scope="col">เลขที่ฝ่ายฯ</th>
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
        <tr <?php if($row[9]==0){ echo"class='text-muted'";}?>>
            <td><?=sprintf("%05d", $row[0])?></td>
            <td><?=$row[1]?></td>
            <td><?php $doc_num =($row[18]!=null)? $row[18]:"อว ".$row[14]; echo $doc_num.$row[4]."/".$row[5];?></td>
            <td><?=date("d/m",strtotime($row[2]))?>/<?=$row[10]?></td>
            <td><?php $doc_fac = ($row[17])? $row[17] : $row[12]; echo mb_strimwidth($doc_fac, 0, 20, "...");?></td>
            <td><?=$row[23]?></td>
            <td class='text-left' data-container="body" data-toggle="tooltip" data-placement="bottom" title="<?=$row[25]?>"><?php echo mb_strimwidth($row[7], 0, 65, "...")?></td>
            <td><?=$row[20]?></td>
            <?php if($row[9]!=0){ ?>
                    <td><a role="button" class="btn btn-outline-primary btn-sm" href="modify.php?gra_num=<?=$row[1]?>&year_show=<?=$year_show?>">แก้ไข</a></td>         
                    <td><button  id="return" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-gra_num="<?=$row[1]?>" data-target="#returnModal">&nbsp;&nbsp;คืน&nbsp;&nbsp;</button></td>
                <?php }    
                  else{ ?>
                    <td colspan="2"><button type="button" class="btn btn-outline-secondary btn-sm" disabled>คืนเรื่องแล้ว</button></td>
            <?php }?>
          </tr>
      <?php }?>
      </tbody>
      </table>
      <!-- Pagination script ถ้าน้อยกว่า10ไม่ต้องมีตัวเปลี่ยนหน้า (จะได้ใช้ทั้งหน้าแรกและหน้าeditด้วย)-->
      <?php if($num_rows>10){?>
      <script type="text/javascript" src="pagination/paginathing.js"></script>
      <script type="text/javascript">
        var limitpage = "<?=$limitpage?>"
        $(document).ready(function($){
          $('#table01 tbody').paginathing({
            perPage: 10,
            limitPagination: limitpage,
            insertAfter: '#table_title',
            firstText: '&#171;&#171;', // "First button" text
            lastText: '&#187;&#187;', // "Last button" text
            ulClass: 'pagination justify-content-center',
          });
        });
      </script>
      <?php } ?>
<?php }
else {?>
<h4 align="center">ไม่พบหนังสือรับตามข้อมูลที่ท่านค้นหา</h4>
<?php };?>

<!--Return Modal -->
  <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="dialog">
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
  <script type="text/javascript">
       $('#returnModal').on('show.bs.modal', function (event){
    var button = $(event.relatedTarget)
    var gra_num = button.data('gra_num')
    var modal = $(this)
    modal.find('.modal-text').html('คืนเอกสารรับเลขที่ห้อง ' + gra_num + ' หรือไม่?<br>(เอกสารที่คืนแล้ว จะไม่สามารถแก้ไขข้อมูลใดๆ ได้)')
    modal.find('.return_confirm').attr('href' , 'return.php?gra_num='+gra_num+'&year_show='+year_show)
  })
  </script>