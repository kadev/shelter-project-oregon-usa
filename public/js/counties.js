$( document ).ready(function() {
    var urlController = appURL + "counties/";

    $('#country-published').on('click', function() {
        $(this).toggleClass('on');

        var input = $(this).attr('data-input');
        input = $('input[name='+ input + ']');

        if(input.val() == 1){
            input.val(0);
        }else{
            input.val(1);
        }
    });

    $('#select-state').select2({
        placeholder: 'Select an order',
        width: '100%'
    });

    $("#create-county").on("click", function(){
        var formData = $("#form-create-county").serialize();
        var countyName = $("input[name=name]").val();
        var state = $("select[name=state-id]").val();

        if(countyName.length > 0 && state.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addCounty',
                data: { data_county: formData },
                beforeSend: function(){
                    blockUISection("#form-create-county", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'County created!',
                                text: 'The county was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage counties",
                                cancelButtonText: "Create another"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "counties";
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

                    unblockUISection("#form-create-county");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }


    });

    $("#edit-county").on("click", function(){
        var formData = $("#form-edit-county").serialize();
        var county_id = $(this).attr("data-county");
        var countyName = $("input[name=name]").val();
        var state = $("select[name=state-id]").val();

        if(countyName.length > 0 && state.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateCounty',
                data: { data_county: formData, county_id: county_id },
                beforeSend: function(){
                    blockUISection("#form-edit-county", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'County updated!',
                                text: 'The county was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage counties",
                                cancelButtonText: "Continue editing"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "counties";
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

                    unblockUISection("#form-edit-county");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }
    });

    if ( $("#table-counties").length ) {

        $("#table-counties").delegate(".delete-county", "click", function(){
            var county_id = $(this).attr("data-county");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this county!",
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
                            url: urlController+'deleteCounty',
                            data: { county_id: county_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result['response'] == true){
                                    swal(
                                        {
                                            title: 'County deleted!',
                                            text: 'The county was deleted successfully.',
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
                        swal("Cancelled", "Your country is safe.", "error");
                    }
                });
        });

        $('#table-counties').DataTable({
            "ajax": urlController + "getCountiesData",
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[0, 'asc']],
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