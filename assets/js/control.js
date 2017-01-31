
function rChartData(label,data1,data2,element){
    var radarChartData = {
        labels: label,
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: data1
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: data2
            }
        ]
    };

    window.myRadar = new Chart(document.getElementById(element).getContext("2d")).Radar(radarChartData, {
        responsive: true
    });
}       

function boxPieData(dataK, element){
    $(element).empty();
    
        $.plot($(element), dataK, {
            series: {
                pie: {
                    show: true,
                    radius: 500,
                    label: {
                        show: true,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }
                },
            },
            legend: {
                show: false
            }
        });
}

function hc_pieChart(cElement, cLabel, cData){  
    jQuery(document).ready(function($) {
        Highcharts.chart(cElement, {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: cLabel },
            tooltip: { pointFormat: '{series.name}: {point.y}, <br/>Percentage: <b>{point.percentage:.1f}%</b> ' },
            plotOptions: {
                pie: {  allowPointSelect: true, cursor: 'pointer',
                        dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: { color: (Highcharts.theme &&  Highcharts.theme.contrastTextColor) || 'black' }
                        }
                }
            },
            series: [{
                name: 'Total', colorByPoint: true,
                data: cData 
            }]
            , credits : { enabled : false}
            , exporting : { enabled : false}
        });
    });
}



function BarData(barData,element){
    // Morris Bar for comparisons
    //alert(element);
        Morris.Bar({
            element: element,
            resize: true,
            data: barData,
            xkey: 'DLabel',
            ykeys: ['DVal'],
            labels: ['Estimate'],
            barRatio: 0.4,
            
            xLabelAngle: 35,
            hideHover: 'auto'
        });
    
    
}

function BarData2(barData,element){
    var data = {
        "xScale": "ordinal",
        "yScale": "linear",
        "main": [{
            "className": ".bardata",
            "data": barData
        }]
    };
    var myChart = new xChart('bar', data, element);

}
    
function labelFormatter(label, series) {
    return "<div style='font-size:12px; text-align:center; padding:5px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}

function hBXX(id, yLabel, series, tooltip){
    jQuery(document).ready(function($) {
    Highcharts.chart(id,{
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: yLabel
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: tooltip+': <b>{point.y:1f}</b>'
            },
            series: [{
                name: 'Population',
                data: series,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif',
                        background: 'rgba(255,255,255, 0.2)'
                    }
                }
            }],
                exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                }
        });
    });
}