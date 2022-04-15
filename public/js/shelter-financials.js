$(function($) {
    $.fn.shelterFinancials = function( options ) {
        var urlController = appURL + "shelters/";
        var section = $("#financial-section");
        var table = this.find("#manage-financial-files-table");
        var actions = {
            addFile: $("#add-financial-file"),
            updateFile: $("#edit-financial-file")
        }

        var buttons = {
            newFile: $("#new-financial-file"),
            deleteFile: ".delete-financial-file",
            editFile: ".edit-financial-file",
            showFinancialSection: ".show-financial-section"
        }

        var modals = {
            newFile: $("#add-financial-file-modal"),
            editFile: $("#edit-financial-file-modal")
        }

        var elements = {
            uploadContainer: $("#upload-container"),
            editUploadContainer: $("#edit-upload-container"),
            uploadFiles: $("#upload-financial-files"),
            editUploadFile: $("#edit-upload-financial-files"),
            startUpload: ".ff_fileupload_actions button.ff_fileupload_start_upload",
            deleteUpload: ".ff_fileupload_remove_file",
            changeFileType: ".change-file-type"
        }

        elements.uploadFiles.FancyFileUpload({
            url : urlController + 'uploadFinancialFiles',
            maxfilesize : 1000000,
            added : function(e, data) {
                var tr = elements.uploadContainer.find(".ff_fileupload_uploads tr");
                actions.addFile.prop("disabled", true);

                if(tr.length > 1){
                    tr.first().remove();
                }

                elements.uploadContainer.find(elements.startUpload).click();
            },
            uploadcompleted : function(e, data) {
                var flink = data.jqXHR.responseJSON.url + data.jqXHR.responseJSON.filename;
                modals.newFile.find("input[name=upload-link]").val(flink);
                actions.addFile.prop("disabled", false);
            }
        });

        elements.editUploadFile.FancyFileUpload({
            url : urlController + 'uploadFinancialFiles',
            maxfilesize : 1000000,
            added : function(e, data) {
                var tr = elements.editUploadContainer.find(".ff_fileupload_uploads tr");
                actions.updateFile.prop("disabled", true);

                if(tr.length > 1){
                    tr.first().remove();
                }
                elements.editUploadContainer.find(elements.startUpload).click();
            },
            uploadcompleted : function(e, data) {
                var flink = data.jqXHR.responseJSON.url + data.jqXHR.responseJSON.filename;
                modals.editFile.find("input[name=upload-link]").val(flink);
                actions.updateFile.prop("disabled", false);
            }
        });

        $(buttons.showFinancialSection).on("change", function () {
            var value = $(this).val();
            if(value == 1) section.show();
            if(value != 1) section.hide();
        });

        buttons.newFile.on("click", function(){
            modals.newFile.find("input[name=file-title]").val("");
            modals.newFile.find("input[name=file-link]").val("");
            modals.newFile.find("input[name=upload-link]").val("");
            modals.newFile.find(".change-file-type[data-type=link]").click();
            modals.newFile.find(".ff_fileupload_uploads").empty();
            modals.newFile.modal("show");
        });

        table.delegate(buttons.editFile, "click", function(){
            var row = $(this).attr("data-row");
            var tr = table.find("tr[data-row="+ row +"]");
            var type = tr.find("input[name$='[type]']").val();
            var title = tr.find("input[name$='[title]']").val();
            var file = tr.find("input[name$='[file]']").val();

            modals.editFile.find(".ff_fileupload_uploads").empty();
            modals.editFile.find("input").val("");
            modals.editFile.find("input[name=file-type]").val(type);
            modals.editFile.find(".change-file-type[data-type="+ type +"]").click();
            modals.editFile.find("input[name=file-title]").val(title);

            if(type == "link"){
                modals.editFile.find("input[name=file-link]").val(file);
            }else if(type == "upload-file"){
                modals.editFile.find("input[name=upload-link]").val(file);
            }

            actions.updateFile.attr("data-row", row);

            modals.editFile.modal("show");
        });

        table.delegate(buttons.deleteFile, "click", function(){
            var row = $(this).attr("data-row");

            swal({
                    title: "Are you sure?", text: "Confirm the action to continue...",
                    type: "warning", showCancelButton: true,
                    confirmButtonClass: "btn-danger", confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel.!", closeOnConfirm: true, closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        table.find("tr[data-row="+ row +"]").remove();
                        updateFilesCounter("decrease");
                        var counter = 0;

                        table.find("tr").each(function() {
                            var attr = $(this).attr('data-row');
                            if(typeof attr !== 'undefined' && attr !== false){+
                                $(this).attr('data-row', counter + 1);
                                $(this).find("input[name$='[type]']").attr("name", "financialfiles[" + counter + "][type]");
                                $(this).find("input[name$='[title]']").attr("name", "financialfiles[" + counter + "][title]");
                                $(this).find("input[name$='[file]']").attr("name", "financialfiles[" + counter + "][file]");
                                $(this).find(".delete-financial-file").attr("data-row", counter + 1);
                                $(this).find(".edit-financial-file").attr("data-row", counter + 1);
                                $(this).find(".th-row").text(counter + 1);
                                counter++;
                            }
                        });
                    }else{
                        return true;
                    }
                });
        });

        actions.addFile.on("click", function(){
            var title = modals.newFile.find("input[name=file-title]").val();
            var link = modals.newFile.find("input[name=file-link]").val();
            var uploadFile = modals.newFile.find("input[name=upload-link]").val();
            var type = modals.newFile.find("input[name=file-type]").val();

            if(type == "link"){
                addRowToFinancialTable(type, title, link);
            }else if(type == "upload-file"){
                addRowToFinancialTable(type, title, uploadFile);
            }

            $(".empty-message").hide();
            modals.newFile.modal('hide');
        });

        actions.updateFile.on("click", function(){
            var row = $(this).attr("data-row");

            var title = modals.editFile.find("input[name=file-title]").val();
            var link = modals.editFile.find("input[name=file-link]").val();
            var uploadFile = modals.editFile.find("input[name=upload-link]").val();
            var type = modals.editFile.find("input[name=file-type]").val();
            var tr = table.find("tr[data-row="+ row +"]");

            tr.find("input[name$='[type]']").val(type);
            tr.find(".title-label").text(title);
            tr.find("input[name$='[title]']").val(title);

            if(type == "link"){
                tr.find(".file-label").text(link);
                tr.find("input[name$='[file]']").val(link);
            }else if(type == "upload-file"){
                tr.find(".file-label").text(uploadFile);
                tr.find(".file-label").attr("href", uploadFile);
                tr.find("input[name$='[file]']").val(uploadFile);
            }

            modals.editFile.modal('hide');
        });

        $("body").delegate(elements.deleteUpload, 'click', function(){
            $(this).parent().parent().remove();
            $("input[name=upload-link]").val("");
        });

        $(elements.changeFileType).on("click", function() {
            var modal = $(this).parents(".modal-content");
            var type = $(this).attr("data-type");
            var uploadContainer = modal.find(".upload-container");
            var linkContainer = modal.find(".link-container");

            $(elements.changeFileType).removeClass("btn-primary");
            uploadContainer.hide(); linkContainer.hide();

            if(type == "upload-file"){
                $(".change-file-type[data-type=upload-file]").addClass("btn-primary");
                uploadContainer.show();
            }

            if(type == "link"){
                $(".change-file-type[data-type=link]").addClass("btn-primary");
                linkContainer.show();
            }

            $("input[name=file-type]").val(type);
        });

        function addRowToFinancialTable(type, title, file){
            var container = table.find("tbody");
            var counter = buttons.newFile.attr("data-counter");
            var template = "";

            counter = parseInt(counter) + 1;

            template += '<tr data-row="'+ counter +'">' + '<th scope="row"><span class="th-row">'+ counter +'</span><input name="financialfiles['+(counter - 1)+'][type]" type="hidden" value="'+type+'"></th>';
            template += '<td><span class="title-label">'+ title +'</span><input name="financialfiles['+(counter - 1)+'][title]" type="hidden" value="'+title+'"></td>';
            template += '<td class="td-ellipsis"><a class="file-label" href="'+file+'" target="_blank">'+  file +'</a><input name="financialfiles['+(counter - 1)+'][file]" type="hidden" value="'+file+'"></td>';
            template += '<td><div class="btn-icon-list">';
            template += '<span data-row="'+ counter +'" class="btn ripple btn-info btn-sm edit-financial-file"><i class="fe fe-edit"></i></span>';
            template += '<span data-row="'+ counter +'" class="btn ripple btn-danger btn-sm delete-financial-file"><i class="fe fe-trash"></i></span>';
            template += '</div></td></tr>';

            container.append(template);

            updateFilesCounter("increase");

            return true;
        }

        function updateFilesCounter(action){
            var currentValue = parseInt(buttons.newFile.attr("data-counter"));
            var emptyMessage = $(".empty-message");

            switch (action) {
                case "increase": currentValue = currentValue + 1; break;
                case "decrease":
                    if(currentValue > 0){
                        currentValue = currentValue - 1;
                    }
                    break;
            }

            buttons.newFile.attr("data-counter", currentValue);

            if(currentValue == 0){
                emptyMessage.show();
            }else{
                emptyMessage.hide();
            }

            return true;
        }
    };

}( jQuery ));