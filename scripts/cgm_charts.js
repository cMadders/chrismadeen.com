// axis supplied are D3 scales, context is canvas context, dimensions is
// an array with height and width of canvas, to properly scale on resize
// events
function xAxisSteps(axis,context,dimensions) {
    var tickCount = 8;
    if (dimensions.width < 400)
        tickCount = tickCount / 2;
        
        tickSize = 6,
        ticks = axis.ticks(tickCount),
        tickFormat = axis.tickFormat();

    ticks = removeExcessTicks(ticks);
    context.beginPath();
    ticks.forEach(function(d) {
        context.moveTo(axis(d), dimensions.height);
        context.lineTo(axis(d), dimensions.height + tickSize);
    });

   context.strokeStyle = "black";
   context.stroke();
   context.textAlign = "center";
   context.textBaseline = "top";
   context.save();      
   
   ticks.forEach(function(d) {
     const parseTime = d3.timeFormat("%m-%d");
     context.font = "bold 10px sans-serif";
     context.fillText(parseTime(d), axis(d), dimensions.height + tickSize);
   });
   
   context.beginPath();
   context.moveTo(0, dimensions.height);
   context.lineTo(dimensions.width, dimensions.height);
   context.strokeStyle = "black";
   context.stroke();

   context.restore();
 }


 function yAxisSteps(axis,context,dimensions) {
   var tickCount = (dimensions.height / 50) + 1,
       tickSize = 6,
       tickPadding = 3,
       ticks = axis.ticks(tickCount),
       tickFormat = axis.tickFormat(tickCount);

   context.beginPath();
   ticks.forEach(function(d) {
     context.moveTo(0, axis(d));
     context.lineTo(-6, axis(d));
   });
   context.strokeStyle = "black";
   context.stroke();

   context.beginPath();
   context.moveTo(-tickSize, 0);
   context.lineTo(0.5, 0);
   context.lineTo(0.5, dimensions.height);
   context.lineTo(-tickSize, dimensions.height);
   context.strokeStyle = "black";
   context.stroke();

   context.textAlign = "right";
   context.textBaseline = "middle";
   context.font = "bold 10px sans-serif";
   ticks.forEach(function(d) {
     context.fillText(tickFormat(d), -tickSize - tickPadding, axis(d));
   });

   context.save();
   //context.rotate(-Math.PI / 2);
   context.textAlign = "right";
   context.textBaseline = "top";
   context.font = "bold 10px sans-serif";
   context.fillText("Steps", -8, tickSize * -1);
   context.restore();
 }

 var drawFootChart = function (data){
     var times = data.times;
     var steps = data.steps;

     var canvas = document.querySelector("canvas"),
         context = canvas.getContext("2d");
     var margin = {top: 20, right: 30, bottom: 30, left: 50},
         width = canvas.width - margin.left - margin.right,
         height = canvas.height - margin.top - margin.bottom;

     var x = d3.scaleTime()
         .domain([d3.min(times),d3.max(times)])
         .nice()
         .range([margin.top, width]);

     var y = d3.scaleLinear()
         .domain([0,d3.max(steps)]).nice()
         .range([height, margin.top + margin.bottom]);

     var line = d3.line()
         .x(function(d) { return x(d.dateTime); })
         .y(function(d) { return y(d.value); })
         .curve(d3.curveStep)
         .context(context);

     var dimensions = {width:width,height:height,margins:margin};
     
     // Clear the canvas before redrawing the chart on resize
     context.clearRect(0,0, canvas.width,canvas.height);
     context.save();
     context.translate(margin.left, margin.top);

     xAxisSteps(x,context,dimensions);
     yAxisSteps(y,context,dimensions);

     context.beginPath();
     line(data.combined);
     context.lineWidth = 3;
     context.strokeStyle = "orange";
     context.stroke();
     context.restore();
 };
 
// The scaleTime function can duplicate dates/tick marks on
// dynamically scaled/resized charts.  This will remove excess ticks.
function removeExcessTicks(ticks){
    let lastValue = '';
    let deleteKeys = new Array();
    for (let [key, value] of Object.entries(ticks)) {
        val = String(value);
        valArr = val.split(' ');
        val = valArr[0] + valArr[1] + valArr[2] + valArr[3];
        if(val == lastValue){
            deleteKeys.push(key);
        }
        lastValue = val;
    }
    deleteKeys.forEach(function(d){
        delete ticks[d];
    });
    return ticks;
}