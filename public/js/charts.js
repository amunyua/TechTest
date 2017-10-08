$(document).ready(function () {
    // alert('ready00');
    var url = $('#url').val();
    $.ajax({
        url:url,
        type: "GET",
        dataType:'json',
        success:function (data) {
            if(!data){
                alert('please do the migrations first to seed required data');
            }
        }
    });
    $.getJSON(url, function (csv) {
        console.log(csv);
        var chart = Highcharts.chart('container1', {
            data: {
                csv: csv
            },
            title: {
                text: 'Onboarding Flow'
            },

            // subtitle: {
            //     text: 'Source: thesolarfoundation.com'
            // },

            yAxis: {
                title: {
                    text: 'Users(%)'
                }
            },
            xAxis: {
                title: {
                    text: 'On boarding steps(%)'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0
                }
            },

            series: csv,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    });
});

