$( document ).ready(function() {
    var urlController = appURL + "reports/";
    var urlDataChartController = appURL + "DataCharts/";

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/prediction-of-animals-received-from-2014-to-2024',
        data: {  },
        beforeSend: function(){
            blockUISection("#received-prediction-container-2", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#received-prediction-container-2").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Prediction of the next 5 years of received animals",
                        yaxisname: "Animals",
                        subcaption: "2019-2024",
                        showhovereffect: "1",
                        drawcrossline: "1",
                        theme: "fint"
                    },
                    categories: [result.dataGraph.categories],
                    dataset: [
                        result.dataGraph.realDataset,
                        result.dataGraph.predictiveDataset
                    ]
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "msline",
                        renderAt: "predictive-chart-4",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });
            }else{

            }

            unblockUISection("#received-prediction-container-2");
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/prediction-of-animals-euthanized-from-2014-to-2024',
        data: {  },
        beforeSend: function(){
            blockUISection("#euthanized-prediction-container-2", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#euthanized-prediction-container-2").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Prediction of the next 5 years of euthanized animals",
                        yaxisname: "Animals",
                        subcaption: "2019-2024",
                        showhovereffect: "1",
                        drawcrossline: "1",
                        theme: "fint"
                    },
                    categories: [result.dataGraph.categories],
                    dataset: [
                        result.dataGraph.realDataset,
                        result.dataGraph.predictiveDataset
                    ]
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "msline",
                        renderAt: "predictive-chart-5",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });
            }else{

            }

            unblockUISection("#euthanized-prediction-container-2");
        });

    $.ajax({
        method: 'POST',
        url: urlDataChartController+'getDataChart/prediction-of-animals-returned-from-2014-to-2024',
        data: {  },
        beforeSend: function(){
            blockUISection("#returned-prediction-container-2", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
                $("#returned-prediction-container-2").find(".last-updated-label").text(result.last_updated);

                const dataSource = {
                    chart: {
                        caption: "Prediction of the next 5 years of returned animals",
                        yaxisname: "Animals",
                        subcaption: "2019-2024",
                        showhovereffect: "1",
                        drawcrossline: "1",
                        theme: "fint"
                    },
                    categories: [result.dataGraph.categories],
                    dataset: [
                        result.dataGraph.realDataset,
                        result.dataGraph.predictiveDataset
                    ]
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "msline",
                        renderAt: "predictive-chart-6",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });
            }else{

            }

            unblockUISection("#returned-prediction-container-2");
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

