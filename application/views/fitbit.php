<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128622299-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-128622299-1');
    </script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Fitbit API and Graphing</title>

    <!--<link type="text/css" rel="stylesheet" href="http://www.chrismadeen.com/css/main.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://www.chrismadeen.com/css/cgm_main.css" rel="stylesheet">
    <link href="https://www.chrismadeen.com/css/charts.css" rel="stylesheet">
</head>
<body class="container-fluid" style="margin-top:15px;max-width:1200px;text-align:center;display:flex">
    <div id="fitbit_container" class="container-fluid canvas row theme-color" style="height:100%;overflow-y:scroll;margin:auto">
        <div class="chart-container col-xs-12 col-sm-12  col-md-offset-1 col-lg-offset-0 col-md-9 col-lg-8 col-xl-8" id="foot_chart">
            <canvas width="960" height="500" class="chart-canvas" id="foot_chart_canvas"></canvas>
            <h4 class="chart-header">CGM Footsteps - REST / OAuth 2.0 / D3.js - 
                <i data-activity="steps" class="glyphicon glyphicon-calendar activity-date-opener" data-toggle="modal" data-target="#dateModalCenter"></i>
                <div class="button-row">
                    <input type="button" class="button-row-button" value="Submit" id="submit_foot_activity"/>
                    <a href="https://www.chrismadeen.com"><input type="button" class="button-row-button" value="Back" id="back_button"></a>
                </div>
            </h4>
        </div>
        <div class="chart-summary col-md-offset-1 col-sm-offset-1 col-lg-offset-0 col-xs-offset-1 col-xs-10 col-sm-10 col-md-9 col-lg-4 col-xl-4">
            <div class="row">
                <p class="col-md-offset-1 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    Thanks for trying out Chris Madeen's Implicit Grant Flow (OAuth 2.0)  Fitbit API demonstration!
                    Feel free to submit your footstep data to the local database, which will be viewable in the future on
                    <a href="https://www.chrismadeen.com">chrismadeen.com</a>!
                </p>
            </div>
            <div class="row form-container">
            </div>
        </div>
    </div>
    <?php include 'application/views/modals/activity_range_modal.php'; ?>
</body>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/cgm_charts.js?modified=<?php echo filemtime(FCPATH . 'scripts/cgm_charts.js')?>"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/cgm_fitbit.js?modified=<?php echo filemtime(FCPATH . 'scripts/cgm_fitbit.js')?>"></script>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
    const fitbit_id = "<?php echo $fitbit_id;?>";
    const cookie = "<?php echo $main_cook['value'];?>";

    var temp;
    let fitbit_user_id;
    let user_info;
    let fitbitAccessToken;
    let drawingFunctions = {steps:drawFootChart};
    
    // If user hasn't authed with Fitbit, redirect to Fitbit OAuth Implicit Grant Flow
    if (!window.location.hash) {
        window.location.replace('https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=' + fitbit_id +'&redirect_uri=https%3A%2F%2Fwww.chrismadeen.com%2FMain%2Ffitbit&scope=heartrate%20activity%20profile');
    } else {
        var fragmentQueryParameters = {};
        window.location.hash.slice(1).replace(
            new RegExp("([^?=&]+)(=([^&]*))?", "g"),
            function($0, $1, $2, $3) { fragmentQueryParameters[$1] = $3; }
        );
        fitbit_user_id = fragmentQueryParameters.user_id;
        fitbitAccessToken = fragmentQueryParameters.access_token;
    }
    
    $('#submit_foot_activity').on('click',function(){
        submitActivityData(localFitbitData.steps,'steps',fitbit_user_id)
                .then(function(data){
                    window.console.log(data);
                })
                .catch();
    });
  
     $('#date_modal_save').on('click',function(){
       
       const start = footStartDate = $('#modal_start_date').val();
       const end = footEndDate = $('#modal_end_date').val();
       const activity = $(this).attr('current_activity');
       
       getDailyActivitiesDateRange(start,end,activity)
               .then(function(data){
                   // Set data for resizeobserver, then redraw the activity
                   localFitbitData[activity] = data;
                   drawingFunctions[activity](data);
               })
               .catch(function(error){
                   window.console.log(error);
               });
    });
    
    $('.activity-date-opener').on('click',function(){
        $('#date_modal_save').attr('current_activity',$(this).data('activity'));
    });
  
    $(window).focus(function() {
        windowFocused = true;
    });

    $(window).blur(function() {
        windowFocused =false;
    });

    // Page Load Actions
    getDailyActivitiesDateRange(formatDateObject(lastWeek),formatDateObject(yesterday),"steps");


</script>
</html>