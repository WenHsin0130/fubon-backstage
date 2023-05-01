<?php
session_start();
// if(isset($_SESSION['verified_user_id']))
// {
//     $_SESSION['status'] = "you are already logged in";
//     header('Location: index.php');
//     exit();
// }
include('includes/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>富邦人壽後台管理</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6"><br><br><br>
                                <?php
                                    if(isset($_SESSION['status']))
                                    {
                                        echo"<h5 class='alert alert-success .alert-link'>".$_SESSION['status']."</h5>";
                                        unset($_SESSION['status']);
                                    }
                                ?>
                                <div class="card">
                                    <div class="card-header" ><h2 class="text-center my-3">註冊帳號
                                    <a class="btn btn-danger float-end" href="login.php" >返回</a></h2>
                                    </div><br>
                                    <div class="card-body">
                                       <form action="code.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="name" type="text" >
                                                <label for="">姓名</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" type="email" >
                                                <label for="">員工信箱</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" type="password" >
                                                <label for="">密碼 (請輸入6個以上字元)</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="phone" type="password" >
                                                <label for="" >電話 (範例: 9xxxxxxxx)</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <!-- d-flex align-items-center justify-content-between mt-4 mb-0 -->
                                                <button class="btn btn-primary" name="register_btn" type="submit">註冊</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>