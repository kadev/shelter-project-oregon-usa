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
                    <h2 class="main-content-title tx-24 mg-b-5">Active shelters by year: <?php echo $year; ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>animalData">Animal Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Active shelters by year: <?php echo $year; ?></li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <select id="filter-shelters-by-year" class="form-control select2" placeholder="Filter Shelters by Active Year">
                            <option label="Select Year" value="0">Select Year</option>
                            <?php for($i = date('Y'); $i >= 1970; $i--): ?>
                                <option label="<?php echo $i; ?>" value="<?php echo $i; ?>" <?php echo ($i == $year) ? 'selected':'' ; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
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
                                <h6 class="main-content-label mb-1">Shelters Table</h6>
                                <p class="text-muted card-sub-title">In the following table you will find the active shelters of the year: <?php echo $year; ?></p>
                            </div>
                            <?php if(!empty($shelters)): ?>
                                <div class="alert alert-primary" role="alert">
                                    Result: <strong><?php echo count($shelters); ?></strong> active shelters found in <strong><?php echo $year; ?></strong>.
                                </div>
                            <table class="table" id="table-shelters-by-year">
                                <thead>
                                <tr>
                                    <th class="wd-5p">ID</th>
                                    <th class="wd-10p">Shelter Name</th>
                                    <th class="wd-40p">Street Address</th>
                                    <th class="wd-40p">State</th>
                                    <th class="wd-5p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($shelters as $shelter): ?>
                                        <?php if(!empty($shelter)): ?>
                                            <tr>
                                                <td><?php echo $shelter->id ?></td>
                                                <td><?php echo Helper::getTheCorrectShelterName($shelter->shelter_name); ?></td>
                                                <td><?php echo $shelter->street_address; ?></td>
                                                <td><?php echo $State->getStateNameById($shelter->states_id); ?></td>
                                                <td>
                                                    <div class="btn-icon-list">
                                                        <a href="<?php echo URL . 'shelters/edit/' . $shelter->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <br>
                                <div class="alert alert-warning" role="alert">
                                    No shelters with animal data were found for the selected year.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->