<?php use Mini\Libs\Helper; ?>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #3c4858;
    }
</style>

<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Shelter: <?php echo $shelter->shelter_name; ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>animalData">Animal Data</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>animalData/index/<?php echo $data->shelter_id; ?>/<?php echo $data->year; ?>"><?php echo $shelter->shelter_name; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Activity Log: <?php echo $data->year; ?></li>
                    </ol>
                </div>
                <div class="d-flex">

                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Activity Log</h6>
                                <p class="text-muted card-sub-title"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-logs">
                                    <thead>
                                    <tr>
                                        <th class="wd-3p">ID</th>
                                        <th class="wd-10p">User</th>
                                        <th class="wd-70p">Activity</th>
                                        <!-- <th class="wd-10p">key</th> -->
                                        <th class="wd-17p">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($logs as $log): ?>
                                        <tr>
                                            <td><?php echo $log->id ?></td>
                                            <td class="d-flex flex-row align-items-center">
                                                <div class="main-img-user avatar-sm mr-2"> <img alt="avatar" class="rounded-circle" src="<?php echo URL; ?>img/users/1.png"> </div>
                                                <?php echo Helper::getUsername($log->user_id); ?>
                                            </td>
                                            <td><?php echo Helper::getMessageForLog($log); ?></td>
                                            <!--<td><?php echo $log->activity ?></td>-->
                                            <td><?php echo date("F j, Y, g:i a", strtotime($log->created_at)); ?></td>
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