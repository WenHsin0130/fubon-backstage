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
        <title>富邦人壽後台管理</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" />
        <!-- FusionBrew --> 
        <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-database.js"></script>
        <script src="js/chart.js"></script> 
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
            for(var i=0; i<keys.length; i++) {
              var key = keys[i];
              cdata.push({
                label: '有幫助',
                value: data[key]['helpful'],
              },
              {
                label: '沒幫助',
                value: data[key]['helpless'],
              });
            }
          var firebaseChart = new FusionCharts({
              type: 'pie2d',
              renderAt: 'chart-container',
              width: '1100',
              height: '550',
              dataFormat: 'json',
              dataSource: {
                  "chart": {
                        "caption": "有無幫助表",
                        "paletteColors": "#518CD5, #E5E9F5",
                        "bgColor": "#ffffff",
                        "showBorder": "0",
                        "use3DLighting": "0",
                        "showShadow": "10",
                        "enableSmartLabels": "0",
                        "startingAngle": "10",
                        "labelDisplay": "Rotate",
                        "showPercentValues": "1",
                        "showPercentInTooltip": "1",
                        "labelFontSize" : "15",
                        "labelFontBold" : "1",
                        "pieRadius": "180",
                        "exportEnabled": "1",
                        "decimals": "1",
                        "captionFontSize": "25",
                        "subcaptionFontSize": "14",
                        "subcaptionFontBold": "0",
                        "toolTipBgColor": "#e3e3e3",
                        "toolTipPadding": "10",
                        "toolTipColor": "#050100",
                        "toolTipBorderRadius": "3",
                        "toolTipBorderAlpha": "0",
                        "showHoverEffect": "0",
                        "startingAngle": "90",
                        "showLegend": "1",
                        "legendBgColor": "#ffffff",
                        "legendBorderAlpha": '0',
                        "legendShadow": '1',
                        "legendItemFontSize": '13',
                        "legendItemFontColor": '#666666',
                        "legendItemFontBold": '1'
                  },
                  "data": cdata
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
                    <div class="container-fluid px-4"><br>
                      <div id="chart-container" ><svg width="90px"  height="90px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="{{config.color}}" ng-attr-stroke-width="{{config.width}}" ng-attr-r="{{config.radius}}" ng-attr-stroke-dasharray="{{config.dasharray}}" stroke="#518CD5" stroke-width="9" r="33" stroke-dasharray="155.50883635269477 53.83627878423159" transform="rotate(324 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>                          
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
