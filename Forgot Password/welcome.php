<?php
mysql_connect('localhost', 'root', '') or die('No connection');
mysql_select_db('reguserdb');

$email = $_POST['email'];
$pass = $_POST['pass'];
$sql = "SELECT * FROM registered_users WHERE email='$email' AND password='$pass'";
$result = mysql_query($sql);
if(mysql_num_rows($result) == 1) {
    echo 'Welcome';
} else {
    echo 'Wrong password';
}
?>