$( document ).ready(function() {
    var urlController = appURL + "countries/";

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

    $('.order-select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select an order',
        width: '100%'
    });

    $("#create-country").on("click", function(){
        var formData = $("#form-create-country").serialize();
        var countryName = $("input[name=country-name]").val();
        var shortName = $("input[name=short-name]").val();

        if(countryName.length > 0 && shortName.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addCountry',
                data: { data_country: formData },
                beforeSend: function(){
                    blockUISection("#form-create-country", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Country created!',
                                text: 'The country was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage countries",
                                cancelButtonText: "Create another"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "countries";
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

                    unblockUISection("#form-create-country");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }


    });

    $("#edit-country").on("click", function(){
        var formData = $("#form-edit-country").serialize();
        var country_id = $(this).attr("data-country");
        var countryName = $("input[name=country-name]").val();
        var shortName = $("input[name=short-name]").val();

        if(countryName.length > 0 && shortName.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateCountry',
                data: { data_country: formData, country_id: country_id },
                beforeSend: function(){
                    blockUISection("#form-edit-country", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Country updated!',
                                text: 'The country was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage countries",
                                cancelButtonText: "Continue editing"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "countries";
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

                    unblockUISection("#form-edit-country");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }
    });

    if ( $("#table-countries").length ) {

        $("#table-countries").delegate(".delete-country", "click", function(){
            var country_id = $(this).attr("data-country");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this country!",
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
                            url: urlController+'deleteCountry',
                            data: { country_id: country_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result['response'] == true){
                                    swal(
                                        {
                                            title: 'Country deleted!',
                                            text: 'The country was deleted successfully.',
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

        $('#table-countries').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [0, 'DESC']
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