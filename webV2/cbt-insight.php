<?php
    session_start();
    require 'connection.php';
    if (isset($_GET['paket'])) {
        $paket = $_GET['paket'];
    } else {
        $paket = "1111";
    }

    if (isset($_GET['user'])) {
        $user = $_GET['user'];
    } else {
        $user = "Unknown";
    }
    // CONTOH URL
    // sibercenter.com/tugaskita/webV2/cbt-insight?user=5cb34fc3bfc1f&paket=8890
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
    <title>Insight | TugasKita</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style type="text/css">
        h1 {
            font-family: 'Asap', sans-serif;
        }
        p, button {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
                  
        });
    </script>
</head>
<body>
    <div class="container"><br><br>
        <center>
            <img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/stella-maris.png"><br><br> 
            <p class="text-danger h5">SMAK STELLA MARIS SURABAYA</p><br><br><br>
            <p id="text">Kamu suka soal tadi?</p><br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="sistem/register_insight" method="POST">
                        <input type="hidden" name="paket" value="<?php echo $paket;?>">
                        <input type="hidden" name="user" value="<?php echo $user;?>">
                        <button type="submit" value="1" name="bintang" class="btn btn-warning"><span class="fa fa-star animated heartBeat infinite slower"></span> 1 </button>&nbsp&nbsp&nbsp&nbsp
                        <button type="submit" value="2" name="bintang" class="btn btn-warning"><span class="fa fa-star animated heartBeat infinite slow"></span> 2 </button><br><br>
                        <button type="submit" value="3" name="bintang" class="btn btn-warning"><span class="fa fa-star animated heartBeat infinite"></span> 3 </button>&nbsp&nbsp&nbsp&nbsp
                        <button type="submit" value="4" name="bintang" class="btn btn-warning"><span class="fa fa-star animated heartBeat infinite fast"></span> 4 </button>&nbsp&nbsp&nbsp&nbsp
                        <button type="submit" value="5" name="bintang" class="btn btn-warning"><span class="fa fa-star  animated heartBeat infinite faster"></span> 5 </button>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </center>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>