$( document ).ready(function() {
    var urlController = appURL + "shelterBackups/";
    var sheltersUrlController = appURL + "shelters/";

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

    if ( $("#sidebar-programs").length ) {
        $('#sidebar-programs').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300,
            disable: true
        });

        $('#sidebar-programs').summernote("disable");
    }

    $('select[name=order], select[name=type-of-entry], select[name=open-door-shelter], select[name=type-shelter], select[name=designated-no-kill], select[name=importing-shelter], select[name=financials], select[name=shelter-data-available]').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select one',
        width: '100%'
    });

    $('select[name=state], select[name=county]').select2({
        placeholder: 'Select one',
        width: '100%'
    });

    $('#restore-backup').on('click', function(){
        var formData = $("#form-edit-shelter-backup").serialize();
        var backup_id = $(this).attr("data-backup");

        swal({
                title: "Confirm action",
                text: "Are you sure you want to restore this backup?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, restore!",
                cancelButtonText: "No, cancel.!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        method: 'POST',
                        url: urlController+'restore',
                        data: { backup_id: backup_id }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result['response'] == true){
                                swal(
                                    {
                                        title: 'Successful restore!',
                                        text: 'Backup was restored successfully. .',
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
                        });
                } else {
                    swal("Cancelled", "Backup has not been restored.", "error");
                }
            });
    });
})