function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(0, 0),
    	disableDefaultUI: true,
		zoom: 2,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
}

$(document).ready(function(){
	initialize();
	$('#map_canvas').height( $(window).height() );
});