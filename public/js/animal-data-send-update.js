$(function($) {
    $.fn.dataEditorPermissions = function( options ) {
        var urlController = appURL + "animalData/";
        var urlControllerUpdates = appURL + "animalDataUpdates/";

        var actions = {
            sendUpdate: $("#send-update"),
            sendCreateUpdate: $("#save-data"),
            updateRequest: $("#update-request"),
            changeRequestStatus: $(".change-status"),
            deleteRequest: $(".delete-request")
        }

        var buttons = {
            enableEditing: $("#enable-editing"),
            enableRequestEditing: $("#enable-request-editing"),
            disableEditing: $("#disable-editing"),
            enableEditComments: $("#enable-edit-comments"),
            disableEditComments: $("#disable-edit-comments")
        }

        var modals = {

        }

        var elements = {
            manageUpdatesTable: $("#manage-updates"),
            animalDataContainer: $("#animal-data-container"),
            formAnimalData: $("#form-animal-data"),
            shelterDetailsContainer: $("#shelter-details-container"),
            notFoundSheltersError: $("#no-shelters-found-message"),
            createData: $('.create-animal-data')
        }

        var inputs = { //Include: <input>, <textarea>, <select>, etc.
            states: ".states-select",
            shelter: "input[name=shelter_id]",
            shelters: ".shelters-select",
            years: "#filter-data-by-year",
            noData: "#no-data-checkbox",
            request: "input[name=request_id]"
        }

        // Initialize elements / inputs
        $(inputs.states).select2({placeholder: 'Select a state', width: '100%'});
        $(inputs.shelters).select2({placeholder: 'Select a shelter', width: '100%'});

        if ( $(inputs.years).is( "select" ) ) {
            $(inputs.years).select2({placeholder: 'Select a year', width: '100%'});
        }

        if ( elements.manageUpdatesTable.length ) {
            elements.manageUpdatesTable.DataTable({
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                order: [[0, 'asc']]
            });
        }

        $(inputs.states).on('select2:select', function (e){
            var data = e.params.data;
            var notFoundError = elements.notFoundSheltersError;

            elements.shelterDetailsContainer.hide();

            $.ajax({
                method: 'POST', url: urlController+'getSheltersByState',
                data: { data_id: data.id },
                beforeSend: function(){
                    blockSection($("#search-data-container"), "Getting data, please wait...")
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        var shelters = result.shelters;

                        $(inputs.shelters).find("option").remove();

                        var newOption = new Option("Choose one", "", false, false);
                        $(inputs.shelters).append(newOption).trigger('change');

                        shelters.forEach(function(shelter) {
                            var newOption = new Option(shelter.shelter_name, shelter.id, false, false);
                            $(inputs.shelters).append(newOption).trigger('change');
                        });

                        elements.notFoundSheltersError.hide();
                        $(inputs.shelters).removeAttr("disabled");
                    }else{
                        elements.notFoundSheltersError.show();
                        $(inputs.shelters).attr("disabled", true);
                        $(inputs.shelters).find("option").remove();
                    }

                    unblockSection($("#search-data-container"));
                });
        });

        $(inputs.shelters).on('select2:select', function (e){
            var data = e.params.data;
            location.href = urlController+"send-update/"+data.id;
        });

        $(inputs.years).on('select2:select', function (e){
            var data = e.params.data;
            var shelter = $(inputs.shelters).val();

            location.href = urlController+"send-update/"+shelter+"/"+data.id;
        });

        buttons.enableEditing.on('click', function(){
            var year = $(inputs.years).val();

            if(year != null){
                $(".i-animal-data").removeClass('d-none');
                $(".i-other-info").removeClass('d-none');
                $(".label-animal-data").addClass('d-none');
                $(".label-other-info").addClass('d-none');

                $(this).addClass('d-none');
                $("#disable-editing").removeClass('d-none');
                actions.updateRequest.removeClass('d-none');

                actions.sendUpdate.removeClass('d-none');
                $('.note-editor').show();
            }else{
                swal({title: 'Oops...', text: 'Select a year to continue', type: 'error'})
            }

        });

        buttons.enableRequestEditing.on('click', function(){
            var year = $(inputs.years).val();

            if(year != null){
                $(".i-animal-data").removeClass('d-none');
                $(".i-other-info").removeClass('d-none');
                $(".label-animal-data").addClass('d-none');
                $(".label-other-info").addClass('d-none');

                $(this).addClass('d-none');
                $("#disable-editing").removeClass('d-none');

                actions.sendUpdate.removeClass('d-none');
                $('.note-editor').show();
            }else{
                swal({title: 'Oops...', text: 'Select a year to continue', type: 'error'})
            }
        });

        buttons.disableEditing.on('click', function(){
            $(".i-animal-data").addClass('d-none');
            $(".label-animal-data").removeClass('d-none');
            $(".i-other-info").addClass('d-none');
            $(".label-other-info").removeClass('d-none');
            $(this).addClass('d-none');

            buttons.enableEditing.removeClass('d-none');
            actions.sendUpdate.addClass('d-none');
            actions.updateRequest.addClass('d-none');

            $('.note-editor').hide();

            $('.i-animal-data').each(function(i, obj) {
                var value = $(this).parent().find('.label-animal-data').text();
                $(this).val(value);
            });

            $('.i-other-info').each(function(i, obj) {
                var value = $(this).parent().find('.label-other-info').html();
                $(this).val(value);
            });
        });

        buttons.enableEditComments.on("click", function(){
            $("#disable-edit-comments").show();
            $("#update-comments").show();
            $(".label-comments").addClass("d-none");

            $('.note-editor').show().find(".btn").show();
            $(this).hide();
        });

        buttons.disableEditComments.on("click", function (){
            $(".comment-button").hide();
            $("#enable-edit-comments").show();
            $('.note-editor').hide();
            $(".label-comments").removeClass("d-none");
        });

        $(elements.createData).on("click", function(){
            $(".i-animal-data, .i-other-info").val("").removeClass("d-none");
            $(".label-animal-data").addClass("d-none");
            $(".label-other-info").addClass("d-none");
            $("#save-data").removeClass("d-none");
            $("#update-data").addClass("d-none");
            $('#animal-data-table').find('tbody tr').show();
            $('#animal-data-table').find('tfoot tr').show();
            $('#animal-data-table').find('tbody .message-error').hide();
            $("#enable-editing").addClass("d-none");
            $("#disable-editing").addClass("d-none");
            $('.note-editor').show();
            $("#notes").summernote('reset');

            unlockAnimalDataTable();
            changeTableMode("creation");
        });

        $(inputs.noData).on("click", function () {
            swal({
                    title: "Are you sure?",
                    text: "Confirm the action to continue",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, I'm sure!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        if ($(inputs.noData).is(':checked')) {
                            lockAnimalDataTable();
                        } else {
                            unlockAnimalDataTable();
                        }
                    }else{
                        if($(inputs.noData).is(':checked')){
                            $(inputs.noData).prop("checked", false);
                            $(".label-no-data-activated").hide();
                        }else{
                            $(inputs.noData).prop("checked", true);
                            $(".label-no-data-activated").show();
                        }
                    }
                });
        });

        actions.sendCreateUpdate.on("click", function(){
            var shelter_id = $(inputs.shelter).val();

            if(shelter_id.length != 0){
                var year = $(inputs.years).val();
                var noData = 0;

                if($(inputs.noData).is(':checked')) noData = 1;


                if(year != null && year.length != 0){
                    var data = elements.formAnimalData.serialize();

                    $.ajax({
                        method: 'POST',
                        url: urlControllerUpdates+'createAnimalDataByShelterIDAndYear',
                        data: { shelter: shelter_id, year: year, no_data: noData, data: data },
                        beforeSend: function(){
                            blockAnimalDataSection();
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result.response == true){
                                swal(
                                    {
                                        title: 'Your update has been sent',
                                        text: 'Now an administrator will verify your updates.',
                                        type: 'success',
                                        showCancelButton: true,
                                        confirmButtonText: "Go to manage updates",
                                        cancelButtonText: "Send another"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            window.location.href = urlController + "updates";
                                        }else{
                                            window.location.href = urlController + "send-update";
                                        }
                                    }
                                );
                            }else{
                                swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                                    function(isConfirm) {
                                        location.reload();
                                    }
                                )
                            }
                        });
                }else{
                    swal({title: 'Required field...', text: 'Please select a year to make the request.', type: 'warning'})
                }
            }else{
                swal({title: 'Required field...', text: 'An error occurred with the request, reload the page and try again.', type: 'error'},
                    function(isConfirm) {
                        location.reload();
                    }
                )
            }
        });

        actions.sendUpdate.on("click", function(){
            actions.sendCreateUpdate.click();
        });

        actions.updateRequest.on("click", function(){
            var request_id = $(inputs.request).val();
            var shelter_id = $(inputs.shelter).val();

            if(shelter_id.length != 0 && request_id.length != 0){
                var year = $(inputs.years).val();
                var noData = 0;

                if($(inputs.noData).is(':checked')) noData = 1;


                if(year != null && year.length != 0){
                    var data = elements.formAnimalData.serialize();

                    $.ajax({
                        method: 'POST',
                        url: urlControllerUpdates+'updateRequestAnimalDataRequest',
                        data: { request: request_id, shelter: shelter_id, year: year, no_data: noData, data: data },
                        beforeSend: function(){
                            blockAnimalDataSection();
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result.response == true){
                                swal(
                                    {
                                        title: 'The request has been updated successfully.',
                                        text: '',
                                        type: 'success',
                                        showCancelButton: true,
                                        confirmButtonText: "Accept",
                                        cancelButtonText: "Go to manage updates"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            location.reload();
                                        }else{
                                            window.location.href = urlController + "updates";
                                        }
                                    }
                                );
                            }else{
                                swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                                    function(isConfirm) {
                                        location.reload();
                                    }
                                )
                            }
                        });
                }else{
                    swal({title: 'Required field...', text: 'Please select a year to make the request.', type: 'warning'})
                }
            }else{
                swal({title: 'Required field...', text: 'An error occurred with the request, reload the page and try again.', type: 'error'},
                    function(isConfirm) {
                        location.reload();
                    }
                )
            }
        });

        actions.changeRequestStatus.on("click", function(){
           var request = $(inputs.request).val();
           var status = $(this).attr("data-status");
           var statusLabel = "";

           switch (status){
               case 'cancelled':
                   statusLabel = "cancel request";break;
               case 'declined':
                   statusLabel = "decline request";break;
               case 'approved':
                   statusLabel = "approve request";break;
               case 'pending':
                   statusLabel = "send again"; break;
           }

           if(request.length && status.length){
               swal({
                       title: "Are you sure?",
                       text: "You will not be able to undo this action later!",
                       type: "warning",
                       showCancelButton: true,
                       confirmButtonClass: "btn-danger",
                       confirmButtonText: "Yes, "+statusLabel+"!",
                       cancelButtonText: "No",
                       closeOnConfirm: false
                   },
                   function(isConfirm) {
                       if (isConfirm) {
                           $.ajax({
                               method: 'POST',
                               url: urlControllerUpdates+'changeRequestStatus',
                               data: { request: request, status: status },
                               beforeSend: function(){
                                   blockAnimalDataSection();
                               }
                           })
                               .done(function( data ) {
                                   var result = JSON.parse(data);

                                   if(result.response == true){
                                       swal(
                                           {
                                               title: 'The request has been '+status+' successfully.',
                                               text: '',
                                               type: 'success',
                                               showCancelButton: true,
                                               confirmButtonText: "Go to manage updates",
                                               cancelButtonText: "Ok"
                                           },
                                           function(isConfirm) {
                                               if (isConfirm) {
                                                   window.location.href = urlController + "updates";
                                               }else{
                                                   location.reload();
                                               }
                                           }
                                       );
                                   }else{
                                       somethingWentWrong();
                                   }
                               });
                       }
                   });
           }else{
               somethingWentWrong();
           }
        });

        actions.deleteRequest.on("click", function(){
           var request = $(this).attr("data-request");

           if(request.length){
               swal({
                       title: "Are you sure?",
                       text: "You will not be able to undo this action later!",
                       type: "warning",
                       showCancelButton: true,
                       confirmButtonClass: "btn-danger",
                       confirmButtonText: "Yes, delete it!",
                       cancelButtonText: "No",
                       closeOnConfirm: false
                   },
                   function(isConfirm) {
                       if (isConfirm) {
                           $.ajax({
                               method: 'POST',
                               url: urlControllerUpdates+'deleteRequest',
                               data: { request: request },
                               beforeSend: function(){

                               }
                           })
                               .done(function( data ) {
                                   var result = JSON.parse(data);

                                   if(result.response == true){
                                       swal(
                                           {
                                               title: 'The request has been successfully removed.',
                                               text: '',
                                               type: 'success',
                                               confirmButtonText: "Ok",
                                           },
                                           function(isConfirm) {
                                               if (isConfirm) {
                                                   location.reload();
                                               }
                                           }
                                       );
                                   }else{
                                       somethingWentWrong();
                                   }
                               });
                       }
                   });
           }else{
               somethingWentWrong();
           }
        });

        function blockSection(container, message){
            container.block({
                message: message,
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

        function unblockSection(container){
            container.unblock();
        }

        function blockAnimalDataSection(){

            elements.animalDataContainer.block({
                message: 'Getting data, please wait.',
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

            $(inputs.noData).attr("disabled", "true");
        }

        function lockAnimalDataTable(){
            var container = $("#animal-data-table");
            container.find("input[name!='no-data']").attr("readonly", "true");
            container.find("textarea").attr("readonly", "true");
            container.find("td").css("color", "gray");
            container.find("tr").css("background-color", "#f6f6ff");
            container.find(".btn").css("display", "none");
            $(".label-no-data-activated").show();

            //Added to activate the notes
            container.find("tr[data-block=false]").css("background-color", "#fff");
            container.find("tr[data-block=false] td").css("color", "inherit");
            container.find("#enable-edit-comments").show();
        }

        function unlockAnimalDataTable(){
            var container = $("#animal-data-table");
            container.find("td").css("color", "inherit");
            container.find("tr").css("background-color", "#fff");
            container.find("input[name!='no-data']").removeAttr("readonly");
            container.find("textarea").removeAttr("readonly");
            container.find("select").removeAttr("readonly");
            container.find(".btn").css("display", "inline-block");
            container.find(".comment-button").hide();
            $(".label-no-data-activated").hide();
        }

        function somethingWentWrong(){
            swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                function(isConfirm) {
                    location.reload();
                }
            )
        }

    };

    $("body").dataEditorPermissions();

}( jQuery ));