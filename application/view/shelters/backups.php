<?php use Mini\Libs\Helper; ?>

<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Shelter Backups: <?php echo $shelter->shelter_name; ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo URL ?>shelters/edit/<?php echo $shelter->id ?>"><?php echo $shelter->shelter_name; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Backups</li>
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
                                <h6 class="main-content-label mb-1">Backups stored for this shelter</h6>
                                <p class="text-muted card-sub-title">View and restore some shelter backup .</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-shelters">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-10p">Backup date</th>
                                        <th class="wd-10p">Created by</th>
                                        <th class="wd-40p">Shelter Name</th>
                                        <th class="wd-5p">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($backups as $backup): ?>
                                        <tr>
                                            <td><a href="<?php echo URL ?>shelters/backup-details/<?php echo $backup->id; ?>"><?php echo $backup->id ?></a></td>
                                            <td><a href="<?php echo URL ?>shelters/backup-details/<?php echo $backup->id; ?>"><?php echo date('F j, Y', strtotime($backup->created_at)); ?></a></td>
                                            <td><?php echo Helper::getUsername($backup->user_id); ?></td>
                                            <td><?php echo Helper::getTheCorrectShelterName($backup->shelter_name); ?></td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="<?php echo URL . 'shelters/backup-details/' . $backup->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-eye"></i></a>
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
