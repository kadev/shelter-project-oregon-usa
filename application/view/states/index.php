
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">States</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">States</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>states/create" type="button" class="btn btn-success my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Create state
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
                                <h6 class="main-content-label mb-1">States</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the states of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-states">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-60p">Name</th>
                                        <th class="wd-10p">Code</th>
                                        <th class="wd-10p">Published</th>
                                        <th class="wd-10p">Order</th>
                                        <th class="wd-5p">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($states as $state): ?>
                                        <tr>
                                            <td><?php echo $state->id ?></td>
                                            <td><?php echo $state->name; ?></td>
                                            <td><?php echo $state->short_name; ?></td>
                                            <td><?php echo ($state->published == 1) ? '<span class="badge badge-success">Yes</span>': '<span class="badge badge-danger">No</span>'; ?></td>
                                            <td><?php echo $state->order; ?></td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="<?php echo URL . 'states/edit/' . $state->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <span data-state="<?php echo $state->id; ?>" class="btn ripple btn-danger btn-sm delete-state"><i class="fe fe-trash"></i></span>
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
