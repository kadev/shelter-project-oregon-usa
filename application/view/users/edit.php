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
                    <h2 class="main-content-title tx-24 mg-b-5">Edit User</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>users">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                                <?php if(!empty($user) AND $user != NULL): ?>
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="main-content-label mb-1">Enter the fields</h6>
                                            <p class="text-muted card-sub-title">Enter the required fields to update the new user.</p>
                                        </div>
                                        <div class="ml-auto">
                                            <button class="btn ripple btn-dark" data-toggle="modal" data-target="#change-password-modal" data-user="<?php echo $user->id; ?>">Change password</button>
                                        </div>
                                    </div>
                                    <form id="form-edit-user" autocomplete="off">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-2">
                                                <label class="">Title: </label>
                                                <input name="title" class="form-control" type="text" value="<?php echo $user->title ?>" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="">Firstname: <span class="tx-danger">*</span></label>
                                                <input name="first-name" class="form-control" required="" value="<?php echo $user->first_name ?>" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="">Lastname: <span class="tx-danger">*</span></label>
                                                <input name="last-name" class="form-control" required="" value="<?php echo $user->last_name ?>" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Email: <span class="tx-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" required="" value="<?php echo $user->email ?>" autocomplete="nope" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Confirm Email: <span class="tx-danger">*</span></label>
                                                <input type="email" name="confirm-email" class="form-control" required="" value="<?php echo $user->email ?>" autocomplete="nope" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Privilege: <span class="tx-danger">*</span></label>
                                                    <select name="privilege" class="form-control privilege-select" value="<?php echo $user->group_id; ?>">
                                                        <option value="4" <?php echo ($user->group_id == 4) ? 'selected':''; ?>>Data Editor</option>
                                                        <option value="3" <?php echo ($user->group_id == 3) ? 'selected':''; ?>>Shelter Editor</option>
                                                        <option value="2" <?php echo ($user->group_id == 2) ? 'selected':''; ?>>Administrator</option>
                                                        <option value="1" <?php echo ($user->group_id == 1) ? 'selected':''; ?>>Super admin (All privileges)</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="jumbotron pt-3 pb-3 mt-3" id="data-editor-section" style="<?php echo ($user->privilege != 4) ? 'display: none;':''; ?>">
                                            <div class="d-flex flex-row justify-content-end">
                                                <h5 class="">Data Permission Management</h5>

                                                <div class="ml-auto">
                                                <span id="new-permission" type="button" class="btn btn-success btn-sm btn-icon-text" data-counter="<?php echo count($user->permissions); ?>">
                                                    <i class="fe fe-plus mr-2"></i> New permission
                                                </span>
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <table class="table  text-nowrap text-md-nowrap table-bordered mg-b-0" id="manage-states-table">
                                                <thead class="thead-dark" style="border: 1px solid #3b4863">
                                                <tr>
                                                    <th style="white-space: nowrap; width: 1%;">#</th>
                                                    <th>State</th>
                                                    <th>Years</th>
                                                    <th class="" style="white-space: nowrap; width: 1%;">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="empty-message" style="<?php echo (!empty($user->permissions)) ? 'display:none;':''; ?>">
                                                    <td colspan="4" class="text-center font-weight-bold">No permissions found</td>
                                                </tr>
                                                <?php $counter = 1; foreach ($user->permissions as $permission): ?>
                                                    <tr data-row="<?php echo $counter; ?>">
                                                        <th scope="row">
                                                            <span class="th-row"><?php echo $counter; ?></span>
                                                        </th>
                                                        <td>
                                                            <?php if($permission->value == "all"): ?>
                                                                <span class="state-label">All States</span>
                                                            <?php else: ?>
                                                                <span class="state-label"><?php echo \Mini\Libs\Helper::getStateName($permission->value); ?></span>
                                                            <?php endif; ?>
                                                            <input name="permissions[<?php echo $counter-1; ?>][state]" type="hidden" value="<?php echo $permission->value; ?>">
                                                        </td>
                                                        <td class="td-ellipsis">
                                                            <span class="years-label"><?php echo ($permission->other_value == "all") ? "All Years" : str_replace(",", ", ", $permission->other_value); ?></span>
                                                            <input name="permissions[<?php echo $counter-1; ?>][years]" type="hidden" value="<?php echo $permission->other_value; ?>">
                                                        </td>
                                                        <td>
                                                            <div class="btn-icon-list">
                                                                <span data-row="<?php echo $counter; ?>" class="btn ripple btn-info btn-sm edit-permission"><i class="fe fe-edit"></i></span>
                                                                <span data-row="<?php echo $counter; ?>" class="btn ripple btn-danger btn-sm delete-permission"><i class="fe fe-trash"></i></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $counter++; endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                        <span id="edit-user" class="btn ripple btn-main-primary btn-lg" data-user="<?php echo $user->id; ?>">Update</span>
                                    </div>
                                </form>
                                <?php else: ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        The user you want to edit does not exist, it was probably recently deleted.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->

<div class="modal fade" tabindex="-1" role="dialog" id="change-password-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="change-password-form" autocomplete="off" >
                    <input name="id" type="hidden" value="<?php echo $user->id; ?>">
                    <div class="form-group">
                        <label for="i-new-password">New Password</label>
                        <input type="password" class="form-control" name="new-password" id="i-new-password" placeholder="Enter new password" value="" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="i-confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm-new-password" id="i-confirm-password" placeholder="Confirm new password" value="" autocomplete="new-password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="change-user-password">Change</button>
            </div>
        </div>
    </div>
</div>

<div class="modal show" id="add-permission-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add State</h6>
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
