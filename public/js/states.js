$( document ).ready(function() {
    var urlController = appURL + "states/";

    $('#state-published').on('click', function() {
        $(this).toggleClass('on');

        var input = $(this).attr('data-input');
        input = $('input[name='+ input + ']');

        if(input.val() == 1){
            input.val(0);
        }else{
            input.val(1);
        }
    });

    $('.order-select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select an order',
        width: '100%'
    });

    $("#create-state").on("click", function(){
        var formData = $("#form-create-state").serialize();
        var stateName = $("input[name=state-name]").val();
        var shortName = $("input[name=short-name]").val();

        if(stateName.length > 0 && shortName.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addState',
                data: { data_state: formData },
                beforeSend: function(){
                    blockUISection("#form-create-state", "Saving data, please wait...")
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'State created!',
                                text: 'The state was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage states",
                                cancelButtonText: "Create another"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "states";
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

                    unblockUISection("#form-create-state");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }


    });

    $("#edit-state").on("click", function(){
        var formData = $("#form-edit-state").serialize();
        var state_id = $(this).attr("data-state");
        var stateName = $("input[name=state-name]").val();
        var shortName = $("input[name=short-name]").val();

        if(stateName.length > 0 && shortName.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateState',
                data: { data_state: formData, state_id: state_id },
                beforeSend: function(){
                    blockUISection("#form-edit-state", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'State updated!',
                                text: 'The state was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage states",
                                cancelButtonText: "Continue editing"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "states";
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

                    unblockUISection("#form-edit-state");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }
    });

    if ( $("#table-states").length ) {

        $("#table-states").delegate(".delete-state", "click", function(){
            var state_id = $(this).attr("data-state");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this state!",
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
                            url: urlController+'deleteState',
                            data: { state_id: state_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result['response'] == true){
                                    swal(
                                        {
                                            title: 'State deleted!',
                                            text: 'The state was deleted successfully.',
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
                        swal("Cancelled", "Your state is safe.", "error");
                    }
                });
        });

        $('#table-states').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [1, 'asc']
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

})