<?php
  session_start();
  require 'web/sistem/connection.php';
  date_default_timezone_set('Asia/Jakarta');
  $info = getdate();
  $date = $info['mday'];
  $month = $info['mon'];
  $year = $info['year'];
  $hour = $info['hours'];
  $min = $info['minutes'];
  $sec = $info['seconds'];
  $today = formatDate($date."-".$month."-".$year);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/conflicting_copy_Tugas_1.png" />
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>TugasKita Guru</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
      h1 {
        font-family: 'Asap', sans-serif;
      }
      label, form, .tugas-desc {
        font-family: 'Nunito', sans-serif;
      }
      button:hover {
        cursor: pointer;
      }
      table tbody tr td .absent-date {
        font-size:10px;
      }
      table tbody tr td .absent-status {
        font-size:10px;
        font-family: arial;
        font-weight: bold;
      }
    </style>
</head>
<body>
    <div class="container">
      <br><br>
      <h1><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/conflicting_copy_Tugas_1.png" width="70"> TugasKita <small class="text-danger">guru</small></h1>
      <br>

      <div class="alert alert-danger" role="alert">
        <b>CAUTION : </b>Halaman ini hanya untuk <b>GURU</b> atau <b>PENGAJAR</b>
      </div>

      <div class="card border-0">
        <h2 class="card-header bg-primary text-light"><span class="fa fa-pencil"></span> Tambah Tugas</h2> 
        <div class="card-body bg-light">
          <form action="admin_systems/register_tugas.php" method="POST">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Judul <span class="text-danger">*</span></label>
                      <input type="text" name="tugasnama" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Keterangan <span class="text-danger">(optional)</span></label>
                      <textarea class="form-control" rows="10" name="tugascerita"></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Deadline <span class="text-danger">*</span></label>
                      <input type="date" name="tugaswaktu" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Mata Pelajaran <span class="text-danger">*</span></label>
                      <select name="tugaspelajaran" class="form-control">
                        <option value="matematika_peminatan">Matematika Peminatan</option>
                        <option value="matematika_wajib">Matematika Wajib</option>
                        <option value="agama">Agama</option>
                        <option value="ppkn">PPKN</option>
                        <option value="seni_budaya">Seni Budaya</option>
                        <option value="penjaskes">Penjaskes</option>
                        <option value="fisika">Fisika</option>
                        <option value="kimia">Kimia</option>
                        <option value="biologi">Biologi</option>
                        <option value="geografi">Geografi</option>
                        <option value="sejarah">Sejarah</option>
                        <option value="sosiologi">Sosiologi</option>
                        <option value="mulok">Mulok</option>
                        <option value="wirausaha">Wirausaha</option>
                        <option value="bahasa_indonesia">Bahasa Indonesia</option>
                        <option value="bahasa_mandarin">Bahasa Mandarin</option>
                        <option value="bahasa_inggris">Bahasa Inggris</option>
                        <option value="komputer">Komputer</option>
                        <option value="lintas_minat">Lintas Minat</option>
                        <option value="lainnya">Lainnya</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Lokasi Grup <span class="text-danger">*</span></label>
                      <select name="tugaslokasi" class="form-control">
                        <?php
                          $G_SQL = "SELECT * FROM grup";
                          $G_RES = mysqli_query($connection, $G_SQL);
                          while ($G_FET = mysqli_fetch_assoc($G_RES)) {
                            $grupid = $G_FET['grup_id'];
                            $grupnama = $G_FET['grup_nama'];
                            echo '<option value="'.$grupid.'">'.$grupnama.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Prioritas <span class="text-danger">*</span></label><br>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" value="wajib" name="tugasprioritas" checked>WAJIB
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" value="tidak wajib" value="" name="tugasprioritas">TIDAK WAJIB
                        </label>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block" style="font-family: sans-serif;"><span class="fa fa-send-o"></span> <b>KIRIM TUGAS</b></button>
                </div>
            </div>
            
          </form>
        </div>
        <div class="card-footer text-light bg-primary text-right">
          Tugas yang telah ditambahkan akan dinotifikasikan ke semua anggota dalam grup yang dipilih
        </div>       
      </div>
      
      <br>
      <div class="card border-0">
        <div class="card-body bg-light">
          <h3 class="card-title text-info"><i class="fa fa-book"></i> <b>TugasKita Absent</b></h3>
          <!-- <img src="https://res.cloudinary.com/dizwvnwu0/image/upload/v1571243816/tugaskita/assets/playstore.png" width="300" class="img-fluid"><br><br> -->
          <p class="card-text pform">Mencatat absent setiap siswa setiap harinya <a href="absent"><b>Kunjungi</b></a></p>
        </div>
        <div class="card-footer text-right bg-info text-light">
          TugasKita Indonesia
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="card border-primary">
            <h3 class="card-header bg-primary text-light"><i class="fa fa-group"></i> <b>GRUP</b></h3>
            <div class="card-body">
              <h6 class="card-title">Pilih satu untuk melihat tugas</h6>
              <?php
                
                    $G_SQL = "SELECT * FROM grup;";
                    $G_RES = mysqli_query($connection, $G_SQL);
                    while($G_FET = mysqli_fetch_assoc($G_RES)) {
                      $grupid = $G_FET['grup_id'];
                      $grupnama = $G_FET['grup_nama'];

                      echo '<form action="admin_systems/load_tugas" method="POST">
                        <div class="form-group">
                          <input type="hidden" name="grupid" value="'.$grupid.'">
                        </div>
                        <button type="submit" name="submit" class="btn btn-danger">'.$grupnama.'</button>
                      </form>';
                    } 
              ?>
            </div>
          </div>
          <br>
        </div>
        <div class="col-md-8 col-sm-12">
          <div class="card border-0">
            <h3 class="card-header bg-primary text-light"><b>SEKARANG <small class="badge-danger badge-pill"><?php echo $today;?></small></b></h3>
            <div class="card-body bg-light">
              <?php
                if (isset($_SESSION['tugas'])) {
                  if (count($_SESSION['tugas']['tugas_today']) > 0) {
                    for ($i=0; $i < count($_SESSION['tugas']['tugas_today']); $i++) { 
                      $id = $_SESSION['tugas']['tugas_today'][$i]['tugasid'];
                      $title = $_SESSION['tugas']['tugas_today'][$i]['tugaspelajaran'];
                      $header = $_SESSION['tugas']['tugas_today'][$i]['tugasnama'];
                      $subheader = $_SESSION['tugas']['tugas_today'][$i]['tugascerita'];
                      echo '<div class="row">
                        <div class="col-md-9 col-sm-8">
                          <h5><b>'.$header.'</b> <small class="text-light badge-pill badge-primary">'.$title.'</small></h5>
                          <p class="card-text tugas-desc">'.$subheader.'</p>
                        </div>
                        <div class="col-md-3 col-sm-2">
                          <form action="edit-tugas" method="POST">
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-info"><span class="fa fa-edit"></span> edit</button>
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-danger"><span class="fa fa-trash"></span></button>
                          <form>
                        </div>
                      </div>
                      <br>';
                    }
                  } else {
                    echo "<p>Tidak ada tugas!</p>";
                  }
                } else {
                  echo "<p>Pilih salah satu grup untuk melihat tugas!</p>";
                }
              ?>
            </div>
          </div>
          <br>
          <div class="card border-0">
            <h3 class="card-header bg-primary text-light"><b>BESOK</b></h3>
            <div class="card-body bg-light">
              <?php
                if (isset($_SESSION['tugas'])) {
                  if (count($_SESSION['tugas']['tugas_tommorow']) > 0) {
                    for ($i=0; $i < count($_SESSION['tugas']['tugas_tommorow']); $i++) {
                      $id = $_SESSION['tugas']['tugas_tommorow'][$i]['tugasid']; 
                      $title = $_SESSION['tugas']['tugas_tommorow'][$i]['tugaspelajaran']; 
                      $header = $_SESSION['tugas']['tugas_tommorow'][$i]['tugasnama'];
                      $subheader = $_SESSION['tugas']['tugas_tommorow'][$i]['tugascerita'];
                      echo '<div class="row">
                        <div class="col-md-9 col-sm-8">
                          <h5><b>'.$header.'</b> <small class="text-light badge-pill badge-primary">'.$title.'</small></h5>
                          <p class="card-text tugas-desc">'.$subheader.'</p>
                        </div>
                        <div class="col-md-3 col-sm-2">
                          <form action="edit-tugas" method="POST">
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-info"><span class="fa fa-edit"></span> edit</button>
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-danger"><span class="fa fa-trash"></span></button>
                          <form>
                        </div>
                      </div>
                      <br>';
                    }
                  } else {
                    echo "<p>Tidak ada tugas!</p>";
                  }
                } else {
                  echo "<p>Pilih salah satu grup untuk melihat tugas!</p>";
                }
              ?>
            </div>
          </div>
          <br>
          <div class="card border-0">
            <h3 class="card-header bg-primary text-light"><b>LAINNYA</b></h3>
            <div class="card-body bg-light">
              <?php
                if (isset($_SESSION['tugas'])) {
                  if (count($_SESSION['tugas']['tugas_others']) > 0) {
                    for ($i=0; $i < count($_SESSION['tugas']['tugas_others']); $i++) { 
                      $id = $_SESSION['tugas']['tugas_others'][$i]['tugasid'];
                      $title = $_SESSION['tugas']['tugas_others'][$i]['tugaspelajaran'];
                      $header = $_SESSION['tugas']['tugas_others'][$i]['tugasnama'];
                      $subheader = $_SESSION['tugas']['tugas_others'][$i]['tugascerita'];
                      $subsubheader = $_SESSION['tugas']['tugas_others'][$i]['tugaswaktu_harilagi'];
                      echo '<div class="row">
                        <div class="col-md-9 col-sm-8">
                          <h5><b>'.$header.'</b> <small class="text-light badge-pill badge-primary">'.$title.'</small></h5>
                          <p class="card-text tugas-desc">'.$subheader.'</p>
                        </div>
                        <div class="col-md-3 col-sm-4">
                          <b class="text-danger">'.$subsubheader.'</b><br>
                          <form action="edit-tugas" method="POST">
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-info"><span class="fa fa-edit"></span> edit</button>
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-danger"><span class="fa fa-trash"></span></button>
                          <form>
                        </div>
                      </div>
                      <br>';
                    }
                  } else {
                    echo "<p>Tidak ada tugas!</p>";
                  }
                } else {
                  echo "<p>Pilih salah satu grup untuk melihat tugas!</p>";
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <br><br>
      <p>empowered by <b>TugasKita Indonesia</b></p>
      <br><br><br>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php
  function formatDate($date) {
    $dateArray = explode("-", $date);
    $day = $dateArray[0];
    $month = $dateArray[1];
    $year = $dateArray[2];
  
    switch ($month) {
      case '1':$month = "JAN";break;
      case '2':$month = "FEB";break;
      case '3':$month = "MAR";break;
      case '4':$month = "APR";break;
      case '5':$month = "MEI";break;
      case '6':$month = "JUNI";break;
      case '7':$month = "JULI";break;
      case '8':$month = "AGT";break;
      case '9':$month = "SEPT";break;
      case '10':$month = "OKT";break;
      case '11':$month = "NOV";break;
      case '12':$month = "DES";break;
    }

    return $day." ".$month." ".$year;
  }
?>