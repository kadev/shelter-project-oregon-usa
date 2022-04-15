<style>
    #preview-article-image{

    }
</style>
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Article</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>home/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URL; ?>articles">News Articles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
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
                                <?php if(!empty($article) AND $article != NULL): ?>
                                    <div>
                                        <h6 class="main-content-label mb-1">Enter the fields</h6>
                                        <p class="text-muted card-sub-title">Enter the required fields to update the article.</p>
                                    </div>
                                    <form id="form-edit-article">
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Article Image:</label>
                                                    <div id="container-preview-article-image" style="<?php echo empty($article->image) ? 'display:none;':''; ?>">
                                                        <img id="preview-article-image" src="<?php echo URL ?>/uploads/<?php echo $article->image; ?>" class="img-fluid" style="max-height: 200px;">
                                                        <br><span id="remove-current-image" data-id="<?php echo $article->id; ?>" class="btn ripple btn-danger mt-3">Remove Image</span>
                                                    </div>
                                                    <input type="hidden" name="article-image" value="<?php echo $article->image; ?>"/>
                                                    <div id="fancy-uploader-container" style="<?php echo !empty($article->image) ? 'display:none;':''; ?>">
                                                        <input id="upload-article-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" url="<?php echo URL .'articles/uploadArticleImage' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Article Name: </label>
                                                    <input name="article-name" class="form-control" required="" type="text" value="<?php echo $article->page_name; ?>" placeholder="Type here...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Permalink:</label>
                                                    <input name="permalink" class="form-control" required="" value="<?php echo $article->permalink; ?>" placeholder="Type here...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <label class="">Order:</label>
                                                    <select class="form-control order-select" name="order" value="<?php echo $article->order; ?>">
                                                        <option label="Choose one"> </option>
                                                        <option value="0" <?php echo ($article->order == 0) ? 'selected' : ''; ?>>0</option>
                                                        <option value="1" <?php echo ($article->order == 1) ? 'selected' : ''; ?>>1</option>
                                                        <option value="2" <?php echo ($article->order == 2) ? 'selected' : ''; ?>>2</option>
                                                        <option value="3" <?php echo ($article->order == 3) ? 'selected' : ''; ?>>3</option>
                                                        <option value="4" <?php echo ($article->order == 4) ? 'selected' : ''; ?>>4</option>
                                                        <option value="5" <?php echo ($article->order == 5) ? 'selected' : ''; ?>>5</option>
                                                        <option value="6" <?php echo ($article->order == 6) ? 'selected' : ''; ?>>6</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="">Published:</label>
                                                    <div id="article-published" class="main-toggle main-toggle-success <?php echo ($article->published == 1) ? 'on' : 'off'; ?> check-toggle" data-input="published">
                                                        <span></span>
                                                    </div>
                                                    <input name="published" class="form-control" type="hidden" value="<?php echo $article->published; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Article Content Short:</label>
                                            <textarea id="article-content-short" name="article-content-short"><?php echo $article->content_short; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="">Article Content:</label>
                                            <textarea id="article-content" name="article-content"><?php echo $article->content; ?></textarea>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                            <span id="edit-article" data-article="<?php echo $article->id; ?>" class="btn ripple btn-main-primary btn-lg">Update</span>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        The article you want to edit does not exist, it was probably recently deleted.
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
