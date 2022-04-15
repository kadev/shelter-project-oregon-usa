$( document ).ready(function() {
    var urlController = appURL + "reports/";
    var urlDataChartController = appURL + "DataCharts/";

    /*
    $.ajax({
        method: 'POST',
        url: urlController+'/percentageOfSheltersByType',
        data: {  },
        beforeSend: function(){
            blockUISection("#sr-percentage-of-shelters-by-type-container", "Generating chart...");
        }
    })
        .done(function( data ) {
            var result = JSON.parse(data);

            if(result.response == true){
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
                        renderAt: "sr-percentage-of-shelters-by-type-chart",
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });


                unblockUISection("#sr-percentage-of-shelters-by-type-container");
            }else{

            }
        });


     */




    if($("#returned-animal-data-container").length){
        $.ajax({
            method: 'POST',
            url: urlController+'animalDataGraph2/',
            data: {  },
            beforeSend: function(){
                blockUISection("#sr-animal-data-graph-container-2", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "All animal data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "0",
                            plottooltext: "<b>$dataValue</b> animals $seriesName",
                            theme: "fint"
                        },
                        categories: result.data.categories
                        ,
                        dataset:
                        result.data.dataset

                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "msspline",
                            renderAt: "sr-animalDataGraph-2",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#sr-animal-data-graph-container-2");
                }else{

                }
            });

        $.ajax({
            method: 'POST',
            url: urlController+'getDataChartForColumn/received',
            data: {  },
            beforeSend: function(){
                blockUISection("#received-animal-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Received Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "1",
                            plottooltext: "<b>$dataValue</b> animals $seriesName",
                            theme: "fint"
                        },
                        data:
                        result.data
                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "spline",
                            renderAt: "received-animal-data",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#received-animal-data-container");
                }else{

                }
            });

        $.ajax({
            method: 'POST',
            url: urlController+'getDataChartForColumn/returned',
            data: {  },
            beforeSend: function(){
                blockUISection("#returned-animal-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Returned Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "1",
                            plottooltext: "<b>$dataValue</b> Animals",
                            theme: "fint"
                        },
                        data:
                        result.data
                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "spline",
                            renderAt: "returned-animal-data",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#returned-animal-data-container");
                }else{

                }
            });

        $.ajax({
            method: 'POST',
            url: urlController+'getDataChartForColumn/placed',
            data: {  },
            beforeSend: function(){
                blockUISection("#placed-animal-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Placed Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "1",
                            plottooltext: "<b>$dataValue</b> Animals",
                            theme: "fint"
                        },
                        data:
                        result.data
                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "spline",
                            renderAt: "placed-animal-data",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#placed-animal-data-container");
                }else{

                }
            });

        $.ajax({
            method: 'POST',
            url: urlController+'getDataChartForColumn/transfered',
            data: {  },
            beforeSend: function(){
                blockUISection("#transfered-animal-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Transfered Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "1",
                            plottooltext: "<b>$dataValue</b> Animals",
                            theme: "fint"
                        },
                        data:
                        result.data
                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "spline",
                            renderAt: "transfered-animal-data",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#transfered-animal-data-container");
                }else{

                }
            });

        $.ajax({
            method: 'POST',
            url: urlController+'getDataChartForColumn/euthanized',
            data: {  },
            beforeSend: function(){
                blockUISection("#euthanized-animal-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Euthanized Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "1",
                            plottooltext: "<b>$dataValue</b> Animals",
                            theme: "fint"
                        },
                        data:
                        result.data
                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "spline",
                            renderAt: "euthanized-animal-data",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#euthanized-animal-data-container");
                }else{

                }
            });

        $.ajax({
            method: 'POST',
            url: urlController+'getDataChartForColumn/transfered_out',
            data: {  },
            beforeSend: function(){
                blockUISection("#transfered-out-animal-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Transfered Out Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "1",
                            plottooltext: "<b>$dataValue</b> Animals",
                            theme: "fint"
                        },
                        data:
                        result.data
                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "spline",
                            renderAt: "transfered-out-animal-data",
                            width: "100%",
                            height: "100%",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#transfered-out-animal-data-container");
                }else{

                }
            });
    }





    $("#close-select-shelters-2").on("click", function(){
        var container = $("#select-shelters-container");
        container.fadeOut();
        $(this).hide();
        $("#select-shelters-2").show();
        $("#reports-section").show();
    });

    $("#search-input").on("keyup", function(){
        searchShelters();
    });

    $("#filter-by-state").on("change", function(){
        var value = $(this).val();
        var container = $("#shelters-container");
        var list = $("#sortable1");

        $.ajax({
            method: 'POST',
            url: urlController+'getSheltersByState',
            data: { state: value},
            beforeSend: function(){
                if(container.length){
                    blockUISection(container, "Getting shelters...");
                }
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    list.find("li").remove();
                    var results = 0;
                    if(result.shelters.length > 0){
                        result.shelters.forEach(function(shelter) {
                            results++;
                            list.append('<li class="ui-state-default w-100 mb-2" data-shelter="'+shelter.id+'">'+shelter.shelter_name+'</li>');
                        });
                    }

                    if(results > 0){
                        $("#empty-results-filter-by-state").hide();
                    }else{
                        $("#empty-results-filter-by-state").show();
                    }

                    unblockUISection(container);

                }else{
                    swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'});
                }
            });
    });

    $("#select-shelters-2").on("click", function(){
        var container = $("#select-shelters-container");
        container.fadeIn();
        $(this).hide();
        $("#close-select-shelters-2").show();
        $("#reports-section").hide();
    });

    $("#save-shelters-2").on("click", function(){
        var $container = document.getElementById("sortable2");
        var lis = $container.getElementsByTagName('li');
        var shelters = [];

        console.log(lis);
        for (var i = 0; i < lis.length; i++) {
            //button = div[i].getElementsByClassName("btn-shelter")[0];
            var id = lis[i].getAttribute("data-shelter");
            console.log(id);
            shelters.push(id);
        }

        shelters = shelters.join();
        console.log(shelters);
        var container = $("#main-content");

        $.ajax({
            method: 'POST',
            url: urlController+'saveSelectedShelterForReportSection',
            data: { shelters: shelters},
            beforeSend: function(){
                if(container.length){
                    blockUISection(container, "Updating shelters...");
                }
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){

                    swal(
                        {
                            title: 'Successful shelters update .',
                            text: 'The shelters has been updated successfully.',
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
    });

    $("#filter-by-state").on("change", function(){
        var value = $(this).val();
        var container = $("#shelters-container");
        var list = $("#sortable1");

        $.ajax({
            method: 'POST',
            url: urlController+'getSheltersByState',
            data: { state: value},
            beforeSend: function(){
                if(container.length){
                    blockUISection(container, "Getting shelters...");
                }
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    list.find("li").remove();
                    if(result.shelters.length > 0){
                        result.shelters.forEach(function(shelter) {
                            list.append('<li class="ui-state-default w-100 mb-2" data-shelter="'+shelter.id+'">'+shelter.shelter_name+'</li>');
                        });
                    }

                    unblockUISection(container);

                }else{
                    swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'});
                }
            });
    });

    if ( $("#table-shelters-details").length ) {
        $.ajax({
            method: 'POST',
            url: urlController+'getSheltersDetailsForReport',
            beforeSend: function(){
                blockUISection($("#sr-shelters-table-details"), "Getting data...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                   $("#table-shelters-details").append(result.table)

                    /*$('#table-shelters-details').DataTable({
                        language: {
                            searchPlaceholder: 'Search...',
                            sSearch: '',
                            lengthMenu: '_MENU_ items/page',
                        }
                    });*/

                    unblockUISection($("#sr-shelters-table-details"));
                }else{
                    swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'});
                }
            });
    }


    /******************************************************
     **************  SHELTERS REPORT V3   *****************
     ****************************************************/

    if($("#received-shelters-data-container").length){
        $.ajax({
            method: 'POST',
            url: urlController+'getDataForColumnByShelters2/received',
            data: {  },
            beforeSend: function(){
                blockUISection("#received-shelters-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    const dataSource = {
                        chart: {
                            caption: "Received Shelters Data from the last 10 years",
                            yaxisname: "Qty",
                            subcaption: "2012-2021",
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "0",
                            plottooltext: "<b>$dataValue</b> animals $seriesName",
                            theme: "fint"
                        },
                        categories: result.data.categories
                        ,
                        dataset:
                        result.data.dataset

                    };

                    FusionCharts.ready(function() {
                        var myChart = new FusionCharts({
                            type: "msline",
                            renderAt: "received-shelters-data",
                            width: "100%",
                            height: "600",
                            dataFormat: "json",
                            dataSource
                        }).render();
                    });

                    unblockUISection("#received-shelters-data-container");
                }else{

                }
            });
    }






    /***************************
     * END SHELTER REPORT V3
     */

    function searchShelters() {
        console.log("Search...");
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search-input');
        filter = input.value.toUpperCase();
        $container = document.getElementById("sortable1");
        div = $container.getElementsByTagName('li');
        var results = 0;
        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < div.length; i++) {
            //button = div[i].getElementsByClassName("btn-shelter")[0];
            txtValue = div[i].textContent || div[i].innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                div[i].style.display = "flex";
                results++;
            } else {
                div[i].style.display = "none";
            }
        }
    }

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


});