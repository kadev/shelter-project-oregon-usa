$( document ).ready(function() {
    var urlController = appURL + "users/";

    cleanInputsForAutocomplete();

    if($("#data-editor-section").length) {
        console.log("Initializing permissions section...");
        $("#data-editor-section").dataEditorPermissions();
    }

    $('.privilege-select').select2({
        placeholder: 'Select one shelter',
        width: '250px'
    });

    $('.states-select').select2({
        placeholder: 'Select state'
    });

    $('.years-select').select2({
        placeholder: 'Select year(s)'
    });

    $('.privilege-select').on('select2:select', function (e) {
        var data = e.params.data;
        var dataEditorFields = $("#data-editor-section");

        if(data.id == 4){
            dataEditorFields.show();
        }else{
            $('.states-select').val(null).trigger('change');
            dataEditorFields.hide();
        }
    });

    $("#create-user").on("click", function(){
        var formData = $("#form-create-user").serialize();
        var firstName = $("input[name=first-name]").val();
        var lastName = $("input[name=last-name]").val();
        var email = $("input[name=email]").val();
        var c_email = $("input[name=confirm-email]").val();
        var pass = $("input[name=password]").val();
        var c_pass = $("input[name=confirm-password]").val();

        if(firstName.length > 0 && lastName.length > 0 && email.length > 0 && c_email.length > 0 && pass.length > 0 && c_pass.length > 0){
            if(email == c_email){
                if(pass == c_pass){
                    $.ajax({
                        method: 'POST',
                        url: urlController+'addUser',
                        data: { data_user: formData },
                        beforeSend: function(){
                            blockUISection("#form-create-user", "Saving data, please wait...");
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result['response'] == true){
                                swal(
                                    {
                                        title: 'User created!',
                                        text: 'The user was created successfully.',
                                        type: 'success',
                                        showCancelButton: true,
                                        confirmButtonText: "Go to manage users",
                                        cancelButtonText: "Create another"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            window.location.href = appURL + "users";
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

                            unblockUISection("#form-create-user");
                        });
                }else{
                    swal({ title: 'Incorrect fields...', text: 'The passwords entered do not match.', type: 'error' })
                }
            }else{
                swal({ title: 'Incorrect fields...', text: 'The emails entered do not match.', type: 'error' })
            }
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'})
        }
    });

    $("#edit-user").on("click", function(){
        var formData = $("#form-edit-user").serialize();
        var user_id = $(this).attr("data-user");
        var email = $("input[name=email]").val();
        var c_email = $("input[name=confirm-email]").val();
        var firstName = $("input[name=first-name]").val();
        var lastName = $("input[name=last-name]").val();

        if(firstName.length > 0 && lastName.length > 0 && email.length > 0 && c_email.length > 0){
            if(email == c_email){
                $.ajax({
                    method: 'POST',
                    url: urlController+'updateUser',
                    data: { data_user: formData, user_id: user_id },
                    beforeSend: function(){
                        blockUISection("#form-edit-user", "Updating data, please wait...")
                    }
                })
                    .done(function( data ) {
                        var result = JSON.parse(data);

                        if(result['response'] == true){
                            swal(
                                {
                                    title: 'User updated!',
                                    text: 'The User was updated successfully.',
                                    type: 'success',
                                    showCancelButton: true,
                                    confirmButtonText: "Go to manage users",
                                    cancelButtonText: "Continue editing"
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.href = appURL + "users";
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

                        unblockUISection("#form-edit-user");
                    });
            }else{
                swal({ title: 'Incorrect fields...', text: 'The emails entered do not match.', type: 'error' })
            }
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'})
        }
    });

    $("#update-profile").on("click", function(){
        var formData = $("#form-update-profile").serialize();
        var firstName = $("input[name=firstname]").val();
        var lastName = $("input[name=lastname]").val();
        var email = $("input[name=email]").val();
        var username = $("input[name=username]").val();

        if(firstName.length > 0 && lastName.length > 0 && email.length > 0 && username.length > 0){
            $.ajax({
                method: 'POST',
                url: urlController+'updateProfile',
                data: { data_profile: formData },
                beforeSend: function(){
                    blockUISection("#form-update-profile", "Updating data, please wait...");
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result['response'] == true){
                        swal(
                            {
                                title: 'Profile updated!',
                                text: 'Your profile was updated successfully.',
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

                    unblockUISection("#form-update-profile");
                });
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'})
        }
    });

    $("#change-profile-password").on("click", function(){
        var formData = $("#form-change-password").serialize();
        var password = $("input[name=password]");
        var newPassword = $("input[name=new-password]");
        var confirmNewPassword = $("input[name=confirm-new-password]");

        if(password.length > 0 && newPassword.length > 0 && confirmNewPassword.length > 0){
            if(newPassword.val() == confirmNewPassword.val()) {
                $.ajax({
                    method: 'POST',
                    url: urlController+'changePassword',
                    data: { data_password: formData },
                    beforeSend: function(){
                        blockUISection("#form-change-password", "Updating data, please wait...");
                    }
                })
                    .done(function( data ) {
                        var result = JSON.parse(data);

                        if(result.response == true){
                            swal(
                                {
                                    title: 'Updated password!',
                                    text: 'The password has been updated successfully.',
                                    type: 'success'
                                },
                                function(isConfirm) {
                                    $("input[name=password]").val('');
                                    newPassword.val('');
                                    confirmNewPassword.val('');
                                }
                            );
                        }else{
                            swal(
                                {
                                    title: 'Oops...',
                                    text: result.message,
                                    type: 'error'
                                },
                                function(isConfirm) {
                                }
                            )
                        }

                        unblockUISection("#form-change-password");
                    });
            }else{
                swal({title: 'Password confirmation is incorrect.', text: 'The new passwords do not match.', type: 'error'});
            }
        }else{
            swal({title: 'Oops...', text: 'Enter the required fields.', type: 'error'})
        }
    });

    $("#change-user-password").on("click", function(){
        var form = $("#change-password-form");
        var npass = form.find("input[name=new-password]").val();
        var ncpass = form.find("input[name=confirm-new-password]").val();
        var formData = form.serialize();

        if(npass.length > 0 || ncpass.length > 0){
            if(npass.length >= 4 || ncpass.length >= 4){
                if(npass == ncpass){
                    $.ajax({
                        method: 'POST',
                        url: urlController+'forceChangePassword',
                        data: { data_password: formData },
                        beforeSend: function(){
                            blockUISection("#change-password-form", "Updating data, please wait...")
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result.response == true){
                                $("change-password-modal").modal("hide")

                                swal(
                                    {
                                        title: 'Updated password!',
                                        text: 'The password has been updated successfully.',
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
                                        text: result.message,
                                        type: 'error'
                                    },
                                    function(isConfirm) {
                                    }
                                )
                            }

                            unblockUISection("#change-password-form");
                        });
                }else{
                    alert("Passwords do not match, try gain.");
                }
            }else{
                alert("The password must be greater than 4 characters.")
            }
        }else{
            alert("Enter the required fields.");
        }
    });

    $("#table-users").delegate(".delete-user", "click", function(){
        var user_id = $(this).attr("data-user");
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this user!",
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
                        url: urlController+'deleteUser',
                        data: { user_id: user_id },
                        beforeSend: function(){
                            blockUISection(".table-responsive", "Deleting data, please wait...");
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result['response'] == true){
                                swal(
                                    {
                                        title: 'User deleted!',
                                        text: 'The user was deleted successfully.',
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
                    swal("Cancelled", "Your user is safe.", "error");
                }
            });
    });

    if ( $("#table-users").length ) {
        $('#table-users').DataTable({
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

    function cleanInputsForAutocomplete(){
        if ( $("#form-create-user").length ){
            //$("#form-create-user").find("input").val("").removeClass();
        }
    }

});