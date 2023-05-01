<?php
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
<!-- datatable -->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<!-- google chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- FusionBrew --> 
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-database.js"></script>
<script src="js/chart.js"></script> 
<script src="js/mepu-2.js"></script> 
</head>
<body class="sb-nav-fixed">

<br><br>

<label for="genderSelect">搜尋性別：</label>
    <select  id="genderSelect">
        <option value="" selected>全部</option>
        <option value="男">男</option>
        <option value="女">女</option>
    </select>
    <label>年齡分布：</label>
    <select id="minAge">
        <option value="">全部</option>
        <option value="18">18 歲</option>
        <?php 
            for($i=20; $i<=130; $i+=10) {
                echo "<option value=\"$i\">$i 歲</option>";
            }
        ?>
    </select>
    至
    <select id="maxAge">
        <option value="">全部</option>
        <option value="18">18 歲</option>
        <?php 
            for($i=20; $i<=130; $i+=10) {
                echo "<option value=\"$i\">$i 歲</option>";
            }
        ?>
    </select>

    
    <table id="myTable" border="1" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>時間</th>
                <th>輸入內容</th>
                <th>回覆內容（題目標題）</th>
                <th>保戶性別</th>
                <th>保戶年齡</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>
