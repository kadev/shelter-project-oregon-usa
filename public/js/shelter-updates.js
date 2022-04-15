$( document ).ready(function() {
    var urlController = appURL + "shelterUpdates/";
    var sheltersUrlController = appURL + "shelters/";

    if($("#financial-section").length) {
        $("#financial-section").shelterFinancials();
    }

    if ( $("#sidebar-programs").length ) {
        $('#sidebar-programs').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300
        });

        if($("#form-edit-shelter-update").length){
            $('#sidebar-programs').summernote("disable");
        }
    }

    if ( $("#upload-shelter-image").length ) {

        $('#upload-shelter-image').FancyFileUpload({
            url : sheltersUrlController + 'uploadShelterImage',
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
            url : sheltersUrlController + 'uploadShelterImage',
            maxfilesize : 1000000,
            added : function(e, data) {
                this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
            },
            uploadcompleted : function(e, data) {
                $("input[name=shelter-logo]").val(data.jqXHR.responseJSON.filename);
                $(".shelter-logo-container").find(".ff_fileupload_dropzone_wrap").hide();
            }
        });

        $("#form-send-shelter-update, #form-edit-shelter-update").on('click', '.ff_fileupload_remove_file', function(){
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
                beforeSend: function (){
                    if($("#form-send-shelter-update").length){
                        blockUISection("#form-send-shelter-update", "Deleting image, please wait...");
                    }

                    if($("#form-edit-shelter-update").length){
                        blockUISection("#form-edit-shelter-update", "Deleting image, please wait...");
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

                    if($("#form-send-shelter-update").length){
                        unblockUISection("#form-send-shelter-update");
                    }

                    if($("#form-edit-shelter-update").length){
                        unblockUISection("#form-edit-shelter-update");
                    }
                });
        });
    }

    $(".remove-current-image").on("click", function(){
        var imageShelter = $("input[name=" + $(this).attr("data-input") + "]").val();
        var previewContainer = $($(this).attr("data-prev-container"));
        var uploaderContainer = $($(this).attr("data-upl-container"));
        var shelterID = $(this).attr("data-id");

        $("input[name=" + $(this).attr("data-input") + "]").val("");
        uploaderContainer.show();
        previewContainer.hide();
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

    $('select[name=order], select[name=type-of-entry], select[name=open-door-shelter], select[name=type-shelter], select[name=designated-no-kill], select[name=importing-shelter], select[name=financials], select[name=shelter-data-available]').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select one',
        width: '100%'
    });

    $('select[name=state], select[name=county]').select2({
        placeholder: 'Select one',
        width: '100%'
    });

    $('select[name=state]').on('select2:select', function (e) {
        var data = e.params.data;
        var countySelect = $('select[name=county]');

        $.ajax({
            method: 'POST',
            url: sheltersUrlController+'getCountiesByState', //getSheltersByState
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
                }else{
                    countySelect.attr("disabled", true);
                    countySelect.find("option").remove();
                }

                unblockUISection("#contact-info-container");
            });
    });

    $("#send-shelter-update").on("click", function(){
        var formData = $("#form-send-shelter-update").serialize();
        var shelter_id = $(this).attr("data-shelter");
        var shelterName = $("input[name=shelter-name]").val();

        if(shelterName.length > 0 ){
            $.ajax({
                method: 'POST',
                url: urlController+'store',
                data: { data_shelter: formData, shelter_id: shelter_id },
                beforeSend: function(){
                    blockUISection("#form-send-shelter-update", "Sending update, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Update sent!',
                                text: 'Shelter update successfully submitted for approval..',
                                type: 'success'
                            },
                            function(isConfirm) {
                                window.location.href = appURL + "shelters/updates";
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

                    unblockUISection("#form-send-shelter-update");
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

    $('#approve-update').on('click', function(){
        var update_id = $(this).attr("data-update");
        swal({
                title: "Are you sure you approve this update?",
                text: "The current shelter information will be superseded by the information in this update!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, approve!",
                cancelButtonText: "No, cancel.!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                //var formData = $("#form-edit-shelter-update").serialize();

                if (isConfirm) {
                    $.ajax({
                        method: 'POST',
                        url: urlController+'approveRequest',
                        data: { update_id: update_id },
                        beforeSend: function(){
                            blockUISection("#form-edit-shelter-update", "Approving update, please wait...");
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result['response'] == true){
                                swal(
                                    {
                                        title: 'Approved update !',
                                        text: 'Now the shelter already has the updated information.',
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

                            unblockUISection("#form-edit-shelter-update");
                        });
                } else {
                    swal("Cancelled", "The shelter has not been updated.", "error");
                }
            });
    });

    $('#decline-update').on('click', function(){
        var update_id = $(this).attr("data-update");
        swal({
                title: "Are you sure you decline this update?",
                text: "Shelter information will not be updated!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, approve!",
                cancelButtonText: "No, cancel.!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        method: 'POST',
                        url: urlController+'declineRequest',
                        data: { update_id: update_id },
                        beforeSend: function(){
                            blockUISection("#form-edit-shelter-update", "Declining update, please wait...");
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result['response'] == true){
                                swal(
                                    {
                                        title: 'Declined update !',
                                        text: 'The update has been successfully declined.',
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

                            unblockUISection("#form-edit-shelter-update");
                        });
                } else {
                    swal("Cancelled", "Declination canceled.", "error");
                }
            });
    });

    $('#update-request').on('click', function(){
        var formData = $("#form-edit-shelter-update").serialize();
        var update_id = $(this).attr("data-update");

        $.ajax({
            method: 'POST',
            url: urlController+'updateRequest',
            data: { data_update: formData, update_id: update_id },
            beforeSend: function(){
                blockUISection("#form-edit-shelter-update", "Updating data, please wait...");
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result['response'] == true){
                    swal(
                        {
                            title: 'Successful update!',
                            text: 'The request has been updated successfully.',
                            type: 'success'
                        },
                        function(isConfirm) {
                            $("#disabled-editing").click();
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

                unblockUISection("#form-edit-shelter-update");
            });
    });

    $('#enable-editing').on('click', function(){
        $("#approve-update").hide();
        $("#decline-update").hide();
        $("#disabled-editing").show();
        $("#update-request").show();
        $("#new-financial-file").show();
        $(".delete-financial-file").show();
        $(".edit-financial-file").show();
        $("#fancy-uploader-logo-container").removeClass("ff_fileupload_disabled");
        $("#fancy-uploader-image-container").removeClass("ff_fileupload_disabled");
        $('#sidebar-programs').summernote("enable");


        $(this).hide();

        $(".remove-current-image.edit-field").removeClass('d-none');
        $("input.edit-field").removeAttr('disabled');
        $("select.edit-field").removeAttr('disabled');
    });

    $('#disabled-editing').on('click', function(){
        $("#approve-update").show();
        $("#decline-update").show();
        $("#enable-editing").show();
        $("#update-request").hide();
        $("#new-financial-file").hide();
        $(".delete-financial-file").hide();
        $(".edit-financial-file").hide();
        $("#fancy-uploader-logo-container").addClass("ff_fileupload_disabled");
        $("#fancy-uploader-image-container").addClass("ff_fileupload_disabled");
        $('#sidebar-programs').summernote("disable");

        $(this).hide();

        $(".remove-current-image.edit-field").addClass('d-none');
        $("input.edit-field").attr('disabled', true);
        $("select.edit-field").attr('disabled', true);
    });

    if ( $("#shelter-updates").length ) {
        $('#shelter-updates').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[0, 'desc']]
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

    function checkStringIsNotEmpty(string){
        if(string.length == 0){
            return "-";
        }else{
            return string;
        }
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
})