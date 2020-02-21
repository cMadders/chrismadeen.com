<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <script>
        // To Do - add https redirect in .htaccess
    if (location.protocol != 'https:'){
        location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    }
    </script>
<head>
    <?php include 'application/views/google_inserts/google_header_tag.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Look at my Stuff</title>

    <!--<link type="text/css" rel="stylesheet" href="http://www.chrismadeen.com/css/main.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://vjs.zencdn.net/6.2.0/video-js.css" rel="stylesheet">
    <link href="https://www.chrismadeen.com/css/cgm_main.css?modified=<?php echo filemtime(FCPATH . 'css/cgm_main.css')?>" rel="stylesheet">
    <link href="https://www.chrismadeen.com/css/charts.css?modified=<?php echo filemtime(FCPATH . 'css/charts.css')?>" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Varela+Round|Work+Sans|Zilla+Slab&display=swap" rel="stylesheet">
</head>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<body class="container-fluid theme-background-color">
    <?php include 'application/views/google_inserts/google_body_tag.php'; ?>
    <div id="menu_bar" class="menu-bar row theme-background-color theme-border-bottom">
        <div class="banner-header col-xs-4 col-sm-4 col-md-4 col-lg-5 col-xl-4">
            <div class="row">
                <div class="col-xs-6 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-xs">
                        <img class="headshot img-responsive img-circle" id="headshot" src="https://www.chrismadeen.com/img/thumbnails/headshot.jpg" style="">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <p class="banner-text">Chris Madeen</p>
                    <p class="hidden-xs banner-text banner-text-accent">Full Stack Developer</p>
                    <p class="hidden-sm hidden-md hidden-lg hidden-xl banner-text banner-text-accent">F-Stack Dev</p>
                </div>
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-7 col-xl-8 banner-links">
            <div class="centered-items theme-color row">
                <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3 col-xl-3"><a class="theme-color" href="https://codeigniter.com/" target="_blank">Codeigniter</a></span>
                <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3 col-xl-3"><a class="theme-color" href="d3js.org" target="_blank">D3.js</span></a>
                <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3 col-xl-3"><a class="theme-color" href="https://api.jquery.com/jquery.ajax/" target="_blank">Ajax</span></a>
                <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3 col-xl-3"><a class="theme-color" href="https://jquery.com/" target="_blank">JQuery</span></a>
            </div>
        </div>
    </div>
    <div class="row main-content-container">
        <div class="main-container col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xl-11 theme-background-color">
            <div class="row centered-items container-fluid canvas">
                <!--<h2 class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-xl-offset-3 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Sorry, this site is still under development.</h2>-->
            </div>
            <div id="fitbit_container" class="hidden container-fluid canvas row" related="fitbit-related">
                <div class="chart-container col-xs-12 col-sm-12  col-md-offset-1 col-lg-offset-0 col-md-9 col-lg-8 col-xl-8" id="foot_chart">
                    <canvas width="960" height="500" class="chart-canvas" id="foot_chart_canvas"></canvas>
                    <h4 class="chart-header">CGM Footsteps - Ajax / MYSQL / D3.js - <i data-activity="steps" class="glyphicon glyphicon-calendar activity-date-opener" data-toggle="modal" data-target="#dateModalCenter"></i></h4>
                </div>
                <div class="chart-summary chart-summary-cgm col-md-offset-1 col-sm-offset-1 col-lg-offset-0 col-xs-offset-1 col-xs-10 col-sm-10 col-md-9 col-lg-4 col-xl-4">
                    <div class="row">
                        <p class="col-md-offset-1 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">You, like many others, probably stay awake at night wondering, "How many footsteps does Chris Madeen
                            take in a day, a week, or even a month? Well, you can rest easy, now, because I have the solution
                            to your problems.
                        </p>
                        <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> Using the Fitbit API, I frequently retrieve this data and store it locally.  
                            Using Ajax and MySQL, this information is retrieved and presented with the <a href="https://d3js.org/" target==_blank">D3.js</a> data visualization library.
                            A ResizeObserver also keeps the chart looking relatively spiffy in different orientations and scales.
                        </p>
                    </div>
                </div>
            </div>
            <div id="resume_container" class="hidden container-fluid canvas">

            </div>
            <div id="about_container" class="container-fluid row canvas hidden">
                <div class="dialogue col-xs-12 col-sm-12 col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 hidden-xs">
                            <h3 class="list-header row-even">About Chris </h3>
                            <p>
                                Hello and welcome to ChrisMadeen.com.  If you are looking to get more information on me, Chris Madeen, then you have come to the right place.
                                I have spent a majority of my professional career as a LAMP stack developer.  Not exactly cutting edge, but I'm good at what I do.  I excel at
                                creative algorithms and debugging.  Usually, for better or for worse, I will find a way to integrate programming into my various hobbies.
                            </p>
                            <p>
                                Continually thinking with outside-the-box solutions has allowed me to overcome nearly every obstacle that has presented itself.  I enjoy
                                cooperative development and working on a team.  Following direction is a specialty, but I'm never afraid to voice any concerns.  One of 
                                the greatest joys of my profession is learning new skills in an endlessly changing environment.
                            </p>
                            <p>
                                I thrive outside of the technical realm in social and sales environments.  Doing voice over work and having a background in sales enables 
                                me to feel at home in conference meetings and on sales calls.  A personable, flexible and professional demeanor makes inter-department 
                                relations a breeze.
                            </p>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 hidden-xs">
                            <h3 class="list-header row-even">Technical Skills </h3>
                            <ul class="skills-list row-odd">
                                <li>LAMP Stack Development</li>
                                <li>Java</li>
                                <li>Node.js</li>
                                <li>Javascript/JQuery</li>
                                <li>Responsive Design</li>
                                <li>Object Oriented Programming</li>
                                <li>Relational Database Design</li>
                                <li>Adobe Creative Suite (Sciprting, Editing, Animation)</li>
                                <li>D3.js Visualization </li>
                                <li>Social Media APIs</li>
                                <li>Google Analytics</li>
                                <li>Computer Repair & Hardware installation</li>
                                <li>Server Migration</li>
                            </ul>
                            <h3 class="list-header row-even">Achievements</h3>
                            <ul class="skills-list row-odd">
                                <li>Created a complete system of Enterprise Resource Planning software</li>
                                <li>Streamlined production processes, enabling a completely remote operated business using cloud based solutions</li>
                                <li>Cooperatively developed an embeddable native advertising solution with GUI database interface</li>
                            </ul>
                        </div>
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-sm hidden-md hidden-lg hidden-xl">
                            <h3 class="list-header row-even">About Chris </h3>
                            <p>
                                Hello and welcome to ChrisMadeen.com.  If you are looking to get more information on me, Chris Madeen, then you have come to the right place.
                                I have spent a majority of my professional career as a LAMP stack developer.  Not exactly cutting edge, but I'm good at what I do.  I excel at
                                creative algorithms and debugging.  Usually, for better or for worse, I will find a way to integrate programming into my various hobbies.
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-sm hidden-md hidden-lg hidden-xl">
                            <h3 class="list-header row-even">Technical Skills </h3>
                            <ul class="skills-list row-odd">
                                <li>LAMP Stack Development</li>
                                <li>Java</li>
                                <li>Node.js</li>
                                <li>Javascript/JQuery</li>
                                <li>Responsive Design</li>
                                <li>Object Oriented Programming</li>
                                <li>Relational Database Design</li>
                                <li>Adobe Creative Suite (Sciprting, Editing, Animation)</li>
                                <li>D3.js Visualization </li>
                                <li>Social Media APIs</li>
                                <li>Google Analytics</li>
                                <li>Computer Repair & Hardware installation</li>
                                <li>Server Migration</li>
                            </ul>
                            <h3 class="list-header row-even">Achievements</h3>
                            <ul class="skills-list row-odd">
                                <li>Created a complete system of Enterprise Resource Planning software</li>
                                <li>Streamlined production processes, enabling a completely remote operated business using cloud based solutions</li>
                                <li>Cooperatively developed an embeddable native advertising solution with GUI databse interface</li>
                            </ul>
                        </div>
                    </div>
                    <!--
                    <div class="row">
                        <p class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 hidden-in-portrait">
                            Some of my non-technical skills that might be of interest are a strong, clear speaking voice that I have used to do voice over work in professional
                            environments.  Give me a ring, I think you will agree.  My public speaking skills help me excel in conferencing and sales environments.  A good humor 
                            and optimistic attitude help, in that regard, as well.
                        </p>
                        <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-in-landscape hidden-sm hidden-md hidden-lg hidden-xl">
                            Some of my non-technical skills that might be of interest are a strong, clear speaking voice that I have used to do voice over work in professional
                            environments.  Give me a ring, I think you will agree.  My public speaking skills help me excel in conferencing and sales environments.  A good humor 
                            and optimistic attitude help, in that regard, as well.
                        </p>
                        <p class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 hidden-in-portrait">
                            Feel free to play with Herbert while you are here.  He is becoming more functional and friendly as the days go by, so check back in on him.
                       </p>
                        <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-in-landscape hidden-sm hidden-md hidden-lg hidden-xl">
                            Feel free to play with Herbert while you are here.  He is becoming more functional and friendly as the days go by, so check back in on him.
                       </p>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <div class="side-bar col-xs-2 col-sm-3 col-md-2 col-lg-2 col-xl-1 theme-background-color">
            <div class="row">
                <div class="side-bar-header">
                  <img src="https://www.chrismadeen.com/img/thumbnails/cm_logo_small.png" class="img-responsive"/>
                  <i class="glyphicon glyphicon-menu-hamburger img-responsive menu-collapse hidden"></i>
                  <p class="hidden hidden-xs hidden-sm">chrismadeen.com</p>
                </div>
            </div>
            <ul class="nav nav-list row menu-container">
                <li id="resume_button" class="nav-item cgm-nav  cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a class="nav-link canvas-toggle menu-bar-anchor row" href="#" victim="#resume_container">
                        <i class="glyphicon glyphicon-open-file side-bar-glyph col-xl-12 col-sm-5 col-md-4 col-lg-4 col-xl-4" title="View Resume"></i>
                        <div class="hidden-xs col-sm-7 col-md-8 col-lg-8 col-xl-8 side-bar-glyph-container"><span class="side-bar-glyph-header">Resume</span></div>
                    </a>
                </li>
                <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a class="nav-link canvas-toggle menu-bar-anchor row" href="#" victim="#about_container">
                        <i class="glyphicon glyphicon-info-sign side-bar-glyph col-xl-12 col-sm-5 col-md-4 col-lg-4 col-xl-4" title="About Chris"></i>
                        <div class="hidden-xs col-sm-7 col-md-8 col-lg-8 col-xl-8 side-bar-glyph-container"><span class="side-bar-glyph-header">About</span></div>
                    </a>
                </li>
                <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a class="nav-link menu-bar-anchor row" href="https://github.com/cMadders?tab=repositories" target="_blank">
                        <i class="fab fa-github side-bar-glyph col-xl-12 col-sm-5 col-md-4 col-lg-4 col-xl-4"  title="Git Repositories"></i>
                        <div class="hidden-xs col-sm-7 col-md-8 col-lg-8 col-xl-8 side-bar-glyph-container"><span class="side-bar-glyph-header">Github</span></div>
                    </a>
                </li>
                <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <a class="nav-link menu-bar-anchor row" href="https://www.linkedin.com/in/chris-madeen-0aa36180" target="_blank">
                        <i class="fab fa-linkedin side-bar-glyph col-xl-12 col-sm-5 col-md-4 col-lg-4 col-xl-4" title="LinkedIn"></i>
                        <div class="hidden-xs col-sm-7 col-md-8 col-lg-8 col-xl-8 side-bar-glyph-container"><span class="side-bar-glyph-header">LinkedIn</span></div>
                    </a>
                </li>
                <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" data-toggle="collapse" data-target="#examples">
                    <a class="nav-link menu-bar-anchor row">
                        <i class="glyphicon glyphicon-folder-open side-bar-glyph col-xl-12 col-sm-5 col-md-4 col-lg-4 col-xl-4" title="Examples"></i>
                        <div class="hidden-xs col-sm-7 col-md-8 col-lg-8 col-xl-8 side-bar-glyph-container"><span class="side-bar-glyph-header">Examples</span></div>
                    </a>
                    <ul class="nav nav-list collapse" id="examples">
                        <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <a id="fitbit_button" class="nav-link canvas-toggle sidebar-subtext" href="#" victim="#fitbit_container">Fit API</a>
                        </li>
                        <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <a id="herbert_button" class="nav-link sidebar-subtext" href="#">Herbert</a>
                        </li>
                        <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          <a id="destroy_button" class="nav-link disabled sidebar-subtext hidden" href="#">Destroy</a>
                        </li>   
                    </ul>
                </li>
                <li class="nav-item cgm-nav col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 fitbit-related canvas-related hidden">
                    <a class="nav-link canvas-toggle menu-bar-anchor row" href="#">   
                        <span class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-xs hidden-sm">
                            <p>Have a Fitbit of your own?</p>
                            <p>Log in using OAuth 2.0 to view and submit your data to my database!</p>
                        </span>
                        <a class="hidden-xs hidden-sm" href="https://www.chrismadeen.com/Main/fitbit" target="_blank">
                            <input class="button-row-button row" type="button" value="Log-in">
                        </a>
                        <input class="hidden-md hidden-lg hidden-xl button-row-button row" type="button" value="Log-in" data-toggle="modal" data-target="#fitbitLoginModal">
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php include 'application/views/modals/activity_range_modal.php'; ?>
    <?php include 'application/views/modals/fitbit_login_modal.php'; ?>
    <span open="true" id="side_collapser" class=" collapse-chevron"><i class="fas fa-chevron-right theme-color-accent"></i></span>
</body>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://vjs.zencdn.net/6.2.0/video.min.js"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/herbert.js?modified=<?php echo filemtime(FCPATH . 'scripts/herbert.js')?>"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/cgm_charts.js?modified=<?php echo filemtime(FCPATH . 'scripts/cgm_charts.js')?>"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/cgm_fitbit.js?modified=<?php echo filemtime(FCPATH . 'scripts/cgm_fitbit.js')?>"></script>
<script type="text/javascript" src="https://www.chrismadeen.com/scripts/cgm_js_helper_functions.js?modified=<?php echo filemtime(FCPATH . 'scripts/cgm_js_helper_functions.js')?>"></script>
<script>
    // Note to Viewer - Some methodology could be more efficient within this script tag.  The intent is to show
    // knowledge of rudimentary javascript functionality with different control structures and functions with 
    // a little bit of humor to go along with it.
    // To Do - Redirect in .htaccess
    const cookie = "<?php echo $main_cook['value'];?>";
    const cgmBase = "https://www.chrismadeen.com/";
    const fitbitAPIDemo = cgmBase + "Main/fitbit";
    const resumeURL = "https://docs.google.com/document/d/e/2PACX-1vQ6deR0Og6hchmAeW9qYC16groQvE7dfaLeFdJK3n74vM_PNklnZsStmvdUxdztIkxQcosENziIDpaP/pub";
    
    let videoPlaying = false;
    let windowFocused = true;
    let resumeLoaded = false;
    let drawingFunctions = {steps:drawFootChart};
    
    // On Click Events
    $('#resume_button').on('click',function(){

        if (resumeLoaded)
            return;
        
        let resumeFrame = document.createElement('iframe');
        
        resumeFrame.src = resumeURL;
        resumeFrame.className = 'resume_frame';
        resumeFrame.setAttribute('scrolling','yes');
        
        $('#resume_container').append($(resumeFrame));
        
        resumeLoaded = true;
        $('#side_collapser').click();
    });
    
    $('#fitbit_button').on('click',function(){
        
        const curActivity = 'steps';
        let loader = createLoader('#foot_chart');
        
        getLocalActivities(footStartDate,footEndDate,1,curActivity)
                .then(processDailyActivities)
                .then(function(data){
                    drawFootChart(data);
                    if(localFitbitData.steps.length === 0){
                        localFitbitData.steps = data;
                        observeChart(document.getElementById('foot_chart_canvas'),localFitbitData,curActivity,drawFootChart);
                    }
                    loader.remove();
                })
                .catch(function(data){
                    window.console.log(data);
                });
   });
   
   $('#date_modal_save').on('click',function(){
       
       const start = footStartDate = $('#modal_start_date').val();
       const end = footEndDate = $('#modal_end_date').val();
       const activity = $(this).attr('current_activity');
       
       getLocalActivities(start,end,1,activity)
               .then(processDailyActivities)
               .then(function(data){
                   // Set data for resizeobserver, then redraw the activity
                   localFitbitData[activity] = data;
                   drawingFunctions[activity](data);
               }).catch(function(data){
                   window.console.log(data);
               });
    });

   $('#fitbit_modal_button').on('click',function(){
            window.open(fitbitAPIDemo, "_blank");
    });

    // booleans passed to toggle player.  True = on, False = off
    function toggleVideoPlayer(on){
        
        if(on){
            $('#video_player_container').fadeIn(5000);
            $('#video_player_container').removeClass('hidden');
            $('#video_carousel').fadeOut();
        }else{
            $('#video_player_container').fadeOut(5000);
            $('#video_player_container').addClass('hidden');
            $('#video_carousel').fadeIn();            
        }
    }
    
    $('#herbert_button').on('click',function(){
        
        var ourHerbert = new Herbert();
        
        ourHerbert.loadHerbertImages();
        ourHerbert.loadActionImages();
        
        $('#destroy_button').removeClass('hidden');
    });
   
    // Destroy all active herberts, using their innate function
    $('#destroy_button').on('click',function(){
        
       for(i = 0;i < herbertArray.length;i++){
           herbertArray[i].destroy();
       } 
       
       herbertArray.length = 0;
       $('#destroy_button').addClass('hidden');
    });
    
    $('.canvas-toggle').on('click',function(){
        
        var selector = $(this).attr('victim');
        var target = $(selector);
        const relatedSelect = "." + target.attr('related');
        
        heightAndOpacityFade('#headshot');
        
        if(!target.hasClass('hidden')){
            rollCanvasUp(selector,relatedSelect);     
        }else{
            rollCanvasDown(selector,relatedSelect);
        }
    });
    
    // Set the current activity to be selected on save
    $('.activity-date-opener').on('click',function(){
        $('#date_modal_save').attr('current_activity',$(this).data('activity'));
    });
    
    $('.menu-collapse').on('click',function(){
        
    });
    
    function createLoader(selector){
        
        let container = $(document.createElement('div'));
        let loader = $(document.createElement('div'));
        
        container.addClass('loader-container');
        loader.addClass('loader');
        
        container.append(loader);
        $(selector).prepend(container);
        
        return container;
    }
    
    function heightAndOpacityFade(selector){
        const height = $(selector).height();
        d3.select(selector)
                .style("opacity", 1.0)
                .transition()
                .style("opacity", 0)
                .style("height",height + "px")
                .transition()
                .style("height","0px")
                .duration('50').on("end",function(){
                    $(selector).addClass('hidden');
                    $(selector).attr('style','');
                });
    }
    
    function rollCanvasUp(selector,relatedSelect){
        d3.select(selector)
                .style("overflow-y","scroll")
                .style("height", "100%")
                .transition()
                .ease(d3.easeBounce)
                .style("height", "0%")
                .duration('1200').on("end",function(){
                    $(selector).addClass('hidden');
                    $(selector).attr('style','');
                    $(relatedSelect).addClass('hidden');
                });
    }
    
    function rollCanvasDown(selector,relatedSelect){
        
        $('.canvas').addClass('hidden');
        $('.canvas-related').addClass('hidden');
        
        $(selector).removeClass('hidden');
        
        d3.select(selector)
                .style("overflow-y","scroll")
                .style("height", "0%")
                .transition()
                .ease(d3.easeBounce)
                .style("height", "100%")
                .duration('1200').on("end",function(){
                    $(selector).attr("style","");
                    $(relatedSelect).removeClass('hidden');
                });
    }
    
    // Set height on scrolling elements in accordance with header size changes.
    const headerObserver = new ResizeObserver(() => { 
        const menu = $('#menu_bar');
        
        let height = menu.height();
        let top = getIntFromStyle(menu.css('padding-top'));
        let bottom = getIntFromStyle(menu.css('padding-bottom'));
        
        height = height + top + bottom;
        
        $('.main-content-container').attr("style","height:calc(100% - " + height + "px)");
        
        let sidebarWidth = $('.side-bar').width();
        let chevronWidth = $('#side_collapser i').width();

        $('#side_collapser').css('right',sidebarWidth + (chevronWidth * 2) + 'px');
        
    }); 
    
    $('#side_collapser').on('click',function(){
        main = $('.main-container')[0];
        side = $('.side-bar')[0];
        child = $(this).children('i');
        childClass = child.attr('class');
        
        if(this.getAttribute("open") == "true"){
            absorbElement(main,side);
            $(this).attr("open","false");
            child.attr('class',childClass.replace('right','left'));
        }else{
            if(!side.hasAttribute('previous-cols'))
                $(side).attr('previous-cols',printColumns(side));
            unabsorbElement(main,side);
            this.setAttribute("open","true");
            child.attr('class',childClass.replace('left','right'));
        }
    });

    $('#modal_end_date').on('change',function(){
        const end = $(this).val();
        endObj = new Date(end);
        if(endObj > today){
            window.alert("The end date is in the future. I do not even know what I will be doing, then.\n Let's just set that to today's date.");
            $(this).val(formatDateObject(today));
        }
    });

    headerObserver.observe(document.getElementById('menu_bar'));
    headerObserver.observe($('.side-bar')[0]);
    
    $(window).focus(function() {
        windowFocused = true;
    });

    $(window).blur(function() {
        windowFocused =false;
    });
    
</script>
</html>