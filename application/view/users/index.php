
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Users</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>users/create" type="button" class="btn btn-success my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Create user
                        </a>
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
                                <h6 class="main-content-label mb-1">Users</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the users of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-users">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-10p">Name</th>
                                        <th class="wd-40p">Username</th>
                                        <th class="wd-40p">Status</th>
                                        <th class="wd-40p">Group</th>
                                        <th class="wd-40p">Last Login</th>
                                        <th class="wd-5p">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?php echo $user->id ?></td>
                                            <td><?php echo $user->title.' '.$user->first_name .' '.$user->last_name; ?></td>
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo ($user->active == 1) ? 'Active':'Inactive'; ?></td>
                                            <td>
                                                <?php if($user->group_id == 2): ?>
                                                    Administrator
                                                <?php elseif($user->group_id == 1): ?>
                                                    Superadmin
                                                <?php elseif($user->group_id == 3): ?>
                                                    Shelter Editor
                                                <?php elseif($user->group_id == 4): ?>
                                                    Data Editor
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($user->last_login == NULL): ?>
                                                    Never logged in
                                                <?php else: ?>
                                                    <?php echo date("Y-m-d",$user->last_login); ?>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="<?php echo URL . 'users/edit/' . $user->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <span data-user="<?php echo $user->id; ?>" class="btn ripple btn-danger btn-sm delete-user"><i class="fe fe-trash"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
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
