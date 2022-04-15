<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit State</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>states">States</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit State</li>
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
                                <?php if(!empty($state) AND $state != NULL): ?>
                                    <div>
                                    <h6 class="main-content-label mb-1">Enter the fields</h6>
                                    <p class="text-muted card-sub-title">Enter the required fields to update the new state.</p>
                                </div>
                                    <form id="form-edit-state">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Name: <span class="tx-danger">*</span></label>
                                                <input name="state-name" class="form-control" required="" type="text" value="<?php echo $state->name; ?>" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Short name: <span class="tx-danger">*</span></label>
                                                <input name="short-name" class="form-control" required="" value="<?php echo $state->short_name; ?>" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Order: </label>
                                                <select class="form-control order-select" name="order">
                                                    <option label="Choose one"> </option>
                                                    <option <?php echo ($state->order == 0) ? 'selected' : ''; ?> value="0">0</option>
                                                    <option <?php echo ($state->order == 1) ? 'selected' : ''; ?> value="1">1</option>
                                                    <option <?php echo ($state->order == 2) ? 'selected' : ''; ?> value="2">2</option>
                                                    <option <?php echo ($state->order == 3) ? 'selected' : ''; ?> value="3">3</option>
                                                    <option <?php echo ($state->order == 4) ? 'selected' : ''; ?> value="4">4</option>
                                                    <option <?php echo ($state->order == 5) ? 'selected' : ''; ?> value="5">5</option>
                                                    <option <?php echo ($state->order == 6) ? 'selected' : ''; ?> value="6">6</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Published: </label>
                                                <div id="state-published" class="main-toggle main-toggle-success <?php echo ($state->published == 1) ? 'on':'off' ; ?>" data-input="published">
                                                    <span></span>
                                                </div>
                                                <input name="published" class="form-control" type="hidden" value="<?php echo $state->published ?>">
                                            </div>
                                        </div>
                                    </div>

                                        <div class="d-flex flex justify-content-end">
                                            <span id="edit-state" data-state="<?php echo $state->id; ?>" class="btn ripple btn-main-primary btn-lg">Update</span>
                                        </div>
                                </form>
                                <?php else: ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        The state you want to edit does not exist, it was probably recently deleted.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Row end -->
        </div>
    </div>
</div>
<!-- End Main Content-->


