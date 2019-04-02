$(document).ready(function($){
for (var i = 1; i <=150 ; i++) {
$('.list-group').append('<li class="list-group-item"> Item ' + i + '</li>');
}
$('#table01 tbody').paginathing({
perPage: 10,
insertAfter: '#table01',
firstText: 'หน้าแรก', // "First button" text
lastText: 'หน้าสุดท้าย', // "Last button" text
ulClass: 'pagination justify-content-center',
});
});