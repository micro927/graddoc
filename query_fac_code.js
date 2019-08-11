$('#fac').click(function(){
  var fac_id = $('#fac').val();
  $.ajax({
    url:'fetch_fac_code.php',
    data:'fac_id='+fac_id,
    success:function(data){
      $('#fac_code_show').html(data);
    },
  });
});