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
        <title>Pinsurance Backstage</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" />       
        <!-- FusionBrew --> 
        <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-database.js"></script>
        <script src="js/chart.js"></script> 
        
        <script>
                // Firebase配置
                const firebaseConfig = {
                    apiKey: "AIzaSyCquxlwE2gavHGJzMyweVw2Mf3JFpFGLy4",
                    authDomain: "fubonagent-yqqh.firebaseapp.com",
                    databaseURL: "https://fubonagent-yqqh-default-rtdb.firebaseio.com",
                    projectId: "fubonagent-yqqh",
                    storageBucket: "fubonagent-yqqh.appspot.com",
                    messagingSenderId: "757414683945",
                    appId: "1:757414683945:web:0d1179b3c5cfdee18f4338",
                    measurementId: "G-K0T0QJYW37"
                };
                // 初始化Firebase
                firebase.initializeApp(firebaseConfig);
        </script>
        <script>
          window.addEventListener("load", getData(genFunction));
          function getData(callbackIN) {
            var ref = firebase.database().ref("qaIntentsStats");
            ref.once('value').then(function (snapshot) {
              callbackIN(snapshot.val())
            });
          }
          function genFunction(data) {
            var cdata = [];
            var keys = Object.keys(data);
            keys.sort(function(a, b) {
                return data[b]['hits'] - data[a]['hits'];
            });
            keys = keys.slice(0, 10);
            for(var i=0; i<keys.length; i++) {
                var key = keys[i];
                cdata.push({
                    label: data[key]['displayName'],
                    value: data[key]['hits']
                });
            }
          var firebaseChart = new FusionCharts({
              type: 'column2d',
              renderAt: 'chart-container',
              width: '1100',
              height: '500',
              dataFormat: 'json',
              dataSource: {
                  "chart": {
                      "caption": "常見問題 (問題 / 提問次數)",
                      "subCaptionFontBold": "0",
                      "captionFontSize": "25",
                      "subCaptionFontSize": "17",
                      "captionPadding": "15",
                      "captionFontColor": "#4a4d69",
                      "baseFontSize": "14",
                      "baseFont": "Barlow",
                      "canvasBgAlpha": "0",
                      "bgColor": "#FFFFFF",
                      "bgAlpha": "100",
                      "exportEnabled": "1",
                      "showBorder": "0",
                      "showCanvasBorder": "0",
                      "showPlotBorder": "0",
                      "showAlternateHGridColor": "0",
                      "usePlotGradientColor": "0",
                      "paletteColors": "#518CD5",
                      "showValues": "0",
                      "divLineAlpha": "10",
                      "showAxisLines": "1",
                      "drawAnchors": "0",
                      "xAxisLineColor": "#4a4d69",
                      "xAxisLineThickness": "0.7",
                      "xAxisLineAlpha": "50",
                      "yAxisLineColor": "#4a4d69",
                      "yAxisLineThickness": "0.7",
                      "yAxisLineAlpha": "50",
                      "baseFontColor": "#050100",
                      "toolTipBgColor": "#E5E9F5",
                      "toolTipPadding": "10",
                      "toolTipColor": "#050100",
                      "toolTipBorderRadius": "3",
                      "toolTipBorderAlpha": "0",
                      "drawCrossLine": "1",
                      "crossLineColor": "#8C8C8C",
                      "crossLineAlpha": "60",
                      "crossLineThickness": "0.7",
                      "alignCaptionWithCanvas": "1"
                  },
                  "data": cdata,
              }
          });
          firebaseChart.render();
          }

      </script>
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Chart</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                                常見問題次數表
                            </a>
                            <a class="nav-link" href="pie-chart.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                                回答反饋總表
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                                聊天紀錄總表
                            </a>
                            <div class="sb-sidenav-menu-heading">Promotion</div>
                            <a class="nav-link" href="activity.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-guitar"></i></div>
                                活動清單/優惠清單
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
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="col-xl-3 col-md-6"><br>
                                <div class="card bg-primary text-white mb-4 shadow rounded">
                                    <div class="card-body" style="font-family:微軟正黑體"><i class="fas fa-thumbtack me-1"></i> 總提問次數</div>
        
                                    <div class="card-footer  d-flex align-items-center justify-content-between">
                                         <div class="text-white" id="hits-value" ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6"><br>
                                <div class="card bg-warning text-white mb-4 shadow rounded">
                                    <div class="card-body" style="font-family:微軟正黑體"><i class="fas fa-thumbtack me-1"></i>三個月內總提問次數</div>
                                    <div class="card-footer  d-flex align-items-center justify-content-between">
                                         <div class="text-white" id="threeMonth"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6"><br>
                                <div class="card bg-success text-white mb-4 shadow rounded">
                                    <div class="card-body" style="font-family:微軟正黑體"><i class="fas fa-thumbtack me-1"></i> 一個月內總提問次數</div>
                                    <div class="card-footer  d-flex align-items-center justify-content-between">
                                         <div class="text-white" id="oneMonth"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6"><br>
                                <div class="card bg-danger text-white mb-4 shadow rounded">
                                    <div class="card-body" style="font-family:微軟正黑體"><i class="fas fa-thumbtack me-1"></i> 一周內總提問次數</div>
                                    <div class="card-footer  d-flex align-items-center justify-content-between">
                                         <div class="text-white" id="oneWeek"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            
                        <div class="row">
                            <div class="col-xl-12"><br>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        常見問題長條圖
                                    </div><br>
                                    <div id="chart-container" style="margin-left: 1px;"><svg width="90px"  height="90px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="{{config.color}}" ng-attr-stroke-width="{{config.width}}" ng-attr-r="{{config.radius}}" ng-attr-stroke-dasharray="{{config.dasharray}}" stroke="#518CD5" stroke-width="9" r="33" stroke-dasharray="155.50883635269477 53.83627878423159" transform="rotate(324 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>                          
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                常見問題總覽表
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-bordered">
                                    <thead >
                                        <tr >
                                            <th>回覆內容( 題目標題 )</th>
                                            <th>提問次數</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>回覆內容( 題目標題 )</th>
                                            <th>提問次數</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            include('dbcon.php');

                                            $ref_table = 'qaIntentsStats';
                                            $fetchdata = $database->getReference($ref_table)->getValue();

                                            if($fetchdata > 0)
                                            {
                                                $i = 1;
                                                foreach($fetchdata as $key => $row)
                                                {
                                                ?>
                                        <tr>
                                            <td><?=$row['displayName'];?></td>
                                            <td><?=$row['hits'];?></td>
                                            
                                        </tr>
                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <tr>
                                                        <td colspan="7" align="center">No Information!</td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </main>
            </div>
        </div>
        
        <script>
                var totalHits = 0;
                const dbRef = firebase.database().ref('qaIntentsStats');
                
                dbRef.once('value', (snapshot) => {
                const data = snapshot.val();
                for (let key in data) {
                    totalHits += data[key].hits;
                }
                // 更新 HTML 元素
                const hitsElement = document.getElementById("hits-value");
                hitsElement.innerHTML = totalHits;
              
                });
        </script>
        <script>
             // 取得現在的 Unix 時間戳記（以毫秒為單位）
              const now = new Date();

              // 取得一周前的 Unix 時間戳記（以毫秒為單位）
              const oneWeekAgo = now - (7 * 24 * 60 * 60 * 1000);
              const oneMonthAge = now -(30 * 24 * 60 * 60 * 1000);
              const threeMonthAge = now -(90 * 24 * 60 * 60 * 1000);

              // 取得 Firebase 數據庫的引用
              const ref = firebase.database().ref('qaChatLog');

              // 按照子節點的值排序，從一周前的時間戳記開始查詢
              ref.orderByKey().startAt(oneWeekAgo.toString()).once('value', (snapshot) => {
                // 計算符合條件的資料筆數
                const count = snapshot.numChildren();

                 // 將 count 值插入到 HTML 中的 #hits-value 元素中
                 document.querySelector('#oneWeek').textContent = count;
              }); 
              ref.orderByKey().startAt(oneMonthAge.toString()).once('value', (snapshot) => {
                // 計算符合條件的資料筆數
                const count = snapshot.numChildren();
                
                 // 將 count 值插入到 HTML 中的 #hits-value 元素中
                 document.querySelector('#oneMonth').textContent = count;
              });
              ref.orderByKey().startAt(threeMonthAge.toString()).once('value', (snapshot) => {
                // 計算符合條件的資料筆數
                const count = snapshot.numChildren();
                
                 // 將 count 值插入到 HTML 中的 #hits-value 元素中
                 document.querySelector('#threeMonth').textContent = count;
              });

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
