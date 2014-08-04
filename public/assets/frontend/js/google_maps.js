function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(45.4654219, 9.1859243),
    	disableDefaultUI: true,
		zoom: 2.5,
		mapTypeId: google.maps.MapTypeId.TERRAIN
	};
	window.map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
}

$(document).ready(function(){
	initialize();
	$('#map_canvas').height( $(window).height()-50 );


});