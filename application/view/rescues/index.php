<?php use Mini\Libs\Helper; ?>

<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Rescue</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rescues</li>
                    </ol>
                </div>

                <div class="d-flex">
                    <div class="justify-content-center">
                        <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                            <a href="<?php echo URL ?>rescues/create" type="button" class="btn btn-success my-2 btn-icon-text">
                                <i class="fe fe-plus mr-2"></i> Create rescue
                            </a>
                        <?php endif; ?>
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
                                <h6 class="main-content-label mb-1">Rescues</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the rescues of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-rescues" style="max-width: 100% !important;">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-10p" data-priority="1">Rescue Name</th>
                                        <th class="wd-40p">Street Address</th>
                                        <th class="wd-40p">State</th>
                                        <th class="wd-5p" data-priority="2">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->
