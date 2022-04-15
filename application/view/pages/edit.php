<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Page</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL ?>pages">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
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
                                <?php if(!empty($page) AND $page != NULL): ?>
                                    <div>
                                    <h6 class="main-content-label mb-1">Edit the fields</h6>
                                    <p class="text-muted card-sub-title">Enter the required fields to update the page.</p>
                                </div>
                                    <form id="form-edit-page">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Page Name: <span class="tx-danger">*</span></label>
                                                <input name="page_name" class="form-control" required="" type="text" value="<?php echo $page->page_name; ?>" placeholder="Type here...">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Permalink: <span class="tx-danger">*</span></label>
                                                <input name="permalink" class="form-control" required="" value="<?php echo $page->permalink; ?>" placeholder="Type here...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-6">
                                                <label class="">Order: </label>
                                                <select name="order" class="form-control order-select" value="<?php echo $page->order; ?>">
                                                    <option label="Choose one"> </option>
                                                    <option <?php echo ($page->order == 0) ? 'selected':''; ?> value="0">0</option>
                                                    <option <?php echo ($page->order == 1) ? 'selected':''; ?> value="1">1</option>
                                                    <option <?php echo ($page->order == 2) ? 'selected':''; ?> value="2">2</option>
                                                    <option <?php echo ($page->order == 3) ? 'selected':''; ?> value="3">3</option>
                                                    <option <?php echo ($page->order == 4) ? 'selected':''; ?> value="4">4</option>
                                                    <option <?php echo ($page->order == 5) ? 'selected':''; ?> value="5">5</option>
                                                    <option <?php echo ($page->order == 6) ? 'selected':''; ?> value="6">6</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="">Parent Page: </label>
                                                <select name="parent" class="form-control parent-page-select">
                                                    <option label="Choose one"> </option>
                                                    <option value="NULL" <?php echo ($page->cms_pages_id == null) ? 'selected':'';?>>No parent</option>

                                                    <?php foreach ($pages as $tpage): ?>
                                                        <option <?php echo ($tpage->id == $page->cms_pages_id) ? 'selected':''; ?> value="<?php echo $tpage->id ?>"><?php echo $tpage->page_name ;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-sm-12">
                                                <label class="">Published: </label>
                                                <div class="main-toggle main-toggle-success <?php echo ($page->published == 1) ? 'on':'off';?> check-toggle" data-input="published">
                                                    <span></span>
                                                </div>
                                                <input name="published" class="form-control" type="hidden" value="<?php echo $page->published; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="">Page Content: </label>
                                        <textarea id="page-content" name="page-content"><?php echo $page->content; ?></textarea>
                                    </div>

                                        <div class="d-flex flex-row-reverse">
                                            <div id="edit-page" class="btn ripple btn-main-primary btn-lg" data-page="<?php echo $page->id; ?>">
                                                <span aria-hidden="true" class="spinner-border spinner-border-sm d-none" role="status"></span>
                                                Update
                                            </div>
                                        </div>
                                </form>
                                <?php else: ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        The page you want to edit does not exist, it was probably recently deleted.
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