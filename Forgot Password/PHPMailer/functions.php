<?php 
    mysql_connect('localhost', 'root', '') or die('No connection');
    mysql_select_db('reguserdb');

	function email_send() {
        if(isset($_POST['send'])) {
            $email = $_POST['email'];                
            $sql = "SELECT * FROM registered_users WHERE email='$email'";
            $result = mysql_query($sql);
            if(mysql_num_rows($result) == 1) {
                include 'PHPMailer/PHPMailerAutoload.php';
                $email = $_POST['email'];
                $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
                $newpass = '';
                for ($i = 0; $i < 8; $i++) {
                    $newpass .= $characters[rand(0,strlen($characters) - 1)];   
                }                
                $sql1 = "UPDATE registered_users SET password='$newpass' WHERE email='$email'";
                mysql_query($sql1);
                $mailer = new PHPMailer();
                $mailer->IsSMTP();
                $mailer->Host = 'smtp.gmail.com:465'; 
                $mailer->SMTPAuth = TRUE;
                $mailer->Port = 465;
                $mailer->mailer="smtp";
                $mailer->SMTPSecure = 'ssl'; 
                $mailer->IsHTML(true);
                $mailer->SMTPOptions = array('ssl' => array(
                                        'verify_peer' => false, 
                                        'verify_peer_name' => false, 
                                        'allow_self_signed' => true)
                                        );
                $mailer->Username = 'webdevallen@gmail.com';
                $mailer->Password = '121232123';
                $mailer->From = 'allenvillanueva8@gmail.com'; 
                $mailer->FromName = 'Allen Villanueva';
                $mailer->Body =  'Hello your new password is '.$newpass.' <a href="http://localhost/Forgot%20Password/index.php">Click on this link to login</a>';
                $mailer->Subject = 'New Password';
                $mailer->AddAddress($email);
                if(!$mailer->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mailer->ErrorInfo;
                } else {
                    echo 'Successfully Sent';
                }
            } else {
                echo 'User not exist';
            }
        }
	}