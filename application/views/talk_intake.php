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
    
    .btn-submit{
        margin-left:15px;
    }
    
    .image-gallery{
        margin-left:10%;
        margin-right:10%;
        margin-top: 5%;
    }
    
    .file-input{
        width:100%
    }
    
    .main-body{
        background-image:linear-gradient(green,lightgreen);
        width:100%;
        height:1000px;
    }
    
    .main-form{
        max-width: 75%;
        margin-left: 25%;
        margin-right: 25%;
        margin-top: 10%;
        background-color: #c3c3c3;
        border-radius: 25px;
        padding: 20px;
        border: 2px;
        border-style: groove;
        border-color: #bababa;
    }
    
    .sentence-container{
        background-color: rgba(255,255,255,.5);
        height: 10%;
        border-radius: 50px;
        border-color: lightgrey;
        border: 1px;
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
        margin-top:25%;
        min-width:50px;
    }
    
    .text-input{
        max-width:300px;
    }
    
    .tri-container{
    }
    
    .vocabulary-image{
        width: 100%;
        border-radius: 50px;
        border: 4px;
        border-color: #e39c8b;
        border-style: solid;
    }
    
    .vocabulary-item{
        float: left;
        width: 25%;
        margin: 10px;
        border-radius: 50px;
        max-width:100px;
    }
    
</style>
<body>
    <div class="container-fluid main-body">
        <form class="main-form row" enctype="multipart/form-data">
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control text-input" id="description" aria-describedby="descriptionHelp" placeholder="Enter Description">
            <small id="descriptionHelp" class="form-text text-muted">Choose one word to describe the image.</small>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label for="image">Upload an Image</label>
            <input type="file" name="imageToUpload" id="imageToUpload" class="file-input">
            <img id="image_preview" class="hidden vocabulary-image vocabulary-item" src="#" alt="uploaded image"/>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button id="submit" type="submit" class="btn-submit btn btn-primary">Submit</button>
        </form>
    </div>
</body>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://vjs.zencdn.net/6.2.0/video.min.js"></script>
<script>
    var cookie ='<?php echo $_COOKIE['Cook']; ?>';
    var baseURL = '<?php echo $base;?>';
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#image_preview').attr('src', e.target.result);
              $('#image_preview').removeClass('hidden');
            };
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imageToUpload").change(function() {
      readURL(this);
    });
    
    $('#submit').on('click',function(){
        file = document.getElementById('imageToUpload').files[0];
        window.console.log(file);
        //uploadRecord({words:'words',files:file});
        /*
        var file = document.getElementById('imageToUpload').files[0];
        var reader = new FileReader();
        reader.readAsText(file, 'UTF-8');
        reader.onload = shipOff;
        //reader.onloadstart = ...
        //reader.onprogress = ... <-- Allows you to update a progress bar.
        //reader.onabort = ...
        //reader.onerror = ...
        //reader.onloadend = ...
        */
    });
    /*
    function shipOff(event) {
        var result = event.target.result;
        var fileName = document.getElementById('imageToUpload').files[0].name;
        $.post('http://www.chrismadeen.com/index.php/main/talk_submit', { data: result, name: fileName }, continueSubmission);
    } 
    */
    function uploadRecord(array){
        var AjaxURL = baseURL + 'index.php/Main/talk_submit';
        window.console.log(array);
        var jsonString = JSON.stringify(array);
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "POST",
        url: AjaxURL,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        data: {data: jsonString},
            success: function (result) {
                window.console.log(result);
            }
        });                
    }
    /*
    $("form").submit(function(evt){	 
        var AjaxURL = baseURL + 'index.php/Main/talk_submit';
        evt.preventDefault();
        window.console.log(this);
        var formData = new FormData();
        formData.append("description",$('#description').val());
        formData.append('imageToUpload',$('#imageToUpload').val());
        window.console.log(formData);
        var formDat = new FormData($('form')[0]);
        window.console.log(formDat);
        $.ajax({
            url: AjaxURL,
            type: 'POST',
            data: formDat,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
              alert(response);
            }
        });
    });
    */
    /*
    $("form").submit(function(evt){	 
        var formData = new FormData();
        evt.preventDefault();
        formData.append("username", "Groucho");
        formData.append("accountnum", 123456); // number 123456 is immediately converted to a string "123456"

        // HTML file input, chosen by user
        formData.append("imageToUpload", $('#imageToUpload').val());

        // JavaScript file-like object
        var content = '<a id="a"><b id="b">hey!</b></a>'; // the body of the new file...
        var blob = new Blob([content], { type: "text/xml"});

        formData.append("webmasterfile", blob);
        entries = formData.entries();
        let entry = entries.next();
        while(!entry.done){
            window.console.log(entry.value);
            entry = entries.next();
        }
        var request = new XMLHttpRequest();
        request.mozBackgroundRequest = true;
        request.open("POST", baseURL + 'index.php/Main/talk_submit');
        request.send(formData);
    });
    */
    $(document).ready(function(){
        $('form').submit(function(e){
            window.console.log(new FormData(this));
            e.preventDefault(); 
                 $.ajax({
                     url: baseURL + 'index.php/Main/do_upload',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                          alert("Upload Image Successful.");
                   }
                 });
            });
    });
</script>
</html>