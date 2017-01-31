/*!
 * remark v1.0.7 (http://getbootstrapadmin.com/remark)
 * Copyright 2015 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */


(function(document, window, $) {
  'use strict';
  var Site = window.Site;

  $(document).ready(function($) {
    Site.run();
  });

  Chart.defaults.global.responsive = true;


  // Example Chartjs Line
  // --------------------
  (function() {
    var lineChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      scaleShowGridLines: true,
      scaleShowVerticalLines: false,
      scaleGridLineColor: "#ebedf0",
      datasets: [{
        fillColor: "rgba(204, 213, 219, .1)",
        strokeColor: $.colors("blue-grey", 300),
        pointColor: $.colors("blue-grey", 300),
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: $.colors("blue-grey", 300),
        data: [65, 59, 80, 81, 56, 55, 40]
      }, {
        fillColor: "rgba(98, 168, 234, .1)",
        strokeColor: $.colors("primary", 600),
        pointColor: $.colors("primary", 600),
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: $.colors("primary", 600),
        data: [28, 48, 40, 19, 86, 27, 90]
      }]
    };

    var myLine = new Chart(document.getElementById("exampleChartjsLine").getContext("2d")).Line(lineChartData);
  })();

/*
  // Example Chartjs Bar
  // --------------------
  (function() {
    var barChartData = {
      labels: ["January", "February", "March", "April", "May"],
      scaleShowGridLines: true,
      scaleShowVerticalLines: false,
      scaleGridLineColor: "#ebedf0",
      barShowStroke: false,
      datasets: [{
        fillColor: $.colors("blue", 500),
        strokeColor: $.colors("blue", 500),
        highlightFill: $.colors("blue", 500),
        highlightStroke: $.colors("blue", 500),
        data: [65, 45, 75, 50, 60]
      }, {
        fillColor: $.colors("blue-grey", 300),
        strokeColor: $.colors("blue-grey", 300),
        highlightFill: $.colors("blue-grey", 300),
        highlightStroke: $.colors("blue-grey", 300),
        data: [30, 20, 40, 25, 45]
      }]
    };

    var myBar = new Chart(document.getElementById("exampleChartjsBar").getContext("2d")).Bar(barChartData);
  })();


  */


  

  // Example Chartjs Pie
  // -------------------
  (function() {
   
    var pieData = [{
      value: 85,
      color: $.colors("primary", 500),
      label: "Yes"
    }, {
      value: 15,
      color: $.colors("blue-grey", 200),
      label: "No"
    }];

    var myPie = new Chart(document.getElementById("securityPie").getContext("2d")).Pie(pieData);
  })();

    // Nets Chartjs Pie
  // -------------------
  (function() {
    var pieData = [{
      value: 90,
      color: $.colors("red", 500),
      label: "No"
    }, {
      value: 10,
      color: $.colors("blue-grey", 200),
      label: "Yes"
    }];

    var myPie = new Chart(document.getElementById("netsPie").getContext("2d")).Pie(pieData);
  })();


  

})(document, window, jQuery);
