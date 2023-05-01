<?php
session_start();
include('dbcon.php');

if(isset($_POST['login_now_btn']))
{
    $email = $_POST['email'];
    $clearTextPassword = $_POST['password'];

    try{
        $user = $auth->getUserByEmail("$email");
        
        try{
            $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword); 
            $idTokenString = $signInResult->idToken();

            try{
                $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                $uid = $verifiedIdToken->claims()->get('sub');

                $_SESSION['verified_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;

                
                header("Location: index.php");
                exit();

            } catch (InvalidToken $e){
                echo 'The token is invalid: '.$e->getMessage();
            }catch (\InvalidArgumentException $e){
                echo 'The token could not be parsed: '.$e->getMessage();
            }

           
        } catch (Exception $e){
            $_SESSION['status'] = "密碼錯誤";
            header("Location: login.php");
            exit();
        }


    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e){
         //echo $e->getMessage();
         $_SESSION['status'] = "此帳號未被註冊";
         header("Location: login.php");
         exit();
    }
}
else
{
    $_SESSION['status'] = "Not allowed";
         header("Location: login.php");
         exit(); 
}

?>