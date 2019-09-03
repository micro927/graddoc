<form class="needs-validation" novalidate style="margin:auto" action="<?=$action?>" method="POST">
    
    <div class="form-group row">
      <label for="datepicker" class="col-md-2 col-form-label">เลือกวันที่</label>
      <div class="col-md-4">
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
      <label for="staff_id" class="col-md-2 col-form-label">เลือกผู้ปฏิบัติงาน</label>
      <div class="col-md-4">
        <select class="form-control" id="staff_id" name="staff_id">
        <option id="staff" value="all">ทั้งหมด</option>
        <?php while($row_staff = $query_staff->fetch_assoc()){?>
        <option id="staff" value="<?=$row_staff['staff_id']?>"><?=$row_staff['staff_name']?></option>
        <?php }?>

        </select>
      </div>
    </div>