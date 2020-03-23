<!DOCTYPE html>
<html>
<head>
	<title>Sending Message</title>
</head>
<body>
	<?php
		date_default_timezone_set('Asia/Jakarta');
		$info = getdate();
		$date = $info['mday'];
		$month = $info['mon'];
		$year = $info['year'];
		$hour = $info['hours'];
		$min = $info['minutes'];
		$sec = $info['seconds'];
		$current = $date."/".$month."/".$year;


	?>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	
	<script type="text/javascript">
		function sendMessage(to, title, body) {
			var payload = {
			  "to" : to,
			  "notification": {
			    "title": title,
			    "body": body
			  }
			}
			
			$.ajax({
				type: 'POST',
				url: 'https://fcm.googleapis.com/fcm/send',
				headers:{
					Authorization: 'key=AIzaSyBz4f622_0HE8o3WKuoaNiGejApLoQaw9Y'
				},
				contentType: 'application/json',
				dataType: 'json',
				data: JSON.stringify(payload)
				// success: function(response) {
				// 	alert("Sent to "+response.success+" Devices");
				// },
				// error: function(error) {
				// 	alert("Some error occurred");
				// }
			})
		}
	</script>

	<script type="text/javascript">
		sendMessage("eFl2jls4z5M:APA91bG0j_pKVMV0ssjqxnGJHA71QG-HtqwtMLRBXd922RyWEyK8LpbUkHIdy-qFwM8Gr2Av1w5Ygb1MW6LjiWS6VAsnBjYHwOzzvljaFPRJnAPNOJQmqavqMOOLR9PhkcfUvX9sS-E5", "Hey", "Come on");
	</script>
</body>
</html>