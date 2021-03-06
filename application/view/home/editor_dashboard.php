<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Welcome To Shelter Project Dashboard</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-sm-12 col-lg-12 col-xl-8">

                    <!--Row-->
                    <div class="row row-sm  mt-lg-4">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="card bg-primary custom-card card-box">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="offset-xl-3 offset-sm-6 col-xl-8 col-sm-6 col-12 img-bg ">
                                            <h4 class="d-flex  mb-3">
                                                <span class="font-weight-bold text-white ">Hi <?php echo $session['name']; ?>!</span>
                                            </h4>
                                            <p class="tx-white-7 mb-1">Welcome to your configuration panel, we present you a summary of your activity:</p>
                                        </div>
                                        <img src="<?php echo URL; ?>img/pngs/work3.png" alt="user-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Row -->

                    <!--Row-->
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="card-item">
                                        <div class="card-item-icon card-icon">
                                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect height="14" opacity=".3" width="14" x="5" y="5"/><g><rect fill="none" height="24" width="24"/><g><path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z"/><rect height="5" width="2" x="7" y="12"/><rect height="10" width="2" x="15" y="7"/><rect height="3" width="2" x="11" y="14"/><rect height="2" width="2" x="11" y="10"/></g></g></g></svg>
                                        </div>
                                        <div class="card-item-title mb-2">
                                            <label class="main-content-label tx-13 font-weight-bold mb-1">Total Shelters</label>
                                        </div>
                                        <div class="card-item-body">
                                            <div class="card-item-stat">
                                                <h4 class="font-weight-bold"><?php echo $dashboard->totalShelters; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="card-item">
                                        <div class="card-item-icon card-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
                                        </div>
                                        <div class="card-item-title mb-2">
                                            <label class="main-content-label tx-13 font-weight-bold mb-1">Approved Shelters</label>
                                        </div>
                                        <div class="card-item-body">
                                            <div class="card-item-stat">
                                                <h4 class="font-weight-bold">0</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="card-item">
                                        <div class="card-item-icon card-icon">
                                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/></svg>
                                        </div>
                                        <div class="card-item-title  mb-2">
                                            <label class="main-content-label tx-13 font-weight-bold mb-1">Pending update requests</label>
                                        </div>
                                        <div class="card-item-body">
                                            <div class="card-item-stat">
                                                <h4 class="font-weight-bold">0</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End row-->

                    <!--row-->
                    <div class="row row-sm">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="card custom-card overflow-hidden d-none">
                                <div class="card-header border-bottom-0">
                                    <div>
                                        <label class="main-content-label mb-2">List Of Pending Shelters</label> <span class="d-block tx-12 mb-0 text-muted"></span>
                                    </div>
                                </div>
                                <div class="card-body pl-0">
                                    <div class>
                                        <div class="container">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 d-none">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row row-sm">
                                        <div class="col-6">
                                            <div class="card-item-title">
                                                <label class="main-content-label tx-13 font-weight-bold mb-2">Total Animals received</label>
                                                <span class="d-block tx-12 mb-0 text-muted">This year</span>
                                            </div>
                                            <p class="mb-0 tx-24 mt-2"><b class="text-primary">671</b></p>
                                            <a href="#" class="text-muted">12 Monday, Oct 2020 </a>
                                        </div>
                                        <div class="col-6">
                                            <img src="<?php echo URL; ?>img/pngs/dog-house.png" alt="image" class="best-emp" style="width: 100px; height: 100px; top: 7px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 d-none">
                            <div class="card custom-card">
                                <div class="card-header  border-bottom-0 pb-0">
                                    <div>
                                        <div class="d-flex">
                                            <label class="main-content-label my-auto pt-2">Top Animals Received</label>
                                        </div>
                                        <span class="d-block tx-12 mt-2 mb-0 text-muted"> This year</span>
                                    </div>
                                </div>
                                <div class="card-body pt-3">
                                    <div class="row mt-0">
                                        <div class="col-5">
                                            <span class="">Dogs</span>
                                        </div>
                                        <div class="col-4 my-auto">
                                            <div class="progress ht-6 my-auto">
                                                <div class="progress-bar ht-6 wd-80p" role="progressbar"  aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex">
                                                <span class="tx-13"><i class="text-success fe fe-arrow-up"></i><b>24.75%</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-5">
                                            <span class="">Cats</span>
                                        </div>
                                        <div class="col-4 my-auto">
                                            <div class="progress ht-6 my-auto">
                                                <div class="progress-bar ht-6 wd-70p" role="progressbar"  aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex">
                                                <span class="tx-13"><i class="text-danger fe fe-arrow-down"></i><b>12.34%</b></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-none">
                            <div class="card custom-card mg-b-20">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                        <div>
                                            <label class="main-content-label mb-2">Tasks</label> <span class="d-block tx-12 mb-3 text-muted">Your last tasks created and without.</span>
                                        </div>
                                        <div class="ml-auto">
                                            <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Task</a>
                                                <a class="dropdown-item" href="#">Prority</a>
                                                <a class="dropdown-item" href="#">Status</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"><i class="fa fa-cog mr-2"></i> Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive tasks">
                                        <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                            <thead>
                                            <tr>
                                                <th class="wd-lg-10p">Task</th>
                                                <th class="wd-lg-20p">Prority</th>
                                                <th class="wd-lg-20p">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="font-weight-semibold d-flex"><label class="ckbox my-auto mr-4 mt-1"><input checked="" type="checkbox"><span></span></label><span class="mt-1">Create new shelter for Portland</span></td>
                                                <td class="text-primary">High</td>
                                                <td><span class="badge badge-pill badge-primary-light">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-semibold d-flex"><label class="ckbox my-auto mr-4"><input checked="" type="checkbox"><span></span></label><span class="mt-1">Write an article about the importance of adoption</span></td>
                                                <td class="text-secondary">Normal</td>
                                                <td><span class="badge badge-pill badge-warning-light">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-semibold d-flex"><label class="ckbox my-auto mr-4"><input type="checkbox"><span></span></label><span class="mt-1">Report bug on the "Shelter Data" page</span></td>
                                                <td class="text-warning">Low</td>
                                                <td><span class="badge badge-pill badge-primary-light">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-semibold d-flex"><label class="ckbox my-auto mr-4"><input type="checkbox"><span></span></label><span class="mt-1">Generate November report</span></td>
                                                <td class="text-primary">High</td>
                                                <td><span class="badge badge-pill badge-danger-light">Rejected</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col end -->
                    </div><!-- Row end -->
                </div><!-- col end -->
                <div class="col-sm-12 col-lg-12 col-xl-4 mt-xl-4">
                    <div class="card custom-card overflow-hidden d-none">
                        <div class="card-header  border-bottom-0 pb-0">
                            <div>
                                <div class="d-flex">
                                    <label class="main-content-label my-auto pt-2">Your latest updated shelters</label>
                                    <div class="ml-auto mt-3 d-flex">
                                        <div class="mr-3 d-flex text-muted tx-13"><span class="legend bg-primary rounded-circle"></span>Completed</div>
                                        <div class="d-flex text-muted tx-13"><span class="legend bg-light rounded-circle"></span>Pending</div>
                                    </div>
                                </div>
                                <span class="d-block tx-12 mt-2 mb-0 text-muted"> Current year data. </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 my-auto">
                                    <h6 class="mb-3 font-weight-normal">Shelters completed</h6>
                                    <div class="text-left">
                                        <h3 class="font-weight-bold mr-3 mb-2 text-primary"><?php echo $dashboard->dataRegistrationAdvance->sheltersCompleted; ?></h3>
                                        <p class="tx-13 my-auto text-muted">Pending Shelters: <?php echo $dashboard->dataRegistrationAdvance->sheltersPending; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 my-auto">
                                    <div class="forth circle" data-percentage="<?php echo $dashboard->dataRegistrationAdvance->percentageCompleted; ?>">
                                        <div class="chart-circle-value circle-style"><div class="tx-16 font-weight-bold"><?php echo $dashboard->dataRegistrationAdvance->percentageCompleted; ?>%</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card custom-card card-dashboard-calendar pb-0">
                        <label class="main-content-label mb-2 pt-1">Your latest updated shelters</label>
                        <span class="d-block tx-12 mb-2 text-muted">These are the last shelters you have updated</span>
                        <?php if(!empty($dashboard->lastModifiedShelters)): ?>
                            <table class="table table-hover m-b-0 transcations mt-2">
                            <tbody>
                            <?php foreach($dashboard->lastModifiedShelters as $item): ?>
                                <tr>
                                    <td class="wd-5p">
                                        <div class="main-img-user avatar-md">
                                            <?php if($item->logo == null OR empty($item->logo)): ?>
                                                <img alt="Shelter Logo" class="rounded-circle mr-3" src="<?php echo URL; ?>img/pngs/pet-house.png">
                                            <?php else: ?>
                                                <img alt="Shelter Logo" class="rounded-circle mr-3" src="<?php echo URL.'uploads/' . $item->logo;?>">
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-middle ml-3">
                                            <div class="d-inline-block">
                                                <h6 class="mb-1"><?php echo $item->shelter_name; ?></h6>
                                                <?php if($item->request_status == 'pending'): ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php elseif($item->request_status == 'approved'): ?>
                                                    <span class="badge badge-success">Approved</span>
                                                <?php elseif($item->request_status == 'declined'): ?>
                                                    <span class="badge badge-danger">Declined</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="d-inline-block">
                                            <p class="mb-0 tx-11 text-muted"><?php echo date("F j, Y", strtotime($item->created_at)); ?></p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">
                                <strong>You have not updated shelters.!</strong>
                            </div>
                        <?php endif; ?>
                    </div>
                </div><!-- col end -->
            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->

