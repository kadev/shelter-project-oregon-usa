<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit County</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>counties">Counties</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit County: <?php echo $county->Name; ?></li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!--Row-->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div>
                                    <h6 class="main-content-label mb-1">Enter the fields</h6>
                                    <p class="text-muted card-sub-title">Enter the required fields to update the county.</p>
                                </div>
                                <form id="form-edit-county">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Name: <span class="tx-danger">*</span></label>
                                                <input name="name" class="form-control" value="<?php echo $county->Name; ?>" required="" type="text" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">State: <span class="tx-danger">*</span></label>
                                                <select id="select-state" name="state-id" class="form-control">
                                                    <option label="Choose one"> </option>
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?php echo $state->id ?>" <?php echo ($state->short_name == $county->StateAbbreviation) ? 'selected' : ''; ?>><?php echo $state->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <span id="edit-county" data-county="<?php echo $county->CountyID; ?>" class="btn ripple btn-main-primary btn-lg">Update</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->


