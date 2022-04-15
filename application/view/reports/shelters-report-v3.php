<style>
    #sortable1, #sortable2 {
        width: 142px;
        min-height: 20px;
        list-style-type: none;
        margin: 0;
        padding: 5px 0 0 0;
        float: left;
    }
    #sortable1 li, #sortable2 li {
        padding: 5px;
        font-size: 1.2em;
        width: 100%;
        cursor: move;
    }

    .ui-state-highlight { height: 2em; line-height: 1.2em; margin-bottom: 10px;}
</style>
<!-- Main Content-->
<div id="main-content" class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Shelters Report</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shelters Report</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <span id="select-shelters-2" type="button" class="btn btn-info my-2 btn-icon-text">
                            <i class="fe fe-edit mr-2"></i> Select Shelters (<?php echo $countSelectedShelters; ?>)
                        </span>
                        <span id="close-select-shelters-2" type="button" class="btn btn-danger my-2 btn-icon-text" style="display:none">
                            <i class="fe fe-x mr-2"></i>  Cancel selection
                        </span>

                    </div>
                </div>
            </div>
            <!-- End Page Header -->


            <!-- row opened -->
            <div class="row row-sm" id="select-shelters-container" style="display: none;">
                <div class="col-lg-6 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex">
                                    <h6 class="main-content-label mb-1">Select shelters</h6>
                                </div>

                                <div class="alert alert-warning mt-2" role="alert">
                                    <strong>Instructions: </strong> Select a state to see the shelters, then drag the shelter you want to the "Shelters Selected" section to finalize the selection click on "Save selection".
                                </div>

                                <div class="form-group mt-2">
                                    <p class="mg-b-10">Filter by state</p>
                                    <form>
                                        <select class="form-control" id="filter-by-state" name="state">
                                            <option label="0">Choose one</option>
                                            <?php foreach ($states as $state): ?>
                                                <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </form>

                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-12" >
                                <div class="p-3 d-inline-block w-100" style="border: 1px solid #eee;">
                                    <div class="form-group mt-2">
                                        <p class="mg-b-10">Search results by name</p>
                                        <input id="search-input" class="form-control" placeholder="Search for name..." type="text">
                                    </div>
                                    <div id="shelters-container" class="mt-3">
                                        <ul id="sortable1" class="connectedSortable w-100">

                                        </ul>
                                    </div>
                                    <div id="empty-results-filter-by-state" class="alert alert-danger mg-b-0" role="alert" style="display:none;">
                                        <strong class="d-block mb-1">No shelters were found in the selected state..</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex align-items-center mb-2">
                                    <h6 class="main-content-label mb-0">Shelters selected</h6>
                                    <span id="save-shelters-2" type="button" class="btn btn-success my-0 btn-icon-text d-inline-flex align-items-center ml-auto">
                                        <i class="fe fe-save mr-2"></i>Save selection
                                    </span>
                                </div>

                                <div class="p-3 d-inline-block w-100 mt-2" style="border: 1px solid #eee;">
                                    <ul id="sortable2" class="connectedSortable w-100" style="min-height: 300px;">
                                        <?php foreach ($sheltersSelected as $item): ?>
                                            <li class="ui-state-default w-100 mb-2" data-shelter="<?php echo $item->id ?>"><?php echo $item->shelter_name ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="reports-section" class="row row-sm">
                <div class="alert alert-warning w-100 px-4" role="alert">
                    <strong>The following charts are generated based on animal data from the following shelters:</strong><br>
                    <ul class="mt-2">
                        <?php foreach ($sheltersSelected as $shelter): ?>
                            <li><?php echo $shelter->shelter_name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 d-none">
                    <div class="card custom-card overflow-hidden " id="sr-animal-data-graph-container-2">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label mb-2">Animal Data Graph</label>
                            </div>
                        </div>
                        <div class="card-body pl-0">
                            <div class>
                                <div class="container">
                                    <div id="sr-animalDataGraph-2" class="w-100" style="min-height: 300px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="card custom-card overflow-hidden " id="received-shelters-data-container">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label mb-2">Received Shelters Data from the last 10 years</label>
                            </div>
                        </div>
                        <div class="card-body pl-0">
                            <div class>
                                <div class="container">
                                    <div id="received-shelters-data" class="w-100" style="min-height: 300px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content-->
<script>

    window.onload = function() {
        $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable",
            placeholder: "ui-state-highlight",
            cursor: "move"

        }).disableSelection();

        $("#sortable2").on("sortover", function(event, ui){
            $("#sortable2").parent().css("background-color", "#ffeeba");
        });

        $( "#sortable2" ).on( "sortreceive", function( event, ui ) {
            $("#sortable2").parent().css("background-color", "white");
        } );

        $( "#sortable2").on( "sortstop", function( event, ui ) {
            $("#sortable2").parent().css("background-color", "white");
        } );

        $("#filter-by-state").select2();

    };
</script>