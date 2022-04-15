<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Create Animal</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>animals">Animals</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Animal</li>
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
                                    <p class="text-muted card-sub-title">Enter the required fields to create the new animal.</p>
                                </div>
                                <form id="form-create-animal">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Name: <span class="tx-danger">*</span></label>
                                                <input name="animal-name" class="form-control" required="" type="text" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Country: </label>
                                                <select class="form-control country-select" name="country">
                                                    <option label="Choose one"> </option>
                                                    <?php foreach ($countries as $country): ?>
                                                        <option value="<?php echo $country->id ?>"><?php echo $country->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Order: </label>
                                                <select class="form-control order-select" name="order">
                                                    <option label="Choose one"> </option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Published: </label>
                                                <div id="animal-published" class="main-toggle main-toggle-success on check-toggle" data-input="published">
                                                    <span></span>
                                                </div>
                                                <input name="published" class="form-control" type="hidden" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <span id="create-animal" class="btn ripple btn-main-primary btn-lg">Create</span>
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


