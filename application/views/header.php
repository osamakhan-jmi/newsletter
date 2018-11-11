<!doctype html>
<html>
<head>
<table align="center">

	<tr>
		<th>Latitude</th>
		<th><input type="text" disabled id="latitude"></th>
	</tr>
	<tr>
		<th>Longitude</th>
		<th><input type="text" disabled id="longitude"></th>
	</tr>
	<tr>
		<th>City</th>
		<th><input type="text" disabled id="city"></th>
	</tr>
	<tr>
		<th>Temprature</th>
		<th><input type="text" disabled id="temprature"></th>
	</tr>
</table>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}
function showPosition(position) {
	$("#latitude").val(position.coords.latitude);
	$("#longitude").val(position.coords.longitude);
}
	
(function worker() {
	getLocation();
  		$.ajax({
			url: 'http://api.openweathermap.org/data/2.5/weather?lat='+ $("#latitude").val() + '&lon=' + $("#longitude").val() + '&APPID=ac7ffeb17652b69ad9d97e0d528817a4&units=metric', 
    		success: function(data) {
				$("#city").val(data.name);
				$("#temprature").val(JSON.stringify(data.main.temp) + 'C');
    		},
    		complete: function() {
				setTimeout(worker, 5000);
			}
  		});
})();
	
</script>

</head>
</html>