$(document).ready(function() {

	$("#add").click(function (e) {
		
		$('.dynamicFields').append('<div class="singleField">'+
		'<div class="singleInput"><label>Kategooria</label><br><select name="Category[]"> <option value="1">Saiad ja leivad</option> <option value="2">Lihatooted</option> <option value="3">Jahutooted</option> <option value="4">Köögiviljad</option> <option value="5">Kohv, tee ja kakao</option> <option value="6">Kokkamismaterjalid</option> <option value="7">Tervisetooted</option> <option value="8">Köögitarbed</option> <option value="9">Rämpstoit</option> <option value="10">Hügieenitarbed</option> <option value="14">Alkohol</option> <option value="15">Tubakas</option> <option value="16">Koduhooldus</option> </select></div>'+
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

// Lisaväljade tegemiseks kasutasin peamiselt selle video abi: https://www.youtube.com/watch?v=jSSRMC0F6u8