<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    function startsWith($haystack, $needle)
    {
         $length = strlen($needle);
         return (substr($haystack, 0, $length) === $needle);
    }

    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return $length === 0 || 
        (substr($haystack, -$length) === $needle);
    }
    function filterFact($fact){
        $check = strtolower($fact);
        if(endsWith($check,'id')){
            return false;
        }
        return true;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <script>
        // To Do - add https redirect in .htaccess
    if (location.protocol != 'https:'){
        location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Arrested Development Facts and Theories</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://vjs.zencdn.net/6.2.0/video-js.css" rel="stylesheet">
    <style type="text/css">
        .form-item{
            display: inline;
            width: 50%;
            float: left;
            margin-bottom: 10px;
        }
        
        .field-container{
            margin-left: auto;
            width: 75%;
            margin-right: auto;
            margin-bottom: 15px;
            margin-top:10px;
            border: 2px;
            border-color: black;
            border-style: solid;
            border-radius: 10px;
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .submit-button{
            margin-bottom:15px;
            width:100%;
            float:left;
        }
       
        .nav-adjust{
            display: table;
            margin-left: auto !important;
            margin-right: auto !important;
            float:none;
        }
        
        .banner{
            display:-webkit-inline-box;
            width:100%;
        }
       
        .text-selector{
            width:40%;
            color:black;
            margin-left:10px;
            float:right;
        }
        
        .select-filter{
            width:40%;
            float:left;
        }
        
        .form-subheader{
            width:100%;
            float:left;
        }
        
        .filter-container{
            width:50%;
            float:left;
            margin-top:10px;
            margin-bottom:10px;
        }
        
        .filter-button{
            width: 150px;
            border-radius: 25px;
            margin-bottom: 10px;
            background-color: #ff9b15;
            color: white;
            font-weight: 900;
        }
       
        .filter-submit{
            margin-top:25px;
        }
        
        .filter-item{
            margin: 10px;
            background-color: orange;
            width: 100px;
            border-radius: 25px;
            text-align: center;
            color: snow;
        }
        
        .filter-text{
            font-size: medium;
            font-weight: 900;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            float: left;
            width: 70px;
            padding-left: 5px;
        }
        
        #filter_select_container{
            width:100%;
        }
        
        
        
        .glyphy{
            margin-left: 10px;
            margin-top: 5px;
        }
        
    </style>
</head>
<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<body>
    <div id="banner" class="text-center">
        <img class="mx-auto d-block img-responsive banner" src="<?php echo $baseURL;?>/img/AR/arrested-development-banner.jpg"/>
    </div>
    <nav class="navbar navbar-inverse" style="border-radius:0px">
        <ul class="nav navbar-nav nav-adjust">
          <li class="active menu-option" data-target="entry"><a href="#">Entry</a></li>
          <li class="menu-option" id="associate_menu_button" data-target="associate"><a href="#">Associate</a></li>
          <li class="menu-option" data-target="view"><a href="#">View</a></li>
        </ul>
    </nav>
    <?php
    foreach($entry_types as $key => $value){
        echo '<div class="form-container container entry" id="' . $key . '_field_enter">';
            echo '<div class="field-container row">';
            echo '<h4>Enter ' . $key . ':</h4>';
            foreach($value['columns'] as $column){
                if(!filterFact($column->COLUMN_NAME)){
                    continue;
                }
                echo '<label class="form-item form-label">' . $column->COLUMN_NAME . '</label>';
                echo '<input type="text" class="form-item input-text form-item-' . $key . '" id="' . $column->COLUMN_NAME . '">';
            }
            ?>
            <div class="submit-button">
                <input type="button" class="record-submit" data-type="<?php echo $key;?>" value="Insert"/>
            </div>
            </div>
        </div>
        <?php
    }
    ?>
        <div class="form-container container hidden associate" id="associate_container">
            <div class="field-container row">
                <h2> Associate:</h2>
                <?php
                /*
                foreach($entry_types as $key => $value){
                    echo '<h4>' . $key . ':</h4>';
                    echo '<input type="text" value="Search..." data-target="' . $key . '_associate" class="input-text form-item input-text"/>';
                    echo '<select name="' . $key . '_associate" id="' . $key . '_associate" class="text-selector form-item">';
                        echo '<option value=""></option>';
                    foreach($value['entries'] as $entry){
                        $id = $entry->$key . '_ID';
                        echo '<option value="' . $id . '">' . $entry->short_text;
                    }
                    echo '</select>';
                }
                 * 
                 */
                ?>
                <h4>Facts:</h4>
                <input type="text" value="Search..." data-target="facts_associate"  class="input-text form-item input-text"/>
                <select name="facts_associate"  data-id="2" id="facts_associate" class="text-selector form-item associate-select">
                    <option value=""></option>
                <?php
                foreach($facts as $fact){
                    echo '<option value="' . $fact->facts_ID . '">' . $fact->text . '</option>';
                }
                ?>
                </select>
                <h4 class="form-subheader">Topics:</h4>
                <input type="text" data-target="topics_associate" value="Search..."  class="input-text form-item input-text"/>
                <select name="topics_associate" id="topics_associate" data-id="3" class="text-selector form-item associate-select">
                    <option value=""></option>
                <?php
                foreach($topics as $topic){
                    echo '<option value="' . $topic->topics_ID . '">' . $topic->text . '</option>';
                }
                ?>
                </select>
                <h4 class="form-subheader">Characters:</h4>
                <input type="text" data-target="characters_associate" value="Search..." class="input-text form-item input-text"/>
                <select name="characters_associate" id="characters_associate" data-id="4" class="text-selector form-item associate-select">
                    <option value=""></option>
                <?php
                foreach($characters as $character){
                    echo '<option value="' . $character->characters_ID . '">' . $character->character_name . '</option>';
                }
                ?>
                </select>
                <h4 class="form-subheader">Theories:</h4>
                <input type="text" data-target="theories_associate" value="Search..." class="input-text form-item input-text"/>
                <select name="theories_associate" id="theories_associate" data-id="1" class="text-selector form-item associate-select">
                    <option value=""></option>
                <?php
                foreach($theories as $theory){
                    echo '<option value="' . $theory->theories_ID . '">' . $theory->text . '</option>';
                }
                ?>
                </select>
                <div class="submit-button">
                    <input type="button" class="associate-submit" value="Associate"/>
                </div>
                <div class="topic-container fact-topic-container hidden">
                    <h4 class="form-subheader">Topics:</h4>
                </div>
                <div class="theory-container fact-theory-container hidden">
                    <h4 class="form-subheader">Theories:</h4>
                </div>
            </div>
        </div>
        <div class="form-container container hidden view" id="filter_container">
            <div class="field-container row">
                <div class="filter-container">
                    <input type="button" class="filter-button" data-id="3" data-type="topics" id="add_topic_filter" title="Add a Topic Filter" value="Topic Select">
                    <input type="button" class="filter-button" data-id="4" data-type="characters" id="add_character_filter" title="Add a Character Filter" value="Character Select">
                    <input type="button" class="filter-button" data-id="1" data-type="theories" title="Include Theories" value="Theories">
                    <input type="button" class="filter-button" data-id="2"data-type="facts" title="Include Facts" value="Facts">
                </div>
                <div class="filter-select-container filter-container">
                    <select id="filter_select_container">
                        
                    </select>
                    <div class="submit-button">
                        <input type="button" class="filter-button filter-submit" value="Select"/>
                    </div>
                </div>
                <div class="item-viewer">
                    
                </div>
            </div>
        </div>
        <div class="form-container container hidden" id="filter_view_container">
            <div class="field-container filter-field-container row">

            </div>
        </div>
        <div class="form-container container hidden" id="item_view_container">
            <div class="field-container item-field-container row">
                <ol id="item_ordered_list">
                    
                </ol>
            </div>
        </div>
</body>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://vjs.zencdn.net/6.2.0/video.min.js"></script>
<script type="text/javascript">
    const cookie = "<?php echo $main_cook['value'];?>";
    var baseURL = '<?php echo $baseURL;?>';
    var filterObjects = new Array();
    
    var filterObject = function(filterType, filterText, filterValue, filterTable){
        this.filterType = filterType;
        this.filterValue = filterValue;
        this.filterTable = filterTable;
        this.active = true;
        var me = this;
        container = $(document.createElement('div'));
        var text = $(document.createElement('p'));
        text.html(filterText);
        var span = $(document.createElement('span'));
        container.addClass('filter-item filter-item-' + filterType);
        span.addClass('glyphicon glyphicon-remove glyphy');
        text.addClass('filter-text');
        container.append(text);
        container.append(span);
        span.on('click',function(){
           me.active = false;
           $(this).parent().remove();
           checkFilters();
        });
        this.container = container;
        this.span = span;
        this.text = text;
    };
    
    filterObject.prototype.getFilterType = function(){
        return this.filterType;
    };
    
    filterObject.prototype.getText = function(){
        return this.text;
    };
    
    filterObject.prototype.getValue = function(){
        return this.filterValue;
    };
    
    filterObject.prototype.getContainer = function(){
        return this.container;
    };
    
    filterObject.prototype.setActive = function(activeIn){
        this.active = activeIn;
    };
    
    filterObject.prototype.isActive = function(){
        return this.active;
    };
    
    // End Filter Object
    
    $('.record-submit').on('click',function(){
        var type = $(this).data('type');
        var submitObject = {};
        $('.form-item-' + type).each(function(){
            submitObject[$(this).attr('id')] = $(this).val();
        });
        result = insertRecord(type,submitObject);
    });
    
    $('.filter-submit').on('click',function(){
        if($('#filter_select_container').val() === '')
            return;

        var select = document.getElementById('filter_select_container');
        var text = select.options[select.selectedIndex].innerHTML;
        
        var filter = new filterObject($(select).attr('did'),text, select.value, $(select).attr('dtype'));
        filterObjects.push(filter);
        
        getFilteredItems(filterObjects,addItemsToList);
        $('.filter-field-container').append(filter.getContainer());
    });
    
    $('.menu-option').on('click',function(){
        $('.active').removeClass('active');
        $('.form-container').addClass('hidden');
        $('.' + $(this).data('target')).removeClass('hidden');
        $(this).addClass('active');
    });
    
    $('.associate-submit').on('click',function(){
        var associativeArr = new Array();
        $('.associate-select').each(function(){
            var dataID = $(this).data('id');
            var option = $(this.options[this.selectedIndex]);
            var obj = {};
            
            if(option.val() === "")
                return;
            
            obj['type'] = dataID;
            obj['id'] = option.val();
            associativeArr.push(obj);
        });
        insertRelations(associativeArr);
    });
    
    $('#add_topic_filter').on('click',function(){
        $('#filter_select_container').attr('did',$(this).data('id'));
        $('#filter_select_container').attr('dtype',$(this).data('type'));
        var callback = function(result){
            $('#filter_select_container').html('');
            for(i = 0;i < result.length;i++){
                var option = $(document.createElement('option'));
                option.val(result[i].topics_ID);
                option.html(result[i].text);
                $('#filter_select_container').append(option);
            }  
        };
        getTopics(callback);
    });
    
    $('#add_character_filter').on('click',function(){
        $('#filter_select_container').attr('did',$(this).data('id'));
        $('#filter_select_container').attr('dtype',$(this).data('type'));
        var callback = function(result){
            $('#filter_select_container').html('');
            for(i = 0;i < result.length;i++){
                var option = $(document.createElement('option'));
                option.val(result[i].characters_ID);
                option.html(result[i].text);
                $('#filter_select_container').append(option);
            }  
        };
        getCharacters(callback);
    });

    $('#associate_menu_button').on('click',function(){
        var callback = function(things){
            dataTypes = ['facts', 'topics','characters','theories'];
            facts = things.facts;
            topics = things.topics;
            $('#facts_associate').empty();
            $('#topics_associate').empty();
            $('#characters_associate').empty();
            for(i = 0;i < dataTypes.length;i++){
                array = things[dataTypes[i]];
                $('#' + dataTypes[i] + '_associate').empty();
                option = $(document.createElement('option'));
                option.val('');
                $('#' + dataTypes[i] + '_associate').append(option);
                for(k = 0;k < array.length;k++){
                    window.console.log(array[k]);
                    option = $(document.createElement('option'));
                    option.attr('value',array[k][dataTypes[i] + '_ID']);
                    option.html(array[k].text);             
                    $('#' + dataTypes[i] + '_associate').append(option);
                }
            }
        };
        getAllTheThings(callback);
    });

    $(document).ready(function(){
        $('.nav li[data-target="view"]').click();  
    });
    
    function insertRecord(type, submitObject){
        var AjaxURL = baseURL + 'index.php/AD/insertRecord';
        var my_arr = {type:type, obj: submitObject};
        var jsonString = JSON.stringify(my_arr);
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "POST",
        url: AjaxURL,
        dataType: 'json',
        data: {data: jsonString},
            success: function (result) {
                window.alert(result.response);
            }
        });
    }
    
    function insertRelations(array){
        var AjaxURL = baseURL + 'index.php/AD/insertRelations';
        var my_arr = {relations:array};
        var jsonString = JSON.stringify(my_arr);
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "POST",
        url: AjaxURL,
        data: {data: jsonString},
            success: function (result) {
                if(result > 0){
                    window.alert('Success! HUZZAH!');
                }else{
                    window.alert('Failure.  It did not work.');
                }
            }
        });                
    }
    
    function getTopics(callback){
        var AjaxURL = baseURL + 'index.php/AD/getTopics';
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "GET",
        url: AjaxURL,
        dataType: 'json',
            success: function (result) {
                window.console.log(result);
                callback(result);
            }
        });            
    }
    
    function getCharacters(callback){
        var AjaxURL = baseURL + 'index.php/AD/getCharacters';
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "GET",
        url: AjaxURL,
        dataType: 'json',
            success: function (result) {
                window.console.log(result);
                callback(result);
            }
        });            
    }
    
    function getFactRelations(factID){
        var AjaxURL = baseURL + 'index.php/AD/getFactRelations';
        var my_arr = {fact_ID:factID};
        var jsonString = JSON.stringify(my_arr);
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "POST",
        url: AjaxURL,
        data: {data: jsonString},
            success: function (result) {
                window.alert(result);
            }
        });        
    }
    
    function getFilteredItems(fObjects, callback){
        var AjaxURL = baseURL + 'index.php/AD/getFilteredItems';
        var jsonString = JSON.stringify(fObjects);
        $.ajaxSetup({
        url:"AjaxURL",
        data:{ci_csrf_token: cookie},
            success:function(result){
            }
        });
        $.ajax({
        type: "POST",
        url: AjaxURL,
        dataType: 'json',
        data: {data: jsonString},
            success: function (result) {
                window.console.log(result);
                callback(result);
            }
        }); 
    }
    
    function getAllTheThings(callback){
        var AjaxURL = baseURL + 'index.php/AD/getAllTheThings';
        $.ajax({
        type: "GET",
        url: AjaxURL,
        dataType: 'json',
            success: function (result) {
                callback(result);
            }
        }); 
    }
    
    function checkFilters(){
        newFilter = new Array();
        filterObjects.forEach(function(filter){
            window.console.log('checking filter for active:' + filter);
            if(filter.isActive())
                newFilter.push(filter);
        });
        filterObjects = newFilter;
        getFilteredItems(filterObjects,addItemsToList);
    }
    
    
    var addItemsToList = function(items){
        ol = $('#item_ordered_list');
        ol.empty();
        textArray = new Array();
        window.console.log('items');
        window.console.log(items);
        if(items.length == 0){
            $('#item_view_container').addClass('hidden');
            $('#filter_view_container').addClass('hidden');            
        }else{
            $('#item_view_container').removeClass('hidden');
            $('#filter_view_container').removeClass('hidden');            
        }
        for(i = 0;i < items.length;i++){
            window.console.log(items[i]);
            subitems = items[i].items;
            window.console.log(subitems);
            for(k = 0;k < subitems.length;k++){
                if(textArray.includes(subitems[k].text))
                    continue;
                textArray.push(subitems[k].text)
                li = $(document.createElement('li'));
                li.html(subitems[k].text);
                ol.append(li);
            }
        }
    };

    
</script>
</html>