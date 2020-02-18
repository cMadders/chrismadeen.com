
    var herbertImgBase = 'https://www.chrismadeen.com/img/Herbert/';
    var herbertDirections = ['rightWalk','downRightWalk','downWalk','downLeftWalk','leftWalk','upLeftWalk','upWalk','upRightWalk','idle'];
    var herbertActions = {wave:26,death:51};
    var herbertDirectionImages = [];
    var herbertArray = new Array();
    var herbertIntervalSpeed = 33;
    var currentFixedUpdate = function(){};
    
    // Basic Herbert fixed update to animate walking directions
    // After initial loading, src images are loaded from cache
    
    var fixedHerbertUpdate = function(herbertIn){
        ++herbertIn.frame;
        
        if(herbertIn.frame > herbertIn.animax){
            herbertIn.frame = 1;
        }
        // To-Do - Since herbert actions are loaded in the action array for caching, implement image flipping
        // from existing elements rather than changing the src attribute for a possible better performance
        herbertIn.image.src = herbertImgBase + herbertDirections[herbertIn.direction] + '/' + herbertIn.frame + '.png';
        
        herbertIn.moveFrame();
        herbertIn.checkCollision();
    };

    // Begin Herbert Action
    
    var HerbertAction = function(herbertIn,actionName){
        this.herbert = herbertIn;
        this.finished = false;
        this.interval = function(){};
        this.actionName = actionName;
    };
    
    
    HerbertAction.prototype.complete = function(){
        clearInterval(this.herbert.interval);
        this.herbert.interval = this.herbert.previousInterval;
        this.herbert.action = 0;
        this.finished = true;
        this.herbert.resetInterval();
    };
    
    HerbertAction.prototype.begin = function(){
        var action = this;
        var herb = this.herbert;
        herb.frame = 0;
        herb.previousInterval = herb.interval;
        clearInterval(herb.interval);
        action.interval = function(){
            ++herb.frame;
            if(herb.frame > herb.animax){
                action.complete();
            }
            herb.image.src = herbertImgBase + action.actionName + '/' + herb.frame + '.png';            
        };
        
        herb.interval = setInterval(function(){
                            action.interval();}, herbertIntervalSpeed
                        );   
    };
    // End Herbert Action
    
    // Begin Herbert
    var Herbert = function(){
        var herb = this;
        this.frame = 1;
        this.direction = 1;
        this.previousDirection = 1;
        this.action = 0;
        this.animax = 25;
        this.animaxBase = 25;
        this.previousAnimax = 25;
        this.herbertSpeed = 1;
        this.directionImages = [];
        this.actionImages = [];
        this.actionSet = false;
        this.DOM = document.createElement('div');
        this.image = document.createElement('img');
        this.previousInterval = function(){};
                
        $(this.DOM).addClass('herbert');
        $(this.image).addClass('herbert_img');
        $(this.image).attr('src',herbertImgBase + 'standing_still.png');
        $(this.DOM).append($(this.image));
        $('body').append($(this.DOM));

        // Halt Herbert on mouseenter / mobile click and then idle (direction 8)
        $(this.DOM).mouseenter(function(){
            herb.previousDirection = herb.direction;
            herb.direction = 8;

            this.previousInterval = this.interval;
            clearInterval(this.interval);
            
            if(herb.action === 0){
                herb.action = new HerbertAction(herb,"wave");
                herb.action.begin();
            }
        });

        // Restore Herbert basic action
        $(this.DOM).mouseleave(function(){
            herb.direction = herb.previousDirection;
            this.interval = this.previousInterval;
        });

        this.resetInterval();
        herbertArray.push(this);
    };

    // Clears and resets the interval to reduce running processes

    Herbert.prototype.resetInterval = function(){
        var herb = this;
        clearInterval(this.interval);
        // Store the interval so it can be killed / replaced later
        this.interval = setInterval(function(){
                            fixedHerbertUpdate(herb)}, herbertIntervalSpeed
                        );        
    };

    Herbert.prototype.setDirectionImages = function(direction,images){
        this.directionImages[direction] = images;
    };
    
    Herbert.prototype.setActionImages = function(action,images){
        this.actionImages[action] = images;
    };

    // Pre-load images for a better rendering experience
    Herbert.prototype.loadHerbertImages = function(){
        var imgArray = [];
        // Load the standard herbert movements
        for(i = 0;i < herbertDirections.length;i++){
            for(k = 1;k <= this.animax;k++){
                var img = $(document.createElement('img'));
                img.attr('src',herbertImgBase + herbertDirections[i] + '/' + k + '.png');
                img.addClass('herbert_img');
                imgArray.push(img);
            }
            this.setDirectionImages(i,imgArray);
        }
    };
    
    Herbert.prototype.loadActionImages = function(){
        // Load the standard herbert movements
        var keys = Object.keys(herbertActions);
        for (i = 0;i < keys.length;i++) {
            var imgArray = [];
            for(k = 1;k <= herbertActions[keys[i]];k++){
                var img = $(document.createElement('img'));
                img.attr('src',herbertImgBase + keys[i] + '/' + k + '.png');
                img.addClass('herbert_img');
                imgArray.push(img);
            }
            this.setActionImages(keys[i],imgArray);
        }
    };
    
    Herbert.prototype.checkCollision = function(){
        // *Note* Replace image find with more precision in case
        // future images are added to Herbert
        var image = $(this.DOM).find('img')[0];
        var position = $(this.DOM).position();
        var collideLeft = false;
        var collideRight = false;
        var collideTop = false;
        var collideBottom = false;
        
        // Check for boundary collisions with image offsets
        if(position.left >= (window.innerWidth - image.width)){
            collideRight = true;
        }else if(position.left <= 0){
            collideLeft = true;
        }else if(position.top > (window.innerHeight - image.height)){
            collideBottom = true;
        }else if(position.top < 0){
            collideTop = true;
        }else{
            return false;
        }
        
        var rando;
        var arr;
        
        // Randomize boundary redirects
        if(collideLeft){
            arr = [0,1,7];
        }else if(collideRight){
            arr = [3,4,5];
        }else if(collideTop){
            arr = [1,2,3];
        }else if(collideBottom){
            arr = [5,6,7];
        }
        rando = Math.floor(Math.random() * 2);
        this.direction = arr[rando];
    };

    // 8 axis movement definition for Herbert
    Herbert.prototype.moveFrame = function(){
        var div = this.DOM;
        var top = $(div).css('top').replace('px');
        var left = $(div).css('left').replace('px');
        
        switch (this.direction){
            case 0:
                $(div).css('left',(parseInt(left) + this.herbertSpeed) + 'px');
                break;
            case 1:
                $(div).css('left',(parseInt(left) + this.herbertSpeed) + 'px');
                $(div).css('top',(parseInt(top) + this.herbertSpeed) + 'px');
                break;
            case 2:
                $(div).css('top',(parseInt(top) + this.herbertSpeed) + 'px');
                break;
            case 3:
                $(div).css('top',(parseInt(top) + this.herbertSpeed) + 'px');
                $(div).css('left',(parseInt(left) - this.herbertSpeed) + 'px');
                break;          
            case 4:
                $(div).css('left',(parseInt(left) - this.herbertSpeed) + 'px');
                break;
            case 5:
                $(div).css('top',(parseInt(top) - this.herbertSpeed) + 'px');
                $(div).css('left',(parseInt(left) - this.herbertSpeed) + 'px');
                break;
            case 6:
                $(div).css('top',(parseInt(top) - this.herbertSpeed) + 'px');
                break;
            case 7:
                $(div).css('top',(parseInt(top) - this.herbertSpeed) + 'px');
                $(div).css('left',(parseInt(left) + this.herbertSpeed) + 'px');                
                break;
            default:
                break;
        }
    };
    
    // Removes Herbert, displaying destruction animation and removing active fixed intervals
    Herbert.prototype.destroy = function(){
        var herb = this;
        clearInterval(this.interval); 
        herb.action = new HerbertAction(herb,"death");
        herb.animax = herbertActions.death;
        herb.action.complete = function(){
                            clearInterval(herb.interval);
                            herb.action.finished = true;
                            herb.DOM.remove();
                        };
        herb.action.begin();
    };
    