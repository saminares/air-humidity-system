google.load('visualization', '1', {packages: ['corechart', 'line']});
google.setOnLoadCallback(init);

//Creates the chart and appends to index.php
function drawChart(div, dataUrl, vaxis, haxis, color)
{
	var jsonData = [];
	$.getJSON(dataUrl, function( data ) {
	  jsonData = data;
	  for(var i = 0 ; i < jsonData.length; i++)
	  {
		jsonData[i][0] = new Date(jsonData[i][0].substr(0,10) + 'T' + jsonData[i][0].substr(11,8) + '+0200');
		jsonData[i][1] = Number(jsonData[i][1]);
	  }
	  
	var data = new google.visualization.DataTable();
	  data.addColumn('datetime', vaxis);
	  data.addColumn('number', haxis);

	  data.addRows(jsonData);

	  var options = {
		hAxis: {
			
		  title: '',
		gridlines: {count: 25}
		},
		vAxis: {
		
		  title: haxis
		},
		series: {
            0: { color: color}

          },
		legend:'none'
	  };

	  var chart = new google.visualization.LineChart(document.getElementById(div));
	  chart.draw(data, options);
	});
}

//Get Latest measurments and appends to index.php
function latestData(div, dataUrl, topic, unit)
{
  $.getJSON(dataUrl, function(data) {

   $('#'+div).append('<span>'+topic+": "+data[data.length - 1][1]+ unit +'</span>');


  });
}

//Runs drawchart and latest data function
function init() {
  
  latestData("hum_div","export.php?type=hum", "Humidity", " %");
  drawChart("chart_div2","export.php?type=hum","Time","Humidity", "#0000FF");
}



