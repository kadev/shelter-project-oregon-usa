<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">My Profile</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="row square">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="panel profile-cover">
                                <div class="profile-cover__img">
                                    <img src="<?php echo URL; ?>img/users/1.png" alt="img" />
                                    <h3 class="h3"><?php echo $user->first_name . ' '. $user->last_name; ?></h3>
                                </div>
                                <div class="profile-cover__action bg-img">
                                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                                    <a href="<?php echo URL; ?>articles/create" class="btn btn-rounded btn-danger"> <i class="fa fa-plus"></i> <span> Article</span> </a>
                                    <?php endif; ?>
                                </div>
                                <div class="profile-cover__info">
                                    <ul class="nav">
                                        <li style="color: white;">
                                            <strong style="color: white;">0</strong>Articles
                                        </li>
                                        <li style="color: white;">
                                            <strong style="color: white;">0</strong>Shelters
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="profile-tab tab-menu-heading">
                                <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                                    <a class="nav-link  active" data-toggle="tab" href="#about">About</a>
                                    <a class="nav-link" data-toggle="tab" href="#edit">Edit Profile</a>
                                    <a class="nav-link" data-toggle="tab" href="#change-password">Change Password</a>
                                    <a class="nav-link" data-toggle="tab" href="#preferences">Preferences</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card main-content-body-profile">
                        <div class="tab-content">
                            <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                                <div class="card-body p-0 border p-0 rounded-10">
                                    <div class="p-4">
                                        <label class="main-content-label tx-13 mg-b-20">Biography</label>
                                        <p class="m-b-5"> <?php echo $user->biography; ?></p>
                                        <div class="m-t-30">
                                            <label class="main-content-label tx-13 mg-b-20">General Information</label>
                                            <div class="p-t-10">
                                                <p class=""><strong>Title:</strong> <?php echo $user->title; ?></p>
                                                <p class=""><strong>Name:</strong> <?php echo $user->first_name . ' '. $user->last_name; ?></p>
                                                <p class=""><strong>Email:</strong> <?php echo $user->email; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top"></div>
                                    <div class="p-4">
                                        <label class="main-content-label tx-13 mg-b-20">Account Information</label>
                                        <div class="m-t-30">
                                            <div class="p-t-10">
                                                <p class=""><strong>Username:</strong> <?php echo $user->username; ?></p>
                                                <p class=""><strong>User group:</strong>
                                                    <?php if($user->group_id == 0): ?>
                                                        Web Administrator
                                                    <?php elseif($user->group_id == 1): ?>
                                                        Administrator
                                                    <?php else: ?>
                                                        Staff
                                                    <?php endif; ?>
                                                </p>
                                                <p class=""><strong>User since:</strong> <?php echo date("F j, Y", $user->created_on); ?></p>
                                                <p class=""><strong>Status:</strong>
                                                    <?php if($user->active == 1): ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-content-body tab-pane p-4 border-top-0" id="edit">
                                <div class="card-body border">
                                    <div class="mb-4 main-content-label">Edit Information</div>
                                    <form id="form-update-profile" class="form-horizontal">
                                        <div class="mb-4 main-content-label">General Information</div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Biography</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="biography" type="text" class="form-control" placeholder="Type here..." value="<?php echo $user->biography; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Title</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="title" type="text" class="form-control" placeholder="Type here..." value="<?php echo $user->title; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">First Name <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="firstname" type="text" class="form-control" placeholder="Type here..." value="<?php echo $user->first_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Last Name <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="lastname" type="text" class="form-control" placeholder="Type here..." value="<?php echo $user->last_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Email <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="email" type="email" class="form-control" placeholder="Type here..." value="<?php echo $user->email; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4 main-content-label">Account Information</div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Username <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="username" type="text" class="form-control" placeholder="Type here..." value="<?php echo $user->username; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <span id="update-profile" class="btn ripple btn-success"><i class="fe fe-check"></i> Update</span>
                                    </form>
                                </div>
                            </div>

                            <div class="main-content-body tab-pane p-4 border-top-0" id="change-password">
                                <div class="card-body border">
                                    <div class="mb-4 main-content-label">Change Password</div>
                                    <form id="form-change-password" class="form-horizontal">
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Password <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="password" type="password" class="form-control" placeholder="Type here..." value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">New Password <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="new-password" type="password" class="form-control" placeholder="Type here..." value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Confirm New Password <span class="tx-danger">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input name="confirm-new-password" type="password" class="form-control" value="" placeholder="Type here...">
                                                </div>
                                            </div>
                                        </div>

                                        <span id="change-profile-password" class="btn ripple btn-success"><i class="fe fe-check"></i> Change Password</span>
                                    </form>
                                </div>
                            </div>

                            <div class="main-content-body tab-pane p-4 border-top-0" id="preferences">
                                <div class="card-body border">
                                    <div class="mb-4 main-content-label">Preferences</div>
                                    <form id="form-user-preferences" class="form-horizontal">
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <div class="col-md-3">
                                                    <label class="form-label">Zoom</label>
                                                </div>
                                                <div class="col-md-12">

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
<!-- End Main Content-->