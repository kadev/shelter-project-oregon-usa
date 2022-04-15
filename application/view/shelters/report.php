<?php use Mini\Libs\Helper; ?>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #3c4858;
    }
</style>
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Shelter Report</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shelter Report</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button id="show-shelters-modal" type="button" class="btn btn-primary my-2 btn-icon-text" data-target="#shelters-modal" data-toggle="modal" data-effect="effect-scale">
                            <i class="fe fe-search mr-2"></i> Search Shelter
                        </button>
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
                                <h6 class="main-content-label mb-1">Search by State</h6>
                                <p class="text-muted card-sub-title">Filter the shelters by state and select one to view the report.</p>
                            </div>
                            <form id="form-create-article">
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-sm-6">
                                            <label class="">Select one state</label>
                                            <select class="form-control states-select" name="state">
                                                <option label="Choose one"> </option>
                                                <?php foreach ($states as $state): ?>
                                                    <?php if(!isset($reportData)): ?>
                                                        <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $state->id; ?>" <?php echo ($state->id == $reportData->shelter->states_id) ? 'selected':''; ?>>
                                                            <?php echo $state->name; ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="">Select a shelter</label>
                                            <?php if(!isset($reportData)): ?>
                                                <select class="form-control shelters-select" disabled name="shelter">
                                                    <option label="Choose one"> </option>
                                                </select>
                                            <?php else: ?>
                                                <select class="form-control shelters-select" name="shelter">
                                                    <?php foreach($sheltersState as $item): ?>
                                                        <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $reportData->shelter->id) ? 'selected':''; ?>>
                                                            <?php echo $item->shelter_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- Row end -->

            <?php if(isset($reportData)): ?>
                <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="card custom-card" id="shelter-report-container">
                            <div class="card-header p-3 pl-0 tx-18 my-auto tx-white bg-primary">
                                Shelter Details
                            </div>
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-md-12 mb-3">
                                        <h2 id="shelter-name"><?php echo $reportData->shelter->shelter_name; ?></h2>
                                        <input name="shelter_id" type="hidden" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="">State</h6>
                                        <p id="shelter-state" class="card-text"><?php echo $reportData->shelter->state_name; ?></p>
                                        <h6 class="">Address</h6>
                                        <p id="shelter-address" class="card-text">-</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="">Phone</h6>
                                        <p id="shelter-phone" class="card-text"><?php echo $reportData->shelter->phone_numner; ?></p>
                                        <h6 class="">Website</h6>
                                        <a href="<?php echo $reportData->shelter->website; ?>" id="shelter-website" class="card-text"><?php echo $reportData->shelter->website; ?></a>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 border mt-3">
                                        <div class="mt-3">
                                            <div class="row row-sm">
                                                <div class="col-md-12">
                                                    <h6 class="main-content-label mb-1">Report Details</h6>
                                                    <p class="text-muted card-sub-title">View the report of the shelter.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if(!empty($reportData->shelter->report_data)): $data = $reportData->shelter->report_data; ?>
                                            <table id="shelter-report-table" class="table table-bordered" style="width: 100% !important;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Transfers In</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Transfers Out</th>
                                                    <th></th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th class="tx-12">Year</th>
                                                    <th>Received</th>
                                                    <th>Returned</th>
                                                    <th>Placed</th>
                                                    <th>Euthanized</th>
                                                    <th>Transfers In</th>
                                                    <th><small>Within the Area</small></th>
                                                    <th><small>Outside the Area</small></th>
                                                    <th>Transfers Out</th>
                                                    <th><small>Within the Area</small></th>
                                                    <th><small>Outside the Area</small></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data as $animal): ?>
                                                    <?php if(!empty($animal->data)): ?>
                                                        <tr class="table-secondary">
                                                        <th><strong><?php echo $animal->animal_name; ?></strong></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                        <?php foreach ($animal->data as $item): ?>
                                                        <tr>
                                                            <td><strong><?php echo $item->year; ?></strong></td>
                                                            <td><?php echo $item->received; ?></td>
                                                            <td><?php echo $item->returned; ?></td>
                                                            <td><?php echo $item->placed; ?></td>
                                                            <td><?php echo $item->euthanized; ?></td>
                                                            <td><?php echo $item->transfered; ?></td>
                                                            <td><?php echo $item->transfered_in_within_area; ?></td>
                                                            <td><?php echo $item->transfered_in_outside_area; ?></td>
                                                            <td><?php echo $item->transfered_out; ?></td>
                                                            <td><?php echo $item->transfered_out_within_area; ?></td>
                                                            <td><?php echo $item->transfered_out_outside_area; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                        <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php else: ?>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Main Content-->

<!-- MODALS -->

<div class="modal" id="shelters-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Select a shelter</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table" id="table-shelters-report">
                    <thead>
                    <tr>
                        <th class="wd-70p">Shelter Name</th>
                        <th class="wd-25p">State</th>
                        <th class="wd-5p"></th>
                    </tr>
                    </thead>

                </table>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
