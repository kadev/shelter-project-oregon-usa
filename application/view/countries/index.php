
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Countries</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Countries</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>countries/create" type="button" class="btn btn-success my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Create country
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
                                <h6 class="main-content-label mb-1">Countries</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the countries of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-countries">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-35p">Name</th>
                                        <th class="wd-35p">Code</th>
                                        <th class="wd-10p">Published</th>
                                        <th class="wd-10p">Order</th>
                                        <th class="wd-5p">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($countries as $country): ?>
                                        <tr>
                                            <td><?php echo $country->id ?></td>
                                            <td><?php echo $country->name; ?></td>
                                            <td><?php echo $country->short_name; ?></td>
                                            <td><?php echo ($country->published == 1) ? '<span class="badge badge-success">Yes</span>': '<span class="badge badge-danger">No</span>'; ?></td>
                                            <td><?php echo $country->order; ?></td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="<?php echo URL . 'countries/edit/' . $country->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <span data-country="<?php echo $country->id; ?>" class="btn ripple btn-danger btn-sm delete-country"><i class="fe fe-trash"></i></span>
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
