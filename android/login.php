<?php
    session_start();
    require 'connection.php';
    date_default_timezone_set('Asia/Jakarta');
    $info = getdate(date("U"));
    $date = $info['mday']; // 2
    $date_n = $info['weekday']; // TUESDAY
    $month = $info['mon']; // 1
    $month_n = $info['month']; // JANUARY
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];
    if ($_SERVER['REQUEST_METHOD']=='POST') {        
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $pwd = mysqli_real_escape_string($connection, $_POST['password']);
        

        $SQL = "SELECT * FROM akun WHERE user_email='$email';";
        $RES = mysqli_query($connection, $SQL);
        $result = array();
        $result['login'] = array();
        if(mysqli_num_rows($RES) === 1) {
            $FET = mysqli_fetch_assoc($RES);
            if(password_verify($pwd, $FET['user_password'])) {
                $index['user_id'] = $FET['user_id'];
                $index['user_namalengkap'] = $FET['user_namalengkap'];
                $index['user_nama'] = $FET['user_nama'];
                $index['user_email'] = $FET['user_email'];
                $index['user_cerita'] = $FET['user_cerita'];
                $index['user_avatar'] = $FET['user_avatar'].".png";
                $index['user_avatar_alternative'] = $FET['user_avatar_alternative'];
                $index['user_point'] = $FET['user_point'];
                $index['user_notification'] = $FET['user_notification'];
                array_push($result['login'], $index);

                $result['success'] = "1";
                $result['message'] = "success";

                # UPDATE ACTIVITY INFORMATION DATABASE
                $curDate = $date_n." ".$month_n." ".$year." - ".$hour.":".$min.":".$sec;
                $account = $FET['user_id']."-".$FET['user_email'];
                if (isset($_POST['device']) && isset($_POST['device_name'])) {
                    $device = mysqli_real_escape_string($connection, $_POST['device']);
                    $device_name = mysqli_real_escape_string($connection, $_POST['device_name']);
                    $activitySQL = "INSERT INTO activity_log (device, log, model, account) VALUES ('$device', '$curDate', '$device_name', '$account');";
                    mysqli_query($connection, $activitySQL);
                } 

                echo json_encode($result);
                mysqli_close($connection);
                exit();
            } else {
                $result['success'] = "0";
                $result['message'] = "error password has been changed";
                echo json_encode($result);
                mysqli_close($connection);
                exit();
            }
        } else {
            $result['success'] = "0";
            $result['message'] = "error not founded account";
            echo json_encode($result);
            mysqli_close($connection);
            exit();
        }
    }