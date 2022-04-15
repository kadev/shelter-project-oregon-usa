<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Animal</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>animals">Animals</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Animal</li>
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
                                <?php if(!empty($animal) AND $animal != NULL): ?>
                                    <div>
                                        <h6 class="main-content-label mb-1">Enter the fields</h6>
                                        <p class="text-muted card-sub-title">Enter the required fields to update the animal.</p>
                                    </div>
                                    <form id="form-edit-animal">
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Name: <span class="tx-danger">*</span></label>
                                                    <input name="animal-name" class="form-control" required="" type="text" value="<?php echo $animal->name; ?>" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Country: </label>
                                                    <select class="form-control country-select" name="country">
                                                        <option label="Choose one"> </option>
                                                        <?php foreach ($countries as $country): ?>
                                                            <option <?php echo ($animal->countries_id == $country->id) ? 'selected':''; ?> value="<?php echo $country->id ?>"><?php echo $country->name; ?></option>
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
                                                        <option <?php echo ($animal->order == 0) ? 'selected':''; ?> value="0">0</option>
                                                        <option <?php echo ($animal->order == 1) ? 'selected':''; ?> value="1">1</option>
                                                        <option <?php echo ($animal->order == 2) ? 'selected':''; ?> value="2">2</option>
                                                        <option <?php echo ($animal->order == 3) ? 'selected':''; ?> value="3">3</option>
                                                        <option <?php echo ($animal->order == 4) ? 'selected':''; ?> value="4">4</option>
                                                        <option <?php echo ($animal->order == 5) ? 'selected':''; ?> value="5">5</option>
                                                        <option <?php echo ($animal->order == 6) ? 'selected':''; ?> value="6">6</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Published: </label>
                                                    <div id="animal-published" class="main-toggle main-toggle-success <?php echo ($animal->published == 1) ?'on':'off'; ?>" data-input="published">
                                                        <span></span>
                                                    </div>
                                                    <input name="published" class="form-control" type="hidden" value="<?php echo $animal->published; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-end">
                                            <span id="edit-animal" data-animal="<?php echo $animal->id; ?>" class="btn ripple btn-main-primary btn-lg">Update</span>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        The animal you want to edit does not exist, it was probably recently deleted.
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


