<?php use Mini\Libs\Helper; ?>

<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Manage Updates</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Updates</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Requests</h6>
                                <p class="text-muted card-sub-title">Manage and authorize animal data upgrade requests. .</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="manage-updates">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-40p">Shelter Name</th>
	                                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                                            <th class="wd-10p">User</th>
	                                    <?php endif; ?>
                                        <th class="wd-20p">Date</th>
                                        <th class="wd-10p">Status</th>
                                        <th class="wd-5p">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td><a href="<?php echo URL ?>animalData/updates/<?php echo $request->id; ?>">#<?php echo $request->id ?></a></td>
                                            <td><a href="<?php echo URL ?>animalData/updates/<?php echo $request->id; ?>"><?php echo Helper::getShelterName($request->shelter_id); ?></a></td>
                                            <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
	                                            <td><?php echo Helper::getUsername($request->user_id); ?></td>
	                                        <?php endif; ?>
                                            <td><?php echo date('F j, Y', strtotime($request->created_at)); ?></td>
                                            <td>
                                                <?php if($request->request_status == 'pending'): ?>
                                                    <span class="badge badge-warning"><?php echo ucfirst($request->request_status); ?></span>
                                                <?php elseif($request->request_status == 'approved'): ?>
                                                    <span class="badge badge-success"><?php echo ucfirst($request->request_status); ?></span>
                                                <?php elseif($request->request_status == 'declined'): ?>
                                                    <span class="badge badge-danger"><?php echo ucfirst($request->request_status); ?></span>
                                                <?php elseif($request->request_status == 'cancelled'): ?>
	                                                <span class="badge badge-dark"><?php echo ucfirst($request->request_status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <?php if($session['privilege'] == 4): ?>
                                                        <?php if($request->request_status == "cancelled"): ?>
			                                                <a href="javascript:void(0);" class="btn ripple btn-danger btn-sm delete-request" data-request="<?php echo $request->id; ?>"><i class="fe fe-trash"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <a href="<?php echo URL . 'animalData/updates/' . $request->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-eye"></i></a>
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
