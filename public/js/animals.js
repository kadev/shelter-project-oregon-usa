$( document ).ready(function() {
    var urlController = appURL + "animals/";

    $('#animal-published').on('click', function() {
        $(this).toggleClass('on');

        var input = $(this).attr('data-input');
        input = $('input[name='+ input + ']');

        if(input.val() == 1){
            input.val(0);
        }else{
            input.val(1);
        }
    });

    $('.order-select, .country-select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select one',
        width: '100%'
    });

    $("#create-animal").on("click", function(){
        var formData = $("#form-create-animal").serialize();
        var animalName = $("input[name=animal-name]").val();

        if(animalName.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addAnimal',
                data: { data_animal: formData },
                beforeSend: function(){
                    blockUISection("#form-create-animal", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Animal created!',
                                text: 'The animal was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage animals",
                                cancelButtonText: "Create another"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "animals";
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

                    unblockUISection("#form-create-animal");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }
    });

    $("#edit-animal").on("click", function(){
        var formData = $("#form-edit-animal").serialize();
        var animal_id = $(this).attr("data-animal");
        var animalName = $("#form-edit-animal").find("input[name=animal-name]").val();

        if(animalName.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateAnimal',
                data: { data_animal: formData, animal_id: animal_id },
                beforeSend: function(){
                    blockUISection("#form-edit-animal", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Animal updated!',
                                text: 'The animal was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage animals",
                                cancelButtonText: "Continue editing"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "animals";
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

                    unblockUISection("#form-edit-animal");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'});
        }
    });

    if ( $("#table-animals").length ) {

        $("#table-animals").delegate(".delete-animal", "click", function(){
            var animal_id = $(this).attr("data-animal");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this animal!",
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
                            url: urlController+'deleteAnimal',
                            data: { animal_id: animal_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result['response'] == true){
                                    swal(
                                        {
                                            title: 'Animal deleted!',
                                            text: 'The animal was deleted successfully.',
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
                        swal("Cancelled", "Your animal is safe.", "error");
                    }
                });
        });

        $('#table-animals').DataTable({
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