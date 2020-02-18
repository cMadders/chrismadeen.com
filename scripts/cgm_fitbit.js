const today = new Date();

let localFitbitData = {steps: new Array()};
let yesterday = new Date();
let lMonth = new Date();
let lastWeek = new Date();
let footStartDate = lastWeek;
let footEndDate = yesterday;

lMonth.setMonth(lMonth.getMonth() - 1);
yesterday.setDate(today.getDate() - 1);
lastWeek.setDate(today.getDate() - 8);

function observeChart(element,data,activity, rechart){
    const resizeObserver = new ResizeObserver(() => { 
            let height = $(element).height();
            let width = $(element).width();
            
            if (height > window.innerHeight)
                height = window.innerHeight;
            if (width > window.innerWidth)
                width = window.innerWidth;
            
            $(element).attr('height',height);
            $(element).attr('width',width);                
            
            rechart(data[activity]);
    }); 

    resizeObserver.observe(element);    
}

// Make an API request and graph it
var processResponse = function(res) {
    if (!res.ok) {
        throw new Error('Fitbit API request failed: ' + res);
    }

    var contentType = res.headers.get('content-type');
    if (contentType && contentType.indexOf("application/json") !== -1) {
        return res.json();
    } else {
        throw new Error('JSON expected but received ' + contentType);
    }
};

var processDailyActivities = function(activities){
    let times = new Array();
    let steps = new Array();
    const parseTime = d3.timeParse('%Y-%m-%d');
    
    data = activities['activities-steps'];
    
    data.forEach(function(d) {
      d['dateTime'] = parseTime(d['dateTime']);
      
      times.push(d['dateTime']);
      steps.push(parseInt(d['value']));
    });
    
    return {times: times,steps:steps,combined:data};
};

var processHeartRate = function(timeSeries) {
    return timeSeries['activities-heart-intraday'].dataset.map(
        function(measurement) {
            return [
                measurement.time.split(':').map(
                    function(timeSegment) {
                        return Number.parseInt(timeSegment);
                    }
                ),
                measurement.value
            ];
        }
    );
};

var graphActivity = function(data){
    if(localFitbitData.steps.length === 0){
        localFitbitData.steps = data;
        observeChart(document.getElementById('foot_chart_canvas'),localFitbitData,'steps',drawFootChart);
    }
    drawFootChart(data);
    return data;
};

function getDailyActivitiesDateRange(dateStart,dateEnd,activity){
    return new Promise((resolve,reject) => {
        fetch(
              'https://api.fitbit.com/1/user/-/activities/' + activity + '/date/' + dateStart + '/' + dateEnd + '.json',
                {
                    headers: new Headers({
                        'Authorization': 'Bearer ' + fitbitAccessToken
                    }),
                    mode: 'cors',
                    method: 'GET'
                }
        ).then(processResponse)
        .then(processDailyActivities)
        .then(graphActivity)
        .then(data=>{
            resolve(data);
        })
        .catch(function(error) {
            window.console.log(error);
            reject(error);
        });
    });
}

function getLocalActivities(dateStart,dateEnd,user,type){
    return new Promise((resolve,reject) => {
        var AjaxURL = 'https://www.chrismadeen.com/fitbit/getActivities';
        var my_arr = {activity:type,user:user,dateStart:dateStart,dateEnd:dateEnd};
        var jsonString = JSON.stringify(my_arr);
        $.ajaxSetup({
            url:"AjaxURL",
            data:{ci_csrf_token: cookie},
            success:function(result){
                window.console.log(result);
            }
        });
        $.ajax({
        type: "POST",
        url: AjaxURL,
        data: {data: jsonString},
            success: function (result) {
                resolve(result);
            },
            error: function(error){
                reject(error);
            }
        });                
    });
}

function getUserProfile(){
    return new Promise((resolve,reject) => {
        fetch(
              'https://api.fitbit.com/1/user/-/profile.json',
                {
                    headers: new Headers({
                        'Authorization': 'Bearer ' + fitbitAccessToken
                    }),
                    mode: 'cors',
                    method: 'GET'
                }
        ).then(processResponse)
        .then(data=>{
            resolve(data);
        })
        .catch(function(error) {
            console.log(error);
            reject(error);
        });
    });
}

var submitActivityData = function(data,type,user_id){
        return new Promise((resolve,reject) => {
        var AjaxURL = 'https://www.chrismadeen.com/fitbit/submitActivities';
        var my_arr = {activities:data,type:type,user:user_id};
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
                window.alert(result.response + '!' + ' \nNew Entries: ' + result.entries);
                resolve(result);
            }
        });
    });
};

var getActivities = function(dateStart,dateEnd,user,type){
    var AjaxURL = 'https://www.chrismadeen.com/fitbit/getActivities';
    var my_arr = {activity:type,user:user,dateStart:dateStart,dateEnd:dateEnd};
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
            window.console.log(result);
        }
    });                
};

function formatDateObject(today){
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
      dd = '0' + dd;
    }

    if (mm < 10) {
      mm = '0' + mm;
    }
    return yyyy + '-' + mm + '-' + dd;
}