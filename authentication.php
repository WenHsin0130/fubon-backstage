<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['verified_user_id']))
{
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];


    try{
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    }catch (InvalidToken $e){
        // echo 'The token is invalid: '.$e->getMessage();
        $_SESSION['expiry_status'] = "Token Expired/Invalid. Login Again";
        header('Location: logout.php');
        exit();
    }catch (\InvalidArgumentException $e){
        echo 'The token could not be parsed: '.$e->getMessage();
      
    } 
}
else
{
    $_SESSION['status'] = "請先登入";
    header('Location: login.php');
    exit();
}
?>