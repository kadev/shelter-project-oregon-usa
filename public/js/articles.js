$( document ).ready(function() {
    var urlController = appURL + "articles/";
    var filesController = appURL + "files/";

    if ( $("#upload-article-image").length ) {

        $('#upload-article-image').FancyFileUpload({
            url : urlController + 'uploadArticleImage',
            maxfilesize : 1000000,
            added : function(e, data) {
                // It is okay to simulate clicking the start upload button.
                this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
            },
            uploadcompleted : function(e, data) {
                $("input[name=article-image]").val(data.jqXHR.responseJSON.filename);
                $(".ff_fileupload_dropzone_wrap").hide();
            },
            uploaddestroy : function(e, data){
                alert("asdasd");
            }
        });

    }



    $("#form-create-article, #form-edit-article").on('click', '.ff_fileupload_remove_file', function(){
        var imageArticle = $("input[name=article-image]").val();
        var previewContainer = $(this);
        var uploaderContainer = $(".ff_fileupload_dropzone_wrap");

        $.ajax({
            method: 'POST',
            url: urlController+'removeImageArticle',
            data: { image_article: imageArticle },
            beforeSend: function(){
                if($("#form-create-article").length){
                    blockUISection("#form-create-article", "Deleting image, please wait...");
                }

                if($("#form-edit-article").length){
                    blockUISection("#form-edit-article", "Deleting image, please wait...");
                }
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    $("input[name=article-image]").val("")
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

                if($("#form-create-article").length){
                    unblockUISection("#form-create-article");
                }

                if($("#form-edit-article").length){
                    unblockUISection("#form-edit-article");
                }
            });

    });

    $("#remove-current-image").on("click", function(){
        var imageArticle = $("input[name=article-image]").val();
        var previewContainer = $("#container-preview-article-image");
        var uploaderContainer = $("#fancy-uploader-container");
        var articleID = $(this).attr("data-id");

        $.ajax({
            method: 'POST',
            url: urlController+'removeImageArticle',
            data: { image_article: imageArticle, article_id: articleID },
            beforeSend: function(){
                if($("#form-create-article").length){
                    blockUISection("#form-create-article", "Deleting image, please wait...");
                }

                if($("#form-edit-article").length){
                    blockUISection("#form-edit-article", "Deleting image, please wait...");
                }
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    $("input[name=article-image]").val("")
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

                if($("#form-create-article").length){
                    unblockUISection("#form-create-article");
                }

                if($("#form-edit-article").length){
                    unblockUISection("#form-edit-article");
                }
            });
    });

    /*$('input[name=article-image]').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'The file size is too big (2M max).'
        }
    }); */


    $('#article-published').on('click', function() {
        $(this).toggleClass('on');

        var input = $(this).attr('data-input');
        input = $('input[name='+ input + ']');

        if(input.val() == 1){
            input.val(0);
        }else{
            input.val(1);
        }
    });

    $("input[name=article-name]").focusout(function() {
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

    if ( $("#article-content-short").length ) {
        $('#article-content-short').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300
        });
    }

    if ( $("#article-content").length ) {
        $('#article-content').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300
        });
    }

    $("#create-article").on("click", function(){
        var formData = $("#form-create-article").serialize();
        var imageArticle = $("input[name=article-image]").val();
        var articleName = $("input[name=article-name]").val();
        var permalink = $("input[name=permalink]").val();

        if(articleName.length > 0 && permalink.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'addArticle',
                data: { data_article: formData },
                beforeSend: function() {
                    blockUISection("#form-create-article", "Saving data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Article created!',
                                text: 'The article was created successfully.',
                                type: 'success',showCancelButton: true,
                                confirmButtonText: "Go to manage articles",
                                cancelButtonText: "Create another",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "articles";
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
                                window.location.href = appURL + "articles";
                            }
                        )
                    }

                    unblockUISection("#form-create-article");
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

    $("#edit-article").on("click", function(){
        var formData = $("#form-edit-article").serialize();
        var article_id = $(this).attr("data-article");
        var articleName = $("input[name=article-name]").val();
        var permalink = $("input[name=permalink]").val();

        if(articleName.length > 0 && permalink.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateArticle',
                data: { data_article: formData, article_id: article_id },
                beforeSend: function(){
                    blockUISection("#form-edit-article", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Article updated!',
                                text: 'The article was updated successfully.',
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: "Go to manage articles",
                                cancelButtonText: "Continue editing",
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.href = appURL + "articles";
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

                    unblockUISection("#form-edit-article");
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

    if ( $("#table-articles").length ) {
        $("#table-articles").delegate(".delete-article", "click", function(){
            var article_id = $(this).attr("data-article");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this article!",
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
                            url: urlController+'deleteArticle',
                            data: { article_id: article_id },
                            beforeSend: function(){
                                blockUISection(".table-responsive", "Deleting data, please wait...");
                            }
                        })
                            .done(function( data ) {
                                var result = JSON.parse(data);

                                if(result['response'] == true){
                                    swal(
                                        {
                                            title: 'Article deleted!',
                                            text: 'The article was deleted successfully.',
                                            type: 'success'
                                        },
                                        function(isConfirm) {
                                            window.location.href = appURL + "articles";
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
                        swal("Cancelled", "Your article is safe.", "error");
                    }
                });
        });

        $('#table-articles').DataTable({
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