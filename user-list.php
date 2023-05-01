<?php
include('authentication.php');
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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <!-- 載入 Dialogflow 分析即時圖表的必要 CSS 和 JavaScript 檔案 -->
        <link rel="stylesheet" type="text/css" href="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.css?v=1" />
        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Chart</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                常見問題次數表
                            </a>
                            <a class="nav-link" href="pie-chart.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                有無幫助表
                            </a>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                沒有幫助
                            </a>
                            <!-- <div class="sb-sidenav-menu-heading">Table</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table me-1"></i></div>
                                客戶回饋表
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy;  Fubon Life Insurance Co. Ltd</div>
                            
                        </div>
                    </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12"><br>
                            <?php
                                if(isset($_SESSION['status']))
                            {
                                echo"<h5 class='alert alert-success '>".$_SESSION['status']."</h5>";
                                unset($_SESSION['status']);
                            }
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h2>
                                        <b>Pinsurance</b>
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>序列號</th>
                                                <th>姓名</th>
                                                <th>電話</th>  
                                                <th>員工信箱</th>
                                                <th>修改</th>
                                                <th>刪除</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include('dbcon.php');
                                                $users = $auth->listUsers();
                                                
                                                $i=1;
                                                foreach($users as $user)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?=$i++;?></td>
                                                        <td><?=$user->displayName ?></td>
                                                        <td><?=$user->phoneNumber ?></td>
                                                        <td><?=$user->email ?></td>
                                                        <td>
                                                            <a href="user-edit.php?id=<?=$user->uid;?>" class="btn btn-primary ">修改</a>
                                                        </td>
                                                        <td>
                                                            <!-- <a href="user-delete.php" class="btn btn-danger">刪除</a> -->
                                                            <form action="code.php" method="POST">
                                                                <button type="submit" name="reg_user_delete_btn" value="<?=$user->uid;?>" class="btn btn-danger">刪除</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>



    
