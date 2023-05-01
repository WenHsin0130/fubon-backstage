<?php
include('includes/navbar.php');
include('dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>test123</title>

<link href="css/styles.css" rel="stylesheet" />

<!-- datatable -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<!-- google chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- FusionBrew --> 
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-database.js"></script>
<script src="js/chart.js"></script> 
<script src="js/qaChatlog.js"></script> 

<style>
    

.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
}

.pagination>li {
    display: inline;
}

.pagination>li>a,
.pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}

.pagination>li:first-child>a,
.pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.pagination>li:last-child>a,
.pagination>li:last-child>span {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

.pagination>li>a:focus,
.pagination>li>a:hover,
.pagination>li>span:focus,
.pagination>li>span:hover {
    z-index: 2;
    color: #23527c;
    background-color: #eee;
    border-color: #ddd;
}

.pagination>.active>a,
.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span,
.pagination>.active>span:focus,
.pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7;
}

.pagination>.disabled>a,
.pagination>.disabled>a:focus,
.pagination>.disabled>a:hover,
.pagination>.disabled>span,
.pagination>.disabled>span:focus,
.pagination>.disabled>span:hover {
    color: #777;
    cursor: not-allowed;
    background-color: #fff;
    border-color: #ddd;
}

.pagination-lg>li>a,
.pagination-lg>li>span {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
}

.pagination-lg>li:first-child>a,
.pagination-lg>li:first-child>span {
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
}

.pagination-lg>li:last-child>a,
.pagination-lg>li:last-child>span {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
}

.pagination-sm>li>a,
.pagination-sm>li>span {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
}

.pagination-sm>li:first-child>a,
.pagination-sm>li:first-child>span {
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
}

.pagination-sm>li:last-child>a,
.pagination-sm>li:last-child>span {
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

.form-group {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.form-group label {
  margin-right: 10px;
}

.form-control {
  margin-right: 10px;
}


</style>
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
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            有無幫助表
                        </a>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            沒有幫助
                        </a>
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
                <div class="container-fluid px-4"><br>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            保戶年齡
                            問題詢問年齡分布（排除未登入）
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4" style="width: 50%">
                                    <div id="piechart-memberAge" style="height:400px"></div>
                                </div>
                                <div class="col-sm-4" style="width: 50%">
                                    <div id="piechart-chatAge" style="height:400px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid px-4"><br>
                    <div class="form-group">
                        <label for="genderSelect">搜尋性別：</label>
                        <select id="genderSelect" class="form-control" style="width: 200px;">
                            <option value="" selected>全部</option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select>
                        <label>年齡分布：</label>
                        <select id="minAge" class="form-control" style="width: 200px;">
                            <option value="">全部</option>
                            <option value="18">18 歲（含）</option>
                            <?php 
                            for($i=20; $i<=130; $i+=10) {
                                echo "<option value=\"$i\">$i 歲（含）</option>";
                            }
                            ?>
                        </select>
                        <span>至</span>
                        <select id="maxAge" class="form-control" style="width: 200px;">
                            <option value="">全部</option>
                            <option value="18">18 歲</option>
                            <?php 
                            for($i=20; $i<=130; $i+=10) {
                                echo "<option value=\"$i\">$i 歲</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>




                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            聊天紀錄總表
                            </div>
                            <div class="card-body">
                                <table id="myTable" border="1" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="20%">時間</th>
                                            <th>輸入內容</th>
                                            <th>回覆內容（題目標題）</th>
                                            <th>性別</th>
                                            <th>年齡</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>                    
                    </div>
                </main>
            </div>
        </div>

        <script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>



</body>
</html>
