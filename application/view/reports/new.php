<style>
    #sortable1 { max-height: 500px; }
    #sortable2 { max-height: 700px; }

    #sortable1, #sortable2 {
        width: 142px;
        min-height: 20px;
        list-style-type: none;
        margin: 0;
        padding: 5px 0 0 0;
        float: left;
        overflow: auto; !important;
    }
    #sortable1 li, #sortable2 li {
        padding: 5px;
        font-size: 1em;
        width: 100%;
        cursor: move;
    }

    .ui-state-highlight { height: 2em; line-height: 1.2em; margin-bottom: 10px;}
</style>
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">New Report</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>reports/created">Reports Created</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Report</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div>
                                    <h6 class="main-content-label mb-1">Enter the fields</h6>
                                    <p class="text-muted card-sub-title">Enter the required fields to create the new report.</p>
                                </div>
                                <form id="form-create-report">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-12">
                                                <label class="">Title: <span class="tx-danger">*</span></label>
                                                <input name="title" class="form-control" required="" type="text" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-4">
                                                <label class="">From: <span class="tx-danger">*</span></label>
                                                <select name="from" class="form-control from-select">
                                                    <option label="Choose one"> </option>
                                                    <?php for ($i = 1973; $i <= date("Y"); $i++): ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor;  ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="">To: <span class="tx-danger">*</span></label>
                                                <select name="to" class="form-control to-select" placeholder="Choose one">
                                                    <option label="Choose one"></option>
                                                    <?php for ($i = 1973; $i <= date("Y"); $i++): ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor;  ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="">Criteria: <span class="tx-danger">*</span></label>
                                                <select name="criteria" class="form-control criteria-select" placeholder="Choose one">
                                                    <option label="Choose one"></option>
                                                    <option value="all">All</option>
                                                    <option value="2">Dogs</option>
                                                    <option value="1">Cats</option>
                                                    <option label="5">Rabbits</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-12">
                                                <label class="">Description:</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-12">
                                                <label class="">Published: <span class="tx-danger">*</span></label>
                                                <div class="main-toggle main-toggle-success on check-toggle" data-input="published">
                                                    <span></span>
                                                </div>
                                                <input name="published" class="form-control" type="hidden" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <h6 class="main-content-label mb-1">Select the shelters <span class="tx-danger">*</span></h6>
                                        <p class="text-muted card-sub-title">Select the shelters that will be in the report.</p>
                                    </div>

                                    <div class="form-group mt-2">
                                        <div class="row row-sm">
                                            <div class="col-md-6">
                                                <div class="alert alert-warning mt-2" role="alert">
                                                    <strong>Instructions: </strong> Select a state to see the shelters, then drag the shelter you want to the "Shelters Selected" section to finalize the selection click on "Save selection".
                                                </div>
                                                <p class="mg-b-10">Filter by state</p>
                                                <form>
                                                    <select class="form-control" id="filter-by-state" name="state">
                                                        <option value="0">Choose one</option>
                                                        <?php foreach ($states as $state): ?>
                                                            <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </form>

                                                <div class="p-3 d-inline-block w-100 mt-3" style="border: 1px solid #eee;">
                                                    <div class="form-group mt-2">
                                                        <p class="mg-b-10">Search results by name</p>
                                                        <input id="search-input" class="form-control" placeholder="Search for name..." type="text">
                                                    </div>
                                                    <div id="shelters-container" class="mt-3">
                                                        <ul id="sortable1" class="connectedSortable w-100">

                                                        </ul>
                                                    </div>
                                                    <div id="empty-results-filter-by-state" class="alert alert-danger mg-b-0" role="alert"">
                                                    <strong class="d-block mb-1">No shelters were found in the selected state..</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <h6 class="main-content-label mb-0">Shelters selected</h6>
                                            </div>

                                            <div class="p-3 d-inline-block w-100 mt-2" style="border: 1px solid #eee; background-color: #eaedf7;">
                                                <ul id="sortable2" class="connectedSortable w-100" style="min-height: 300px;">

                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex flex-row-reverse mt-5">
                                        <div id="create-report" class="btn ripple btn-main-primary btn-lg">
                                            <span aria-hidden="true" class="spinner-border spinner-border-sm d-none" role="status"></span>
                                            Create
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
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
            $("#sortable2").parent().css("background-color", "#eaedf7");
        } );

        $( "#sortable2").on( "sortstop", function( event, ui ) {
            $("#sortable2").parent().css("background-color", "#eaedf7");
        } );

        $( "#sortable1").on( "sortstop", function( event, ui ) {
            $("#sortable2").parent().css("background-color", "#eaedf7");
        } );

    };
</script>