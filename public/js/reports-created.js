$( document ).ready(function() {
    var urlController = appURL + "reports/";
    var urlDataChartController = appURL + "DataCharts/";
    var $downloadPDF = $("#downloadPDF");
    var $regenerateCharts = $("#regenerate-charts");

    $('.check-toggle').on('click', function() {
        $(this).toggleClass('on');

        var input = $(this).attr('data-input');
        input = $('input[name='+ input + ']');

        if(input.val() == 1){
            input.val(0);
        }else{
            input.val(1);
        }
    });

    $('.from-select').select2({
        placeholder: 'Select an order',
        width: '100%'
    });

    $('.to-select').select2({
        placeholder: 'Select a parent page',
        width: '100%'
    });

    $('.criteria-select').select2({
        placeholder: 'Select a parent page',
        width: '100%'
    });

    $('#filter-by-state').select2({
        placeholder: 'Select a parent page',
        width: '100%'
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

    $("#create-report").on("click", function(){
        var formData = $("#form-create-report").serialize();
        var reportTitle = $("input[name=title]").val();
        var from = $(".from-select").val();
        var to = $(".to-select").val();

        var shelters = getSheltersSelected();

        console.log(shelters);

        if(reportTitle.length > 0 && from.length > 0 && to.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addReport',
                data: { data_report: formData, shelters: shelters },
                beforeSend: function(){
                    blockUISection("#form-create-report", "Saving data, Please wait, this action may take a few minutes...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Report created!',
                                text: 'The report was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to reports created",
                                cancelButtonText: "Create another",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "reports/created";
                                }else{
                                    location.reload();
                                }
                            }
                        );
                    }else{
                        swal(
                            {
                                title: 'Oops...',
                                text: 'Something went wrong.',
                                type: 'error'
                            },
                            function(isConfirm) {
                                window.location.href = appURL + "reports/created";
                            }
                        )
                    }

                    unblockUISection("#form-create-report");
                });
        }else{
            swal(
                {
                    title: 'Oops...',
                    text: 'Enter the required fields.',
                    type: 'error'
                },
                function(isConfirm) {
                }
            )
        }
    });

    $("#edit-report").on("click", function(){
        var formData = $("#form-edit-report").serialize();
        var report_id = $(this).attr("data-report");
        var reportTitle = $("input[name=title]").val();
        var from = $(".from-select").val();
        var to = $(".to-select").val();

        var shelters = getSheltersSelected();

        if(reportTitle.length > 0 && from.length > 0 && to.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateReport',
                data: { data_report: formData, report_id: report_id, shelters: shelters },
                beforeSend: function(){
                    blockUISection("#form-edit-report", "Updating data, Please wait, this action may take a few minutes...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        swal(
                            {
                                title: 'Report updated!',
                                text: 'The report was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to reports created",
                                cancelButtonText: "Continue editing",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "reports/created";
                                }else{
                                    location.reload();
                                }
                            }
                        );
                    }else{
                        swal(
                            {title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                            function(isConfirm) {
                                window.location.href = appURL + "reports/created";
                            }
                        )
                    }

                    unblockUISection("#form-edit-report");
                });
        }else{
            swal(
                {title: 'Oops...', text: 'Enter the required fields.', type: 'error'},
                function(isConfirm) {
                    window.location.href = appURL + "reports/created";
                }
            )
        }
    });

    if($('#table-reports').length){
        $("#table-reports").delegate(".delete-report", "click", function(){
            var report_id = $(this).attr("data-report");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this report!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel.!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            method: 'POST',
                            url: urlController+'deleteReport',
                            data: { report_id: report_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please a wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result.response == true){
                                    swal(
                                        {
                                            title: 'Report deleted!',
                                            text: 'The report was deleted successfully.',
                                            type: 'success'
                                        },
                                        function(isConfirm) {
                                            window.location.href = appURL + "reports/created";
                                        }
                                    );
                                }else{
                                    swal(
                                        {
                                            title: 'Oops...',
                                            text: 'Something went wrong.',
                                            type: 'error'
                                        },
                                        function(isConfirm) {
                                            window.location.href = appURL + "reports/created";
                                        }
                                    )
                                }

                                unblockUISection(".table-responsive");
                            });
                    } else {
                        swal("Cancelled", "Your report is safe.", "error");
                    }
                });
        });

        $('#table-reports').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[0, 'desc']]
        });
    }

    if($("#received-shelters-data-container").length){
        $.ajax({
            method: 'POST',
            url: urlDataChartController+'getDataChart/'+criteriaLabel+'-received-data-by-shelters-from-report-'+reportID,
            data: {  },
            beforeSend: function(){
                blockUISection("#received-shelters-data-container", "Generating animal data graph...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){

                    if(criteria == "all"){
                        criteriaLabel = "All Animals";
                    }

                    const dataSource = {
                        chart: {
                            caption: criteriaLabel.charAt(0).toUpperCase() + criteriaLabel.slice(1) + " Received By Shelters",
                            yaxisname: "Qty",
                            subcaption: fromYear+"-"+toYear,
                            showhovereffect: "1",
                            drawcrossline: "1",
                            showvalues: "0",
                            plottooltext: "<b>$dataValue</b> animals received in $seriesName",
                            theme: "fint",
                            exportEnabled: 1,
                            connectNullData: 1
                        },
                        categories: result.dataGraph.categories
                        ,
                        dataset:
                        result.dataGraph.dataset

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

                    getColumnsChartsByYear("received");
                }else{

                }
            });
    }

    $downloadPDF.click(function () {
        var $this = $(this);
        $(this).attr("disabled", "true");
        $.when(  blockUISection("#downloadPDF", "<small style='margin-left: -15px;'>Downloading...</small>") )
            .done(function( a1, a2 ) {
                var $PDFName = $this.attr("data-name")
                $(".no-show-pdf").hide();
                $("#logo-pdf").removeClass("d-none");
                CreatePDFfromHTML($PDFName, "#container-for-pdf");
            });
    });

    $regenerateCharts.click(function(){
        var reportID = $(this).attr("data-report");

        swal({
                title: "Are you sure you want to regenerate the charts?",
                text: "This action may take a few minutes!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, regenerate it!",
                cancelButtonText: "No, cancel.!",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        method: 'POST',
                        url: urlController+'generateChartsForReportCreated/'+reportID+'/json',
                        data: { },
                        beforeSend: function(){
                            //blockUISection(".main-content", "Regenerating charts, please a wait, this action may take a few minutes...");
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result.response == true){
                                swal({title: 'Successful regeneration.!', text: 'Charts are now up to date..', type: 'success'},
                                    function(isConfirm) { location.reload(); }
                                );
                            }else{
                                swal(
                                    {title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                                    function(isConfirm) {location.reload();}
                                );
                            }

                            //unblockUISection(".main-content");
                        });
                }else{
                    return false;
                }
            }
        ); //close swal
    });

    function getSheltersDataDetailsTable($hcriteria){
        if ( $("#table-shelters-details").length ) {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/shelters-data-table-'+$hcriteria+'-details-from-report-'+reportID,
                beforeSend: function(){
                    blockUISection($("#sr-shelters-table-details"), "Getting data...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        $("#table-shelters-details").append(result.dataGraph)

                        unblockUISection($("#sr-shelters-table-details"));
                    }else{
                        swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'});
                    }
                });
        }
    }

    function getColumnsChartsByYear($column = "all"){
        var animals = ['cats', 'dogs', 'other', 'all-pets', 'rabbits', 'dogs-&-cats'];

        if(criteria == "all"){
            var $hcriteria = "all";
            criteriaLabel = "All Animals";
        }else{
            $hcriteria = animals[criteria-1];
            criteriaLabel = $hcriteria.charAt(0).toUpperCase() + criteriaLabel.slice(1);
        }

        console.log("Getting "+$column+" data...");

        if($column == "received" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-received-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#received-animal-data-container", "Generating animal data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel.charAt(0).toUpperCase() + criteriaLabel.slice(1) + " Received Data" ,
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> animals $seriesName",
                                theme: "fint",
                                lineColor: "#19b159",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
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
                    } else {

                    }

                    getColumnsChartsByYear("returned");
                });
        }

        if($column == "returned" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-returned-data-by-year-from-report-'+reportID,
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
                                caption: criteriaLabel + " Returned Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#ebb348",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
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

                    getColumnsChartsByYear("placed");
                });
        }

        if($column == "placed" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-placed-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#placed-animal-data-container", "Generating animal data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Placed Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#4680ff",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
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
                    } else {

                    }

                    getColumnsChartsByYear("euthanized");
                });
        }

        if($column == "euthanized" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-euthanized-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#euthanized-animal-data-container", "Generating animal data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Euthanized Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#dc3545",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
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
                    } else {

                    }

                    getColumnsChartsByYear("transfered");
                });
        }

        if($column == "transfered" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-transfered-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#transfered-animal-data-container", "Generating animal data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Transfered Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#6c757d",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
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
                    } else {

                    }

                    getColumnsChartsByYear("transfered_in_within_area");
                });
        }

        if($column == "transfered_in_within_area" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-transfered-in-within-area-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#transfered-within-animal-data-container", "Generating data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Transfered In Within Area Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#559155",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
                            var myChart = new FusionCharts({
                                type: "spline",
                                renderAt: "transfered-within-animal-data",
                                width: "100%",
                                height: "100%",
                                dataFormat: "json",
                                dataSource
                            }).render();
                        });

                        unblockUISection("#transfered-within-animal-data-container");
                    } else {

                    }

                    getColumnsChartsByYear("transfered_in_outside_area");
                });
        }

        if($column == "transfered_in_outside_area" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-transfered-in-outside-area-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#transfered-outside-animal-data-container", "Generating data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Transfered In Outside Area Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#aa5555",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
                            var myChart = new FusionCharts({
                                type: "spline",
                                renderAt: "transfered-outside-animal-data",
                                width: "100%",
                                height: "100%",
                                dataFormat: "json",
                                dataSource
                            }).render();
                        });

                        unblockUISection("#transfered-outside-animal-data-container");
                    } else {

                    }

                    getColumnsChartsByYear("transfered_out");
                });
        }

        if($column == "transfered_out" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-transfered-out-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#transfered-out-animal-data-container", "Generating animal data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Transfered Out Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#6c757d",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
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
                    } else {

                    }

                    getColumnsChartsByYear("transfered_out_within_area");
                });
        }

        if($column == "transfered_out_within_area" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-transfered-out-within-area-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#transfered-out-within-animal-data-container", "Generating data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Transfered Out Within Area Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#553c00",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
                            var myChart = new FusionCharts({
                                type: "spline",
                                renderAt: "transfered-out-within-animal-data",
                                width: "100%",
                                height: "100%",
                                dataFormat: "json",
                                dataSource
                            }).render();
                        });

                        unblockUISection("#transfered-out-within-animal-data-container");
                    } else {

                    }

                    getColumnsChartsByYear("transfered_out_outside_area");
                });
        }

        if($column == "transfered_out_outside_area" || $column == "all") {
            $.ajax({
                method: 'POST',
                url: urlDataChartController+'getDataChart/'+$hcriteria+'-transfered-out-outside-area-data-by-year-from-report-'+reportID,
                data: {},
                beforeSend: function () {
                    blockUISection("#transfered-out-outside-animal-data-container", "Generating data graph...");
                }
            })
                .done(function (data) {
                    var result = JSON.parse(data);

                    if (result.response == true) {
                        const dataSource = {
                            chart: {
                                caption: criteriaLabel + " Transfered Out Outside Area Data",
                                yaxisname: "Qty",
                                subcaption: fromYear+"-"+toYear,
                                showhovereffect: "1",
                                drawcrossline: "1",
                                showvalues: "1",
                                plottooltext: "<b>$dataValue</b> Animals",
                                theme: "fint",
                                lineColor: "#550000",
                                exportEnabled: 1,
                                connectNullData: 1
                            },
                            data:
                            result.dataGraph
                        };

                        FusionCharts.ready(function () {
                            var myChart = new FusionCharts({
                                type: "spline",
                                renderAt: "transfered-out-outside-animal-data",
                                width: "100%",
                                height: "100%",
                                dataFormat: "json",
                                dataSource
                            }).render();
                        });

                        unblockUISection("#transfered-out-outside-animal-data-container");
                    } else {

                    }

                    getSheltersDataDetailsTable($hcriteria);
                });
        }
    }

    function getSheltersSelected(){
        var $container = document.getElementById("sortable2");
        var lis = $container.getElementsByTagName('li');
        var shelters = [];

        console.log(lis);
        for (var i = 0; i < lis.length; i++) {
            //button = div[i].getElementsByClassName("btn-shelter")[0];
            var id = lis[i].getAttribute("data-shelter");
            shelters.push(id);
        }

        return shelters.join();
    }

    function searchShelters() {
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

    //Create PDf from HTML...
    function CreatePDFfromHTML($PDFName, $container) {
        var HTML_Width = $($container).width();
        var HTML_Height = $($container).height();
        var top_left_margin = 30;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
        console.log("HTML_Width: "+ HTML_Width);
        console.log("HTML_Height: "+ HTML_Height);
        console.log("Total pages: "+ totalPDFPages);

        html2canvas($($container)[0], {scale: 2}).then(function (canvas) {
            console.log("Init html2canvaas process...")
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                console.log("Add page "+i+".");
            }

            console.log("Saving PDF...");

            $.when( pdf.save($PDFName+".pdf") ).done(function( a1, a2 ) {
                console.log("Saved pdf completed.");
                unblockUISection("#downloadPDF");
                $(".no-show-pdf").show();
                $("#logo-pdf").addClass("d-none");
                $("#downloadPDF").removeAttr("disabled");
            });

        });
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