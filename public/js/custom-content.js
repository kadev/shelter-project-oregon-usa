$( document ).ready(function() {
    var urlController = appURL + "customContent/";

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

    $("input[name=name]").focusout(function() {
        var name = $(this).val();
        var permalink = name.split(" ").join("-").toLowerCase();
        permalink = permalink.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        $("input[name=permalink]").val(permalink);
    });

    if($('.order-select').length){
        $('.order-select').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Select an order',
            width: '100%'
        });
    }

    if($('.parent-page-select').length){
        $('.parent-page-select').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Select a parent page',
            width: '100%'
        });
    }

    if($('#content').length){
        $('#content').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300
        });
    }

    $("#create-custom-content").on("click", function(){
        var formData = $("#form-create-custom-content").serialize();
        var name = $("input[name=name]").val();
        var permalink = $("input[name=permalink]").val();

        //$(this).removeClass("d-none").attr("disabled", true);

        if(name.length > 0 && permalink.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addCustomContent',
                data: { data_custom_content: formData },
                beforeSend: function(){
                    blockUISection("#form-create-custom-content", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        swal(
                            {
                                title: 'Custom content created!',
                                text: 'The custom content was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage custom content",
                                cancelButtonText: "Create another"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "customContent";
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
                                window.location.href = appURL + "customContent";
                            }
                        )
                    }

                    unblockUISection("#form-create-custom-content");
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

    $("#edit-custom-content").on("click", function(){
        var formData = $("#form-edit-custom-content").serialize();
        var custom_content_id = $(this).attr("data-content");
        var name = $("input[name=name]").val();
        var permalink = $("input[name=permalink]").val();

        if(name.length > 0 && permalink.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateCustomContent',
                data: { data_custom_content: formData, custom_content_id: custom_content_id },
                beforeSend: function(){
                    blockUISection("#form-edit-custom-content", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        swal(
                            {
                                title: 'Custom Content updated!',
                                text: 'The Custom Content was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage custom content",
                                cancelButtonText: "Continue editing"
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "customContent";
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

                    unblockUISection("#form-edit-custom-content");
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

    if ( $("#table-custom-content").length ) {
        $("#table-custom-content").delegate(".delete-content", "click", function(){
            var custom_content_id = $(this).attr("data-content");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this custom content!",
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
                            url: urlController+'deleteCustomContent',
                            data: { custom_content_id: custom_content_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result.response == true){
                                    swal(
                                        {
                                            title: 'Custom content deleted!',
                                            text: 'The custom content was deleted successfully.',
                                            type: 'success'
                                        },
                                        function(isConfirm) {
                                            window.location.href = appURL + "customContent";
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
                                            window.location.href = appURL + "customContent";
                                        }
                                    )
                                }

                                unblockUISection(".table-responsive");
                            });
                    } else {
                        swal("Cancelled", "Your custom content is safe.", "error");
                    }
                });
        });

        $('#table-custom-content').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
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