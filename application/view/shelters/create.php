<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Create Shelter</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>shelters">Shelters</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Shelter</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <form id="form-create-shelter" class="" autocomplete="off">

                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div>
                                            <h5 class="main-content-label mb-1">1. Shelter</h5>
                                            <p class="text-muted card-sub-title">Enter the required fields to create the new shelter.</p>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6 c-upl-image shelter-logo-container" data-input="shelter-logo">
                                                    <label class="">Shelter logo: </label>
                                                    <input type="hidden" name="shelter-logo" />
                                                    <input id="upload-shelter-logo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'shelters/uploadArticleImage' ?>">
                                                    <small class="text-muted card-sub-title">Click here to upload the shelter logo</small>
                                                </div>
                                                <div class="col-sm-6 c-upl-image shelter-image-container" data-input="shelter-image">
                                                    <label class="">Shelter Image: </label>
                                                    <input type="hidden" name="shelter-image" />
                                                    <input id="upload-shelter-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'shelters/uploadArticleImage' ?>">
                                                    <small class="text-muted card-sub-title">Click here to upload the shelter image</small>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Shelter Name: <span class="tx-danger">*</span></label>
                                                    <input name="shelter-name" class="form-control" required="" type="text" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Contact Name: </label>
                                                    <input name="contact-name" class="form-control" placeholder="Type here...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-12">
                                                    <label class="">Shelter Data: </label>
                                                    <input name="shelter-data" class="form-control" type="text" placeholder="Type here...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-lg-12 col-md-12">
                            <div id="contact-info-container" class="card custom-card">
                                <div class="card-body">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
	                                    <div class="d-flex">
		                                    <div>
			                                    <h5 class="main-content-label mb-1">2. Contact Information</h5>
			                                    <p class="text-muted card-sub-title">Enter the shelter's contact details.</p>
		                                    </div>
		                                    <div class="ml-auto">
			                                    <label class="ckbox"><input type="checkbox" name="address-unknown" value="1"><span>Address Unknown</span></label>
		                                    </div>
	                                    </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Contact Title: </label>
                                                    <input name="contact-title" class="form-control" type="text" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Street Address: </label>
                                                    <input name="street-address" class="form-control" placeholder="Type here...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-3">
                                                    <label class="">City: </label>
                                                    <input name="city" class="form-control" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="">State: </label>
                                                    <select id="select-state" name="state" class="form-control">
                                                        <option label="Choose one"> </option>
                                                        <?php foreach ($states as $state): ?>
                                                            <option value="<?php echo $state->id ?>"><?php echo $state->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="">Zip code: </label>
                                                    <input name="zip-code" class="form-control" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="">County: </label>
                                                    <select id="select-county" name="county" disabled class="form-control">
                                                        <option label="Choose one"> </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-4">
                                                    <label class="">Phone Number: </label>
                                                    <input name="phone-number" class="form-control" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="">Email Address: </label>
                                                    <input name="email" class="form-control" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="">Website: </label>
                                                    <input name="website" class="form-control" placeholder="Type here...">
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
                                        <h5 class="main-content-label mb-1">3. Shelter Type</h5>
                                        <p class="text-muted card-sub-title">Enter the information of the type of shelter.</p>
                                    </div>

                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-4">
                                                <label class="">Open Door Shelter:</label>
                                                <select name="open-door-shelter" class="form-control">
                                                    <option label="Choose one"> </option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="">Type of Shelter: </label>
                                                <select name="type-shelter" class="form-control">
                                                    <option label="Choose one"> </option>
                                                    <option value="non-profit">Non-profit</option>
                                                    <option value="government">Government</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="">Designated as No-kill: </label>
                                                <select name="designated-no-kill" class="form-control">
                                                    <option label="Choose one"> </option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">

                                            <div class="col-sm-4">
                                                <label class="">Importing Shelter: </label>
                                                <select name="importing-shelter" class="form-control">
                                                    <option label="Choose one"> </option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="">Financials: </label>
                                                <select id="" name="financials" class="form-control show-financial-section">
                                                    <option label="Choose one"> </option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="">Type of Entry: </label>
                                                <select id="" name="type-of-entry" class="form-control">
                                                    <option value="0" selected>Shelter</option>
                                                    <option value="1">Maddie's Fund</option>
                                                    <option value="2">State Totals</option>
                                                    <option value="3">Rescue</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="">Published: </label>
                                                <div id="shelter-published" class="main-toggle main-toggle-success on" data-input="published">
                                                    <span></span>
                                                </div>
                                                <input name="published" class="form-control" type="hidden" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="jumbotron pt-3 pb-3 mt-3" id="financial-section" style="display: none;">
                                        <div class="d-flex flex-row justify-content-end">
                                            <h5 class="">Financial Files</h5>

                                            <div class="ml-auto">
                                                <span id="new-financial-file" type="button" class="btn btn-success btn-sm btn-icon-text" data-counter="0">
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
                                            <tr class="empty-message">
                                                <td colspan="4" class="text-center font-weight-bold">No related files</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <label class="">Sidebar programs: </label>
                                        <textarea id="sidebar-programs" name="programs"></textarea>
                                    </div>


                                    <div class="d-flex flex-row-reverse">
                                        <span id="create-shelter" data-origin="shelters" class="btn ripple btn-main-primary btn-lg mb-3 mt-5">Create</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">



                    </div>

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
                    <button id="edit-permission" class="btn ripple btn-primary" type="button" data-row="">Edit</button>
                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
