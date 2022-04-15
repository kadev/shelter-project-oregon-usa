
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Animals</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Animals</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>animals/create" type="button" class="btn btn-success my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Create Animal
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
                                <h6 class="main-content-label mb-1">Animals</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the animals of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-animals">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-75p">Name</th>
                                        <th class="wd-10p">Published</th>
                                        <th class="wd-5p">Order</th>
                                        <th class="wd-5p">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($animals as $animal): ?>
                                        <tr>
                                            <td><?php echo $animal->id ?></td>
                                            <td><?php echo $animal->name; ?></td>
                                            <td><?php echo ($animal->published == 1) ? '<span class="badge badge-success">Yes</span>': '<span class="badge badge-danger">No</span>'; ?></td>
                                            <td><?php echo $animal->order; ?></td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="<?php echo URL . 'animals/edit/' . $animal->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <span data-animal="<?php echo $animal->id; ?>" class="btn ripple btn-danger btn-sm delete-animal"><i class="fe fe-trash"></i></span>
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
