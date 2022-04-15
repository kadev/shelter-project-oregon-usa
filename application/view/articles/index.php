
<!-- Main Content-->
<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">News Articles</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News Articles</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <a href="<?php echo URL ?>articles/create" type="button" class="btn btn-success my-2 btn-icon-text">
                            <i class="fe fe-plus mr-2"></i> Create article
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
                                <h6 class="main-content-label mb-1">News Articles</h6>
                                <p class="text-muted card-sub-title">View, edit and delete the news articles of your site.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-articles" style="max-width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="wd-5p">ID</th>
                                        <th class="wd-10p">Image</th>
                                        <th class="wd-40p">Article Title</th>
                                        <th class="wd-40p">Permalink</th>
                                        <th class="wd-5p">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($articles as $article): ?>
                                        <tr>
                                            <td><?php echo $article->id ?></td>
                                            <td>
                                                <?php if(!empty($article->image) AND $article->image != NUll): ?>
                                                    <img src="<?php echo URL; ?>uploads/<?php echo $article->image; ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo URL; ?>img/media/1.jpg">
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $article->page_name; ?></td>
                                            <td title="<?php echo $article->permalink; ?>"><?php echo \Mini\Libs\Helper::limitEcho($article->permalink, 50); ?></td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="<?php echo URL . 'articles/edit/' . $article->id; ?>" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>
                                                    <span data-article="<?php echo $article->id; ?>" class="btn ripple btn-danger btn-sm delete-article"><i class="fe fe-trash"></i></span>
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
