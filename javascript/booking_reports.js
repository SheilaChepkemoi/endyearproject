$(document).ready(function () {


    $.get("http://localhost/SCO4OO/api/report_active_users.php",function (data) {
        $parse=JSON.parse(data);
        var labels=[];

        var labeldata=[];

        $.each($parse,function (key,value) {

            labels.push(value.user_region);

            labeldata.push(value.number);

        });


    });



    $.get("http://localhost/Sheila/api/bookings_report.php",function (data) {

        $parse=JSON.parse(data);

        var labels=[];

        var labeldata=[];

        $.each($parse,function (key,value) {

           labels.push(value.booking_date);

           labeldata.push(value.number);

        })

        var ctx = document.getElementById( "sales-chart" );
        ctx.height = 150;
        var myChart = new Chart( ctx, {
            type: ['line'],
            data: {
                labels: labels,
                type: 'line',
                defaultFontFamily: 'Montserrat',
                datasets: [{
                    label: "Users",
                    data: labeldata,
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(40,167,69,0.75)',
                    borderWidth: 3,
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'rgba(40,167,69,0.75)',
                } ]
            },
            options: {
                responsive: true,

                tooltips: {
                    mode: 'index',
                    titleFontSize: 12,
                    titleFontColor: '#000',
                    bodyFontColor: '#000',
                    backgroundColor: '#fff',
                    titleFontFamily: 'Montserrat',
                    bodyFontFamily: 'Montserrat',
                    cornerRadius: 3,
                    intersect: false,
                },
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: true,
                        fontFamily: 'Montserrat',
                    },
                },
                scales: {
                    xAxes: [ {
                        display: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        }
                    } ],
                    yAxes: [ {
                        display: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    } ]
                },
                title: {
                    display: false,
                    text: 'Normal Legend'
                }
            }
        } );




    });


})