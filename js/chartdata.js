$(document).ready(function () {

        $.ajax({
                url: "api/data.php",
                type: "GET",
                success: function (data) {
                    // console.log(data);
                    var month = [];
                    var totalbill = [];

                    for (var i in data) {
                        month.push("" + data[i].month);
                        totalbill.push(data[i].totalbill);
                    }

                    var chartdata = {

                        labels: month,

                        datasets: [
                            {
                               
                                
                                    backgroundColor: [
                                        'rgba(52, 152, 219,1.0)',
                                        'rgba(46, 204, 113,1.0)',
                                        'rgba(155, 89, 182,1.0)',
                                        'rgba(231, 76, 60,1.0)',
                                        'rgba(241, 196, 15,1.0)',
                                        'rgba(211, 84, 0,1.0)'
                                        
                                    ], 
                                
                               
                                borderWidth: 0,
                                hoverBackgrounColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                hoverBorderColor: 'rgba(200,200,200,1)',
                                data: totalbill

                            }
                        ]

                    };
                    var ctx = $("#bar-graph");

                
                            var bargraph = new Chart(ctx, {
                                type: 'line',
                                fill: false,
                                data: chartdata
                            })

                        },
                        error: function (data) {
                            // console.log(data);
                        }

                }
            );

        }
    );
