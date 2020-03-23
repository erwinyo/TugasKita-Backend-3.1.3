<?php
	session_start();
	require 'connection.php';
	if (isset($_GET['paket']) && $_GET['sekolah']) {
		$paket = mysqli_real_escape_string($connection, $_GET['paket']);
		$sekolah = mysqli_real_escape_string($connection, $_GET['sekolah']);

		# Ambil data paket dari table 'paket'
		$P_SQL = "SELECT * FROM paket WHERE id='$paket' AND sekolah='$sekolah';";
		$P_RES = mysqli_query($connection, $P_SQL);
		$P_FET = mysqli_fetch_assoc($P_RES);

		$namapaket = $P_FET['nama'];

	} else {
		echo "Terjadi Kesalahan dalam permintaan Anda!";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/ico.png" />
  	<!-- Required meta tags -->
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  	<title><?php echo $namapaket;?></title>
  	<link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<style type="text/css">
        h1, h5 {
            font-family: 'Asap', sans-serif;
        }
        p, button, label, form, ol {
            font-family: 'Nunito', sans-serif;
        }
        td, th {
        	font-family: arial;
        }
    </style>
</head>
<body>
	<div class="container">
		<div class="row mt-4">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<a href="cbt-sekolah-dashboard"><button class="btn btn-primary btn-sm"><span class="fa fa-arrow-left"></span> kembali</button></a>
				<div class="row mt-3">
					<div class="col-6">
						<h1><span class="fa fa-signal"></span> TugasKita <small class="text-info">LIVE</small></h1>
					</div>
					<div class="col-6 text-right">
						<h3><span class="fa fa-star text-warning"></span> <span id="rate-value">2.3</span></h3>
					</div>
				</div>
				<small>TAYANGAN LANGSUNG KINERJA DARI PAKET '<?php echo $namapaket;?>'</small>
				<canvas class="mt-5" id="myChart"></canvas>
				<div class="text-right mt-4">
					<small>Data yang ditampilkan berdasarkan data nyata yang terjadi sekarang ini</small>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div><br><br><br><br><br><br><br><br>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<!-- Chart.js -->
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
  	<script type="text/javascript">
  		function addData(chart, label, data) {
		    chart.data.labels.push(label);
		    chart.data.datasets.forEach((dataset) => {
		        dataset.data.push(data);
		    });
		    chart.update();
		}
		function removeData(chart) {
		    chart.data.labels.pop();
		    chart.data.datasets.forEach((dataset) => {
		        dataset.data.pop();
		    });
		    chart.update();
		}
  		var ctx = document.getElementById('myChart').getContext('2d');
  		var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: "",
					        datasets: [{
					            label: 'Prosentase Kesulitan Soal',
					            data: "",
					            backgroundColor: "#159F8A",
					        }]
					    },
					    options: {
					        scales: {
					            yAxes: [{
					                ticks: {
					                    beginAtZero: true
					                }
					            }]
					        }
					    }
					});
  		function sleep(ms) {
		  return new Promise(resolve => setTimeout(resolve, ms));
		}
		async function demo() {
		  await sleep(2000);
		  loadData();
		}	
		function loadData() {
			$.post('sistem/load_statistik', 
			{
				paket: '<?php echo $paket;?>',
				sekolah: '<?php echo $sekolah?>'
			}, function(data, textStatus, xhr) {
	  			var parsed = JSON.parse(data);
	  			if (parsed['success'] == "1") {
	  				for(var i = 0; i < parsed['data'].length; i++){
	  					removeData(myChart);
	  				}
	  				
	  				var soalid = [];
	  				var soalnama = [];
	  				var time_spend = [];
	  				var background = [];
	  				var border = [];
	  				for(var i = 0; i < parsed['data'].length; i++){
	  					var parsedArray = parsed['data'][i].split("~");
	  					soalid.push(parsedArray[0]);
	  					soalnama.push(parsedArray[1]);
	  					time_spend.push(parsedArray[2]);
	  					$("#rate-value").text(parseInt(parsedArray[3]).toFixed(1));

	  					addData(myChart, parsedArray[1].slice(0,20), parsedArray[2]);
	  				}
	  				demo();
				} else {
					alert(parsed['message']);
					console.log(parsed);
				}
			}); 
		}
		loadData();
  	</script>
</body>
</html>