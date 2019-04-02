$('#search').keyup(function(){
  var usearch = $('#search').val();
  $.ajax({
    url:'fetch.php?get_year_show='+year_show,
    data:'s='+usearch,
    success:function(data){
      $('#result').html(data);
    }
  });
});