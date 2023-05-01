// Import the necessary modules
const vscode = require('vscode');
const path = require('path');

// Create a new webview panel
const panel = vscode.window.createWebviewPanel(
    'dialogflowChart', // The panel's ID
    'Dialogflow Analysis Chart', // The panel's title
    vscode.ViewColumn.Two, // The panel's location
    {
        enableScripts: true // Allow JavaScript in the webview
    }
);

// Load the Dialogflow analysis chart webpage
panel.webview.html = `
    <html>
    <head>
        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
        <link rel="stylesheet" type="text/css" href="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.css?v=1" />
        <script>
        <!-- ngIf: config.form === false --><h1 ng-if="config.form === false" ng-cloack="" class="ng-scope"><span ng-bind-html="config.label" class="ng-binding"><em class="ico"><span class="flaticon stroke graph-2"></span></em>Analytics</span> <span class="questions fa fa-question-circle ng-hide" ng-show="config.tour" ng-click="startTour()" role="button" tabindex="0" aria-hidden="true"></span></h1><!-- end ngIf: config.form === false -->

        <!-- ngIf: config.form === true && config.before -->
        <div class="header-form layout-column ng-hide" layout="column" ng-show="config.form === true" ng-cloack="" aria-hidden="true">
            <md-input-container md-no-float="" md-is-error="" ng-form="headerForm" flex="noshrink" ng-cloack="" class="ng-pristine ng-valid md-input-has-placeholder flex-noshrink md-input-has-value ng-valid-required ng-valid-pattern ng-valid-maxlength">
                <input id="entity-name" type="text" name="name" spellcheck="false" placeholder="<em class=&quot;ico&quot;><span class=&quot;flaticon stroke graph-2&quot;></span></em>Analytics" focus-on="!config.readonly &amp;&amp; config.focus" ng-model="config.model" class="form-header ng-pristine ng-untouched ng-valid md-input ng-not-empty ng-valid-required ng-valid-pattern ng-valid-maxlength" ng-maxlength="150" ng-required="config.required" ng-readonly="config.readonly" aria-invalid="false"><div class="md-errors-spacer"></div>
                <div role="alert" ng-messages="config.headerForm.name.$error" class="md-input-messages-animation md-auto-hide ng-inactive" aria-live="assertive">
                    <!-- ngIf: config.touched || config.headerForm.name.$touched || config.headerForm.name.$dirty -->
                    <!-- ngMessage: maxlength -->
                </div>
            </md-input-container>
        </div>
    
    </div></div>
                        </div>
                    </div>
                </div>
    
                
                <div class="wrap-loader">
                    <!-- ngIf: !stateLoaded -->
                </div>
    
                <!-- uiView: workplace --><div class="workplace ng-scope" ui-view="workplace" ng-class="{ 'transparent': !stateLoaded }" style=""><!-- uiView: agent --><div ui-view="agent" class="ng-scope" style=""><analytics-wrapper class="ng-scope ng-isolate-scope"><iframe id="analytics-iframe" ng-src="/projects/fubonagent-yqqh/analytics" frameborder="0" class="analytics-wrapper" (onload)="" src="/projects/fubonagent-yqqh/analytics" style="height: 905px;">
    </iframe>
    </analytics-wrapper></div></div>
    
            </div>
        </section>
        </script>
    </head>
    <body>
        <div id="chart"></div>
    </body>
    </html>
`;

// Set the CSS style for the webview panel
panel.webview.options = {
    // Enable zooming with the mouse scroll wheel
    zoomLevel: 0
};



