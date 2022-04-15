$( document ).ready(function() {
    var urlController = appURL + "pages/";

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

    $("input[name=page_name]").focusout(function() {
       var page_name = $(this).val();
       var permalink = page_name.split(" ").join("-").toLowerCase();
       permalink = permalink.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
       $("input[name=permalink]").val(permalink);
    });

    $('.order-select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select an order',
        width: '100%'
    });

    $('.parent-page-select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select a parent page',
        width: '100%'
    });

    if ( $("#page-content").length ) {
        $('#page-content').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300
        });
    }

    $("#create-page").on("click", function(){
        var formData = $("#form-create-page").serialize();
        var pageName = $("input[name=page_name]").val();
        var permalink = $("input[name=permalink]").val();

        //$(this).removeClass("d-none").attr("disabled", true);

        if(pageName.length > 0 && permalink.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addPage',
                data: { data_page: formData },
                beforeSend: function(){
                    blockUISection("#form-create-page", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Page created!',
                                text: 'The page was created successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage pages",
                                cancelButtonText: "Create another",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "pages";
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
                                window.location.href = appURL + "pages";
                            }
                        )
                    }

                    unblockUISection("#form-create-page");
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

    $("#edit-page").on("click", function(){
        var formData = $("#form-edit-page").serialize();
        var page_id = $(this).attr("data-page");
        var pageName = $("input[name=page_name]").val();
        var permalink = $("input[name=permalink]").val();

        if(pageName.length > 0 && permalink.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updatePage',
                data: { data_page: formData, page_id: page_id },
                beforeSend: function(){
                    blockUISection("#form-edit-page", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Page updated!',
                                text: 'The page was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage pages",
                                cancelButtonText: "Continue editing",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "pages";
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

                    unblockUISection("#form-edit-page");
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

    if ( $("#table-pages").length ) {
        $("#table-pages").delegate(".delete-page", "click", function(){
            var page_id = $(this).attr("data-page");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this page!",
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
                            url: urlController+'deletePage',
                            data: { page_id: page_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result['response'] == true){
                                    swal(
                                        {
                                            title: 'Page deleted!',
                                            text: 'The page was deleted successfully.',
                                            type: 'success'
                                        },
                                        function(isConfirm) {
                                            window.location.href = appURL + "pages";
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
                                            window.location.href = appURL + "pages";
                                        }
                                    )
                                }

                                unblockUISection(".table-responsive");
                            });
                    } else {
                        swal("Cancelled", "Your page is safe.", "error");
                    }
                });
        });

        $('#table-pages').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[0, 'desc']]
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