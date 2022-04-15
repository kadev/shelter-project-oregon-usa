/* Examples */
(function($) {
    var urlController = appURL + "home/";

    /*LIne-Chart */
    $.ajax({
        method: 'POST',
        url: urlController+'getAnimalDataGraph',
        data: {  },
        beforeSend: function(){
            blockUISection("#animal-data-graph-container", "Generating animal data graph...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                var ctx = document.getElementById("animalDataGraph").getContext('2d');
                var myChart = new Chart(ctx, {
                    data: {
                        labels: result.years,
                        datasets: result.dataGraph
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        tooltips: {
                            enabled: true,
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontColor: "#c8ccdb",
                                },
                                barPercentage: 0.9,
                                display: true,
                                gridLines: {
                                    color:'rgba(119, 119, 142, 0.2)',
                                    zeroLineColor: 'rgba(119, 119, 142, 0.2)',
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    fontColor: "#77778e",
                                },
                                display: true,
                                gridLines: {
                                    color:'rgba(119, 119, 142, 0.2)',
                                    zeroLineColor: 'rgba(119, 119, 142, 0.2)',
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Thousands',
                                    fontColor: 'transparent'
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            width:30,
                            height:30,
                            borderRadius:50,
                            labels: {
                                fontColor: "#77778e"
                            },
                        },
                    }
                });

                unblockUISection("#animal-data-graph-container");
            }else{

            }
        });


    var c4 = $('.forth.circle');

    c4.circleProgress({
        startAngle: -Math.PI / 2 * 9,
        value: (parseFloat(c4.attr('data-percentage')) / 100),
        lineCap: 'round',
        emptyFill: 'rgba(204, 204, 204,0.2)',
        fill: {color: '#4680ff'},
        lineCap: 'round'
    });


    function blockUISection($section, $message = null){
        var container = $($section);
        if($message == null) $message = "Loading, please wait...";

        container.block({
            message: $message,
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    }

    function unblockUISection($section){
        var container = $($section);
        container.unblock();
    }




})(jQuery);