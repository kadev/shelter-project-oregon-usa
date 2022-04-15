$(function($) {
    $.fn.dataEditorPermissions = function( options ) {
        var urlController = appURL + "users/";
        var section = $("#data-editor-section");
        var table = this.find("#manage-states-table");
        var actions = {
            addPermission: $("#add-permission"),
            updatePermission: $("#edit-permission")
        }

        var buttons = {
            newPermission: $("#new-permission"),
            deletePermission: ".delete-permission",
            editPermission: ".edit-permission"
        }

        var modals = {
            newPermission: $("#add-permission-modal"),
            editPermission: $("#edit-permission-modal")
        }

        var inputs = { //Include: <input>, <textarea>, <select>, etc.
            yearsPermission: ".years-select"
        }

        buttons.newPermission.on("click", function(){
            modals.newPermission.find("select[name=state]").val(null).trigger("change");
            modals.newPermission.find(".years-select").val(null).trigger("change");
            modals.newPermission.modal("show");
        });

        modals.newPermission.find(inputs.yearsPermission).on("select2:select", function(e){
            verificationForTheYearsSelector($(this), e);
        });

        modals.editPermission.find(inputs.yearsPermission).on("select2:select", function(e){
            verificationForTheYearsSelector($(this), e);
        });

        actions.addPermission.on("click", function(){
            var stateLabel = modals.newPermission.find("select[name=state]").select2('data');
            var stateLabel = stateLabel[0].text;
            var state = modals.newPermission.find("select[name=state]").val();
            var years = modals.newPermission.find("select[name='years[]']").val();

            addRowToFinancialTable(stateLabel, state, years);

            $(".empty-message").hide();
            modals.newPermission.modal('hide');
        });

        table.delegate(buttons.editPermission, "click", function(){
            var row = $(this).attr("data-row");
            var tr = table.find("tr[data-row="+ row +"]");
            var state = tr.find("input[name$='[state]']").val();
            var years = tr.find("input[name$='[years]']").val().split(",");

            modals.editPermission.find("select").val(null).trigger("change");
            modals.editPermission.find("select[name=state]").val(state).trigger("change");
            modals.editPermission.find(".years-select").val(years).trigger("change");

            actions.updatePermission.attr("data-row", row);

            modals.editPermission.modal("show");
        });

        table.delegate(buttons.deletePermission, "click", function(){
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
                                $(this).find("input[name$='[state]']").attr("name", "permissions[" + counter + "][state]");
                                $(this).find("input[name$='[years]']").attr("name", "permissions[" + counter + "][years]");
                                $(this).find(".delete-permission").attr("data-row", counter + 1);
                                $(this).find(".edit-permission").attr("data-row", counter + 1);
                                $(this).find(".th-row").text(counter + 1);
                                counter++;
                            }
                        });
                    }else{
                        return true;
                    }
                });
        });

        actions.updatePermission.on("click", function(){
            var row = $(this).attr("data-row");

            var stateLabel = modals.editPermission.find("select[name=state]").select2('data');
            stateLabel = stateLabel[0].text;
            var yearsLabel = "";

            var state = modals.editPermission.find("select[name=state]").val();
            var years = modals.editPermission.find(".years-select").val();
            var tr = table.find("tr[data-row="+ row +"]");

            tr.find(".state-label").text(stateLabel);
            tr.find("input[name$='[state]']").val(state);

            if(years == "all"){
                yearsLabel = "All Years"
            }else{
                yearsLabel = years.join(', ');
            }

            tr.find(".years-label").text(yearsLabel);
            tr.find("input[name$='[years]']").val(years);

            modals.editPermission.modal('hide');
        });

        function addRowToFinancialTable(stateLabel, state, years){
            var container = table.find("tbody");
            var counter = buttons.newPermission.attr("data-counter");
            var template = "";
            var yearsLabel = "";

            if(years == "all"){
                yearsLabel = "All Years"
            }else{
                yearsLabel = years.join(', ');
            }

            console.log("Adding new permission...");console.log(stateLabel)
            console.log(state);console.log(years);

            counter = parseInt(counter) + 1;

            template += '<tr data-row="'+ counter +'">' + '<th scope="row"><span class="th-row">'+ counter +'</span></th>';
            template += '<td><span class="state-label">'+ stateLabel +'</span><input name="permissions['+(counter - 1)+'][state]" type="hidden" value="'+state+'"></td>';
            template += '<td class="td-ellipsis"><span class="years-label">'+ yearsLabel +'</span><input name="permissions['+(counter - 1)+'][years]" type="hidden" value="'+years.join()+'"></td>';
            template += '<td><div class="btn-icon-list">';
            template += '<span data-row="'+ counter +'" class="btn ripple btn-info btn-sm edit-permission"><i class="fe fe-edit"></i></span>';
            template += '<span data-row="'+ counter +'" class="btn ripple btn-danger btn-sm delete-permission"><i class="fe fe-trash"></i></span>';
            template += '</div></td></tr>';

            container.append(template);

            updateFilesCounter("increase");

            return true;
        }

        function updateFilesCounter(action){
            var currentValue = parseInt(buttons.newPermission.attr("data-counter"));
            var emptyMessage = $(".empty-message");

            switch (action) {
                case "increase": currentValue = currentValue + 1; break;
                case "decrease":
                    if(currentValue > 0){
                        currentValue = currentValue - 1;
                    }
                    break;
            }

            buttons.newPermission.attr("data-counter", currentValue);

            if(currentValue == 0){
                emptyMessage.show();
            }else{
                emptyMessage.hide();
            }

            return true;
        }

        function verificationForTheYearsSelector(element, e){
            var data = e.params.data;

            if(data.id == 'all'){
                element.val(null).val('all').trigger('change');
            }else{
                var values = element.select2('val'),
                    i = values.indexOf('all');
                if (i >= 0) {
                    values.splice(i, 1);
                    element.val(values).trigger("change");
                }
            }
        }
    };

}( jQuery ));