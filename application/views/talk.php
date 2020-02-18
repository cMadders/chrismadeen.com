<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Talk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://vjs.zencdn.net/6.2.0/video-js.css" rel="stylesheet">
</head>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<style>
    .main-body{
        background-image:linear-gradient(green,lightgreen);
        width:100%;
        height:1000px;
    }
    
    .image-gallery{
        margin-left:10%;
        margin-right:10%;
        margin-top: 5%;
    }
    
    .sentence-container{
        background-color: rgba(255,255,255,.5);
        height: 10%;
        border-radius: 50px;
        border-color: lightgrey;
        border: 1px;
        border-style: solid;
    }
    
    .tri-container{
    }
    
    .vocabulary-item{
        float: left;
        width: 25%;
        margin: 10px;
        border-radius: 50px;
        max-width:100px;
    }
    
    .vocabulary-image{
        width: 100%;
        border-radius: 50px;
        border: 4px;
        border-color: #e39c8b;
        border-style: solid;
    }
    
    .sentence-images{
        margin-top:10px;
    }
    
    .sentence-item{
        border-radius: 50px;
        max-width:100px;        
    }
    
    .sentence-play-button{
        border-radius: 50px;
        max-width:100px;    
    }
    
</style>
<body>
    <div class="container-fluid main-body">
        <div class="image-gallery row">
            <div id="tri_container_verb" class="tri-container col-xs-6 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <?php 
                foreach($vocabulary as $word){
                    echo '<div class="vocabulary-item" data-vid="' . $word->vocab_ID .'" data-primary="' . $word->group_ID . '" data-gname="' . $word->group_name . '" data-display="' . $word->display_name . '">
                        <img class="vocabulary-image" src="' .  $base . 'img/talking/' . $word->group_name . '/' . strtolower($word->display_name) . '.png"/>
                         </div>';
                }
            ?>
            </div>
            <div id="tri_container_noun" class="tri-container col-xs-6 col-sm-4 col-md-4 col-lg-4 col-xl-4">

            </div>
            <div id="tri_container_sign" class="tri-container col-xs-6 col-sm-4 col-md-4 col-lg-4 col-xl-4">

            </div>
        </div>
        <div class="sentence-container row">
            <div id="sentence_images" class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 sentence-images">
                <div id="sentence_play_button" class="sentence-play-button col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <img class="vocabulary-image img-responsive" src="http://www.chrismadeen.com/img/talking/misc/playbutton.png">
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://vjs.zencdn.net/6.2.0/video.min.js"></script>
<script>
    var BASE = 'http://www.chrismadeen.com/';
    var AUDIO_BASE = BASE + 'audio/TapTalk/';
    
    // Objects
    var talkObject = function(domObject){
        this.domObj = domObject;
    };
    
    talkObject.prototype.appendTo = function(objectIn){
        $('.select-container[data-vid="' + this.domObj.data('vid') + '"]');
        objectIn.append(this.domObj);
    };
    
    talkObject.prototype.getDomObj = function(){
        return this.domObj;
    };
    
    $(document).ready(function(){
        $('.vocabulary-item').each(function(){
            console.log($(this));
            var group = $(this).data('gname');
            $('#tri_container_' + group).append($(this));    
        });
    });
    
    $('.vocabulary-item').on('click',function(){
       path = AUDIO_BASE + $(this).data('gname') + '/' + $(this).data('display').toLowerCase() + '.wav';
       var audio = new Audio(path); 
       audio.play();
       var exists = $('.sentence-item').filter('[data-vid="' + $(this).data('vid') + '"]');
       if(exists.length > 0)
           return;
       talker = new talkObject($(this).clone());
       talker.getDomObj().addClass('col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4');
       talker.getDomObj().attr('class',talker.getDomObj().attr('class').replace('vocabulary-item','sentence-item'));
       console.log(talker);
       talker.appendTo($('.sentence-images'));
       $('#sentence_images').append($('#sentence_play_button'));
    });
    
    $('#sentence_play_button').on('click',function(){
       var items = $('.sentence-images').find('.sentence-item');
       playSentence(items,0);
    });
    
    function playSentence(array,iteration){
        var talk = $(array[iteration]);
        window.console.log(talk);
        if(!array[iteration])
            return;
        window.console.log('pass');
        path = AUDIO_BASE + talk.data('gname') + '/' + talk.data('display').toLowerCase() + '.wav';
        var audio = new Audio(path);
        audio.onended = function(){
            playSentence(array,++iteration);  
        };
        audio.play();
    }
    
</script>
</html>