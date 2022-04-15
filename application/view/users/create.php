<style>
    .select2-selection--multiple {
        background-color: #fff !important;
        border: 2px solid #ced4da !important;
        border-radius: 3px !important;
    }
</style>
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Create User</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>users">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create User</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div>
                                    <h6 class="main-content-label mb-1">Enter the fields</h6>
                                    <p class="text-muted card-sub-title">Enter the required fields to create the new user.</p>
                                </div>
                                <form id="form-create-user" autocomplete="off">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-2">
                                                <label class="">Title: </label>
                                                <input name="title" class="form-control" type="text" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="">Firstname: <span class="tx-danger">*</span></label>
                                                <input type="text" name="first-name" class="form-control" required="" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="">Lastname: <span class="tx-danger">*</span></label>
                                                <input type="text" name="last-name" class="form-control" required="" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Email: <span class="tx-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" required="" autocomplete="nope" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Confirm Email: <span class="tx-danger">*</span></label>
                                                <input type="email" name="confirm-email" class="form-control" required="" autocomplete="nope" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Password: <span class="tx-danger">*</span></label>
                                                <input name="password" class="form-control" type="password" required="" autocomplete="new-password" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Confirm Password: <span class="tx-danger">*</span></label>
                                                <input name="confirm-password" class="form-control" type="password"  required="" autocomplete="new-password" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Privilege: <span class="tx-danger">*</span></label>
                                                <select name="privilege" class="form-control privilege-select">
                                                    <option value="4" selected>Data Editor</option>
                                                    <option value="3">Shelter Editor</option>
                                                    <option value="2">Administrator</option>
                                                    <option value="1">Super admin (All privileges)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="jumbotron pt-3 pb-3 mt-3" id="data-editor-section" style="">
                                        <div class="alert alert-warning" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                            <strong>Info:</strong>
                                            Add states and the years that the new user will be able to view and send updates.
                                        </div>
                                        <div class="d-flex flex-row justify-content-end">
                                            <h5 class="">Data Permission Management</h5>

                                            <div class="ml-auto">
                                                <span id="new-permission" type="button" class="btn btn-success btn-sm btn-icon-text" data-counter="0">
                                                    <i class="fe fe-plus mr-2"></i> Add permission
                                                </span>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <table class="table text-nowrap text-md-nowrap table-bordered mg-b-0" id="manage-states-table">
                                            <thead class="thead-dark" style="border: 1px solid #3b4863">
                                            <tr>
                                                <th style="white-space: nowrap; width: 1%;">#</th>
                                                <th>State</th>
                                                <th>Years</th>
                                                <th class="" style="white-space: nowrap; width: 1%;">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="empty-message" style="">
                                                <td colspan="4" class="text-center font-weight-bold">No permissions found</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span id="create-user" class="btn ripple btn-main-primary btn-lg">Create</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->

<div class="modal show" id="add-permission-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Permission</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control states-select" name="state">
                            <option value="all">All States</option>
                            <?php foreach ($states as $state): ?>
                                <option value="<?php echo $state->id ?>"><?php echo $state->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Year(s)</label>
                        <select class="form-control years-select" name="years[]" multiple="multiple">
                            <option value="all">All Years</option>
                            <?php for($i = date("Y"); $i >= 1970; $i--): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="add-permission" class="btn ripple btn-primary" type="button">Add</button>
                <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal show" id="edit-permission-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit Permision</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control states-select" name="state">
                            <option value="all">All States</option>
                            <?php foreach ($states as $state): ?>
                                <option value="<?php echo $state->id ?>"><?php echo $state->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Year(s)</label>
                        <select class="form-control years-select" name="years[]" multiple="multiple">
                            <option value="all">All Years</option>
                            <?php for($i = date("Y"); $i >= 1970; $i--): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="edit-permission" class="btn ripple btn-primary" type="button" data-row="">Edit</button>
                <button class="btn ripple btn-danger" data-dismiss="modal" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>



