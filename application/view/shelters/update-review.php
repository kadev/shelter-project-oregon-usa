<!-- Main Content-->
<style>
    .ff_fileupload_disabled .ff_fileupload_dropzone{
        pointer-events: none;
    }
</style>
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Update review: <?php echo (isset($shelter->shelter_name)) ? $shelter->shelter_name : '' ; ?> </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>shelters">Shelters</a></li>
                        <li class="breadcrumb-item">Shelter Updates</li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $shelter->shelter_name; ?></li>
                    </ol>
                </div>

                <div class="d-flex">
                    <div class="justify-content-center">
                        <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                            <?php if($shelter->request_status == 'pending'): ?>
                                <a id="approve-update" href="javascript:void(0);" data-update="<?php echo $shelter->id; ?>" type="button" class="btn btn-success my-2 btn-icon-text">
                                    <i class="fe fe-check mr-2"></i> Approve
                                </a>
                                <a id="decline-update" href="javascript:void(0);" data-update="<?php echo $shelter->id; ?>" type="button" class="btn btn-danger my-2 btn-icon-text">
                                    <i class="fe fe-x mr-2"></i> Decline
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($shelter->request_status == 'pending'): ?>
                            <a id="disabled-editing" href="javascript:void(0);" type="button" class="btn btn-dark my-2 btn-icon-text" style="display:none;">
                                <i class="fe fe-x mr-2"></i> Cancel edit
                            </a>
                            <a id="enable-editing" href="javascript:void(0);" type="button" class="btn btn-primary my-2 btn-icon-text">
                                <i class="fe fe-edit mr-2"></i> Edit
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <form id="form-edit-shelter-update" class="">
                <div class="row row-sm">
                <?php if(!empty($shelter) AND $shelter != NULL): ?>
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card" style="border: 4px solid
                            <?php echo ($shelter->request_status == "pending") ? " lightskyblue" : ""; ?>
                            <?php echo ($shelter->request_status == "approved") ? " #19b159" : ""; ?>
                            <?php echo ($shelter->request_status == "declined") ? " #fd6074" : ""; ?>
                        ;">
                            <div class="card-body">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div>
                                        <h6 class="main-content-label mb-1">Update Review
                                            <?php if($shelter->request_status == "pending"): ?>
                                                <span class="badge badge-warning">Pending</span>
                                            <?php elseif($shelter->request_status == "approved"): ?>
                                                <span class="badge badge-success">Approved</span>
                                            <?php elseif($shelter->request_status == "declined"): ?>
                                                <span class="badge badge-danger">Declined</span>
                                            <?php endif; ?>
                                        </h6>
                                        <p class="text-muted card-sub-title">View the requested shelter update, and approve or decline. </p>
                                    </div>

                                    <div class="alert
                                        <?php echo ($shelter->request_status == "pending") ? " alert-outline-info" : ""; ?>
                                        <?php echo ($shelter->request_status == "approved") ? " alert-outline-success" : ""; ?>
                                        <?php echo ($shelter->request_status == "declined") ? " alert-outline-danger" : ""; ?>
                                    " role="alert">
                                        <strong>Update information</strong> This request has been created by: <strong><?php echo \Mini\Libs\Helper::getUsername($shelter->user_id); ?></strong> at <?php echo date('l jS \of F Y h:i:s A', strtotime($shelter->created_at)); ?>.
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
                                                    <div id="container-preview-shelter-logo" style="<?php echo empty($shelter->logo) ? 'display:none;':''; ?>">
                                                        <img id="preview-shelter-logo" src="<?php echo URL ?>/uploads/<?php echo $shelter->logo; ?>" class="img-fluid" style="max-height: 200px;">
                                                        <br>
                                                        <span data-id="<?php echo $shelter->id; ?>" data-input="shelter-logo"
                                                              data-prev-container="#container-preview-shelter-logo" data-upl-container="#fancy-uploader-logo-container"
                                                              class="btn ripple btn-danger mt-3 remove-current-image d-none edit-field" >
                                                                Remove Image
                                                        </span>
                                                    </div>
                                                    <input type="hidden" name="shelter-logo" value="<?php echo $shelter->logo; ?>"/>
                                                    <div id="fancy-uploader-logo-container" class="ff_fileupload_disabled" style="<?php echo !empty($shelter->logo) ? 'display:none;':''; ?>">
                                                        <input id="upload-shelter-logo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'shelters/uploadShelterImage' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 c-upl-image shelter-image-container" data-input="shelter-image">
                                                    <label class="font-weight-semibold">Shelter Image:</label>
                                                    <div id="container-preview-shelter-image" style="<?php echo empty($shelter->image) ? 'display:none;':''; ?>">
                                                        <img id="preview-shelter-image" src="<?php echo URL ?>/uploads/<?php echo $shelter->image; ?>" class="img-fluid" style="max-height: 200px;">
                                                        <br>
                                                        <span data-id="<?php echo $shelter->id; ?>" data-input="shelter-image"
                                                              data-prev-container="#container-preview-shelter-image" data-upl-container="#fancy-uploader-image-container"
                                                              class="btn ripple btn-danger mt-3 remove-current-image d-none edit-field">
                                                            Remove Image
                                                        </span>
                                                    </div>
                                                    <input type="hidden" name="shelter-image" value="<?php echo $shelter->image; ?>"/>
                                                    <div id="fancy-uploader-image-container" class="ff_fileupload_disabled" style="<?php echo !empty($shelter->image) ? 'display:none;':''; ?>">
                                                        <input id="upload-shelter-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'shelters/uploadShelterImage' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="font-weight-semibold">Shelter Name: <span class="tx-danger">*</span></label>
                                                    <input name="shelter-name" class="form-control edit-field" required="" type="text" disabled value="<?php echo $shelter->shelter_name; ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="font-weight-semibold">Contact Name:</label>
                                                    <input name="contact-name" class="form-control edit-field" disabled value="<?php echo $shelter->contact_name; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-12">
                                                    <label class="">Shelter Data: </label>
                                                    <input name="shelter-data" class="form-control edit-field" disabled type="text" value="<?php echo $shelter->shelter_data; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-lg-12 col-md-12">
                            <div id="contact-info-container" class="card custom-card" style="<?php echo ($shelter->address_unknown == 1) ? 'background-color: #f6f6ff;':'' ; ?>">
                                <div class="card-body">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="d-flex">
                                            <div>
                                                <h5 class="main-content-label mb-1">2. Contact Information</h5>
                                                <p class="text-muted card-sub-title">Enter the shelter's contact details.</p>
                                            </div>
                                            <div class="ml-auto">
                                                <label class="ckbox">
                                                    <input class="edit-field" type="checkbox" name="address-unknown" disabled value="1" <?php echo ($shelter->address_unknown == 1) ? 'checked=""':'' ; ?>>
                                                    <span>Address Unknown</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="font-weight-semibold">Contact Title:</label>
                                                    <input name="contact-title" class="form-control edit-field" type="text" disabled value="<?php echo $shelter->contact_title; ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="font-weight-semibold">Street Address:</label>
                                                    <input name="street-address" class="form-control edit-field" disabled value="<?php echo $shelter->street_address; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-3">
                                                    <label class="font-weight-semibold">City:</label>
                                                    <input name="city" class="form-control edit-field" disabled value="<?php echo $shelter->city; ?>">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="font-weight-semibold">State:</label>
                                                    <select name="state" class="form-control edit-field" disabled value="<?php echo $shelter->states_id; ?>">
                                                        <option label="Choose one"> </option>
                                                        <?php foreach ($states as $state): ?>
                                                            <option value="<?php echo $state->id ?>" <?php echo ($shelter->states_id == $state->id) ? 'selected':''; ?>><?php echo $state->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="font-weight-semibold">Zip code:</label>
                                                    <input name="zip-code" class="form-control edit-field" disabled value="<?php echo $shelter->zip; ?>">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="font-weight-semibold">County:</label>
                                                    <select name="county" class="form-control edit-field" disabled value="<?php echo $shelter->county; ?>">
                                                        <option label="Choose one"> </option>
                                                        <?php foreach ($counties as $county): ?>
                                                            <option value="<?php echo $county->Name ?>" <?php echo ($shelter->county == $county->Name) ? 'selected':''; ?>><?php echo $county->Name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Phone Number:</label>
                                                    <input name="phone-number" class="form-control edit-field" disabled value="<?php echo $shelter->phone_number; ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Email Address:</label>
                                                    <input name="email" class="form-control edit-field" disabled value="<?php echo $shelter->email_address; ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Website:</label>
                                                    <input name="website" class="form-control edit-field" disabled value="<?php echo $shelter->website; ?>">
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
                                                    <select name="open-door-shelter" class="form-control edit-field" disabled value="<?php echo $shelter->open_shelter; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option value="1" <?php echo ($shelter->open_shelter == 1) ? 'selected':''; ?>>Yes</option>
                                                        <option value="0" <?php echo ($shelter->open_shelter == 0) ? 'selected':''; ?>>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Type of Shelter:</label>
                                                    <select name="type-shelter" class="form-control edit-field" disabled value="<?php echo $shelter->type_shelter; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option value="non-profit" <?php echo ($shelter->type_shelter == 'non-profit') ? 'selected':''; ?>>Non-profit</option>
                                                        <option value="government" <?php echo ($shelter->type_shelter == 'government') ? 'selected':''; ?>>Government</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Designated as No-kill:</label>
                                                    <select name="designated-no-kill" class="form-control edit-field" disabled value="<?php echo $shelter->designated_no_kill; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option value="1" <?php echo ($shelter->designated_no_kill == 1) ? 'selected':''; ?>>Yes</option>
                                                        <option value="0" <?php echo ($shelter->designated_no_kill == 0) ? 'selected':''; ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Importing Shelter:</label>
                                                    <select name="importing-shelter" class="form-control edit-field" disabled value="<?php echo $shelter->importing_shelter; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option value="1" <?php echo ($shelter->importing_shelter == 1) ? 'selected':''; ?>>Yes</option>
                                                        <option value="0" <?php echo ($shelter->importing_shelter == 0) ? 'selected':''; ?>>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Financials:</label>
                                                    <select name="financials" class="form-control edit-field show-financial-section" disabled value="<?php echo $shelter->financials; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option value="1" <?php echo ($shelter->financials == 1) ? 'selected':''; ?>>Yes</option>
                                                        <option value="0" <?php echo ($shelter->financials == 0) ? 'selected':''; ?>>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="">Type of Entry: </label>
                                                    <select id="" name="type-of-entry" class="form-control">
                                                        <option value="0" <?php echo ($shelter->type_of_entry == 0) ? 'selected':''; ?>>Shelter</option>
                                                        <option value="1" <?php echo ($shelter->type_of_entry == 1) ? 'selected':''; ?>>Maddie's Fund</option>
                                                        <option value="2" <?php echo ($shelter->type_of_entry == 2) ? 'selected':''; ?>>State Totals</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="font-weight-semibold">Published:</label>
                                                    <div id="shelter-published" class="main-toggle main-toggle-success <?php echo ($shelter->published == 1) ?'on':'off'; ?>" data-input="published">
                                                        <span></span>
                                                    </div>
                                                    <input name="published" class="form-control edit-field" type="hidden" disabled value="<?php echo $shelter->published; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="jumbotron pt-3 pb-3 mt-3" id="financial-section" style="<?php echo ($shelter->financials == 0) ? 'display: none;':''; ?>">
                                            <div class="d-flex flex-row justify-content-end">
                                                <h5 class="">Financial Files</h5>

                                                <div class="ml-auto">
                                                <span id="new-financial-file" type="button" class="btn btn-success btn-sm btn-icon-text" data-counter="<?php echo count($financialFiles); ?>" style="display: none;">
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
                                                    <th class="" style="white-space: nowrap; width: 1%;">Actions</th>
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
                                                        <td>
                                                            <div class="btn-icon-list">
                                                                <span data-row="<?php echo $counter; ?>" class="btn ripple btn-info btn-sm edit-financial-file" style="display: none;"><i class="fe fe-edit"></i></span>
                                                                <span data-row="<?php echo $counter; ?>" class="btn ripple btn-danger btn-sm delete-financial-file" style="display: none;"><i class="fe fe-trash"></i></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $counter++; endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Sidebar programs: </label>
                                            <textarea class="edit-field" id="sidebar-programs" name="programs"><?php echo $shelter->programs; ?></textarea>
                                        </div>

                                        <div class="d-flex flex-row-reverse">
                                            <span id="update-request" data-update="<?php echo $shelter->id; ?>" class="btn ripple btn-main-primary edit-field mb-3 mt-5" style="display:none;">Update</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php else: ?>
                    <br>
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-danger" role="alert">
                            The shelter you want to edit does not exist, it was probably recently deleted.
                        </div>
                    </div>
                <?php endif; ?>
            </div><!-- Row end -->
            </form>

        </div>
    </div>
</div>
<!-- End Main Content-->


<div class="modal show" id="add-financial-file-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add new Financial File</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <div class="form-group">
                        <label>Select File Type</label>
                        <div aria-label="Basic example" class="btn btn-group w-100 pl-0 pr-0" role="group">
                            <button class="btn ripple btn-light btn-primary pd-x-25 active change-file-type" data-type="link" type="button">Link</button>
                            <button class="btn ripple btn-light pd-x-25 change-file-type" type="button" data-type="upload-file">Upload File</button>
                            <input type="hidden" name="file-type" value="link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="file-title" placeholder="Enter file title" type="text">
                    </div>
                    <div class="form-group link-container">
                        <label>Link</label>
                        <input class="form-control" name="file-link" placeholder="Enter file link" type="text">
                    </div>
                    <div id="upload-container" class="form-group upload-container" style="display: none; ">
                        <label>Upload File</label>
                        <input id="upload-financial-files" name="file-upload" class="form-control" placeholder="Upload file" type="url">
                        <small class="text-muted card-sub-title">Click here to upload the financial file</small>
                    </div>

                    <input name="upload-link" class="form-control" placeholder="Upload file" type="hidden">


                    <button class="btn ripple btn-main-primary d-none">Submit</button> </div>
            </div>
            <div class="modal-footer">
                <button id="add-financial-file" class="btn ripple btn-primary" type="button">Add</button>
                <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal show" id="edit-financial-file-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit Financial File</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <div class="form-group">
                        <label>Select File Type</label>
                        <div aria-label="Basic example" class="btn btn-group w-100 pl-0 pr-0" role="group">
                            <button class="btn ripple btn-light btn-primary pd-x-25 active change-file-type" data-type="link" type="button">Link</button>
                            <button class="btn ripple btn-light pd-x-25 change-file-type" type="button" data-type="upload-file">Upload File</button>
                            <input type="hidden" name="file-type" value="link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="file-title" placeholder="Enter file title" type="text">
                    </div>
                    <div class="form-group link-container">
                        <label>Link</label>
                        <input class="form-control" name="file-link" placeholder="Enter file link" type="text">
                    </div>
                    <div id="edit-upload-container" class="form-group upload-container" style="display: none;">
                        <label>Upload File</label>
                        <input id="edit-upload-financial-files" name="file-upload" class="form-control" placeholder="Upload file" type="files">
                        <small class="text-muted card-sub-title">Click here to update the financial file</small>
                        <input name="upload-link" class="form-control" placeholder="Upload file" readonly type="text">

                    </div>

                </div>
                <div class="modal-footer">
                    <button id="edit-financial-file" class="btn ripple btn-primary" type="button" data-row="">Edit</button>
                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>