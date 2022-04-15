$( document ).ready(function() {
    var urlController = appURL + "AnimalData/";
    var urlShelterController = appURL + "shelters/";
    var animalData = null;

    $('.states-select').select2({placeholder: 'Select a state', width: '100%'});

    $('.states-select').on('select2:select', function (e) {
        var data = e.params.data;
        var shelterSelect = $('.shelters-select');
        var notFoundError = $("#no-shelters-found-message");

        $("#shelter-details-container").hide();

        $.ajax({
            method: 'POST',
            url: urlController+'getSheltersByState',
            data: { data_id: data.id },
            beforeSend: function(){
                blockSearchSection();
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    var shelters = result.shelters;

                    shelterSelect.find("option").remove();

                    var newOption = new Option("Choose one", "", false, false);
                    shelterSelect.append(newOption).trigger('change');

                    shelters.forEach(function(shelter) {
                        var newOption = new Option(shelter.shelter_name, shelter.id, false, false);
                        shelterSelect.append(newOption).trigger('change');
                    });

                    notFoundError.hide();
                    shelterSelect.removeAttr("disabled");
                }else{
                    notFoundError.show();
                    shelterSelect.attr("disabled", true);
                    shelterSelect.find("option").remove();
                }

                unblockSearchSection();
            });
    });

    $('.shelters-select').select2({
        placeholder: 'Select one shelter',
        width: '100%'
    });

    $('.shelters-select').on('select2:select', function (e) {
        var data = e.params.data;
        //var shelterSelect = $('.shelters-select');

        $.ajax({
            method: 'POST',
            url: urlController+'getShelterByID',
            data: { data_id: data.id },
            beforeSend: function(){
                blockSearchSection();
                blockShelterDetailsSection();
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    fillShelterData(result.shelter);
                    animalData = result.shelter.animal_data;
                    var population = result.shelter.population;
                    var notes = result.shelter.notes;
                    var no_data = result.shelter.no_data;

                    var newUrl = urlController+"index/"+result.shelter.id+"/"+result.last_year
                    window.history.replaceState({ path: newUrl }, null, newUrl);

                    if(animalData != false){
                        fillAnimalDataTable(animalData, population, notes, no_data);
                        changeTableMode("reading");
                        $('#animal-data-table').find('tbody tr').show();
                        $('#animal-data-table').find('tfoot tr').show();
                        $("#no-data-checkbox").removeAttr("disabled");
                        $('#animal-data-table').find('tbody .message-error').hide();
                    }else{
                        $('.i-other-info').val("");
                        $("#notes").summernote('reset');
                        $('.label-animal-data').text("");
                        $('.label-other-info').html("");
                        $('.i-animal-data').val("");
                        $('#filter-data-by-year').val(null).trigger('change');
                    }

                    $("#shelter-details-container").show();
                }else{
                    animalData = null;
                    $("#shelter-details-container").find("card-text").text("-");
                }

                unblockSearchSection();
                unblockShelterDetailsSection();
            });
    });

    if ( $("#notes").length ) {
        var $summernote = $('#notes').summernote({
            placeholder: 'Write your content here ...',
            tabsize: 3,
            height: 300,
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    var div = $('<div />');
                    div.append(bufferText);
                    div.find('*').removeAttr('style');
                    setTimeout(function () {
                        document.execCommand('insertHtml', false, div.html());
                    }, 10);
                }
            }
        });

        $('.note-editor').hide();
        $('.note-editable').css("white-space", "pre");
    }

    $("#go-shelter-activity").on("click", function(){
        var data_id = $("#animal-data-table tbody input[name*='data_id']").first().val();

        if(data_id.length > 0){
            var url = urlController+'activity/'+data_id;
            window.open(url, '_blank').focus();
        }else{
            alert("A redirect error has occurred.");
        }

    });

    $("#reload-shelter-data").on("click", function() {
        var data_id = $("input[name=shelter_id]").val();

        if(data_id.length){
            $.ajax({
                method: 'POST',
                url: urlController+'getShelterByID',
                data: { data_id: data_id },
                beforeSend: function(){
                    blockShelterDetailsSection();
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        fillShelterData(result.shelter);
                        animalData = result.shelter.animal_data;
                        var population = result.shelter.population;
                        var notes = result.shelter.notes;
                        var no_data = result.shelter.no_data;

                        if(animalData != false){
                            fillAnimalDataTable(animalData, population, notes, no_data);
                            changeTableMode("reading");
                            $('#animal-data-table').find('tbody tr').show();
                            $('#animal-data-table').find('tfoot tr').show();
                            $("#no-data-checkbox").removeAttr("disabled");
                            $('#animal-data-table').find('tbody .message-error').hide();
                        }else{
                            $('.i-other-info').val("");
                            $("#notes").summernote('reset');
                            $('.label-animal-data').text("");
                            $('.label-other-info').html("");
                            $('.i-animal-data').val("");
                            $('#filter-data-by-year').val(null).trigger('change');
                        }

                        $("#shelter-details-container").show();
                    }else{
                        animalData = null;
                        $("#shelter-details-container").find("card-text").text("-");
                        $("#shelter-details-container").hide();
                    }

                    unblockShelterDetailsSection();
                });
        }else{
            swal({title: 'Oops...', text: 'Something has gone wrong, try again.', type: 'error'})
        }


    });

    $("#table-search-shelters").delegate(".show-shelter-data", "click", function(){
        var shelter_id = $(this).attr('data-shelter');
        //var shelterSelect = $('.shelters-select');

        $.ajax({
            method: 'POST',
            url: urlController+'getShelterByID',
            data: { data_id: shelter_id },
            beforeSend: function(){
                blockShelterDetailsSection();
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    $('.states-select').val(null).trigger('change');
                    $('.shelters-select').val(null).trigger('change');

                    fillShelterData(result.shelter);
                    animalData = result.shelter.animal_data;
                    var population = result.shelter.population;
                    var notes = result.shelter.notes;
                    var no_data = result.shelter.no_data;

                    if(animalData != false){
                        fillAnimalDataTable(animalData, population, notes, no_data);
                        changeTableMode("reading");
                        $('#animal-data-table').find('tbody tr').show();
                        $('#animal-data-table').find('tfoot tr').show();
                        $("#no-data-checkbox").removeAttr("disabled");
                        $('#animal-data-table').find('tbody .message-error').hide();
                    }else{
                        $('.label-animal-data').text("");
                        $('.i-animal-data').val("");
                        $("#notes").summernote('reset');
                        $('#filter-data-by-year').val(null).trigger('change');
                        $('#animal-data-table').find('tbody tr').hide();
                        $('#animal-data-table').find('tfoot tr').hide();
                        $("#no-data-checkbox").attr("disabled", "disabled").prop("checked", false);
                        $(".label-no-data-activated").hide();
                        $('#animal-data-table').find('tbody .message-error').show();
                    }

                    $("#shelter-details-container").show();
                    $('#shelters-modal').modal('hide');
                }else{
                    animalData = null;
                    $("#shelter-details-container").find("card-text").text("-");
                    $("#shelter-details-container").hide();
                }

                unblockShelterDetailsSection();
            });
    });

    $('.year-select').select2({
        placeholder: 'Select a year',
        width: '100%'
    });

    $('.year-select').on('select2:select', function (e) {
        var data = e.params.data;
        var $year = data.id;
        var shelter = $("input[name=shelter_id]").val();

        $.ajax({
            method: 'POST',
            url: urlController+'getShelterDataByYear',
            data: { year: data.id, shelter: shelter },
            beforeSend: function(jqXHR, settings){
                blockAnimalDataSection();
            }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    animalData = result.animal_data;
                    var population = result.population;
                    var notes = result.notes;
                    var no_data = result.no_data;

                    if(animalData != false){
                        fillAnimalDataTable(animalData, population, notes, no_data);
                        changeTableMode("reading");
                        $('#animal-data-table').find('tbody tr').show();
                        $('#animal-data-table').find('tfoot tr').show();
                        $('#animal-data-table').find('tbody .message-error').hide();
                    }else{
                        $('.label-animal-data').text("");
                        $('.i-animal-data').val("");
                        $("#notes").summernote('reset');
                        //$('#label-year').text("");
                        $('#animal-data-table').find('tbody tr').hide();
                        $('#animal-data-table').find('tfoot tr').hide();
                        $(".label-no-data-activated").hide();
                        $('#animal-data-table').find('tbody .message-error').show();
                    }

                    $("#no-data-checkbox").removeAttr("disabled");

                    if(no_data.status == 1){
                        $("#no-data-checkbox").prop("checked", true);
                        $(".label-no-data-activated").show().parent().show();
                    }else{
                        $("#no-data-checkbox").prop("checked", false);
                        $(".label-no-data-activated").hide().parent().hide();
                    }

                    window.history.replaceState(null, null, urlController+"index/"+shelter+"/"+$year);

                    unblockAnimalDataSection();
                }else{
                    swal({title: 'Oops...', text: 'Something has gone wrong, try again.', type: 'error'})
                    unblockAnimalDataSection();
                }
            });
    });

    // showing modal with effect
    $('#show-shelters-modal').on('click', function(e) {
        e.preventDefault();
        var effect = $(this).attr('data-effect');
        $('#modaldemo8').addClass(effect);
    });

    $("#enable-editing").on('click', function(){
        var year = $("#filter-data-by-year").val();

        if(year != null){
            $(".i-animal-data").removeClass('d-none');
            $(".i-other-info").removeClass('d-none');
            $(".label-animal-data").addClass('d-none');
            $(".label-other-info").addClass('d-none');
            $(this).addClass('d-none');
            $("#disable-editing").removeClass('d-none');
            $("#update-data").removeClass('d-none');
            $('.note-editor').show();
        }else{
            swal({title: 'Oops...', text: 'Select a year to continue', type: 'error'})
        }

    });

    $("#disable-editing").on('click', function(){
        $(".i-animal-data").addClass('d-none');
        $(".label-animal-data").removeClass('d-none');
        $(".i-other-info").addClass('d-none');
        $(".label-other-info").removeClass('d-none');
        $(this).addClass('d-none');
        $("#enable-editing").removeClass('d-none');
        $("#update-data").addClass('d-none');
        $('.note-editor').hide();

        $('.i-animal-data').each(function(i, obj) {
            var value = $(this).parent().find('.label-animal-data').text();
            $(this).val(value);
        });

        $('.i-other-info').each(function(i, obj) {
            var value = $(this).parent().find('.label-other-info').html();
            $(this).val(value);
        });
    });

    $('.create-animal-data').on("click", function(){
        $(".i-animal-data, .i-other-info").val("").removeClass("d-none");
        $(".label-animal-data").addClass("d-none");
        $(".label-other-info").addClass("d-none");
        $("#save-data").removeClass("d-none");
        $("#update-data").addClass("d-none");
        $('#animal-data-table').find('tbody tr').show();
        $('#animal-data-table').find('tfoot tr').show();
        $('#animal-data-table').find('tbody .message-error').hide();
        $("#enable-editing").addClass("d-none");
        $("#disable-editing").addClass("d-none");
        $('.note-editor').show();
        $("#notes").summernote('reset');

        unlockAnimalDataTable();
        changeTableMode("creation");
    });

    $("#save-data").on("click", function(){
        var shelter_id = $("input[name=shelter_id]").val();

        if(shelter_id.length != 0){
            var year = $("#filter-data-by-year").val();

            if(year != null && year.length != 0){
                var data = $("#form-animal-data").serialize();

                $.ajax({
                    method: 'POST',
                    url: urlController+'createAnimalDataByShelterIDAndYear',
                    data: { shelter: shelter_id, year: year, data: data },
                    beforeSend: function(){
                        blockAnimalDataSection();
                    }
                })
                    .done(function( data ) {
                        var result = JSON.parse(data);

                        if(result.response == true){

                            updateAnimalDataTable(shelter_id, year);

                            swal({title: 'Animal data created!', text: 'The animal data was created successfully.', type: 'success'},
                                function(isConfirm) {

                                }
                            );

                            unblockAnimalDataSection();
                        }else{
                            swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                                function(isConfirm) {
                                    location.reload();
                                }
                            )
                        }
                    });
            }else{
                swal({title: 'Required field...', text: 'Please select a year to make the request.', type: 'warning'})
            }
        }else{
            swal({title: 'Required field...', text: 'An error occurred with the request, reload the page and try again.', type: 'error'},
                function(isConfirm) {
                    location.reload();
                }
            )
        }
    });

    $("#update-data").on("click", function(){
        var shelter_id = $("input[name=shelter_id]").val();

        if(shelter_id.length != 0){
            var year = $("#filter-data-by-year").val();

            if(year.length != 0){
                var data = $("#form-animal-data").serialize();

                $.ajax({
                    method: 'POST',
                    url: urlController+'updateAnimalDataByShelterIDAndYear',
                    data: { shelter: shelter_id, year: year, data: data },
                    beforeSend: function(jqXHR, settings){
                        blockAnimalDataSection();
                    }
                })
                    .done(function( data ) {
                        var result = JSON.parse(data);

                        if(result.response == true){
                            swal({title: 'Animal data updated!', text: 'The animal data was updated successfully.', type: 'success'},
                                function(isConfirm) {
                                    updateAnimalDataTable(shelter_id, year);
                                    unblockAnimalDataSection();
                                }
                            );
                        }else{
                            swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                                function(isConfirm) {
                                    location.reload();
                                }
                            )
                        }
                    });
            }else{
                swal({title: 'Required field...', text: 'Please select a year to make the request.', type: 'warning'})
            }
        }else{
            swal({title: 'Required field...', text: 'An error occurred with the request, reload the page and try again.', type: 'error'},
                function(isConfirm) {
                    location.reload();
                }
            )
        }
    });

    $("input[name=no-data]").on("click", function () {
        var container = $("#animal-data-table");
        var noDataCheckbox = $("input[name=no-data]");
        var year = $(".year-select").val();
        var shelter_id = $("input[name=shelter_id]").val();

        if(noDataCheckbox.is(':checked')){
            var status = 1;
        }else{
            var status = 0;
        }

        swal({
                title: "Are you sure?",
                text: "Confirm the action to continue",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, I'm sure!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        method: 'POST',
                        url: urlController+'changeShelterYearNoData',
                        data: { shelter_id: shelter_id, year: year, status: status },
                        beforeSend: function(jqXHR, settings){
                            blockAnimalDataSection();
                        }
                    })
                        .done(function( data ) {
                            var result = JSON.parse(data);

                            if(result.response == true){
                                if(noDataCheckbox.is(':checked')){
                                    lockAnimalDataTable();
                                }else{
                                    unlockAnimalDataTable();
                                }

                                unblockAnimalDataSection()
                            }else{
                                swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'})

                                if(noDataCheckbox.is(':checked')){
                                    noDataCheckbox.prop("checked", false);
                                    $(".label-no-data-activated").hide();
                                }else{
                                    noDataCheckbox.prop("checked", true);
                                    $(".label-no-data-activated").show();
                                }

                                unblockAnimalDataSection()
                            }
                        });
                } else {
                    if(noDataCheckbox.is(':checked')){
                        noDataCheckbox.prop("checked", false);
                        $(".label-no-data-activated").hide();
                    }else{
                        noDataCheckbox.prop("checked", true);
                        $(".label-no-data-activated").show();
                    }
                }
            });
    });

    $("#enable-edit-comments").on("click", function(){
       $("#disable-edit-comments").show();
       $("#update-comments").show();
       $(".label-comments").addClass("d-none");

       $('.note-editor').show().find(".btn").show();
       $(this).hide();
    });

    $("#disable-edit-comments").on("click", function (){
        $(".comment-button").hide();
        $("#enable-edit-comments").show();
        $('.note-editor').hide();
        $(".label-comments").removeClass("d-none");
    });

    $("#update-comments").on("click", function(){
        var note_id = $("input[name=notes_id]").val();
        var shelter_id = $("input[name=shelter_id]").val();
        var year = $("#filter-data-by-year").val();

        if(note_id.length){
            var comments = $("#notes").val();

            $.ajax({
                method: 'POST',
                url: urlController+'updateNotesById',
                data: { note_id: note_id, comments: comments },
                beforeSend: function(jqXHR, settings){
                    blockAnimalDataSection();
                }
            })
                .done(function( data ) {
                    var result = JSON.parse(data);

                    if(result.response == true){
                        swal({title: 'Comments updated!', text: 'The comments was updated successfully.', type: 'success'},
                            function(isConfirm) {
                                updateAnimalDataTable(shelter_id, year);
                                unblockAnimalDataSection();
                            }
                        );
                    }else{
                        swal({title: 'Oops...', text: 'Something went wrong.', type: 'error'},
                            function(isConfirm) {
                                location.reload();
                            }
                        )
                    }
                });
        }else{
            swal({title: 'Required field...', text: 'An error occurred with the request, reload the page and try again.', type: 'error'},
                function(isConfirm) {
                    location.reload();
                }
            )
        }
    });

    function filterAnimalDataByYear($animal_data, $year){
        $animal_data.forEach(function(data) {
            if(data.year == $year){
                return data;
            }
        });
        return false;
    }

    function getDataByCurrentYearOrLastYear($animal_data){
        var date = new Date();
        var current_year = date.getFullYear();
        var animal_data_by_year = filterAnimalDataByYear($animal_data, current_year);

        if(animal_data_by_year){
            return animal_data_by_year;
        }else{
            return $animal_data[Object.keys($animal_data)[0]];;
        }
    }

    function fillShelterData(shelterData){
        $("input[name=shelter_id]").val(shelterData.id);
        $("#shelter-name").text(checkStringIsNotEmpty("#"+shelterData.id)+" "+checkStringIsNotEmpty(shelterData.shelter_name));
        $("#shelter-state").text(checkStringIsNotEmpty(shelterData.state_name));
        $("#shelter-address").text(checkStringIsNotEmpty(shelterData.street_address));
        $("#shelter-phone").text(checkStringIsNotEmpty(shelterData.phone_numner));
        $("#shelter-website").text(checkStringIsNotEmpty(shelterData.website));
        $("#shelter-website").attr("href",checkStringIsNotEmpty(shelterData.website));
    }

    function fillAnimalDataTable(data, population, notes, no_data) {
        $('.i-animal-data').val("");
        $("#notes").summernote('reset');
        data.forEach(function(item) {
            //console.log(item);
            $("#label-year").text(item.year);
            $(".year-select").val(item.year).trigger('change');
            $('input[name="data[' + item.animal_id + '][data_id]"]').val(item.data_id);
            $('input[name="data[' + item.animal_id + '][received]"]').val(item.received).parent().find('.label-animal-data').text(item.received);
            $('input[name="data[' + item.animal_id + '][returned]"]').val(item.returned).parent().find('.label-animal-data').text(item.returned);
            $('input[name="data[' + item.animal_id + '][placed]"]').val(item.placed).parent().find('.label-animal-data').text(item.placed);
            $('input[name="data[' + item.animal_id + '][euthanized]"]').val(item.euthanized).parent().find('.label-animal-data').text(item.euthanized);
            $('input[name="data[' + item.animal_id + '][transfers_in]"]').val(item.transfered).parent().find('.label-animal-data').text(item.transfered);
            $('input[name="data[' + item.animal_id + '][transfers_in_within_area]"]').val(item.transfered_in_within_area).parent().find('.label-animal-data').text(item.transfered_in_within_area);
            $('input[name="data[' + item.animal_id + '][transfers_in_outside_area]"]').val(item.transfered_in_outside_area).parent().find('.label-animal-data').text(item.transfered_in_outside_area);
            $('input[name="data[' + item.animal_id + '][transfers_out]"]').val(item.transfered_out).parent().find('.label-animal-data').text(item.transfered_out);
            $('input[name="data[' + item.animal_id + '][transfers_out_within_area]"]').val(item.transfered_out_within_area).parent().find('.label-animal-data').text(item.transfered_out_within_area);
            $('input[name="data[' + item.animal_id + '][transfers_out_outside_area]"]').val(item.transfered_out_outside_area).parent().find('.label-animal-data').text(item.transfered_out_outside_area);
        });

        $('input[name=population]').val(population.Population).parent().find(".label-other-info").text(population.Population);
        $('input[name=population_id]').val(population.id);
        $('textarea[name=notes]').parent().find(".label-other-info").html(notes.note);
        $('#notes').summernote('code', notes.note);
        $('input[name=notes_id]').val(notes.note_id);

        if(no_data != false){
            if(no_data.status == 1){
                $("#no-data-checkbox").prop("checked", true);
                lockAnimalDataTable();
            }else{
                $("#no-data-checkbox").prop("checked", false);
                unlockAnimalDataTable();
            }
        } else{
            $("#no-data-checkbox").prop("checked", false);
            unlockAnimalDataTable();
        }
    }

    function lockAnimalDataTable(){
        var container = $("#animal-data-table");
        container.find("input[name!='no-data']").attr("readonly", "true");
        container.find("textarea").attr("readonly", "true");
        container.find("td").css("color", "gray");
        container.find("tr").css("background-color", "#f6f6ff");
        container.find(".btn").css("display", "none");
        $(".label-no-data-activated").show();

        //Added to activate the notes
        container.find("tr[data-block=false]").css("background-color", "#fff");
        container.find("tr[data-block=false] td").css("color", "inherit");
        container.find("#enable-edit-comments").show();
    }

    function unlockAnimalDataTable(){
        var container = $("#animal-data-table");
        container.find("td").css("color", "inherit");
        container.find("tr").css("background-color", "#fff");
        container.find("input[name!='no-data']").removeAttr("readonly");
        container.find("textarea").removeAttr("readonly");
        container.find("select").removeAttr("readonly");
        container.find(".btn").css("display", "inline-block");
        container.find(".comment-button").hide();
        $(".label-no-data-activated").hide();
    }

    function checkStringIsNotEmpty(string){
        if(string.length == 0){
            return "-";
        }else{
            return string;
        }
    }

    function updateAnimalDataTable(shelter_id, year){
        $.ajax({
            method: 'POST',
            url: urlController+'getShelterDataByYear',
            data: { year: year, shelter: shelter_id }
        })
            .done(function( data ) {
                var result = JSON.parse(data);

                if(result.response == true){
                    animalData = result.animal_data;
                    var population = result.population;
                    var notes = result.notes;
                    var no_data = result.no_data;

                    if(animalData != false){
                        fillAnimalDataTable(animalData, population, notes,no_data);
                        $('#animal-data-table').find('tbody tr').show();
                        $('#animal-data-table').find('tfoot tr').show();
                        $('#animal-data-table').find('tbody .message-error').hide();
                        $('#animal-data-table').find("input[name=no-data]").parent().show();
                    }else{
                        $('.label-animal-data').text("");
                        $('.i-animal-data').val("");
                        $("#notes").summernote('reset');
                        $('#animal-data-table').find('tbody tr').hide();
                        $('#animal-data-table').find('tfoot tr').hide();
                        $('#animal-data-table').find('tbody .message-error').show();
                        $('#no-data-checkbox').prop("checked", false);
                        $(".label-no-data-activated").hide();
                        $('#animal-data-table').find("input[name=no-data]").parent().hide();
                    }

                    changeTableMode("reading");
                }else{

                }
            });
    }

    function changeTableMode(mode){
        switch(mode) {
            case 'reading':
                $('.label-animal-data, .label-other-info').removeClass("d-none");
                $('.i-animal-data, .i-other-info').addClass("d-none");
                $('#disable-editing, #save-data, #cancel-creation, #update-data').addClass("d-none");
                $('#enable-editing').removeClass("d-none");
                $('.note-editor').hide();
                break;
            case 'creation':
                $('.label-animal-data, .label-other-info').addClass("d-none");
                $('.i-animal-data, .i-other-info').removeClass("d-none");
                $('#disable-editing, #update-data, #enable-editing').addClass("d-none");
                $('#save-data, #cancel-creation').removeClass("d-none");
                $('.note-editor').show();
                break;
            case 'update':
                $('.label-animal-data, .label-other-info').addClass("d-none");
                $('.i-animal-data , .i-other-info').removeClass("d-none");
                $('#save-data, #cancel-creation, #enable-editing').addClass("d-none");
                $('#update-data, #disable-editing').removeClass("d-none");
                $('.note-editor').show();
                break;
        }
    }

    function blockSearchSection(){
        var container = $("#search-data-container");
        container.block({
            message: 'Getting data, please wait.',
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

    function blockShelterDetailsSection(){
        var container = $("#shelter-details-container");
        container.block({
            message: 'Getting data, please wait.',
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

    function blockAnimalDataSection(){
        var container = $("#animal-data-container");
        var noDataChkbox = $("#no-data-checkbox");

        container.block({
            message: 'Getting data, please wait.',
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

        noDataChkbox.attr("disabled", "true");
    }

    function unblockSearchSection(){
        var container = $("#search-data-container");
        container.unblock();
    }

    function unblockShelterDetailsSection(){
        var container = $("#shelter-details-container");
        container.unblock();
    }

    function unblockAnimalDataSection(){
        var container = $("#animal-data-container");
        var noDataChkbox = $("#no-data-checkbox");
        container.unblock();
        noDataChkbox.removeAttr("disabled");
    }

    if ( $("#table-search-shelters").length ) {
        $('#table-search-shelters').DataTable({
            "ajax": urlController + "getSheltersTableData",
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [[0, 'asc']]
        });
    }

    $('#filter-shelters-by-year').select2({
        placeholder: 'Select one shelter',
        width: '250px'
    });

    $('#filter-shelters-by-year').on('select2:select', function (e) {
        var data = e.params.data;

        if(data.element.value != 0){
            location.href = urlController +'getSheltersByYear/'+data.element.value;
        }
    });
});