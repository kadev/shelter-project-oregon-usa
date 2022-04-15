<?php use Mini\Libs\Helper; ?>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #3c4858;
    }

    @media only screen and (min-device-width : 2736px) and (max-device-height : 1824px) {
        body {
            zoom: 1.4 !important; /* All browsers */
            -moz-transform: scale(1.3);  /* Firefox */
        }
    }

</style>
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Update Review</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Animal Data</li>
                        <li class="breadcrumb-item active" aria-current="page">Update Review</li>
                    </ol>
                </div>
                <div class="d-flex">
	                <div class="justify-content-center">
                        <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                            <?php if($request->request_status == 'pending'): ?>
				                <a href="javascript:void(0);" type="button" class="btn btn-success my-2 btn-icon-text change-status" data-status="approved">
					                <i class="fe fe-check mr-2"></i> Approve
				                </a>
				                <a href="javascript:void(0);" type="button" class="btn btn-danger my-2 btn-icon-text change-status" data-status="declined">
					                <i class="fe fe-x mr-2"></i> Decline
				                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($request->request_status == 'pending'): ?>
			                <?php if($session['privilege'] == 4): ?>
		                        <a href="javascript:void(0);" type="button" class="btn btn-danger my-2 btn-icon-text change-status" data-status="cancelled">
			                        <i class="fe fe-edit mr-2"></i> Cancel request
		                        </a>
			                <?php endif; ?>
                        <?php endif; ?>
                        <?php if($request->request_status == 'cancelled'): ?>
	                        <?php if($session['privilege'] == 4): ?>
		                        <a href="javascript:void(0);" type="button" class="btn btn-success my-2 btn-icon-text change-status" data-status="pending">
			                        <i class="fe fe-edit mr-2"></i> Send again
		                        </a>
			                <?php endif; ?>
		                <?php endif; ?>
	                </div>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="row row-sm">
	            <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
	                <div class="col-lg-12 col-md-12">
		            <div class="card custom-card" style="border: 4px solid
                    <?php echo ($request->request_status == "pending") ? " lightskyblue" : ""; ?>
                    <?php echo ($request->request_status == "approved") ? " #19b159" : ""; ?>
                    <?php echo ($request->request_status == "declined") ? " #fd6074" : ""; ?>
				            ;">
			            <div class="card-body">
				            <div class="col-md-12 col-lg-12 col-xl-12">
					            <div>
						            <h6 class="main-content-label mb-1">Update Review
                                        <?php if($request->request_status == "pending"): ?>
								            <span class="badge badge-warning">Pending</span>
                                        <?php elseif($request->request_status == "approved"): ?>
								            <span class="badge badge-success">Approved</span>
                                        <?php elseif($shelter->request_status == "declined"): ?>
								            <span class="badge badge-danger">Declined</span>
                                        <?php endif; ?>
						            </h6>
						            <p class="text-muted card-sub-title">View the requested data update, and approve or decline. </p>
					            </div>

					            <div class="alert mb-0
                                        <?php echo ($request->request_status == "pending") ? " alert-outline-info" : ""; ?>
                                        <?php echo ($request->request_status == "approved") ? " alert-outline-success" : ""; ?>
                                        <?php echo ($request->request_status == "declined") ? " alert-outline-danger" : ""; ?>
                                    " role="alert">
						            <strong>Update information</strong> This request has been created by: <strong><?php echo \Mini\Libs\Helper::getUsername($request->user_id); ?></strong> at <?php echo date('l jS \of F Y h:i:s A', strtotime($request->created_at)); ?>.
					            </div>
				            </div>
			            </div>
		            </div>
	            </div>
	            <?php endif; ?>

                <div class="col-lg-12">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="card custom-card" id="shelter-details-container">
                            <div class="card-header p-3 pl-0 tx-18 my-auto tx-white bg-primary">
                                <div class="d-flex">
                                    Shelter Details
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-md-12 mb-3">
                                        <h2 id="shelter-name"><?php echo (isset($shelter)) ? '#' . $shelter->id . ' ' . $shelter->shelter_name:'-'; ?></h2>
	                                    <input name="request_id" type="hidden" value="<?php echo (isset($request)) ? $request->id:''; ?>">
	                                    <input name="shelter_id" type="hidden" value="<?php echo (isset($shelter)) ? $shelter->id:''; ?>">
	                                    <input id="filter-data-by-year" name="year" type="hidden" value="<?php echo (isset($request->year)) ? $request->year:''; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="">State</h6>
                                        <p id="shelter-state" class="card-text"><?php echo (isset($shelter) AND !empty($shelter->states_id)) ? Helper::getStateName($shelter->states_id):'-'; ?></p>
                                        <h6 class="">Address</h6>
                                        <p id="shelter-address" class="card-text"><?php echo (isset($shelter) AND !empty($shelter->street_address)) ? $shelter->street_address:'-'; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="">Phone</h6>
                                        <p id="shelter-phone" class="card-text"><?php echo (isset($shelter) AND !empty($shelter->phone_numner)) ? $shelter->phone_numner:'-'; ?></p>
                                        <h6 class="">Website</h6>
                                        <a href="" id="shelter-website" class="card-text"><?php echo (isset($shelter) AND !empty($shelter->website)) ? $shelter->website:'-'; ?></a>
                                    </div>
                                    <hr>
                                    <div id="animal-data-container" class="col-md-12 border mt-3">
                                        <div class="mt-3">
                                            <div class="d-flex">
                                                <div>
                                                    <h6 class="main-content-label mb-1">Animal Data</h6>
                                                    <p class="text-muted card-sub-title">View and edit the animal data of your site.</p>
                                                </div>

                                                <div class="ml-auto">
                                                    <label class="ckbox w-100 ml-2 d-flex mt-2 mr-auto">
                                                        <input id="no-data-checkbox" type="checkbox" name="no-data" value="1" <?php echo (isset($no_data) AND ($no_data != false) AND ($no_data->status == 1)) ? 'checked':''; ?>>
                                                        <span class="font-weight-bold" style="margin-top: 0.15rem;">No Data For This Year</span>
                                                    </label>
                                                </div>

	                                            <div class="ml-auto">
		                                            <?php if($request->request_status == "pending"): ?>
		                                                <span id="enable-editing" class="btn ripple btn-primary <?php echo (($animalData == NULL) OR (isset($request->no_data_status) AND $request->no_data_status == 1)) ? 'd-none' : ''; ?>"><i class="fe fe-edit"></i> Edit request</span>
		                                            <?php endif; ?>
	                                            </div>
                                            </div>

                                        </div>

                                        <table id="animal-data-table" class="table table-bordered" style="table-layout: fixed;">
                                            <thead>
                                            <tr class="text-center" style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'background-color: rgb(246, 246, 255);' : ''; ?>">
                                                <th style="text-align: left;" colspan="2"><h6 class="mb-0">Data year: <span id="label-year"><?php echo (isset($year)) ? $year : '-'; ?></span></h6></th>
                                                <th colspan="4"></th>
                                                <th colspan="2">Transfers In</th>
                                                <th></th>
                                                <th colspan="2">Transfers Out</th>
                                            </tr>
                                            <tr class="text-center" style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'background-color: rgb(246, 246, 255);' : ''; ?>">
                                                <th class="tx-12">Animal</th>
                                                <th>Received</th>
                                                <th>Return to Owner</th>
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
                                            <!--<label class="label-no-data-activated" style="<?php echo (isset($no_data) AND ($no_data != false) AND $no_data->status == 1) ?'':'display: none;'; ?>">NO DATA FOR THIS YEAR ACTIVATED</label>-->
                                            <form id="form-animal-data">
                                                <tbody>
                                                <?php if(!empty($animalData)): ?>
                                                    <?php if($request->no_data_status != 1): ?>
                                                        <?php foreach ($animalData as $animal => $data): ?>
		                                                    <input type="hidden" name="data[<?php echo $animal; ?>][data_id]" value="<?php echo (!empty($data)) ? $data->data_id : ''; ?>">
		                                                    <tr style="<?php echo (empty($data)) ? 'display:none; ':''; echo (isset($request->no_data_status) and $request->no_data_status == 1) ? 'background-color: rgb(246, 246, 255);' : ''; ?>">
		                                                        <style>.i-animal-data, .i-other-info {color: black !important;}</style>
		                                                        <td style="<?php echo (isset($request->no_data_status) and $request->no_data_status->status == 1) ? 'color: gray;' : ''; ?>"><?php echo Helper::getAnimalName($animal); ?></td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->received:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][received]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->received:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->returned:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][returned]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->returned:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->placed:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][placed]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->placed:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->euthanized:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][euthanized]" class="form-control input-sm i-animal-data d-none " type="text" value="<?php echo (!empty($data)) ? $data->euthanized:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->transfers_in:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][transfers_in]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->transfers_in:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->transfers_in_within_area:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][transfers_in_within_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->transfers_in_within_area:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->transfers_in_outside_area:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][transfers_in_outside_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->transfers_in_outside_area:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->transfers_out:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][transfers_out]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->transfers_out:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->transfers_out_within_area:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][transfers_out_within_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->transfers_out_within_area:'';?>">
		                                                        </td>
		                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
		                                                            <span class="label-animal-data"><?php echo (!empty($data)) ? $data->transfers_out_outside_area:'';?></span>
		                                                            <input name="data[<?php echo $animal; ?>][transfers_out_outside_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($data)) ? $data->transfers_out_outside_area:'';?>">
		                                                        </td>
		                                                    </tr>
                                                        <?php endforeach; ?>
	                                                <?php else: ?>
		                                                <tr>
			                                                <td class="label-no-data-activated text-center d-none" colspan="11">
				                                                <label class="mb-0">NO DATA FOR THIS YEAR ACTIVATED</label>
			                                                </td>
		                                                </tr>
                                                    <?php endif; ?>
                                                <?php else: ?>
	                                                <tr class="message-error">
		                                                <td colspan="11">
			                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
				                                                <strong>No data found for this year!</strong>, try another or <a class="create-animal-data" href="#">create</a> data for this year.
			                                                </div>
		                                                </td>
	                                                </tr>
                                                <?php endif; ?>
                                                </tbody>
                                                <tfoot>
                                                <tr style="<?php echo ($animal_data == NULL) ? 'display:none; ':''; echo (isset($no_data) and $no_data->status == 1) ? 'background-color: rgb(246, 246, 255);' : ''; ?>">
                                                    <td class="tx-bold" style="<?php echo (isset($request->no_data_status) and $request->no_data_status == 1) ? 'color: gray;' : ''; ?>">Population</td>
                                                    <td colspan="10" style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                        <span class="label-other-info"><?php echo (isset($request->population)) ? $request->population:''; ?></span>
                                                        <input id="population" name="population" class="form-control input-sm d-none i-other-info" type="text" value="<?php echo (isset($request->population)) ? $request->population:''; ?>">
                                                    </td>
                                                </tr>
                                                <tr style="<?php echo ($animalData == NULL) ? 'display:none; ':''; ?>" data-block="false">
                                                    <td class="tx-bold">Comments</td>
                                                    <td colspan="10">
                                                        <span class="label-other-info label-comments" style="white-space: pre;"><?php echo (isset($request->note)) ? $request->note:''; ?></span>
                                                        <textarea id="notes" class="form-control i-other-info d-none" name="notes" rows="10"><?php echo (isset($request->note)) ? $request->note:''; ?></textarea>

	                                                    <?php if($request->request_status == "pending"): ?>
	                                                        <div class="mt-4">
	                                                            <span id="disable-edit-comments" class="btn btn-sm ripple btn-warning comment-button" style="display:none;"><i class="fe fe-edit"></i> Cancel edit</span>
	                                                            <span id="update-comments" class="btn btn-sm ripple btn-success comment-button" style="display:none;"><i class="fe fe-edit"></i> Update comments</span>
	                                                            <span id="enable-edit-comments" class="btn btn-sm ripple btn-primary comment-button d-none" style="<?php echo (isset($no_data) and $no_data->status == 1) ? '' : 'display:none;'; ?>"><i class="fe fe-edit"></i> Enabled editing</span>
	                                                        </div>
	                                                    <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php if($request->request_status == "pending"): ?>
	                                                <tr>
	                                                    <td colspan="11">
	                                                        <span id="disable-editing" class="btn ripple btn-warning d-none"><i class="fe fe-edit"></i> cancel edit</span>
	                                                        <span id="update-request" class="btn ripple btn-success d-none"><i class="fe fe-edit"></i>Update request</span>
	                                                    </td>
	                                                </tr>
                                                <?php endif; ?>
                                                </tfoot>
                                            </form>
                                        </table>

                                    </div>
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

<!-- MODALS -->

<div class="modal" id="shelters-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Select a shelter</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table w-100" id="table-search-shelters" style="position: relative; table-layout: fixed;">
                    <thead>
                    <tr>
                        <th class="wd-95p">Shelter Name</th>
                        <th class="wd-5p" style="width: 5% !important; max-width: 34px !important;"></th>
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