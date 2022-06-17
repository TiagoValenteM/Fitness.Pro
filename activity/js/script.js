$(document).ready(function () {
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        $.ajax({url:`../scripts/chart_info.php`, dataType : 'json', success:function(result){
                const newList = [['Type', 'Count']];
                for (const key in result) {
                    newList.push([result[key][0], parseInt(result[key][1])])
                }

                var data = google.visualization.arrayToDataTable(newList);
                var options = {
                    pieHole: 0.6,
                    legend: {position: 'labeled', textStyle: {color: '#f3f3f2',
                            fontname:'SF Pro Display, SF Pro Icons, Helvetica Neue, Helvetica, Arial',
                            fontSize: 16, lineHeight:1.05, fontWeight:600, letterSpacing:-0.015}},
                    tooltip: {isHtml: true, trigger: 'selection', textStyle: {color: '#f3f3f2',
                            fontname:'SF Pro Display, SF Pro Icons, Helvetica Neue, Helvetica, Arial',
                            fontSize: 14, lineHeight:1.05, fontWeight:600, letterSpacing:-0.015}},
                    pieSliceText: 'none',
                    chartArea: { bottom: 20, top: 20, width: "100%", height: "100%"},
                    backgroundColor: 'transparent',
                    pieSliceBorderColor: 'transparent',
                    colors: ['#99fb0b', '#04f1d6', '#f71f6a', '#78f937', '#1ff3b1','#28d2c6',
                        '#c14d82', '#4ef670', '#35f593' ,'#6f94a7', '#8d7999','#8afa1f', '#14f2c0', '#17e0cd',
                        '#dc3676', '#61f757','#3ef586', '#2cf49f', '#43baba', '#7b89a1', '#a9628d'],
                };
                if(data.getNumberOfRows() == 0){
                    $('#no_workouts').show();
                }else{
                    $('#current_month').show();
                var chart = new google.visualization.PieChart(document.getElementById('rings'));
                chart.draw(data, options);
                }
            }
        });
    }
});