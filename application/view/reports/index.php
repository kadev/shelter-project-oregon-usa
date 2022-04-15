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
                    <h2 class="main-content-title tx-24 mg-b-5">Reports</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>
                </div>
                <div class="d-flex">

                </div>
            </div>
            <!-- End Page Header -->


            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6">
                    <div class="card custom-card overflow-hidden " id="animal-data-graph-container">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label mb-2">Animal Data Graph</label>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveAnimalDataGraph/" data-container="#animal-data-graph-container" title="Reload graph data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div class="card-body pl-0">
                            <div class>
                                <div class="container">
                                    <canvas id="animalDataGraph" height="420" class="chart-dropshadow2"></canvas>
                                </div>
                            </div>

                            <p class="mb-0 mt-3 px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="percentage-of-shelters-by-type-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Percentage of shelters by type</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon reload-graph" data-reload="<?php echo URL; ?>DataCharts/savePercentagePerShelterType" data-container="#percentage-of-shelters-by-type-container" title="Reload graph data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="percentage-of-shelters-by-type-chart" class="w-100" style="min-height: 300px;"></div>

                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-4">
                    <div class="card custom-card overflow-hidden" id="top-10-states-most-received-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 states with the most <span style="color: green; font-weight: 600;">received</span></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 states that received the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopStatesWithMostAnimalsReceived/<?php echo $animal; ?>/2019" data-container="#top-10-states-most-received-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($statesMostReceived as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-success text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>State name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getStateName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total received</small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $statesMostReceivedLastUpdated; ?></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-4">
                    <div class="card custom-card overflow-hidden" id="top-10-states-most-euthanized-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 states with the most <span style="color: red; font-weight: 600;">euthanized</span></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 states that euthanized the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopStatesWithMostAnimalsEuthanized/<?php echo $animal; ?>/2019" data-container="#top-10-states-most-euthanized-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($statesMostEuthanized as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-danger text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>State name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getStateName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total euthanized</small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $statesMostEuthanizedLastUpdated; ?></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-4">
                    <div class="card custom-card overflow-hidden" id="top-10-states-most-returned-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 states with the most <span style="color: orange; font-weight: 600;">returned</span></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 states that returned the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopStatesWithMostAnimalsReturned/<?php echo $animal; ?>/2019" data-container="#top-10-states-most-returned-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($statesMostReturned as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-warning text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>State name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getStateName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total returned</small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $statesMostReturnedLastUpdated; ?></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-4">
                    <div id="percentage-animals-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Percentage of animals received</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Percentage of animals received in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/savePercentageOfAnimalsPerYear/received/2019" data-container="#percentage-animals-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div id="percentage-received-chart" class="w-100" style="min-height: 300px;">

                        </div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-4">
                    <div id="percentage-euthanized-animals-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Percentage of animals euthanized</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Percentage of animals euthanized in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/savePercentageOfAnimalsPerYear/euthanized/2019" data-container="#percentage-euthanized-animals-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div id="percentage-euthanized-chart" class="w-100" style="min-height: 300px;">

                        </div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-4">
                    <div id="percentage-returned-animals-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Percentage of animals returned</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Percentage of animals returned in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/savePercentageOfAnimalsPerYear/returned/2019" data-container="#percentage-returned-animals-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <div id="percentage-returned-chart" class="w-100" style="min-height: 300px;">

                        </div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="number-of-animals-received-from-2013-to-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Number of animals received per year [2013-2019]</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveNumberOfAnimalsPerYear/all/received/2019/6" data-container="#number-of-animals-received-from-2013-to-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="chart-number-of-animals-received-from-2013-to-2019" class="w-100" style="min-height: 300px;"></div>

                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="number-of-animals-euthanized-from-2013-to-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Number of animals euthanized per year [2013-2019]</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveNumberOfAnimalsPerYear/all/euthanized/2019/6" data-container="#number-of-animals-euthanized-from-2013-to-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="chart-number-of-animals-euthanized-from-2013-to-2019" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="number-of-animals-received-from-2011-to-2021-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Number of animals received per year [2010-2020]</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveNumberOfAnimalsPerYear/all/received/2020/10" data-container="#number-of-animals-received-from-2011-to-2021-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="chart-number-of-animals-received-from-2011-to-2021" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="number-of-animals-euthanized-from-2011-to-2021-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Number of animals euthanized per year [2010-2020]</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveNumberOfAnimalsPerYear/all/euthanized/2020/10" data-container="#number-of-animals-euthanized-from-2011-to-2021-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="chart-number-of-animals-euthanized-from-2011-to-2021" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12">
                    <h2 class="main-content-title tx-24 mg-b-5 mb-3 mt-4">Transfer reports</h2>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="number-of-animals-transfered-from-2013-to-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Number of animals transfered in per year [2013-2019]</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveNumberOfAnimalsPerYear/all/transfered/2019/6" data-container="#number-of-animals-transfered-from-2013-to-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="chart-number-of-animals-transfered-from-2013-to-2019" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-6">
                    <div id="number-of-animals-transfered-out-from-2013-to-2019-container" class="card custom-card overflow-hidden">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Number of animals transfered out per year [2013-2019]</label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted"></span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveNumberOfAnimalsPerYear/all/transfered-out/2019/6" data-container="#number-of-animals-transfered-out-from-2013-to-2019-container" title="Reload chart data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>

                        <div id="chart-number-of-animals-transfered-out-from-2013-to-2019" class="w-100" style="min-height: 300px;"></div>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div class="card custom-card overflow-hidden" id="top-10-states-most-transfered-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 states with the most <b>transfered in</b></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 states that transfered in the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopStatesWithMostAnimalsTransfered/<?php echo $animal; ?>/2019" data-container="#top-10-states-most-transfered-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($statesMostTransfered as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-warning text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>State name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getStateName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total transfered in</small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>

                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $statesMostTransferedLastUpdated; ?></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div class="card custom-card overflow-hidden" id="top-10-states-most-transfered-out-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 states with the most <b>transfered out</b></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 states that transfered out the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopStatesWithMostAnimalsTransferedOut/<?php echo $animal; ?>/2019" data-container="#top-10-states-most-transfered-out-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($statesMostTransferedOut as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-warning text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>State name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getStateName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total transfered out</small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $statesMostTransferedOutLastUpdated; ?></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div class="card custom-card overflow-hidden" id="top-10-shelters-most-transfered-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 shelters with the most <b>transfered in</b></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 shelters that transfered in the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopSheltersWithMostAnimals/<?php echo $animal; ?>/transfered/2019" data-container="#top-10-shelters-most-transfered-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($sheltersMostTransfered as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-primary text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>Shelter name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getShelterName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total transfered in</small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $sheltersMostTransferedLastUpdated; ?></span></p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-lg-12  col-xl-6 col-xxl-6">
                    <div class="card custom-card overflow-hidden" id="top-10-shelters-most-transfered-out-2019">
                        <div class="card-header border-bottom-0 d-flex">
                            <div>
                                <label class="main-content-label my-auto pt-2">Top 10 shelters with the most <b>transfered out</b></label>
                                <span class="d-block tx-12 mb-4 mt-1 text-muted">Top 10 shelters that transfered out the most animals in 2019</span>
                            </div>
                            <div class="ml-auto">
                                <span class="btn ripple btn-light btn-icon btn-sm reload-graph" data-reload="<?php echo URL; ?>DataCharts/saveTopSheltersWithMostAnimals/<?php echo $animal; ?>/transfered-out/2019" data-container="#top-10-shelters-most-transfered-out-2019" title="Reload list data"><i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                        <ul class="crypto-transcation list-unstyled mg-b-0">
                            <?php $i=1; foreach ($sheltersMostTransferedOut as $key => $value): ?>
                                <?php if($i <= 10): ?>
                                    <li class="list-item mb-3 pl-3 pr-3 mt-0">
                                        <div class="media align-items-center">
                                            <div class="crypto-icon bg-primary text-white"> <span class="wd-20 text-center tx-12 font-weight-bold"><?php echo $i ?></span>
                                            </div>
                                            <div class="media-body ml-3">
                                                <small>Shelter name</small>
                                                <p class="tx-medium mg-b-3 tx-15 mb-0"><?php echo \Mini\Libs\Helper::getShelterName($key); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right ml-auto my-auto">
                                            <small>Total transfered out
                                            </small>
                                            <h5 class="font-weight-semibold tx-16 mb-0"><?php echo $value; ?></h5>
                                        </div>
                                    </li>
                                <?php else: break; ?>
                                <?php endif; ?>
                                <?php $i++; endforeach; ?>
                        </ul>
                        <p class="px-3 text-right" style="color: #c8ccdb">Last data reload: <span class="last-updated-label"><?php echo $sheltersMostTransferedOutLastUpdated; ?></span></p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main Content-->