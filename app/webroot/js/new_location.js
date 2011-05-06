// JavaScript Document
   // window.onload=function() {
	function drawMap(){
		var map;
		var lat=document.getElementById('myLat').value;
		var long=document.getElementById('myLong').value;
		var latLng = new google.maps.LatLng(lat,long);
		var mapcanvas = document.createElement('div');
  		mapcanvas.id = 'mapcanvas';
  		mapcanvas.style.height = '150px';
  		mapcanvas.style.width = '300px';
	 	document.querySelector('article').appendChild(mapcanvas);
		var myOptions = {
     		zoom: 15,
			center:latLng,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
  	 	};
  		map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
  
		var marker = new google.maps.Marker({
										 position: latLng,
										 map: map,
										 title: 'You are here!'
										 });
	}