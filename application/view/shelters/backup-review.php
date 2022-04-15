<style>
    #shelter-published{
        pointer-events: none;
    }
</style>

<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Backup review: <?php echo (isset($backup->shelter_name)) ? $backup->shelter_name : '' ; ?> </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>shelters">Shelters</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>shelters"><?php echo $backup->shelter_name; ?></a></li>
                        <li class="breadcrumb-item">Backup Review: #<?php echo $backup->id; ?></li>
                    </ol>
                </div>

                <div class="d-flex">
                    <div class="justify-content-center">
                        <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                            <a id="restore-backup" href="javascript:void(0);" data-backup="<?php echo $backup->id; ?>" type="button" class="btn btn-primary my-2 btn-icon-text">
                                <i class="fe fe-rotate-ccw mr-2"></i> Restore
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <form id="form-edit-shelter-backup" class="">
                <div class="row row-sm">
                    <?php if(!empty($backup) AND $backup != NULL): ?>
                        <div class="col-lg-12 col-md-12">
                        <div class="card custom-card" style="border: 4px solid orange;">
                            <div class="card-body">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div>
                                        <h6 class="main-content-label mb-1">Backup Review</h6>
                                        <p class="text-muted card-sub-title">View and restore this backup. </p>
                                    </div>

                                    <div class="alert alert-outline-warning" role="alert">
                                        <strong>Backup information</strong> This backup has been created by: <strong><?php echo \Mini\Libs\Helper::getUsername($backup->user_id); ?></strong> at <?php echo date('l jS \of F Y h:i:s A', strtotime($backup->created_at)); ?>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-12 col-md-12">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div>
                                                <h6 class="main-content-label mb-1">1. Shelter</h6>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-6 c-upl-image shelter-logo-container" data-input="shelter-logo">
                                                        <label class="font-weight-semibold">Shelter logo:</label>
                                                        <div id="container-preview-shelter-logo" style="<?php echo empty($backup->logo) ? 'display:none;':''; ?>">
                                                            <img id="preview-shelter-logo" src="<?php echo URL ?>/uploads/<?php echo $backup->logo; ?>" class="img-fluid" style="max-height: 200px;">
                                                            <br>
                                                            <!--<span data-id="<?php echo $backup->id; ?>" data-input="shelter-logo"
                                                      data-prev-container="#container-preview-shelter-logo" data-upl-container="#fancy-uploader-logo-container"
                                                      class="btn ripple btn-danger mt-3 remove-current-image d-none edit-field" >
                                                        Remove Image
                                                </span>-->
                                                        </div>
                                                        <!--<input type="hidden" name="shelter-logo" value="<?php echo $backup->logo; ?>"/>
                                            <div id="fancy-uploader-logo-container" style="<?php echo !empty($shelter->logo) ? 'display:none;':''; ?>">
                                                <input id="upload-shelter-logo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'shelters/uploadShelterImage' ?>">
                                            </div>-->
                                                    </div>
                                                    <div class="col-sm-6 c-upl-image shelter-image-container" data-input="shelter-image">
                                                        <label class="font-weight-semibold">Shelter Image:</label>
                                                        <div id="container-preview-shelter-image" style="<?php echo empty($backup->image) ? 'display:none;':''; ?>">
                                                            <img id="preview-shelter-image" src="<?php echo URL ?>/uploads/<?php echo $backup->image; ?>" class="img-fluid" style="max-height: 200px;">
                                                            <br>
                                                            <!--<span data-id="<?php echo $backup->id; ?>" data-input="shelter-image"
                                                      data-prev-container="#container-preview-shelter-image" data-upl-container="#fancy-uploader-image-container"
                                                      class="btn ripple btn-danger mt-3 remove-current-image d-none edit-field">
                                                    Remove Image
                                                </span>-->
                                                        </div>
                                                        <!--<input type="hidden" name="shelter-image" value="<?php echo $backup->image; ?>"/>
                                            <div id="fancy-uploader-image-container" style="<?php echo !empty($shelter->image) ? 'display:none;':''; ?>">
                                                <input id="upload-shelter-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'shelters/uploadShelterImage' ?>">
                                            </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-6">
                                                        <label class="font-weight-semibold">Shelter Name: <span class="tx-danger">*</span></label>
                                                        <input name="shelter-name" class="form-control edit-field" required="" type="text" disabled value="<?php echo $backup->shelter_name; ?>">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="font-weight-semibold">Contact Name:</label>
                                                        <input name="contact-name" class="form-control edit-field" disabled value="<?php echo $backup->contact_name; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-12">
                                                        <label class="">Shelter Data: </label>
                                                        <input name="shelter-data" class="form-control edit-field" disabled type="text" value="<?php echo $backup->shelter_data; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="col-lg-12 col-md-12">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="d-flex">
                                                <div>
                                                    <h5 class="main-content-label mb-1">2. Contact Information</h5>
                                                    <p class="text-muted card-sub-title">Enter the shelter's contact details.</p>
                                                </div>
                                                <div class="ml-auto">
                                                    <label class="ckbox"><input disabled type="checkbox" name="address-unknown" value="1" <?php echo ($backup->address_unknown == 1) ? 'checked=""':'' ; ?>><span>Address Unknown</span></label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-6">
                                                        <label class="font-weight-semibold">Contact Title:</label>
                                                        <input name="contact-title" class="form-control edit-field" type="text" disabled value="<?php echo $backup->contact_title; ?>">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="font-weight-semibold">Street Address:</label>
                                                        <input name="street-address" class="form-control edit-field" disabled value="<?php echo $backup->street_address; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-3">
                                                        <label class="font-weight-semibold">City:</label>
                                                        <input name="city" class="form-control edit-field" disabled value="<?php echo $backup->city; ?>">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="font-weight-semibold">State:</label>
                                                        <select name="state" class="form-control edit-field" disabled value="<?php echo $backup->states_id; ?>">
                                                            <option label="Choose one"> </option>
                                                            <?php foreach ($states as $state): ?>
                                                                <option value="<?php echo $state->id ?>" <?php echo ($backup->states_id == $state->id) ? 'selected':''; ?>><?php echo $state->name ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="font-weight-semibold">Zip code:</label>
                                                        <input name="zip-code" class="form-control edit-field" disabled value="<?php echo $backup->zip; ?>">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="font-weight-semibold">County:</label>
                                                        <select name="county" class="form-control edit-field" disabled value="<?php echo $backup->county; ?>">
                                                            <option label="Choose one"> </option>
                                                            <?php foreach ($counties as $county): ?>
                                                                <option value="<?php echo $county->Name ?>" <?php echo ($backup->county == $county->Name) ? 'selected':''; ?>><?php echo $county->Name ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Phone Number:</label>
                                                        <input name="phone-number" class="form-control edit-field" disabled value="<?php echo $backup->phone_number; ?>">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Email Address:</label>
                                                        <input name="email" class="form-control edit-field" disabled value="<?php echo $backup->email_address; ?>">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Website:</label>
                                                        <input name="website" class="form-control edit-field" disabled value="<?php echo $backup->website; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="col-lg-12 col-md-12">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div>
                                                <h6 class="main-content-label mb-1">3. Shelter Type</h6>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Open Door Shelter:</label>
                                                        <select name="open-door-shelter" class="form-control edit-field" disabled value="<?php echo $backup->open_shelter; ?>">
                                                            <option label="Choose one"> </option>
                                                            <option value="1" <?php echo ($backup->open_shelter == 1) ? 'selected':''; ?>>Yes</option>
                                                            <option value="0" <?php echo ($backup->open_shelter == 0) ? 'selected':''; ?>>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Type of Shelter:</label>
                                                        <select name="type-shelter" class="form-control edit-field" disabled value="<?php echo $backup->type_shelter; ?>">
                                                            <option label="Choose one"> </option>
                                                            <option value="non-profit" <?php echo ($backup->type_shelter == 'non-profit') ? 'selected':''; ?>>Non-profit</option>
                                                            <option value="government" <?php echo ($backup->type_shelter == 'government') ? 'selected':''; ?>>Government</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Designated as No-kill:</label>
                                                        <select name="designated-no-kill" class="form-control edit-field" disabled value="<?php echo $backup->designated_no_kill; ?>">
                                                            <option label="Choose one"> </option>
                                                            <option value="1" <?php echo ($backup->designated_no_kill == 1) ? 'selected':''; ?>>Yes</option>
                                                            <option value="0" <?php echo ($backup->designated_no_kill == 0) ? 'selected':''; ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Importing Shelter:</label>
                                                        <select name="importing-shelter" class="form-control edit-field" disabled value="<?php echo $backup->importing_shelter; ?>">
                                                            <option label="Choose one"> </option>
                                                            <option value="1" <?php echo ($backup->importing_shelter == 1) ? 'selected':''; ?>>Yes</option>
                                                            <option value="0" <?php echo ($backup->importing_shelter == 0) ? 'selected':''; ?>>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Financials:</label>
                                                        <select name="financials" class="form-control edit-field" disabled value="<?php echo $backup->financials; ?>">
                                                            <option label="Choose one"> </option>
                                                            <option value="1" <?php echo ($backup->financials == 1) ? 'selected':''; ?>>Yes</option>
                                                            <option value="0" <?php echo ($backup->financials == 0) ? 'selected':''; ?>>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="">Type of Entry: </label>
                                                        <select id="" name="type-of-entry" class="form-control">
                                                            <option value="0" <?php echo ($backup->type_of_entry == 0) ? 'selected':''; ?>>Shelter</option>
                                                            <option value="1" <?php echo ($backup->type_of_entry == 1) ? 'selected':''; ?>>Maddie's Fund</option>
                                                            <option value="2" <?php echo ($backup->type_of_entry == 2) ? 'selected':''; ?>>State Totals</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="font-weight-semibold">Published:</label>
                                                        <div id="shelter-published" class="main-toggle main-toggle-success <?php echo ($backup->published == 1) ?'on':'off'; ?>" data-input="published">
                                                            <span></span>
                                                        </div>
                                                        <input name="published" class="form-control edit-field" type="hidden" disabled value="<?php echo $backup->published; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="jumbotron pt-3 pb-3 mt-3" id="financial-section" style="<?php echo ($backup->financials == 0) ? 'display: none;':''; ?>">
                                                <div class="d-flex flex-row justify-content-end">
                                                    <h5 class="">Financial Files</h5>

                                                    <div class="ml-auto">
                                                <span id="new-financial-file" type="button" class="btn btn-success btn-sm btn-icon-text d-none" data-counter="<?php echo count($financialFiles); ?>">
                                                    <i class="fe fe-plus mr-2"></i> New file
                                                </span>
                                                    </div>
                                                </div>
                                                <hr class="my-2">
                                                <table class="table  text-nowrap text-md-nowrap table-bordered mg-b-0" id="manage-financial-files-table">
                                                    <thead class="thead-dark" style="border: 1px solid #3b4863">
                                                    <tr>
                                                        <th style="white-space: nowrap; width: 1%;">#</th>
                                                        <th>Title</th>
                                                        <th>File</th>
                                                        <th class="d-none" style="white-space: nowrap; width: 1%;">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="empty-message" style="<?php echo (!empty($financialFiles)) ? 'display:none;':''; ?>">
                                                        <td colspan="4" class="text-center font-weight-bold">No related files</td>
                                                    </tr>
                                                    <?php $counter = 1; foreach ($financialFiles as $file): ?>
                                                        <tr data-row="<?php echo $counter; ?>">
                                                            <th scope="row">
                                                                <span class="th-row"><?php echo $counter; ?></span>
                                                                <input name="financialfiles[<?php echo $counter-1; ?>][type]" type="hidden" value="<?php echo $file->type; ?>">
                                                            </th>
                                                            <td>
                                                                <span class="title-label"><?php echo $file->title; ?></span>
                                                                <input name="financialfiles[<?php echo $counter-1; ?>][title]" type="hidden" value="<?php echo $file->title; ?>">
                                                            </td>
                                                            <td class="td-ellipsis">
                                                                <a class="file-label" href="<?php echo $file->link; ?>" target="_blank"><?php echo $file->link; ?></a>
                                                                <input name="financialfiles[<?php echo $counter-1; ?>][file]" type="hidden" value="<?php echo $file->link; ?>">
                                                            </td>
                                                            <td class="d-none">
                                                                <div class="btn-icon-list">
                                                                    <span data-row="<?php echo $counter; ?>" class="btn ripple btn-info btn-sm edit-financial-file"><i class="fe fe-edit"></i></span>
                                                                    <span data-row="<?php echo $counter; ?>" class="btn ripple btn-danger btn-sm delete-financial-file"><i class="fe fe-trash"></i></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $counter++; endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="form-group">
                                                <label class="">Sidebar programs: </label>
                                                <textarea id="sidebar-programs" disabled name="programs"><?php echo $backup->programs; ?></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php else: ?>
                        <div class="col-lg-12 col-md-12">
                            <br>
                            <div class="alert alert-danger" role="alert">
                                The backup you want to view does not exist, it was probably recently deleted.
                            </div>
                        </div>
                    <?php endif; ?>
                </div><!-- Row end -->
            </form>
        </div>
    </div>
</div>
<!-- End Main Content-->
