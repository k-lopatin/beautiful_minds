$(document).ready(function(){
	if( $('#answer').val() != '' ){
		point = JSON.parse( $('#answer').val() );
		error = $('#error').val();

		$('.circle').width(error * 2);
		$('.circle').height(error * 2);
		$('.circle').css('left', point.x - error);
		$('.circle').css('top', point.y - error);
		$('.circle').show();
	}
})

$('.map_little').click(function(){
	var src = $(this).attr('src');
	$('#map').html('<img src="' + src +'" class="map_big" /><img src="/assets/admin/img/circle.png" class="circle" />');
})


$(document).on('click', '.map_big', function(e){
	var src = $(this).attr('src');
	var error = $('#error').val();
	var point = new Object();
	point.x = e.offsetX;
	point.y = e.offsetY;
	p = JSON.stringify(point);
	$('#answer').val(p);
	$('input[name=map]').val(src);



	$('.circle').width(error * 2);
	$('.circle').height(error * 2);
	$('.circle').css('left', point.x - error);
	$('.circle').css('top', point.y - error);
	$('.circle').show();
})

$('#error').change(function(){
	if( isNaN( $(this).val() ) ){
		return;
	}
	point = JSON.parse( $('#answer').val() );

	error = $(this).val();
	$('.circle').width(error * 2);
	$('.circle').height(error * 2);
	$('.circle').css('left', point.x - error);
	$('.circle').css('top', point.y - error);
})
