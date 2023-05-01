<?php
session_start();

unset($_SESSION['verified_user_id']);
unset($_SESSION['idTokenString']);

if(isset($_SESSION['expiry_status']))
{
    $_SESSION['status'] = "Session Expired";
}
else
{
    $_SESSION['status'] = "登出成功";
}
header('Location: login.php');
exit();

?>