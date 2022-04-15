<!-- Main Content-->
<style>
    .crypto-icon {
        width: 25px !important;
        height: 25px !important;
    }

    .crypto-transcation.list-unstyled li {
        margin: 17px;
        padding: 7px 5px;
    }
</style>
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Predictive Charts</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Predictive Charts</li>
                    </ol>
                </div>
                <div class="d-flex">

                </div>
            </div>
            <!-- End Page Header -->


            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div id="received-prediction-container-2" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Prediction of the next 5 years of <b>received</b> animals.</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Prediction of the next 5 years of received animals (2019-2024)</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveAnimalDataPrediction/received/5/2019/5/0.5" data-container="#received-prediction-container-2" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div id="predictive-chart-4" class="w-100" style="min-height: 300px;"></div>

                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div id="euthanized-prediction-container-2" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Prediction of the next 5 years of <b>euthanized</b> animals.</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Prediction of the next 5 years of euthanized animals (2019-2024)</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveAnimalDataPrediction/euthanized/5/2019/5/0.3" data-container="#euthanized-prediction-container-2" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div id="predictive-chart-5" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div id="returned-prediction-container-2" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Prediction of the next 5 years of <b>returned</b> animals.</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Prediction of the next 5 years of returned animals (2019-2024)</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveAnimalDataPrediction/returned/5/2019/5/0.5" data-container="#returned-prediction-container-2" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div id="predictive-chart-6" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main Content-->