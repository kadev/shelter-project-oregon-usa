<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Create Custom Content</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>customContent/">Custom Content</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Custom Content</li>
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
                                    <p class="text-muted card-sub-title">Enter the required fields to create the new custom content.</p>
                                </div>
                                <form id="form-create-custom-content">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Name: <span class="tx-danger">*</span></label>
                                                <input name="name" class="form-control" required="" type="text" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Permalink: <span class="tx-danger">*</span></label>
                                                <input name="permalink" class="form-control" required="" type="text" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Order: </label>
                                                <select name="order" class="form-control order-select">
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
                                                <label class="">Parent Page: </label>
                                                <select name="parent" class="form-control parent-page-select" placeholder="Choose one">
                                                    <option label="Choose one"> </option>
                                                    <?php foreach ($customContent as $item): ?>
                                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-12">
                                                <label class="">Published: </label>
                                                <div class="main-toggle main-toggle-success on check-toggle" data-input="published">
                                                    <span></span>
                                                </div>
                                                <input name="published" class="form-control" type="hidden" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="">Content: </label>
                                        <textarea id="content" name="content"></textarea>
                                    </div>

                                    <div class="d-flex flex-row justify-content-end">
                                        <div id="create-custom-content" class="btn ripple btn-main-primary btn-lg">
                                            <span aria-hidden="true" class="spinner-border spinner-border-sm d-none" role="status"></span>
                                            Create
                                        </div>
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