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
                        <span id="select-shelters" type="button" class="btn btn-info my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Select Shelters (<?php echo count($sheltersSelected); ?>)
                        </span>

                        <span id="save-shelters" type="button" class="btn btn-success my-2 btn-icon-text" style="display: none;">
                            <i class="fe fe-plus mr-2"></i> Save shelters
                        </span>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->


            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12" id="select-shelters-container" style="display: none;">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex">
                                    <h6 class="main-content-label mb-1">Select the shelters to be analyzed</h6>
                                    <span id="close-select-shelters" type="button" class="btn ripple btn-danger btn-sm ml-auto">Close</span>
                                </div>
                                <div class="input-group mt-3">
                                    <input id="search-input" class="form-control" placeholder="Search for name..." type="text">
                                    <span class="input-group-btn">
                                        <button class="btn ripple btn-primary" type="button">
                                            <span class="input-group-btn">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </button>
                                    </span>
                                </div>
                                <div id="shelters-container" class="row mt-3">
                                    <?php foreach ($shelters as $shelter): ?>
                                        <?php
                                            $selected = false;

                                            if(!empty($sheltersSelected)){
                                                $index = array_search($shelter->id,$sheltersSelected,true);

                                                if($index != false OR $index == 0){
                                                    if($sheltersSelected[$index] == $shelter->id){
                                                        $selected = true;
                                                    }
                                                }
                                            }

                                        ?>
                                        <div class="col-md-3 my-2 btn-shelter-container" style="height: 56px; display:flex;">
                                            <button class="btn ripple <?php echo ($selected == true) ? 'btn-primary' : 'btn-light'; ?> w-100 btn-shelter" data-status="<?php echo ($selected == true) ? '1' : '0'; ?>" data-shelter="<?php echo $shelter->id; ?>"><?php echo $shelter->shelter_name; ?></button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row row-sm">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6">
                    <div class="card custom-card overflow-hidden " id="sr-animal-data-graph-container">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label mb-2">Animal Data Graph</label>
                            </div>
                        </div>
                        <div class="card-body pl-0">
                            <div class>
                                <div class="container">
                                    <canvas id="sr-animalDataGraph" height="420" class="chart-dropshadow2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="sr-percentage-of-shelters-by-type-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Percentage of shelters by type</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                        </div>

                        <div id="sr-percentage-of-shelters-by-type-chart" class="w-100" style="min-height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content-->