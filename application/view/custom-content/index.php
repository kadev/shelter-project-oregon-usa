
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Custom Content</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="custom-content">Custom Content</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>customContent/create" type="button" class="btn btn-success my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Create new
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
                                <h6 class="main-content-label mb-1">Custom Content</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the custom content of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-custom-content">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-45p">Name</th>
                                        <th class="wd-45p">Permalink</th>
                                        <th class="wd-5p">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($customContent as $item): ?>
                                        <tr>
                                            <td><?php echo $item->id ?></td>
                                            <td><?php echo $item->name ?></td>
                                            <td><?php echo $item->permalink ?></td>
                                            <td>
                                                <div class="btn-icon-list page-actions">
                                                    <a href="<?php echo URL . 'customContent/edit/' . $item->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <span data-content="<?php echo $item->id; ?>" class="btn ripple btn-danger btn-sm delete-content"><i class="fe fe-trash"></i></span>
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
