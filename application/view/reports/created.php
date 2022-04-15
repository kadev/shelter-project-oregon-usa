<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Reports Created</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports Created</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>reports/new-report" type="button" class="btn ripple btn-success my-2 btn-with-icon">
                            <i class="fe fe-plus mr-2"></i> Create report
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->


            <!--Row-->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Reports Created</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the reports created of your site.</p>
                            </div>
                            <?php if(!empty($reports)): ?>
                                <div class="table-responsive">
                                    <table class="table" id="table-reports">
                                        <thead>
                                        <tr>
                                            <th class="wd-5p">ID</th>
                                            <th class="wd-65p">Report Title</th>
                                            <th class="wd-5">#Shelters</th>
                                            <th class="wd-5">From</th>
                                            <th class="wd-5">To</th>
                                            <th class="wd-5">Criteria</th>
                                            <th class="wd-10p">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($reports as $report): ?>
                                            <tr>
                                                <td><a href="<?php echo URL . 'reports/details/' . $report->id; ?>"><?php echo $report->id; ?></a></td>
                                                <td><a href="<?php echo URL . 'reports/details/' . $report->id; ?>"><?php echo $report->title; ?></a></td>
                                                <td><?php echo \Mini\Libs\Helper::countSheltersAreInReport($report->shelters); ?></td>
                                                <td><?php echo $report->from_year; ?></td>
                                                <td><?php echo $report->to_year; ?></td>
                                                <td><?php echo \Mini\Libs\Helper::getNameOfCriteria($report->criteria); ?></td>
                                                <td>
                                                    <div class="btn-icon-list page-actions">
                                                        <a href="<?php echo URL . 'reports/details/' . $report->id; ?>" class="btn ripple btn-warning btn-sm" title="Go to details"><i class="fe fe-list"></i></a>
                                                        <a href="<?php echo URL . 'reports/edit/' . $report->id; ?>" class="btn ripple btn-info btn-sm" title="Edit report"><i class="fe fe-edit"></i></a>
                                                        <span data-report="<?php echo $report->id; ?>" class="btn ripple btn-danger btn-sm delete-report" title="Delete report"><i class="fe fe-trash"></i></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                                    <span class="alert-inner--text">
                                        <strong>No reports were found!</strong> To create the first one click on the "Create report" button.
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->