<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Look at my Stuff</title>

    <!--<link type="text/css" rel="stylesheet" href="http://www.chrismadeen.com/css/main.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://vjs.zencdn.net/6.2.0/video-js.css" rel="stylesheet">
    <style type="text/css">
    body{
        background-color:black !important;
        margin-bottom:25px;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: transparent;  /* optional: just make scrollbar invisible */
    }
    @media screen and (max-width: 800px) and (min-width: 600px) {
        .nav-button {
           font-size: larger !important;
        }
        .resume_frame{
            width:100%;
            min-height:200px;
            max-height:275px;
        }
        #button_masters{
            zoom:.40 !important;
        }
    }
    @media screen and (max-width: 600px) and (min-width: 100px) {
        .nav-button {
           font-size: larger !important;
        }
        .resume_frame{
            width:100%;
            min-height:200px;
            max-height:275px;
        }
        #button_masters{
            zoom:.30 !important;
        }
    }
    .banner-img{
        width:25%;
    }

    .menu-bar{
        /*background-color: #0075b6;
        border: 3px;
        border-style: solid;
        border-color: yellow;
        border-radius: 10px;
        color: white;
        */
        margin-bottom:0px;
    }

    .menu-image{
        max-width:50px !important;
    }

    .about-paragraph{
        margin-left: auto;
        margin-right: auto;
        max-width: 700px;
        color: #45be00;
        font: message-box;
        display: none;
        overflow:hidden;
        font-size:medium;
        margin-bottom:10px;
    }

    #about_container{
        position: absolute;
        max-width: 645px;
    }
    
    #load_text{
        color: rgba(44, 238, 0, 0.8);
        font-family:monospace;
    }
    
    #load_text_container{
        position: fixed;
        top: 40%;
        left: 40%;
    }
    
    #button_masters{
        z-index: 5;
        padding: 0px;
        z-index:5;
        width:50%;
        zoom: .50;
        bottom:0;
        height: 8%;
        position:absolute;
    }
    
    #videos_container{      
        position: absolute;
        margin-top: 42%;
        z-index:8;
    }
    
    #resume_container{
        position: absolute;
        margin-top: 42%;
    }
    
    .about-text{
        padding-right:5px;
        padding-left:5px;
        margin-right: auto;
        margin-left: auto;
        max-width: 70%;
        margin-top:36%;
    }

    .video-thumb{
        border: 7px;
        border-color: #607D8B;
        border-style: ridge;
    }

    .video-thumb-header{
        display:inherit;
        font-weight: 900;
        font-size: large;
    }

    .video-thumb-desc{
        display:inherit;
        padding-left:25px;
        padding-right:25px;
    }

    .video-text{
        color: #f6f300 !important;
    }

    .carousel-indicators li{
        border: 1px solid #f6f300 !important;
    }

    .carousel-indicators .active{
        background-color: #f6f300 !important;
    }

    .console-text{
        color: white;
        font-weight: bold;
        font-size: xx-large;
        font-variant-caps: all-petite-caps;
    }
    
    #videoWrapper{
        width:90%;
        max-width:750px;
    }

    #snake_container{
        width: 90%;
        height: 90%;
        position: fixed;
        margin-left: 5%;
        margin-right: 5%;
        margin-top:3%;
    }

    #games_container{
        width:100%;
        height:100%;
    }

    #snake_score{
        color: white;
        position: fixed;
        font-weight: bold;
        font-size: 20px;
        margin-top: -30px;
    }

    .snake_player{
        height:8px;
        width:8px;
        background-color: green;
        z-index:-1;
        position:fixed;
    }
    .snake_tail{
        position: fixed;
        background-color: green;
        z-index: 40;
    }

    .snake-food{
        background-color: red;
        height: 10px;
        width: 10px;
        border-radius: 5px;
        position: fixed
    }

    .speed-up{
        background-color: blue;
        color: white;
        height: 15px;
        width: 15px;
        border-radius: 15px;
        position: fixed;
        text-align: center;
        font-size: x-small;
        border: 1px;
        border-style: double;
        border-color: white;
    }

    #snake_upper_bounds{
        width: 100%;
        height: 10px;
        position: absolute;
        background-color: white;
    }

    #snake_lower_bounds{
        width: 100%;
        height: 10px;
        position: absolute;
        background-color: white;
        bottom: 0px;
    }

    #snake_right_bounds{
        height: 100%;
        width: 10px;
        position: absolute;
        background-color: white;
        right: 0px;
    }

    #snake_left_bounds{
        height: 100%;
        width: 10px;
        position: absolute;
        background-color:white;
        left: 0px;
    }

    #game_over_container{
        width: 50%;
        height: 50%;
        margin-left: 25%;
        position: absolute;
        display: inherit;
        background-color: #140101;
        border-radius: 25px;
        z-index: 99999;
        margin-top: 10%;
        border-color: white;
        border: 5px;
        border-style: groove;
    }

    #game-over-header{
        color: white;
        text-align: center;
        width: 100%;
    }

    .game_over_button{
        height: 50px;
        /*width: 125px;*/
        border-radius: 8px;
        background-color: darkturquoise;
        font-weight: 800;
        color: inherit;
    }

    .game-over-buttons{
    }

    .banner_header{
        text-align: center;
        border-bottom: 1px;
        border: black;
        border-bottom-style: solid;
        border-right-style: solid;
        border-left-style: solid;
        border-radius: 25px;
        margin-bottom:0px;
    }

    #banner{
        max-width: 800px;
        min-width:450px;
    }
    
    .menu_button_container{
        width: 100%;
        text-align: center;
        background-color: darkslateblue;
        border-radius: 65px;
        border: 6px;
        border-style: solid;
        border-color: #ffffff;
    }

    .resume_frame{
        width:100%;
        height:500px;
    }
        
    </style>
</head>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<body>
    <div id="banner" class="container-fluid hidden">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 banner_header">
                <div class="row" class="position:relative">
                    <img class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" src="http://www.chrismadeen.com/img/overlays/arcade_top.png"/>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="position: absolute;margin-top: 6%;">
                        <img class="banner-img" src="http://www.chrismadeen.com/img/cgm_logo.png"/>
                    </div>
                    <img class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" src="http://www.chrismadeen.com/img/overlays/arcade_middle.png">
                    <img id="console_bottom" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="z-index:2" src="http://www.chrismadeen.com/img/overlays/arcade_bottom.png">
                    <div id="about_container" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-11 col-lg-offset-1 col-lg-10 col-xl-6">
                        <div class="about-text row">
                            <p class="about-paragraph" id="text_transit" style="display:block">
                                Welcome to chrismadeen.com, the web's top resource for information about Chris Madeen.
                            </p>
                            <!--
                            <p class="about-paragraph">
                                This website was built using Codeigniter 3.0, supported by MYSQL database content and JQuery/Javascript.  It is largely still under development.
                            </p>
                            <p class="about-paragraph">
                                Based in Charleston, SC, I work as an end-to-end developer for a LAMP stack server. I find a lot of joy making 2D and 3D animations in my free time,
                                but won't be winning any awards for it.  My personal projects are not too extensive, but feel free to check out my <a href="https://github.com/cMadders" target="_blank">GIT</a>.
                            </p>
                            <p class="about-paragraph">
                                My skills include, but are not limited to:
                            </p>
                            <ul class="about-paragraph">
                                <li>Javascript</li>
                                <li>HTML5</li>
                                <li>CSS</li>
                                <li>Linux</li>
                                <li>Apache</li>
                                <li>MYSQL</li>
                                <li>PHP</li>
                                <li>Node.js</li>
                                <li>Java</li>
                                <li>Responsive Design</li>
                                <li>Adobe After Effects</li>
                                <li>Adobe Premiere</li>
                                <li>Adobe Illustrator</li>
                                <li>Adobe Photoshop</li>
                                <li>Juggling</li>
                            </ul>
                            -->
                        </div>
                    </div>
                    <div id="button_masters" class="col-xs-offset-4 col-sm-offset-4 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 menu-bar">
                        <ul class="nav navbar-nav row menu_button_container">
                            <li id="about_button" class="active nav-button col-sm-3 col-xs-3 col-lg-3 col-xl-3 "><p class="console-text" href="#">About</a><img class="center-block img-responsive arcade-button menu-image" src="http://www.chrismadeen.com/img/menus/yellow_button.png"/></li>
                            <li id="videos_button" class="nav-button col-sm-3 col-xs-3 col-lg-3 col-xl-3"><p class="console-text" href="#">Videos<img class="center-block img-responsive arcade-button menu-image" src="http://www.chrismadeen.com/img/menus/green_button.png"/></p></li>
                            <li id="resume_button" class="nav-button col-sm-3 col-xs-3 col-lg-3 col-xl-3"><p class="console-text" href="#">Resume<img class="center-block img-responsive arcade-button menu-image" src="http://www.chrismadeen.com/img/menus/blue_button.png"/></p></li>
                            <li id="game_button" class="nav-button col-sm-3 col-xs-3 col-lg-3 col-xl-3"><p class="console-text" href="#">Games<img class="center-block img-responsive arcade-button menu-image" src="http://www.chrismadeen.com/img/menus/red_button.png"/></p></li>
                        </ul>
                    </div>
                    <div id="videos_container" class="hidden canvas col-xs-offset-2 col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                        <div id="video_carousel">
                            <div id="videoCarousel" class="carousel slide" data-ride="carousel">
                              <ol class="carousel-indicators">
                                <?php
                                    $count = 0;
                                    $active = 'active';
                                    foreach($videos as $video){
                                        echo '<li data-target="#videoCarousel" data-slide-to="' . $count . '" class="video-li ' . $active . '" data-videopath="' . 
                                                $base . $video->file_path . '"></li>'; 
                                        $count++;
                                        $active = '';
                                    }
                                ?>
                              </ol>
                              <div class="carousel-inner">
                                <?php 
                                    $count = 0;
                                    $active = ' active';
                                    foreach($videos as $video){
                                        echo '<div class="item video-thumb-container container-fluid' . $active . '">';
                                        echo '<img class="d-block w-100 img-responsive img-rounded center-block video-thumb row" src="' . $base . $video->thumbnail_path .
                                                '" data-videopath="' . $base . $video->file_path . '">';
                                        echo '<div class="carousel-caption d-none d-md-block video-text row">';
                                        echo '<p class="video-thumb-header">' . $video->name . '</p>';
                                        echo '<p class="video-thumb-desc">' . $video->description . '</br>' . $video->length .  '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        $active = '';
                                    }
                                ?>
                              </div>
                            <a class="carousel-control-prev" href="#videoCarousel" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#videoCarousel" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        </div>
                        <div id="video_player_container" class="hidden canvas">
                            <div id="videoWrapper" class="center-block">
                                <video id="videoPlayer" class="video-js vjs-16-9" controls poster="" data-setup="{}"></video>
                            </div>
                        </div>
                    </div>
                    <div id="resume_container" class="canvas col-xs-offset-2 col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 hidden">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="games_container" class="hidden">
        <div id="snake_container" class="hidden">
            <div id="snake_score">Score: 0</div>
            <div id="snake_upper_bounds" data-collision="0"></div>
            <div id="snake_lower_bounds" data-collision="0"></div>
            <div id="snake_right_bounds" data-collision="0"></div>
            <div id="snake_left_bounds" data-collision="0"></div>
            <div id="player_block" class="snake_player">
            </div>
        </div>
        <div id="game_over_container" class="hidden">
            <h1 id="game-over-header">GAME OVER</h1>
            <div class="game-over-buttons row">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 col-xl-2"></div>
                <input id="play_again_button" type="button" class="game_over_button col-sm-4 col-xs-4 col-md-4 col-lg-4 col-xl-4" value="Play">
                <div class="col-sm-1 col-xs-1 col-md-1 col-lg-1 col-xl-1"></div>
                <input id="game_exit_button" type="button" class="game_over_button col-sm-4 col-xs-3 col-md-3 col-lg-3 col-xl-3" value="Exit">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 col-xl-2"></div>                        
            </div>
        </div>
    </div>
    <div id="load_text_container" class="container-fluid">
        <h2 count="0" dots="0"  id="load_text"></h2>
    </div>
    <!--Game Start Modal -->
    <div class="modal fade" id="game-start-modal" tabindex="-1" role="dialog" aria-labelledby="Game Start Modal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="game-start-modal-label">Games</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="game-description">
                    <h4>Snake</h4>
                    <p>
                        A traditional snake style game coded in Javascript. Use the left and right arrow keys to navigate your snake.
                    </p>
                    <button type="button" class="play-game-button" data-target="snake">Play</button>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</body>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://vjs.zencdn.net/6.2.0/video.min.js"></script>
<script type="text/javascript" src="<?php echo $base;?>scripts/jquery.touchwipe.min.js"></script>
<script>
    var videoPlayer = videojs("videoPlayer");
    var $videoPlayerContainer = $('.video_player_container');
    var videoPlaying = false;
    
    var animateLoadText = function(){
        text = "Loading";
        val = $('#load_text').attr('count');
        dots = $('#load_text').attr('dots');
        opacity = Math.floor(Math.random() * 4) + 5;
        val = parseInt(val);
        dots = parseInt(dots);
        for(i = 0;i < dots;i++){
            text += '.';
        }
        if(val % 3 == 0){
            $('#load_text').css('color','rgba(44, 238, 0,.8');
        }
        if(val % 20 == 0){
            dots++;
            $('#load_text').css('color','rgba(44, 238, 0,.' + opacity + ')');
            $('#load_text').attr('dots', dots);
        }
        if(dots > 3){
            val = 0;
            $('#load_text').attr('dots', 0);
        }
        val++;
        $('#load_text').attr('count',val);
        $('#load_text').html(text);
   };
    
    // Position buttons on load
    $(window).on('load', function(){
        $('#banner').removeClass('hidden');
        $('#load_text_container').addClass('hidden');
        currentFixedUpdate = function(){};
        //moveElementByDimension($('#button_masters'), 'height', -1.15, 'top');
    });
    $('document').ready(function(){
        var callback = function(){
            $('.about-paragraph').fadeTo("slow",1, function(){} );            
        };
        textAddOneByOneTransition($('#text_transit'),$('#text_transit').html(), 0, 30, callback);
    });
    // Video Events
    videoPlayer.on('ended',function(){
        toggleVideoPlayer(false);
    });
    $('.videoCarousel').carousel();
    $("#video_carousel").touchwipe({
        wipeLeft: function() {
            $('#videoCarousel').carousel('next');
        },
        wipeRight: function() {
            $('#videoCarousel').carousel('prev');
        },
        min_move_x: 20,
        min_move_y: 20,
        preventDefaultEvents: true
    });
    
    // On Click Events
    $('#resume_button').on('click',function(){
        $('.canvas').addClass('hidden');
        $('#resume_container').removeClass('hidden');
        $('#resume_container').html('');
        var resumeFrame = document.createElement('iframe');
        resumeFrame.src = "https://docs.google.com/document/d/e/2PACX-1vRIaGR2XZuZCHiMJ93X2kfIFcQXl1q_4J1EPViAhA0Mx2a8tvJjZS75_HnELyZWfLQkM97n05Ap52Hv/pub?embedded=true";
        resumeFrame.className = 'resume_frame';
        resumeFrame.setAttribute('scrolling','yes');
        $('#resume_container').append($(resumeFrame));
        $('#resume_container').removeClass('hidden');
        $('.nav-button').removeClass('active');
        $('#resume_button').addClass('active');
    });
    
    $('#videos_button').on('click',function(){
        $('.canvas').addClass('hidden');
        $('#videos_container').removeClass('hidden');
        $('.nav-button').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#about_button').on('click',function(){
        $('.canvas').addClass('hidden');
        $('#about_container').removeClass('hidden');
        $('.nav-button').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#game_button').on('click',function(){
        $('#game-start-modal').modal('toggle');
    });
    
    $('.play-game-button').on('click',function(){
        $('#games_container').removeClass('hidden');
        if($(this).data('target') === 'snake'){
            $('.canvas').addClass('hidden');
            $('#banner').addClass('hidden');
            $('#snake_container').removeClass('hidden');
            $('#game-start-modal').modal('toggle');
            currentFixedUpdate = snakeFixedUpdate;
            createFood();
        }
    });
    
    $('#game_exit_button').on('click',function(){
       $('#games_container').addClass('hidden');
       currentFixedUpdate = function(){};
       $('#banner').removeClass('hidden');
       $('#game_over_container').addClass('hidden');
    });
    
    $('.video-thumb').on('click',function(){
        videoPlayer.src([
            {
                type: "video/mp4",
                src: $(this).attr('data-videopath')
            }
        ]);
        toggleVideoPlayer(true);
        videoPlayer.load();
        videoPlayer.play();
    });
    
    $('.arcade-button').on('mousedown',function(){
        pressArcadeButton($(this), 'down');
    });
    
    $('.arcade-button').on('mouseup',function(){
        pressArcadeButton($(this), 'up');
    });
    
    $('.arcade-button').on('dragend',function(){
        pressArcadeButton($(this),'up');
    });
    
    function pressArcadeButton(button, direction){
        var source = button.attr('src');
        if(direction === 'up'){
            var altered = source.replace('_pressed.png','.png');
        }else{
            var altered = source.replace('.png','_pressed.png');
        }
        button.attr('src',altered);
    }
    
    
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
    
    // Game Code =======================================
    // 
    // Basic Player Object

    var windowFocused = true;
    var currentFixedUpdate;


    var PlayerObject = function(domObject,score, speed){
        this.score = score;
        this.domObj = domObject;
        this.speed = speed;
    };
    
    PlayerObject.prototype.addScore = function(scoreIn){
        this.score = this.score + scoreIn;
    };
    
    PlayerObject.prototype.getScore = function (){
        return this.score;
    };
    
    PlayerObject.prototype.getSpeed = function (){
        return this.speed;
    };
    
    PlayerObject.prototype.setSpeed = function(speed){
        this.speed = speed;
    };
    
    PlayerObject.prototype.getDOM = function () {
        return this.domObj;
    };
    
    PlayerObject.prototype.setDOM = function (DOM){
        this.DOM = DOM;
    };
    
    // Snake Objects
    var PlayerSnake = function(domObject, score, speed){
        PlayerObject.apply(this, arguments);
    };
    
    PlayerSnake.prototype = new PlayerObject();
    
    var Collectible = function(data){
      this.score = data.score;
      this.type = data.type;
      this.DOM = data.domObj;
      this.timer = data.timer;
    };

    Collectible.prototype.collect = function(playerObj){
        this.DOM.remove();
        this.resolve();
        this.player = playerObj;
        return this.score;
    };
    
    Collectible.prototype.resolve = function(){
        window.console.log('resolving');
        this.DOM.remove();
    };
    
    Collectible.prototype.getDOM = function(){
        return this.DOM;
    };
    
    Collectible.prototype.setDOM = function(DOM){
        this.DOM = DOM;
    };
    
    Collectible.prototype.getScore = function(){
        return this.score;
    };
    
    Collectible.prototype.setScore = function(score){
        this.score = score;
    };
    
    Collectible.prototype.getType = function(){
        return this.type;
    };
    
    Collectible.prototype.setType = function(type){
        this.type = type;
    };
    
    var PowerUp = function(data){
      Collectible.apply(this,arguments);
      this.type = 'PowerUp';
      this.amount = data.amount;
    };
    
    PowerUp.prototype = Object.create(Collectible.prototype);
    PowerUp.prototype.collect = function (playerObj){
        this.player = playerObj;
        return this.score;
    };    
    
    var SpeedUp = function(data){
        PowerUp.apply(this,arguments);
    };
    
    SpeedUp.prototype = Object.create(PowerUp.prototype);
    SpeedUp.prototype.collect = function (playerObj){
        this.player = playerObj;
        playerObj.setSpeed(playerObj.getSpeed() + this.amount);
        return this.score;
    };
    
    var speedUpData = {};
    speedUpData['score'] = 500;
    speedUpData['domObj'] = null;
    speedUpData['timer'] = 300000;
    speedUpData['amount'] = 2;

    // ----------Snake Variables------------
    // Directions 0-3 for north to west, clockwise
    var snakeActive = true;
    var snakeDirection = 0;
    var snakePlayer = $('#player_block');
    var snakeWidth = Number(snakePlayer.css('width').replace('px',''));;
    var snakeBaseSpeed = 4;
    var snakeSpeed = snakeBaseSpeed;
    var snakeLineWidth = 8;
    var snakeLengthCounter = snakeSpeed;
    var snakeTailMax = 20;
    var currentTailMax = snakeTailMax;
    var snakeTails = [];
    var changeDirection = 99;
    var collisionObject = {};collisionObject['axis'] = 'x';collisionObject['value'] = 1;
    var snakeScore = 0;
    var snakeScoreMultiplier = 1;
    var basicFoodScore = 250;
    var snakeCollectibles = [];
    var boundingMargin = 10;
    var BOUNDARY_COLLISION = 0;


    
    // Snake Code Start
    var snakePlayerObj = new PlayerObject($('#player_block'), 0, snakeBaseSpeed);
    $(document).keydown(function(e) {
        var clone;
        switch(e.which) {
            case 37: // left
                if(snakeDirection === 2 | snakeDirection === 0)
                        return;
                changeDirection = 2;
                collisionObject['axis'] = 'x';
                collisionObject['value'] = -1;
                break;
            case 38: // up
                if(snakeDirection === 1 | snakeDirection === 3)
                        return;
                changeDirection = 3;
                collisionObject['axis'] = 'y';
                collisionObject['value'] = -1;
                break;
            case 39: // right
                if(snakeDirection === 0 | snakeDirection === 2)
                        return;
                changeDirection = 0;
                collisionObject['axis'] = 'x';
                collisionObject['value'] = 1;
                break;
            case 40: // down
                if(snakeDirection === 1 || snakeDirection === 3)
                    return;
                changeDirection = 1;
                collisionObject['axis'] = 'y';
                collisionObject['value'] = 1;
                break;
            default: 
            return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    });
    
    function moveSnake(amount){
        var matrix = $.map(
            snakePlayer.css('transform') //get computed transform value, e.g.: matrix(1, 0, 0, 1, 1000, 0)
                .slice(7, -1)    //strip leading "matrix(" and trailing ")"
                .split(', '),    //split values into an array
            Number //map to numbers - Thanks Stack Overflow.
        );
        switch (snakeDirection){
            case 0:
                transformAmt = matrix[4] + amount;
                snakePlayer.css({"transform":"translate(" + transformAmt + "px," + matrix[5] + "px)"});
                break;
            case 1:
                transformAmt = matrix[5] + amount;
                snakePlayer.css({"transform":"translate(" + matrix[4] + "px," + transformAmt + "px)"});
                break;
            case 2:
                transformAmt = matrix[4] - amount;
                snakePlayer.css({"transform":"translate(" + transformAmt + "px," + matrix[5] + "px)"});
                break;
            case 3:
                transformAmt = matrix[5] - amount;
                snakePlayer.css({"transform":"translate(" + matrix[4] +"px," + transformAmt + "px)"});
                break;
            default:
            return;
        }
        snakeLengthCounter += amount;
    }
    
    function createFood(){
        var chanceX = Math.floor(Math.random() * $(window).width());
        var chanceY = Math.floor(Math.random() * $(window).height());
        var food = document.createElement('div');
        food.className = 'snake-food collectible';
        //food.setAttribute('style','top:' + chanceY + 'px;' + 'right:' + chanceX + 'px');
        //$('#snake_container').append($(food));
        placeSnakeCollectible(food);
        var foodData = {};
        foodData['score'] = basicFoodScore;
        foodData['type'] = 'food';
        foodData['domObj'] = food;
        foodData['timer'] = -1;
        var foodObj = new Collectible(foodData);
        // Use the get(0) to actually store the object for comparison later
        snakeCollectibles.push(foodObj);
    }
    
    function createSnakeTail(){
        // Each tail is a segment added to an array
        // Remove segments from the array and from the DOM
        if(currentTailMax <= snakeTails.length){
            var segment = snakeTails[0];
            snakeTails.shift();
            segment.remove();
        }
        clone = snakePlayer.clone();
        clone.attr('id','');
        clone.addClass('snake_tail');
        snakeTails.push(clone);
        $('#snake_container').append(clone);
    }
    
    function createPowerUp(){
        var chance = Math.floor(Math.random() * 50000);
        if(chance > 49900){
            window.console.log(speedUpData);
            var speedUpper = new SpeedUp(speedUpData);
            window.console.log(speedUpper);
            //var chanceX = Math.floor(Math.random() * $(window).width());
            //var chanceY = Math.floor(Math.random() * $(window).height());
            var power = document.createElement('div');
            power.className = 'power-up speed-up collectible';
            //power.setAttribute('style','top:' + chanceY + 'px;' + 'right:' + chanceX + 'px');
            power.innerHTML = 'S';
            //$('#snake_container').append($(power));
            placeSnakeCollectible(power);
            var powerObj = new SpeedUp(speedUpData);
            powerObj.DOM = power;
            window.console.log(powerObj);
            // Use the get(0) to actually store the object for comparison later
            snakeCollectibles.push(powerObj);
        }
    }
    
    var snakeFixedUpdate = function (){
        if(!windowFocused || !snakeActive)
            return;
        // Begin creating a tail if it has traversed the length of a player
        if(snakeLengthCounter >= snakeLineWidth){
            createSnakeTail();
            snakeLengthCounter = 0;
            // Limit input options so turns can only happen at snake width intervals (prevents overlapping)
            // 99 is an arbitrary number.  Jut don't tell 99 that, it thinks it's special.
            if(changeDirection < 99){
                snakeDirection = changeDirection;
                changeDirection = 99;
            }
        }
        checkCollision(snakePlayer,collisionObject);
        moveSnake(snakePlayerObj.getSpeed());
        createPowerUp();
    };
    
    var textOneByOneTransition = function (target,text, index, interval){
        if(!windowFocused)
            return;
        if(index == 0)
            target.html('');
        // 
        target.html(text[index++]);
        setTimeout(function(){
            textOneByOneTransition(target, text, index, interval);
        }, interval);
    };
    
    var textAddOneByOneTransition = function (target,text, index, interval, callback){
        if(index == text.length){
            callback();
            return;
        }
        if(index == 0)
            target.html('');
        // 
        target.html(target.html() + text[index++]);
        setTimeout(function(){
            textAddOneByOneTransition(target, text, index, interval,callback);
        }, interval);
    };
    
    //currentFixedUpdate = snakeFixedUpdate;
    currentFixedUpdate = animateLoadText;
    setInterval(function(){
        currentFixedUpdate()}, 33
    );
    
    function checkCollision(element, collisionObj){
        var bounds;
        if(collisionObj.axis === 'x'){
            bounds = element.width();
        }else{
            bounds = element.height();
        }
        var position = element.position();
        // Collision detection that checks the entire area where speed will occopy in the next update
        // Probably can do a more efficient collision detection with determining bounding boxes
        for(var i = 0; i <= bounds;i++){
            for(var k = 1;k <= snakePlayerObj.getSpeed();k++){
                var possibleElement;
                if(collisionObj.axis === 'x'){
                    possibleElement = document.elementFromPoint(position.left + i, position.top + k);
                    if(!possibleElement || $(possibleElement).data('collision') === 0){
                        snakeGameOver();
                        currentFixedUpdate = function(){};
                        return;
                    }else if(possibleElement.className.indexOf('collectible') > 0){
                        addToScore(collectSnakeItem(possibleElement));
                        if(possibleElement.className.indexOf('snake-food') >= 0){
                            currentTailMax += snakeTailMax;
                            createFood();
                            return;
                        }
                    }
                }else{
                    possibleElement = document.elementFromPoint(position.left + k, position.top + i);
                    if(!possibleElement || $(possibleElement).data('collision') === 0){
                        snakeGameOver();
                        currentFixedUpdate = function(){};
                        return;
                    }else if(possibleElement.className.indexOf('collectible') > 0){
                        addToScore(collectSnakeItem(possibleElement));
                        if(possibleElement.className.indexOf('snake-food') >= 0){
                            currentTailMax += snakeTailMax;
                            createFood();
                            return;
                        }
                    }                    
                }
            }
        }
    }
    
    function collectSnakeItem(item){
        var removalIndex;
        var scoreOut = 0;
        for(var i = 0;i < snakeCollectibles.length;i++){
            if(item === snakeCollectibles[i].getDOM()){
                removalIndex = i;
                scoreOut = snakeCollectibles[i].collect(snakePlayerObj);
                snakeCollectibles[i].resolve();
            }
        }
        snakeCollectibles.splice(removalIndex,1);
        window.console.log(scoreOut);
        return scoreOut;
    }
    
    function addToScore(amount){
        snakeScore += (amount * snakeScoreMultiplier);
        $('#snake_score').html('Score: ' + snakeScore);
    }

    $(window).focus(function() {
        windowFocused = true;
    });

    $(window).blur(function() {
        windowFocused =false;
    });
    
    function placeSnakeCollectible(elementIn){
        var xMin = Math.round(styleToNumber('#snake_container', 'margin-left')) + boundingMargin;
        var xMax = Math.round(styleToNumber('#snake_container', 'width')) - boundingMargin;
        var yMin = Math.round(styleToNumber('#snake_container', 'margin-top')) + boundingMargin;
        var yMax = Math.round(styleToNumber('#snake_container', 'height')) - boundingMargin;
        window.console.log('xmin: ' + (xMin + boundingMargin));
        var posx = randomIntFromInterval(xMin, xMax);
        var posy = randomIntFromInterval(yMin, yMax);
        /*
        var out = {};
        out['posX'] = posx;
        out['posY'] = posy;
        return out;
        */
        elementIn.setAttribute('style','top:' + posy + 'px;' + 'left:' + posx + 'px');
        $('#snake_container').append($(elementIn));
    }
    
    function reconfigureSnakePlayer(){
        if(snakeDirection === 2 || snakeDirection === 0){
            snakePlayer.css('width',snakeSpeed);
            snakePlayer.css('height',snakeLineWidth);
        }else{
            snakePlayer.css('height',snakeSpeed);
            snakePlayer.css('width',snakeLineWidth);
        }
    }
    
    function snakeGameOver(){
        $('#game_over_container').removeClass('hidden');
        $('#play_again_button').on('click',function(){
            $('#game_over_container').addClass('hidden');
            snakePlayer.css('transform','translate(50px,50px');
            $('.snake_tail').remove();
            snakeSpeed = snakeBaseSpeed;
            snakeDirection = 0;
            $('.collectible').remove();
            currentFixedUpdate = snakeFixedUpdate;
            createFood();
        });
    }
    
    function randomIntFromInterval(min,max){
        var number =  Math.floor(Math.random()*(max-min+1)+min);
        if(number < 0){
            number *= -1;
        }
        return number;
    }
    
    function styleToNumber(element,style){
        var number = $(element).css(style);
        number = number.replace('px','');
        window.console.log(number);
        return number;
    }
    
    // Position an element to that of another
    function positionOff(victim, example){
        position = example.position();
        victim.css('top', position.top + 'px');
        victim.css('left',position.left + 'px');
    }
    
    // Scales a target element to a percent of another
    function scaleToElement(victim, example, percentX, percentY){
        width = styleToNumber(example, 'width');
        height = styleToNumber(example, 'height');
        scaleX = parseInt(width) * percentX;
        scaleY = parseInt(height) * percentY;
        victim.css('width',scaleX);
        victim.css('height',scaleY);
    }

    function moveElementByDimension(element, dimension, direction, modify){
        originalPosition = styleToNumber(element,modify);
        originalValue = styleToNumber(element,dimension);
        window.console.log(originalValue);
        amount = originalValue * direction;
        window.console.log(amount);
        element.css(modify, parseInt(amount) + parseInt(originalPosition) + 'px');
        window.console.log(element.css('top'));
    }

    
    snakePlayer.css('transform','translate(50px,50px');
    
</script>
</html>