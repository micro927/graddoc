<?php
require_once("config.inc");
$fac_id = $_GET['fac_id'];
date_default_timezone_set("Asia/Bangkok");
$fac_doc_code_sql = "SELECT fac_doc_code FROM fac WHERE fac_id='$fac_id'";
$fac_doc_code_query = $mysqli -> query($fac_doc_code_sql);
$fac_doc_code = $fac_doc_code_query -> fetch_row();
if($fac_id==999){?><input name="fac_code"  id="fac_code" class="form-control" type="text" placeholder="เลขหน่วยงาน"  required>
<div class="invalid-feedback">กรุณากรอกเลขหน่วยงาน</div><?php }else{?><input name="fac_code"  id="fac_code" class="form-control" type="text" value="<?=$fac_doc_code[0]?>" placeholder="เลขหน่วยงาน" readonly required>
<?php }?>