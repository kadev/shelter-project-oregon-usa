<!-- Main Content-->
<?php use Mini\Libs\Helper; ?>
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Activity Log</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto pt-2 mb-1">Activity Log</label>
                            <span class="d-block tx-12 mb-0 mt-1 text-muted"></span>
                        </div>
                        <div class="card-body">
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
            </div>
            <!-- row closed -->
        </div>
    </div>
</div>
<!-- End Main Content-->