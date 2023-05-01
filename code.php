<?php
session_start();
include('dbcon.php');

if(isset($_POST['reg_user_delete_btn']))
{
    $uid = $_POST['reg_user_delete_btn'];

    try{
        $auth->deleteUser($uid);

        $_SESSION['status'] = "User Deleted success";
        header('Location:user-list.php');
        exit();
        
    }catch(Exception $e){
        $_SESSION['status'] = "No ID Found";
        header('Location:user-list.php');
        exit();

    } 
}


if(isset($_POST['update_user_btn']))
{
    $displayname = $_POST['display_name'];
    $phone = $_POST['phone'];

    $uid = $_POST['user_id'];
    $properties = [
        'displayName'=>$displayname,
        'phoneNumber'=>$phone,
    ];

    $updateUser = $auth->updateUser($uid, $properties);

    if($updateUser)
    {
        $_SESSION['status'] = "User update success";
        header('Location:user-list.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "user not updated";
        header('Location:user-list.php');  
        exit();
    }
}


if(isset($_POST['register_btn']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'phoneNumber' => '+886'.$phone,
        'password' => $password,
        'displayName'=> $name,
    ];

    $createdUser = $auth->createUser($userProperties);

    if($createdUser)
    {
        $_SESSION['status'] = "User created success";
        header('Location:register.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "user not created";
        header('Location:register.php');  
        exit();
    }
}


?>