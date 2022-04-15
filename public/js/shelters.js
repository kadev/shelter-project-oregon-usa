$( document ).ready(function() {
    var urlController = appURL + "shelters/";
    var urlRescuesController = appURL + "rescues/";

    if($("#financial-section").length) {
        $("#financial-section").shelterFinancials();
    }

    if ( $("#sidebar-programs").length ) {
        $('#sidebar-programs').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300
        });
    }

    if ( $("#upload-shelter-image").length ) {

        $('#upload-shelter-image').FancyFileUpload({
            url : urlController + 'uploadShelterImage',
            maxfilesize : 1000000,
            added : function(e, data) {
                this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
            },
            uploadcompleted : function(e, data) {
                $("input[name=shelter-image]").val(data.jqXHR.responseJSON.filename);
                $(".shelter-image-container").find(".ff_fileupload_dropzone_wrap").hide();
            }
        });

        $('#upload-shelter-logo').FancyFileUpload({
            url : urlController + 'uploadShelterImage',
            maxfilesize : 1000000,
            added : function(e, data) {
                this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
            },
            uploadcompleted : function(e, data) {
                $("input[name=shelter-logo]").val(data.jqXHR.responseJSON.filename);
                $(".shelter-logo-container").find(".ff_fileupload_dropzone_wrap").hide();
            }
        });

        $("#form-create-shelter, #form-edit-shelter").on('click', '.ff_fileupload_remove_file', function(){
            var container = $(this).parents(".c-upl-image");
            var inputUpload = container[Object.keys(container)[0]];
            inputUpload = inputUpload.getAttribute('data-input');
            var imageShelter = $("input[name=" + inputUpload + "]").val();
            var previewContainer = $(this);
            var uploaderContainer = container.find(".ff_fileupload_dropzone_wrap");

            if(imageShelter.length <= 0){
                return 0;
            }

            $.ajax({
                method: 'POST',
                url: urlController+'removeImageShelter',
                data: { image_shelter: imageShelter },
                beforeSend: function(){
                    if($("#form-create-shelter").length){
                        blockUISection("#form-create-shelter", "Deleting image, please wait...");
                    }

                    if($("#form-edit-shelter").length){
                        blockUISection("#form-edit-shelter", "Deleting image, please wait...");
                    }
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        $("input[name=shelter-image]").val("")
                        uploaderContainer.show();
                        previewContainer.parent().parent().remove();
                    }else{
                        swal(
                            {
                                title: 'Oops...',
                                text: 'Something went wrong.',
                                type: 'error'
                            },
                            function(isConfirm) {
                                location.reload();
                            }
                        )
                    }

                    if($("#form-create-shelter").length){
                        unblockUISection("#form-create-shelter");
                    }

                    if($("#form-edit-shelter").length){
                        unblockUISection("#form-edit-shelter");
                    }
                });
        });
    }

    $(".remove-current-image").on("click", function(){
        var imageShelter = $("input[name=" + $(this).attr("data-input") + "]").val();
        var previewContainer = $($(this).attr("data-prev-container"));
        var uploaderContainer = $($(this).attr("data-upl-container"));
        var shelterID = $(this).attr("data-id");

        $.ajax({
            method: 'POST',
            url: urlController+'removeImageShelter',
            data: { image_shelter: imageShelter, shelter_id: shelterID },
            beforeSend: function(){
                if($("#form-create-shelter").length){
                    blockUISection("#form-create-shelter", "Deleting image, please wait...");
                }

                if($("#form-edit-shelter").length){
                    blockUISection("#form-edit-shelter", "Deleting image, please wait...");
                }
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    $("input[name=" + $(this).attr("data-input") + "]").val("")
                    uploaderContainer.show();
                    previewContainer.hide();
                }else{
                    swal(
                        {
                            title: 'Oops...',
                            text: 'Something went wrong.',
                            type: 'error'
                        },
                        function(isConfirm) {
                        }
                    )
                }

                if($("#form-create-shelter").length){
                    unblockUISection("#form-create-shelter");
                }

                if($("#form-edit-shelter").length){
                    unblockUISection("#form-edit-shelter");
                }
            });
    });


    $('#shelter-published').on('click', function() {
        $(this).toggleClass('on');

        var input = $(this).attr('data-input');
        input = $('input[name='+ input + ']');

        if(input.val() == 1){
            input.val(0);
        }else{
            input.val(1);
        }
    });

    $('select[name=order], select[name=type-of-entry], select[name=open-door-shelter]').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select one',
        width: '100%'
    });

    $('select[name=state], select[name=county]').select2({
        placeholder: 'Select one',
        width: '100%',
        matcher: function(params, data) {
            params.term = params.term || '';
            if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                return data;
            }
            return false;
        }
    });

    $('select[name=state]').on('select2:select', function (e) {
        var data = e.params.data;
        var countySelect = $('select[name=county]');

        $.ajax({
            method: 'POST',
            url: urlController+'getCountiesByState', //getSheltersByState
            data: { data_id: data.id },
            beforeSend: function(){
                blockUISection("#contact-info-container", "Getting counties...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    var counties = result.counties;

                    countySelect.find("option").remove();

                    var newOption = new Option("Choose one", "", false, false);
                    countySelect.append(newOption).trigger('change');

                    counties.forEach(function(county) {
                        var newOption = new Option(county.Name, county.Name, false, false);
                        countySelect.append(newOption).trigger('change');
                    });

                    countySelect.removeAttr("disabled");
                    unblockUISection("#contact-info-container");
                }else{
                    countySelect.attr("disabled", true);
                    countySelect.find("option").remove();
                }
            });
    });

    $('select[name=type-shelter], select[name=designated-no-kill], select[name=importing-shelter], select[name=financials]').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select one',
        width: '100%'
    });

    var statesSelect = $('.states-select');
    var shelterSelect = $('.shelters-select');

    statesSelect.select2({placeholder: 'Select a state', width: '100%'});

    statesSelect.on('select2:select', function (e) {
        var data = e.params.data;
        var shelterSelect = $('.shelters-select');

        $.ajax({
            method: 'POST',
            url: urlController+'getSheltersByState',
            data: { data_id: data.id },
            beforeSend: function(){
                blockUISection(".custom-card", "Getting data, please wait...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    var shelters = result.shelters;

                    shelterSelect.find("option").remove();

                    var newOption = new Option("Choose one", "", false, false);
                    shelterSelect.append(newOption).trigger('change');

                    shelters.forEach(function(shelter) {
                        var newOption = new Option(shelter.shelter_name, shelter.id, false, false);
                        shelterSelect.append(newOption).trigger('change');
                    });

                    shelterSelect.removeAttr("disabled");
                }else{
                    shelterSelect.attr("disabled", true);
                    shelterSelect.find("option").remove();
                }

                unblockUISection(".custom-card");
            });
    });

    shelterSelect.select2({
        placeholder: 'Select one shelter',
        width: '100%'
    });

    shelterSelect.on('select2:select', function (e) {
        var data = e.params.data;

        window.location.href = urlController + "report/" + data.id;
    });

    /* This function may no longer be used */
    $('.show-shelter-report').on('click', function () {
        var shelter_id = $(this).attr('data-shelter');
        //var shelterSelect = $('.shelters-select');

        $.ajax({
            method: 'POST',
            url: urlController+'getShelterReport',
            data: { data_id: shelter_id }
        })
            .done(function( data ) {
                var result = JSON.parse(data);
                var shelterReportContainer = $("#shelter-report-container");

                if(result.response == true){
                    $('.states-select').val(null).trigger('change');
                    $('.shelters-select').val(null).trigger('change');

                    shelterReportContainer.removeClass("d-none");
                    $('#shelters-modal').modal('hide');
                }else{
                    animalData = null;
                    shelterReportContainer.find("card-text").text("-");
                    shelterReportContainer.hide();
                }
            });
    });

    $("#create-shelter").on("click", function(){
        var formData = $("#form-create-shelter").serialize();
        var shelterName = $("input[name=shelter-name]").val();
        var origin = $(this).attr("data-origin");

        if(origin == "rescues"){
            var label = "Rescue";
        }else{
            var label = "Shelter";
        }

        if(shelterName.length > 0 ){
            $.ajax({
                method: 'POST',
                url: urlController+'addShelter',
                data: { data_shelter: formData },
                beforeSend: function(){
                    blockUISection("#form-create-shelter", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: label + ' created!',
                                text: 'The ' + label.toLowerCase() + ' was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage " + origin,
                                cancelButtonText: "Create another"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + origin;
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

                            }
                        )
                    }

                    unblockUISection("#form-create-shelter")
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }


    });

    $("#edit-shelter").on("click", function(){
        var formData = $("#form-edit-shelter").serialize();
        var shelter_id = $(this).attr("data-shelter");
        var shelterName = $("input[name=shelter-name]").val();
        var origin = $(this).attr("data-origin");

        if(origin == "rescues"){
            var label = "Rescue";
        }else{
            var label = "Shelter";
        }

        if(shelterName.length > 0 ){
            $.ajax({
                method: 'POST',
                url: urlController+'updateShelter',
                data: { data_shelter: formData, shelter_id: shelter_id },
                beforeSend: function(){
                    blockUISection("#form-edit-shelter", "Updating data, please wait...")
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: label + ' updated!',
                                text: 'The ' + label + ' was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage " +  origin,
                                cancelButtonText: "Continue editing",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + origin;
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

                            }
                        )
                    }

                    unblockUISection("#form-edit-shelter");
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

    $("#table-shelters, #table-rescues").delegate(".delete-shelter", "click", function(){
        var shelter_id = $(this).attr("data-shelter");
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this shelter!",
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
                        url: urlController+'deleteShelter',
                        data: { shelter_id: shelter_id },
                        beforeSend: function(){
                            blockUISection(".table-responsive", "Deleting data, please wait...");
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result['response'] == true){
                                swal(
                                    {
                                        title: 'Shelter deleted!',
                                        text: 'The shelter was deleted successfully.',
                                        type: 'success'
                                    },
                                    function(isConfirm) {
                                        location.reload();
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

                                    }
                                )
                            }

                            unblockUISection(".table-responsive");
                        });
                } else {
                    swal("Cancelled", "Your shelter is safe.", "error");
                }
            });
    });

    if ( $("#table-shelters-report").length ) {
        $('#table-shelters-report').DataTable({
            "ajax": urlController + "getSheltersForSearch",
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[0, 'asc']],
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ]
        });
    }

    if ( $("#table-shelters").length ) {
        $('#table-shelters').DataTable({
            "ajax": urlController + "getSheltersData",
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[1, 'asc']],
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ]
        });
    }

    if ( $("#table-rescues").length ) {
        $('#table-rescues').DataTable({
            "ajax": urlRescuesController + "getRescuesData",
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[1, 'asc']],
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ]
        });
    }

    if ( $('#shelter-report-table').length ) {
        $('#shelter-report-table').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            "paging":   false,
            "ordering": false,
            "info":     false,
            "searching": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    }

    $("input[name=address-unknown]").on("change", function () {

        var container = $("#contact-info-container");

        if($(this).is(':checked')){
            container.find("input[name!='address-unknown']").attr("readonly", "true").val("");
            container.find("select").attr("readonly", "true").val(null).change();
            container.find("label").css("color", "gray");
            container.css("background-color", "#f6f6ff");
            $(this).removeAttr("readonly");
        }else{
            container.find("label").css("color", "#1d212f");
            container.css("background-color", "#fff");
            container.find("input[name!='address-unknown']").removeAttr("readonly");
            container.find("select").removeAttr("readonly");
        }

    });

function fillShelterData(shelterData){
    $("input[name=shelter_id]").val(shelterData.id);
    $("#shelter-name").text(checkStringIsNotEmpty(shelterData.shelter_name));
    $("#shelter-state").text(checkStringIsNotEmpty(shelterData.state_name));
    $("#shelter-address").text(checkStringIsNotEmpty(shelterData.street_address));
    $("#shelter-phone").text(checkStringIsNotEmpty(shelterData.phone_numner));
    $("#shelter-website").text(checkStringIsNotEmpty(shelterData.website));
    $("#shelter-website").attr("href",checkStringIsNotEmpty(shelterData.website));
}

function fillShelterReportData(reportData){

    console.log(reportData);

    reportData.forEach(function(e) {
        var animalData = e.data;

        animalData.forEach(function(d) {
            $("tr[data-animal="+d.animal_id+"]").after("<tr class='report-data'>"+
                "<td>"+d.year+"</td>"+
                "<td>"+d.received+"</td>"+
                "<td>"+d.returned+"</td>"+
                "<td>"+d.placed+"</td>"+
                "<td>"+d.euthanized+"</td>"+
                "<td>"+d.transfered+"</td>"+
                "<td>"+d.transfered_in_within_area+"</td>"+
                "<td>"+d.transfered_in_outside_area+"</td>"+
                "<td>"+d.transfered_out+"</td>"+
                "<td>"+d.transfered_out_within_area+"</td>"+
                "<td>"+d.transfered_out_outside_area+"</td>"+
                "</tr>");
        });
    });
}

function reinitializeReportTable(){
    var table = $('#shelter-report-table');

    table.DataTable().destroy();

    table.DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        },
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
}

    function blockUISection($section, $message = null){
        var container = $($section);
        if($message == null) $message = "Loading, please wait...";

        container.block({
            message: $message,
            overlayCSS: {
                backgroundColor: '#e9ecf6',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#000',
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    }

    function unblockUISection($section){
        var container = $($section);
        container.unblock();
    }

function checkStringIsNotEmpty(string){
    if(string.length == 0){
        return "-";
    }else{
        return string;
    }
}
})