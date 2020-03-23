mengirimkan notifikasi ke seluruh siswa mohon tunggu...
<?php
	echo '<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
				type: "POST",
				url: "https://fcm.googleapis.com/fcm/send",
				headers:{
					Authorization: "key=AIzaSyBz4f622_0HE8o3WKuoaNiGejApLoQaw9Y"
				},
				contentType: "application/json",
				dataType: "json",
				data: JSON.stringify(payload)
			})
		}
	</script>';

	session_start();
	require 'connection.php';
	$pesan = mysqli_real_escape_string($connection, $_POST['pesan']);

	echo '<script>';
	echo 'sendMessage("", "'.$pesan.'");';
	echo '</script>';
?>

<script type="text/javascript">
	function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
	}

	async function waitFor3Second() {
	  await sleep(3000);
	  // Simulate an HTTP redirect:
	  window.location.replace("../sekolah/pengumuman");	
	}

	waitFor3Second();
</script>
