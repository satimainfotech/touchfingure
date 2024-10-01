	var chart;
	AmCharts.ready(function() {
		// SERIAL CHART
		chart = new AmCharts.AmSerialChart();
		chart.dataProvider = chartData1;
		chart.categoryField = "country";
		chart.startDuration = 1;
		
		
		// AXES
		// category
		var categoryAxis = chart.categoryAxis;
		categoryAxis.labelRotation = 45;
		categoryAxis.gridAlpha = 0;
		categoryAxis.fillAlpha = 1;
		categoryAxis.fillColor = "#F5F5F5";
		categoryAxis.gridPosition = "start";
	
		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.dashLength = 5;
		valueAxis.title = value_txt;
		valueAxis.axisAlpha = 0;
		chart.addValueAxis(valueAxis);
	
		// GRAPH
		var graph = new AmCharts.AmGraph();
		graph.valueField = "visits";
		graph.colorField = "color";
		graph.balloonText = "<b>[[category]]: [[value]]</b>";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		chart.addGraph(graph);
	
		// CURSOR
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.zoomable = false;
		chartCursor.categoryBalloonEnabled = false;
		chart.addChartCursor(chartCursor);
	
		chart.creditsPosition = "top-right";
	
		// WRITE
		chart.write("chartdiv1");
		
	});
	
	var chart;
	AmCharts.ready(function() {
		// SERIAL CHART
		chart = new AmCharts.AmSerialChart();
		chart.dataProvider = chartData2;
		chart.categoryField = "country";
		chart.startDuration = 1;
		
		
		// AXES
		// category
		var categoryAxis = chart.categoryAxis;
		categoryAxis.labelRotation = 45; // this line makes category values to be rotated
		categoryAxis.gridAlpha = 0;
		categoryAxis.fillAlpha = 1;
		categoryAxis.fillColor = "#F5F5F5";
		categoryAxis.gridPosition = "start";
	
		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.dashLength = 5;
		valueAxis.title = value_txt;
		valueAxis.axisAlpha = 0;
		chart.addValueAxis(valueAxis);
	
		// GRAPH
		var graph = new AmCharts.AmGraph();
		graph.valueField = "visits";
		graph.colorField = "color";
		graph.balloonText = "<b>[[category]]: [[value]]</b>";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		chart.addGraph(graph);
	
		// CURSOR
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.zoomable = false;
		chartCursor.categoryBalloonEnabled = false;
		chart.addChartCursor(chartCursor);
	
		chart.creditsPosition = "top-right";
	
		// WRITE
		chart.write("chartdiv2");
		
	});
	
	$(document).ready(function() {
		var opts1 = {
			lines: 10,
			angle: 0,
			lineWidth: 0.3,
			pointer: {
				length: 0.45,
				strokeWidth: 0.035,
				color: '#242d3c'
			},
			limitMax: 'true',
			colorStart: '#303641',
			colorStop: '#303641',
			strokeColor: '#ddd',
			generateGradient: true
			
		};
	
		var opts2 = {
			lines: 10,
			angle: 0,
			lineWidth: 0.3,
			pointer: {
				length: 0.45,
				strokeWidth: 0.035,
				color: '#242d3c'
			},
			limitMax: 'true',
			colorStart: '#303641',
			colorStop: '#303641',
			strokeColor: '#ddd',
			generateGradient: true
		};
	
		var opts3 = {
			lines: 10,
			angle: 0,
			lineWidth: 0.3,
			pointer: {
				length: 0.45,
				strokeWidth: 0.035,
				color: '#242d3c'
			},
			limitMax: 'true',
			colorStart: '#303641',
			colorStop: '#303641',
			strokeColor: '#ddd',
			generateGradient: true
		};
	
	
		var target = document.getElementById('gauge1');
		var gauge = new Gauge(target).setOptions(opts1);
		gauge.maxValue = sale_max;
		gauge.animationSpeed = 32;
		gauge.set(sale);
		gauge.setTextField(document.getElementById("gauge1-txt"));
		
		var target = document.getElementById('gauge2');
		var gauge = new Gauge(target).setOptions(opts2);
		gauge.maxValue = six_sale_max;
		gauge.animationSpeed = 32;
		gauge.set(six_sale);
		gauge.setTextField(document.getElementById("gauge2-txt"));
		
		var target = document.getElementById('gauge3');
		var gauge = new Gauge(target).setOptions(opts3);
		gauge.maxValue = one_sale_max; 
		gauge.animationSpeed = 32;
		gauge.set(one_sale);
		gauge.setTextField(document.getElementById("gauge3-txt"));
		
		var updateGauge;
		var gaugeSwitch = document.getElementById('auto-gauge1');
		gaugeSwitch.checked = false;
		new Switchery(gaugeSwitch);
	
		gaugeSwitch.onchange = function() {
			if (gaugeSwitch.checked) {
				updateGauge = setInterval(function() {
					gauge.set(satimait.randomInt(1, 1500));
				}, 2000)
			} else {
				clearInterval(updateGauge);
			}
		};
	
		var updateGauge;
		var gaugeSwitch = document.getElementById('auto-gauge2');
		gaugeSwitch.checked = false;
		new Switchery(gaugeSwitch);
	
		gaugeSwitch.onchange = function() {
			if (gaugeSwitch.checked) {
				updateGauge = setInterval(function() {
					gauge.set(satimait.randomInt(1, 1500));
				}, 2000)
			} else {
				clearInterval(updateGauge);
			}
		};
	
		var updateGauge;
		var gaugeSwitch = document.getElementById('auto-gauge3');
		gaugeSwitch.checked = false;
		new Switchery(gaugeSwitch);
	
		gaugeSwitch.onchange = function() {
			if (gaugeSwitch.checked) {
				updateGauge = setInterval(function() {
					gauge.set(satimait.randomInt(1, 1500));
				}, 2000)
			} else {
				clearInterval(updateGauge);
			}
		};
	});