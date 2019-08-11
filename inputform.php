<form class="needs-validation" novalidate style="margin:auto" action="<?=$action?>" method="POST">
    <div class="form-group row">
      <label for="reg_num" class="col-lg-2 col-form-label">หมายเลขรับสำนักฯ</label>
      <div class="col-lg-4">
        <input maxlength="5" name="reg_num" class="form-control" type="text" placeholder="เลขรับสำนัก" value="<?=sprintf("%05s",$past_reg_num)?>"  required>
        <div class="invalid-feedback">
          กรุณาใส่เลขรับสำนัก
        </div>
      </div>
      <label for="gra_num" class="col-lg-2 col-form-label">หมายเลขรับฝ่ายฯ</label>
      <div class="col-lg-4">
        <input maxlength="5"  name ="gra_num" class="form-control" type="text" placeholder="เลขรับห้อง" value="<?=sprintf("%05s",$past_gra_num)?>" readonly required>
        <div class="invalid-feedback">
          กรุณาใส่เลขรับห้อง
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="fac" class="col-2 col-form-label">จากหน่วยงาน</label>
      <div class="col-4">
        <select class="form-control" id="fac" name="fac_id" onchange="ChangeOthersFacInput()">
        <?php while($row_assoc = $query_fac -> fetch_assoc()){?>
          <option id="fac_id" value="<?=$row_assoc['fac_id']?>"
              <?php if($row_assoc['fac_id']==$past_fac_id){?> selected <?php }?>>
                <?=$row_assoc['fac_id'].' :'.$row_assoc['fac_name']?>
          </option> <?php }?>
      </select>
        <div class="invalid-feedback">
          กรุณาเลือกคณะ
        </div>
      </div>
      <label for="others_fac" class="col-lg-2 col-form-label">ชื่อหน่วยงานอื่น</label>
      <div id ="others_fac_type" class="col-lg-4">
        <input name ="others_fac" id ="others_fac" class="form-control" type="text" placeholder="-" value="<?=$tips?>"  <?php if($past_fac_id!='999'){ ?> readonly <?php } ?>>
      </div>
    </div>
      <script>var oth = "<?=$tips?>";</script>
      <script type="text/javascript" src="others_fac_input.js"></script>
    <div class="form-group row">
      <label for="datepicker" class="col-md-2 col-form-label">ลงวันที่(วันที่ฝ่ายฯ รับ)</label>
      <div class="col-md-3">
        <input  maxlength="10" name="datepicker" class="form-control" id="datepicker" value="<?=$date?>" required>
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
      <label for="fac_code" class="col-sm-1 col-form-label">เลขที่</label>
      <div id="fac_code_show" class="col-sm-2">
        <input name="fac_code" idode" class="form-control" type="text" placeholder="เลขหน่วยงาน" value="<?=$past_fac_doc_code?>" readonly required>
        <div class="invalid-feedback">
          กรุณากรอกเลขหน่วยงาน
        </div>
      </div>
      <script type="text/javascript" src="query_fac_code.js"></script>
      <div class="col-sm-2">
        <input id="from_sub_num" name="from_sub_num" class="form-control" type="text" placeholder="เลขย่อย(ถ้ามี)" value="<?=$from_sub_num?>">
      </div>
      <div class="col-sm-2">
        <input id="from_run_num" name="from_run_num" class="form-control" type="text" placeholder="/ เลขเอกสาร" value="<?=$from_run_num?>" required autofocus>
        <div class="invalid-feedback">
          กรุณากรอกเลขเอกสาร
        </div>
      </div>
    </div>
    <div class="form-group row">
    <label for="dear_to" class="col-md-2 col-form-label">เรียน (ส่งถึง)</label>
      <div class="col-md-3">
        <select class="form-control" id="dear_to" name="dear_to">
        <?php while($row_dear_to = $query_dear_to -> fetch_assoc()){?>
        <option value="<?=$row_dear_to['dear_to_id']?>" <?php if($row_dear_to['dear_to_id']==$dear_to){?> selected <?php }?>><?=$row_dear_to['dear_to_title']?></option>
        <?php }?>
        </select>
      </div>
      <label for="title" class="col-md-1 col-form-label">หัวข้อ(เรื่อง)</label>
      <div class="col-md-6">
        <input name="title" id="title" class="form-control" type="text" placeholder="กรอกเรื่อง.." value="<?=$title?>" required>
        <div class="invalid-feedback">
          กรุณากรอกเรื่อง
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="staff_id" class="col-md-2 col-form-label">การปฏิบัติ</label>
      <div class="col-md-3">
        <select class="form-control" id="staff_id" name="staff_id">
        <?php while($row_staff = $query_staff->fetch_assoc()){?>
        <option id="staff" value="<?=$row_staff['staff_id']?>" <?php if($row_staff['staff_id']==$past_staff_id){?> selected <?php }?>><?=$row_staff['staff_name']?></option>
        <?php }?>

        </select>
      </div>
      <label for="tips-othersfac" class="col-md-1 col-form-label">หมายเหตุ</label>
      <div class="col-md-6">
        <input name="tips-othersfac" id="tips-othersfac" class="form-control" type="text" value="<?=$tips?>" placeholder="หมายเหตุ หรือ ชื่อหน่วยงาน (กรณีมีรับจากหน่วยงานอื่น)">
        <div class="invalid-feedback">
          กรุณากรอกชื่อหน่วยงาน
        </div>
      </div>
    </div>