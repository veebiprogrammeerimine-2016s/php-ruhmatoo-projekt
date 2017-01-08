$(document).ready(function() {

	$("#add").click(function (e) {
		
		$('.fields').append('<div class="singleField">'+
		'<div class="singleInput"><label>Kategooria</label><br><input name="category[]" type="text" ></div>'+
		'<div class="singleInput"><label>Toode</label><br><input name="productName[]" type="text" ></div>'+
		'<div class="singleInput"><label>Hind</label><br><input name="productPrice[]" type="number" step="0.01" min="0" ></div>'+
		'<input type="button" value="X" class="delete">'+
		'</div>');
	});

	$('body').on('click','.delete',function (e) {
		$(this).parent('div').remove();
	});
	
	$("#date").datepicker({
		maxDate: 0
	});

});