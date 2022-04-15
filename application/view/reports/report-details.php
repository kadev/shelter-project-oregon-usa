<style>
    .sweet-alert .la-ball-fall {
        top: 20% !important;
    }

</style>
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div id="container-for-pdf" class="container-fluid">
        <div class="inner-body">

            <img id="logo-pdf" class="d-none d-print-block" src="<?php echo URL; ?>img/brand/NAIAShelterProject-Logo-Small.jpg">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Report Details</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>reports/created">Reports Created</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report Details: #<?php echo $report->id; ?></li>
                    </ol>
                </div>

                <div class="d-flex d-print-none">
                    <div class="justify-content-center">
                        <button id="downloadPDF" type="button" class="btn ripple btn-info my-2 btn-with-icon" data-name="<?php echo str_replace(' ', '-', $report->title); ?>">
                            <i class="fe fe-download mr-2"></i> Export Charts
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <?php if($report != false): ?>
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-warning w-100 px-4" role="alert">
                            <strong>The following charts are generated based on animal data from the following shelters:</strong><br>
                            <ol class="mt-2">
                                <?php foreach ($shelters as $shelter): ?>
                                    <li><?php echo $shelter->shelter_name; ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div>
                                        <h6 class="main-content-label mb-1"><?php echo $report->title ?></h6>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <h6 class="">From: </h6>
                                    <p class="card-text"><?php echo $report->from_year; ?></p>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <h6 class="">To: </h6>
                                    <p class="card-text"><?php echo $report->to_year; ?></p>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <h6 class="">Criteria: </h6>
                                    <p class="card-text"><?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?></p>
                                </div>

                                <div class="col-md-12 col-lg-12 col-xl-12 mt-3">
                                    <h6 class="">Description: </h6>
                                    <p class="card-text"><?php echo $report->description; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 d-print-none">
                        <div class="card custom-card overflow-hidden " id="received-shelters-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Received <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>By Shelters
                                    </label>
                                </div>
                                <div class="ml-auto">
                                    <button id="regenerate-charts" type="button" class="btn ripple btn-info my-2 btn-with-icon" data-report="<?php echo $report->id; ?>">
                                        <i class="fe fe-refresh-cw mr-2"></i> Regenerate charts
                                    </button>
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

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="received-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Received <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="received-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="returned-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Returned <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="returned-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="placed-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Placed <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="placed-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="euthanized-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Euthanized <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="euthanized-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 d-print-none">
                        <h2 class="main-content-title tx-24 mg-b-5 mb-3 mt-4">Transfer In Charts</h2>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="transfered-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Transfered In <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="transfered-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="transfered-within-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Transfered In Within Area <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="transfered-within-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="transfered-outside-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Transfered In Outside Area <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="transfered-outside-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 d-print-none">
                        <h2 class="main-content-title tx-24 mg-b-5 mb-3 mt-4">Transfer Out Charts</h2>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="transfered-out-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Transfered Out <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class="">
                                    <div class="container">
                                        <div id="transfered-out-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="transfered-out-within-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Transfered Out Within Area <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="transfered-out-within-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6 d-print-none">
                        <div class="card custom-card overflow-hidden " id="transfered-outside-animal-data-container">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label mb-2">
                                        <?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?>&nbsp;
                                        Transfered Out Outside Area <?php echo ($report->criteria == "all") ? 'Data ' : ''; ?>by Year
                                    </label>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class>
                                    <div class="container">
                                        <div id="transfered-out-outside-animal-data" class="w-100" style="min-height: 300px;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12  col-xl-12 col-xxl-12 no-show-pdf">
                        <div id="sr-shelters-table-details" class="card custom-card overflow-hidden">
                            <div class="card-header border-bottom-0 d-flex">
                                <div>
                                    <label class="main-content-label my-auto pt-2">Shelters Data Details</label>
                                </div>
                                <div class="ml-auto">
                                    <div class="justify-content-center">
                                        <a href="#" onclick="window.print()" type="button" class="btn ripple btn-info my-2 btn-with-icon no-show-pdf d-print-none">
                                            <i class="fe fe-download mr-2"></i> Print Datatable
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap text-md-nowrap table-bordered mg-b-0" id="table-shelters-details" style="max-width: 100% !important;">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p">Year</th>
                                            <th class="wd-15p">Received</th>
                                            <th class="wd-15p">Returned</th>
                                            <th class="wd-15p">Placed</th>
                                            <th class="wd-15p">Transfered</th>
                                            <th class="wd-15p">Euthanized</th>
                                            <th class="wd-15p">Transfered Out</th>
                                        </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-md-12 col-lg-12 col-xl-12 mt-5">
                        <div id="empty-results-filter-by-state" class="alert alert-danger mg-b-0" role="alert">
                            <strong class="d-block mb-1">The report you want to access does not exist or is no longer available.</strong>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- Row end -->
    </div>
</div>
<!-- End Main Content-->
<script>
    var reportID = '<?php echo (!empty($report)) ? $report->id : ''; ?>';
    var fromYear = '<?php echo (!empty($report)) ? $report->from_year : ''; ?>';
    var toYear = '<?php echo (!empty($report)) ? $report->to_year : ''; ?>';
    var criteria = '<?php echo (!empty($report)) ? $report->criteria : ''; ?>'
    var criteriaLabel = '<?php echo (!empty($report)) ? \Mini\Libs\Helper::getNameOfCriteria($report->criteria) : ''; ?>'
</script>