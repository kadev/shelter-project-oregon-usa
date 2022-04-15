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
                    <h2 class="main-content-title tx-24 mg-b-5">Animal Data</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Animal Data</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center mt-2">
                        <select id="filter-shelters-by-year" class="form-control select2" placeholder="Filter Shelters by Active Year">
                            <option label="Filter Shelters by Active Year" value="0" selected>Filter Shelters by Active Year</option>
                            <?php for($i = date('Y'); $i >= 1970; $i--): ?>
                                <option label="<?php echo $i; ?>" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="justify-content-center ml-3">
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
                    <div class="card custom-card overflow-hidden" id="search-data-container">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Search by State</h6>
                                <p class="text-muted card-sub-title">Filter the shelters by state and select one to view the animal data.</p>
                            </div>
                            <form id="form-create-article">
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-sm-6">
                                            <label class="">Select one state</label>
                                            <select class="form-control states-select" name="state">
                                                <option label="Choose one"> </option>
                                                <?php foreach ($states as $state): ?>
                                                    <option value="<?php echo $state->id; ?>" <?php echo (isset($shelter) AND $shelter->states_id == $state->id) ? 'selected':''; ?>>
                                                        <?php echo $state->name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="">Select a shelter</label>
                                            <select class="form-control shelters-select" name="shelter"
                                                    <?php echo (isset($shelter)) ? '':' disabled'; ?>
                                            >
                                                <option label="Choose one"> </option>
                                                <?php if(isset($shelter)): ?>
                                                    <?php foreach ($shelters as $item): ?>
                                                        <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $shelter->id) ? 'selected':''; ?>><?php echo $item->shelter_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <small id="no-shelters-found-message" class="pl-1" style="color: red; display:none;">No shelters found, try again with another state.</small>
                                        </div>


                                    </div>
                                </div>

                                <span id="create-article" class="btn ripple btn-main-primary d-none">Create</span>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="card custom-card" style="<?php echo (isset($shelter)) ? '':'display:none;'; ?>" id="shelter-details-container">
                            <div class="card-header p-3 pl-0 tx-18 my-auto tx-white bg-primary">
                                <div class="d-flex">
                                    Shelter Details
                                    <div class="ml-auto">
                                        <span id="reload-shelter-data" class="badge badge-light" style="font-weight: 600;font-size: 12px; cursor: pointer;">Reload Shelter Data</span>

                                        <a id="go-shelter-activity" class="badge badge-light" href="#" style="font-weight: 600;font-size: 12px;">Go Activity Log</a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-md-12 mb-3">
                                        <h2 id="shelter-name"><?php echo (isset($shelter)) ? '#' . $shelter->id . ' ' . $shelter->shelter_name:'-'; ?></h2>
                                        <input name="shelter_id" type="hidden" value="<?php echo (isset($shelter)) ? $shelter->id:''; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="">State</h6>
                                        <p id="shelter-state" class="card-text"><?php echo (isset($shelter) AND !empty($shelter->states_id)) ? $State->getStateNameById($shelter->states_id):'-'; ?></p>
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
                                                    <div class="d-flex">
                                                        <select id="filter-data-by-year" class="form-control year-select" style="color: black;" name="year">
                                                            <?php for($i = date("Y"); $i >= 1972 ; $i--): ?>
                                                                <option value="<?php echo $i; ?>" <?php echo (isset($year) AND $year == $i) ? 'selected':''; ?>><?php echo $i; ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
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
                                            <?php $i = 0; $numberOfAnimals = count($animals);?>
                                            <?php foreach ($animals as $animal): ?>
                                                <?php if(isset($shelter) AND isset($year)):
                                                        $animal_data = $AnimalData->getByAnimalShelterIDAndYear($animal->id, $shelter->id, $year);
                                                    else:
                                                        $animal_data = NULL;
                                                    endif;
                                                ?>

                                                <?php if(intval($numberOfAnimals / 2) == $i): ?>
                                                    <tr>
                                                        <td class="label-no-data-activated text-center" style="<?php echo (isset($no_data) AND ($no_data != false) AND $no_data->status == 1) ?'':'display: none;'; ?>" colspan="11">
                                                            <label class="mb-0">NO DATA FOR THIS YEAR ACTIVATED</label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                                    <input type="hidden" name="data[<?php echo $animal->id; ?>][data_id]" value="<?php echo (!empty($animal_data)) ? $animal_data->data_id : ''; ?>">
                                                    <tr style="<?php echo (empty($animal_data)) ? 'display:none; ':''; echo (isset($no_data) and $no_data->status == 1) ? 'background-color: rgb(246, 246, 255);' : ''; ?>">
                                                        <style>.i-animal-data, .i-other-info {color: black !important;}</style>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>"><?php echo $animal->name; ?></td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->received:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][received]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->received:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->returned:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][returned]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->returned:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->placed:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][placed]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->placed:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->euthanized:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][euthanized]" class="form-control input-sm i-animal-data d-none " type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->euthanized:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->transfered:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][transfers_in]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->transfered:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->transfered_in_within_area:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][transfers_in_within_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->transfered_in_within_area:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->transfered_in_outside_area:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][transfers_in_outside_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->transfered_in_outside_area:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->transfered_out:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][transfers_out]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->transfered_out:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->transfered_out_within_area:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][transfers_out_within_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->transfered_out_within_area:'';?>">
                                                        </td>
                                                        <td style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                            <span class="label-animal-data"><?php echo (!empty($animal_data)) ? $animal_data->transfered_out_outside_area:'';?></span>
                                                            <input name="data[<?php echo $animal->id; ?>][transfers_out_outside_area]" class="form-control input-sm i-animal-data d-none" type="text" value="<?php echo (!empty($animal_data)) ? $animal_data->transfered_out_outside_area:'';?>">
                                                        </td>
                                                    </tr>
                                            <?php $i++; endforeach; ?>
                                                <tr class="message-error" style="<?php echo (!empty($animal_data)) ? 'display: none;':''; ?>">
                                                    <td colspan="11">
                                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                            <strong>No data found for this year!</strong>, try another or <a class="create-animal-data" href="#">create</a> data for this year.
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr style="<?php echo ($animal_data == NULL) ? 'display:none; ':''; echo (isset($no_data) and $no_data->status == 1) ? 'background-color: rgb(246, 246, 255);' : ''; ?>">
                                                <td class="tx-bold" style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">Population</td>
                                                <td colspan="10" style="<?php echo (isset($no_data) and $no_data->status == 1) ? 'color: gray;' : ''; ?>">
                                                    <span class="label-other-info"><?php echo (isset($shelter_population)) ? $shelter_population->Population:''; ?></span>
                                                    <input id="population" name="population" class="form-control input-sm d-none i-other-info" type="text" value="<?php echo (isset($shelter_population)) ? $shelter_population->Population:''; ?>">
                                                    <input name="population_id" class="form-control input-sm d-none" type="hidden" value="<?php echo (isset($shelter_population)) ? $shelter_population->id:''; ?>">
                                                </td>
                                            </tr>
                                            <tr style="<?php echo ($animal_data == NULL) ? 'display:none; ':''; ?>" data-block="false">
                                                <td class="tx-bold">Comments</td>
                                                <td colspan="10">
                                                    <span class="label-other-info label-comments" style="white-space: pre;"><?php echo (isset($shelter_notes)) ? $shelter_notes->note:''; ?></span>
                                                    <textarea id="notes" class="form-control i-other-info d-none" name="notes" rows="10"><?php echo (isset($shelter_notes)) ? $shelter_notes->note:''; ?></textarea>
                                                    <input name="notes_id" class="form-control input-sm d-none" type="hidden" value="<?php echo (isset($shelter_notes)) ? $shelter_notes->note_id:''; ?>">

                                                    <div class="mt-4">
                                                        <span id="disable-edit-comments" class="btn btn-sm ripple btn-warning comment-button" style="display:none;"><i class="fe fe-edit"></i> Cancel edit</span>
                                                        <span id="update-comments" class="btn btn-sm ripple btn-success comment-button" style="display:none;"><i class="fe fe-edit"></i> Update comments</span>
                                                        <span id="enable-edit-comments" class="btn btn-sm ripple btn-primary comment-button" style="<?php echo (isset($no_data) and $no_data->status == 1) ? '' : 'display:none;'; ?>"><i class="fe fe-edit"></i> Enabled editing</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="11">
                                                    <span id="enable-editing" class="btn ripple btn-primary <?php echo (($animal_data == NULL) OR (isset($no_data) AND $no_data->status == 1)) ? 'd-none' : ''; ?>"><i class="fe fe-edit"></i> Enable editing</span>
                                                    <span id="disable-editing" class="btn ripple btn-warning d-none"><i class="fe fe-edit"></i> cancel edit</span>
                                                    <span id="update-data" class="btn ripple btn-success d-none"><i class="fe fe-edit"></i> Update data</span>
                                                    <span id="save-data" class="btn ripple btn-success d-none"><i class="fe fe-edit"></i> Create data</span>
                                                </td>
                                            </tr>
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