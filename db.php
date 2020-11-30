<?php
    include 'connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    function sendActivationEmail($email, $token)
    {
        require 'vendor/autoload.php';



        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'drom97977@gmail.com';                     // SMTP username
            $mail->Password   = 'zxhpggpufhxsiblc';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('drom97977@gmail.com', 'Admin TDTU Classroom');
            $mail->addAddress($email, 'Người nhận');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Xác minh tài khoản';
            $mail->Body    = "Vui lòng click  <a href='http://localhost/active.php?email=$email&token=$token'> vào đây </a> để xác minh tài khoản của mình";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function sendResetPassword($email, $token)
    {
        require 'vendor/autoload.php';



        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'drom97977@gmail.com';                     // SMTP username
            $mail->Password   = 'zxhpggpufhxsiblc';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('drom97977@gmail.com', 'Admin TDTU Classroom');
            $mail->addAddress($email, 'Người nhận');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Khôi phục tài khoản';
            $mail->Body    = "Vui lòng click  <a href='http://localhost/reset_password.php?email=$email&token=$token'> vào đây </a> để khôi phục tài khoản của mình";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function check_login($user,$pass){
        $error = '';
        $code = 1;
        $name_user = '';
        $sql = "SELECT * FROM account WHERE username='$user'";
        $conn = openMySQLConnection();
        $result = $conn->query($sql);
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $rowcount = $result->num_rows;
        if (empty($user)) {
            $error = 'Please enter your username';
            return array('code'=>1,'error'=>$error);
        } else if (empty($pass)) {
            $error = 'Please enter your password';
            return array('code'=>1,'error'=>$error);
        } else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
            return array('code'=>1,'error'=>$error);
        } else if ($rowcount > 0) {
            $row = mysqli_fetch_row($result);
            $hash_pass = $row[4];
            if (password_verify($pass, $hash_pass) and $row[5] == 1) {
                $name_user =  $row[1] . ' ' . $row[2];
                $code = 0;
                return array('code'=>0,'user'=>$user,'name_user'=>$name_user);
            } else if (password_verify($pass, $hash_pass) and $row[5] == 0) {
                $error = 'Account not activated';
                return array('code'=>1,'error'=>$error);
            } else {
                $error = 'Invalid username or password';
                return array('code'=>1,'error'=>$error);
            }
        } else {
            $error = 'Invalid username or password';
            return array('code'=>1,'error'=>$error);
        }
    }

        // check exist email in database, if exist return true, else return false
    function exist_email($email)
    {
        $tmp = 'select * from account where email = ?';
        $conn = openMySQLConnection();
        $sql = $conn->prepare($tmp);
        $sql->bind_param('s', $email);

        if (!$sql->execute()) {
            die('Query error' . $sql->error);
        }
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            // email exists
            return true;
        } else {
            // email not exists
            return false;
        }
        $count = $result->fetch_assoc();
    }

    /// check exist username in database, if exist return true, else return false
    function exist_username($user)
    {
        $tmp = 'select * from account where username = ?';
        $conn = openMySQLConnection();
        $sql = $conn->prepare($tmp);
        $sql->bind_param('s', $user);

        if (!$sql->execute()) {
            die('Query error' . $sql->error);
        }
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            // username exists
            return true;
        } else {
            // username not exists
            return false;
        }
        $count = $result->fetch_assoc();
    }

        // save new account to database
    function register($user, $pass, $first_name, $last_name, $email)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $rand = random_int(0, 1000);
        $token = md5($user . '+' . $rand);
        $tmp = 'INSERT INTO `account`(`username`, `firstname`, `lastname`, `email`, `password`, `activate_token`) VALUES (?,?,?,?,?,?) ';
        $conn = openMySQLConnection();
        $sql = $conn->prepare($tmp);
        $sql->bind_param('ssssss', $user, $first_name, $last_name, $email, $hash, $token);
        if (!$sql->execute()) {
            return array('code' => 2, 'error' => 'cannot execute command');
        } else {
            sendActivationEmail($email, $token);
            return array('code' => 0, 'error' => 'Create account successful');
        }
    }

    // active account when account not active
    function activeAccount($email, $token)
    {
        $row_counter = 0;
        $sql = "select username from account where email = ? and activate_token = ? and activated = 0";
        $conn = openMySQLConnection();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss', $email, $token);
        if (!$stm->execute()) {
            return array('code' => 1, 'error' => 'cannot execute command');
        }
        $result = $stm->get_result();
        if ($result->num_rows == 0) {
            return array('code' => 1, 'error' => 'Email or token not found');
        }
        $sql = "update account set activated = 1, activate_token = '' where email = ? ";
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $email);
        if (!$stm->execute()) {
            return array('code' => 1, 'error' => 'cannot execute command');
        }
        $result = $stm->get_result();
        $row_counter = $result->num_rows;
        if ( $row_counter== 0) {
            return array('code' => 1, 'error' => 'Email or token not found');
        }
    }

    // change password
    function change_password($user, $pass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $rand = random_int(0, 1000);
        $token = md5($user . '+' . $rand);
        $conn = openMySQLConnection();
        $sql = "UPDATE `account` SET `password`=? , `activate_token`=? WHERE `username`=?";
        $stmt = $conn->prepare(($sql));
        $stmt->bind_param('sss',$hash,$token,$user);
        if (!$stmt->execute()) {
            return array('code' => 2, 'error' => 'cannot execute command');
        } else {
            return array('code' => 0, 'error' => 'Create account successful');
        }
    }

    //check password có hợp lệ hay không ? nếu có return code = 0 else  !=0
    function authentic_password($user,$pass){
        $error = '';
        $code = 1;
        $name_user = '';
        $sql = "SELECT * FROM account WHERE username='$user'";
        $conn = openMySQLConnection();
        $result = $conn->query($sql);
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $rowcount = $result->num_rows;
        
        if ($rowcount > 0) {
            $row = mysqli_fetch_row($result);
            $hash_pass = $row[4];
            if (password_verify($pass, $hash_pass) and $row[5] == 1) {
                $name_user =  $row[1] . ' ' . $row[2];
                $code = 0;
                return array('code'=>0,'user'=>$user,'name_user'=>$name_user);
            } else if (password_verify($pass, $hash_pass) and $row[5] == 0) {
                $error = 'Account not activated';
                return array('code'=>1,'error'=>$error);
            } else {
                $error = 'Invalid username or password';
                return array('code'=>1,'error'=>$error);
            }
        } else {
            $error = 'Invalid username or password';
            return array('code'=>1,'error'=>$error);
        }
    }

    /// change password
    function checkResetPassword($email,$token){
        $sql = 'select * from reset_token where token = ? and email = ?';
        $conn = openMySQLConnection();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$token,$email);
        if (!$stm->execute()) {
            return false;

        }
        $result = $stm->get_result();
        $counter_rows = $result->num_rows;
        if ($counter_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    function updatePassword($email,$pass){

        $rand = random_int(0, 1000);
        $token = md5($email . '+#(ssf@@$)' . $rand);
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $tmp = 'UPDATE `account` SET `password` = ? , `activate_token` = ? WHERE `email` = ? ';
        $conn = openMySQLConnection();

        $sql = $conn->prepare($tmp);
        $sql->bind_param('sss', $hash, $token, $email);
        $result = $sql->execute();
        if (!$result) {
            return array('code' => 2, 'error' => 'cannot execute command');
        } else {
            $key = resetTokenAfterReset($email);
            return array('code' => 0, 'error' => 'Create account successful');
        }

    }
    function resetTokenAfterReset($email){
        $conn = openMySQLConnection();
        $rand = random_int(0, 71215465244513456);
        $sql = 'update reset_token set token = ? where email = ?';
        $token = md5($email . '+da2610225032aaf#(ssf@@$)' .$rand);
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$token,$email);
        if (!$stm->execute()) {
            return array('code' => 2, 'error' => 'cannot execute command');
        } else {
            return array('code' => 0, 'error' => 'update token successful');
        }
    }

    // function join_class_by_code($username, $key){
        
    // }
?>
