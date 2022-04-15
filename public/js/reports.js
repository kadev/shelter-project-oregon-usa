$( document ).ready(function() {
    var urlController = appURL + "reports/";
    var urlDataChartController = appURL + "DataCharts/";

    if (typeof $animal === 'undefined') {
        $animal = false;
        var animalDataGraphKey = "animal-data-graph";
        var gkey = "animals";
    }else{
        var animalDataGraphKey = "animal-data-graph-"+$animal;
        var gkey = $animal;
    }

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/'+animalDataGraphKey,
        data: {  },
        beforeSend: function(){
            blockUISection("#animal-data-graph-container", "Generating animal data graph...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#animal-data-graph-container").find(".last-updated-label").text(result.last_updated);
                var ctx = document.getElementById("animalDataGraph").getContext('2d');
                var myChart = new Chart(ctx, {
                    data: {
                        labels: result.dataGraph.years,
                        datasets: result.dataGraph.dataGraph
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

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/percentage-of-animals-received-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#percentage-animals-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#percentage-animals-2019-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Percentage of animals received in 2019",
                        plottooltext: "<b>$percentValue</b> of the animals received in 2019 were $label",
                        showlegend: "1",
                        showpercentvalues: "1",
                        legendposition: "bottom",
                        usedataplotcolorforlabels: "1",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "pie2d",
                        renderAt: "percentage-received-chart",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#percentage-animals-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/percentage-of-animals-euthanized-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#percentage-euthanized-animals-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#percentage-euthanized-animals-2019-container").find(".last-updated-label").text(result.last_updated);
                const dataSource = {
                    chart: {
                        caption: "Percentage of animals euthanized in 2019",
                        plottooltext: "<b>$percentValue</b> of the animals euthanized in 2019 were $label",
                        showlegend: "1",
                        showpercentvalues: "1",
                        legendposition: "bottom",
                        usedataplotcolorforlabels: "1",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "pie2d",
                        renderAt: "percentage-euthanized-chart",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#percentage-euthanized-animals-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/percentage-of-animals-returned-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#percentage-returned-animals-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#percentage-returned-animals-2019-container").find(".last-updated-label").text(result.last_updated);
                const dataSource = {
                    chart: {
                        caption: "Percentage of animals returned in 2019",
                        plottooltext: "<b>$percentValue</b> of the animals returned in 2019 were $label",
                        showlegend: "1",
                        showpercentvalues: "1",
                        legendposition: "bottom",
                        usedataplotcolorforlabels: "1",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "pie2d",
                        renderAt: "percentage-returned-chart",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#percentage-returned-animals-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/percentage-of-shelters-by-type',
        data: {  },
        beforeSend: function(){
            blockUISection("#percentage-of-shelters-by-type-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#percentage-of-shelters-by-type-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Percentage of shelters by type",
                        plottooltext: "<b>$percentValue</b> of the animals returned in 2019 were $label",
                        showlegend: "1",
                        showpercentvalues: "1",
                        legendposition: "bottom",
                        usedataplotcolorforlabels: "1",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "pie2d",
                        renderAt: "percentage-of-shelters-by-type-chart",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#percentage-of-shelters-by-type-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/number-of-'+gkey+'-received-from-2013-to-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#number-of-animals-received-from-2013-to-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#number-of-animals-received-from-2013-to-2019-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Number of animals received per year [2013-2019]",
                        subcaption: "",
                        xaxisname: "Year",
                        yaxisname: "Number",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "column2d",
                        renderAt: "chart-number-of-animals-received-from-2013-to-2019",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#number-of-animals-received-from-2013-to-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/number-of-'+gkey+'-euthanized-from-2013-to-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#number-of-animals-euthanized-from-2013-to-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#number-of-animals-euthanized-from-2013-to-2019-container").find(".last-updated-label").text(result.last_updated);
                const dataSource = {
                    chart: {
                        caption: "Number of animals euthanized per year [2013-2019]",
                        subcaption: "",
                        xaxisname: "Year",
                        yaxisname: "Number",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "column2d",
                        renderAt: "chart-number-of-animals-euthanized-from-2013-to-2019",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#number-of-animals-euthanized-from-2013-to-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/number-of-'+gkey+'-transfered-from-2013-to-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#number-of-animals-transfered-from-2013-to-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#number-of-animals-transfered-from-2013-to-2019-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Number of animals transfered in per year [2013-2019]",
                        subcaption: "",
                        xaxisname: "Year",
                        yaxisname: "Number",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "column2d",
                        renderAt: "chart-number-of-animals-transfered-from-2013-to-2019",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#number-of-animals-transfered-from-2013-to-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/number-of-'+gkey+'-transfered-out-from-2013-to-2019',
        data: {  },
        beforeSend: function(){
            blockUISection("#number-of-animals-transfered-out-from-2013-to-2019-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#number-of-animals-transfered-out-from-2013-to-2019-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Number of animals transfered out per year [2013-2019]",
                        subcaption: "",
                        xaxisname: "Year",
                        yaxisname: "Number",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "column2d",
                        renderAt: "chart-number-of-animals-transfered-out-from-2013-to-2019",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#number-of-animals-transfered-out-from-2013-to-2019-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/number-of-'+gkey+'-received-from-2010-to-2020',
        data: {  },
        beforeSend: function(){
            blockUISection("#number-of-animals-received-from-2011-to-2021-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#number-of-animals-received-from-2011-to-2021-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Number of animals received per year [2011-2021]",
                        subcaption: "",
                        xaxisname: "Year",
                        yaxisname: "Number",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "line",
                        renderAt: "chart-number-of-animals-received-from-2011-to-2021",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#number-of-animals-received-from-2011-to-2021-container");
            }else{

            }
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/number-of-'+gkey+'-euthanized-from-2010-to-2020',
        data: {  },
        beforeSend: function(){
            blockUISection("#number-of-animals-euthanized-from-2011-to-2021-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#number-of-animals-euthanized-from-2011-to-2021-container").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Number of animals euthanized per year [2011-2021]",
                        subcaption: "",
                        xaxisname: "Year",
                        yaxisname: "Number",
                        theme: "fint"
                    },
                    data: result.dataGraph
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "line",
                        renderAt: "chart-number-of-animals-euthanized-from-2011-to-2021",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#number-of-animals-euthanized-from-2011-to-2021-container");
            }else{

            }
        });


    $(".reload-graph").on("click", function(){
        var reload = $(this).attr("data-reload");
        var container = $(this).attr("data-container");

        if(reload.length){
            swal(
                {
                    title: 'Confirm the data reload',
                    text: 'Are you sure to reload the data for this graph?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes, reload.",
                    cancelButtonText: "No, cancel."
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            method: 'POST',
                            url: reload,
                            data: {  },
                            beforeSend: function(){
                                if(container.length){
                                    blockUISection(container, "Reload Data graph...");
                                }
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result.response == true){

                                    swal(
                                        {
                                            title: 'Successful data reload.',
                                            text: 'The data has been saved successfully.',
                                            type: 'success',
                                            showCancelButton: true,
                                            confirmButtonText: "Reload page",
                                            cancelButtonText: "No, I'll reload later."
                                        },
                                        function(isConfirm) {
                                            if (isConfirm) {
                                                location.reload();
                                            }else{
                                                return true;
                                            }                                        }

                                    );

                                    if(container.length){
                                        unblockUISection(container);
                                    }
                                }else{
                                    swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'});
                                }
                            });
                    }
                }
            );
        }else{
            swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'});
        }

    })

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

    function labelFormatter(label, series) {
        return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
    }
});

