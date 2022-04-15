<?php use Mini\Libs\Helper; ?>

<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Shelter</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shelters</li>
                    </ol>
                </div>

                <div class="d-flex">
                    <div class="justify-content-center">
                        <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                            <a href="<?php echo URL ?>shelters/create" type="button" class="btn btn-success my-2 btn-icon-text">
                                <i class="fe fe-plus mr-2"></i> Create shelter
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
                                <h6 class="main-content-label mb-1">Shelters</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the shelters of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-shelters" style="max-width: 100% !important;">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-10p" data-priority="1">Shelter Name</th>
                                        <th class="wd-40p">Street Address</th>
                                        <th class="wd-40p">State</th>
                                        <th class="wd-5p" data-priority="2">Action</th>
                                    </tr>
                                    </thead>
                                    <!-- <tbody>
                                    <?php //foreach ($shelters as $shelter): ?>
                                        <tr>
                                            <td><a href="<?php //echo URL ?>shelters/edit/<?php //echo $shelter->id; ?>"><?php //echo $shelter->id ?></a></td>
                                            <td><a href="<?php //echo URL ?>shelters/edit/<?php //echo $shelter->id; ?>"><?php //echo Helper::getTheCorrectShelterName($shelter->shelter_name); ?></a></td>
                                            <td><?php //echo $shelter->street_address; ?></td>
                                            <td><?php //echo $State->getStateNameById($shelter->states_id); ?></td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <?php //if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                                                        <a href="<?php //echo URL . 'shelters/edit/' . $shelter->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                        <span data-shelter="<?php //echo $shelter->id; ?>" class="btn ripple btn-danger btn-sm delete-shelter"><i class="fe fe-trash"></i></span>
                                                    <?php //elseif($session['privilege'] == 3): ?>
                                                        <a href="<?php //echo URL . 'shelters/send-update/' . $shelter->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <?php //endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php //endforeach; ?>
                                    </tbody>-->
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
