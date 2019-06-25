$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var recipient2 = button.data('whatever2')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('แก้ไขเรื่องเข้าเลขที่  ' + recipient)
    modal.find('.modal-body input').val(recipient2)
  })

  $('#returnModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var reg_num = button.data('reg_num') // Extract info from data-* attributes
    var gra_num = button.data('gra_num')
    var fac_title = button.data('fac_title')
    var doc_title = button.data('doc_title')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-text').html('เอกสารรับเลขที่ ' + gra_num +' ('+reg_num+') <br/>' + fac_title + ' : ' + doc_title)
    modal.find('.return_confirm').attr('href' , 'return.php?gra_num='+gra_num+'&year_show='+year_show)
  })