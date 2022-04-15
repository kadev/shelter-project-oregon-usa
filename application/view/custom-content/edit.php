<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Custom Content</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>customContent">Custom Content</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Custom Content</li>
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
                                <?php if(!empty($customContent) AND $customContent != NULL): ?>
                                    <div>
                                        <h6 class="main-content-label mb-1">Edit the fields</h6>
                                        <p class="text-muted card-sub-title">Enter the required fields to update the custom content.</p>
                                    </div>
                                    <form id="form-edit-custom-content">
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Name: <span class="tx-danger">*</span></label>
                                                    <input name="name" class="form-control" required="" type="text" value="<?php echo $customContent->name; ?>" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Permalink: <span class="tx-danger">*</span></label>
                                                    <input name="permalink" class="form-control" required="" value="<?php echo $customContent->permalink; ?>" placeholder="Type here...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Order: </label>
                                                    <select name="order" class="form-control order-select" value="<?php echo $customContent->order; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option <?php echo ($customContent->order == 0) ? 'selected':''; ?> value="0">0</option>
                                                        <option <?php echo ($customContent->order == 1) ? 'selected':''; ?> value="1">1</option>
                                                        <option <?php echo ($customContent->order == 2) ? 'selected':''; ?> value="2">2</option>
                                                        <option <?php echo ($customContent->order == 3) ? 'selected':''; ?> value="3">3</option>
                                                        <option <?php echo ($customContent->order == 4) ? 'selected':''; ?> value="4">4</option>
                                                        <option <?php echo ($customContent->order == 5) ? 'selected':''; ?> value="5">5</option>
                                                        <option <?php echo ($customContent->order == 6) ? 'selected':''; ?> value="6">6</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Parent Custom Content: </label>
                                                    <select name="parent" class="form-control custom-content-select">
                                                        <option label="Choose one"> </option>
                                                        <?php foreach ($customContents as $item): ?>
                                                            <option <?php echo ($item->id == $customContent->parent) ? 'selected':''; ?> value="<?php echo $item->id ?>"><?php echo $item->name ;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-12">
                                                    <label class="">Published: </label>
                                                    <div class="main-toggle main-toggle-success check-toggle <?php echo ($customContent->published == 1) ? 'on':'off';?>" data-input="published">
                                                        <span></span>
                                                    </div>
                                                    <input name="published" class="form-control" type="hidden" value="<?php echo $customContent->published; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Content: </label>
                                            <textarea id="content" name="content"><?php echo $customContent->content; ?></textarea>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                            <div id="edit-custom-content" class="btn ripple btn-main-primary btn-lg" data-content="<?php echo $customContent->id; ?>">
                                                <span aria-hidden="true" class="spinner-border spinner-border-sm d-none" role="status"></span>
                                                Update
                                            </div>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        The custom content you want to edit does not exist, it was probably recently deleted.
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