<div class="main-content side-content pt-0">

    <div class="container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Search</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php URL; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- row -->
            <div class="row row-sm">
                <div class="col-sm-12 col-md-12">
                    <div class="card custom-card search-page">
                        <div class="card-body pb-2">
                            <div class="input-group mb-2">
                                <input id="i-page-search" type="text" class="form-control border-right-0 pl-3" Value="<?php echo isset($string) ? $string : ''; ?>" placeholder="Searching.....">

                                <span class="input-group-append">
                                    <button id="alternative-search" class="btn ripple btn-primary" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="card-body pl-0 pr-0 bd-t-0 pt-0">
                            <div class="main-content-body-profile mb-3">
                                <nav class="nav main-nav-line">
                                    <a class="search-nav-item nav-link d-flex <?php echo $searchType == 'all' ? 'active' : ''; ?>" data-toggle="tab" data-value="all" href="#tab1"><i class="bx bx-search-alt tx-18 t-1 mr-2"></i>All</a>
                                    <a class="search-nav-item nav-link d-flex <?php echo $searchType == 'shelters' ? 'active' : ''; ?>" data-toggle="tab" data-value="shelters" href="#tab2"><i class="bx bx-image-alt tx-18 mr-2"></i>Shelters</a>
                                    <a class="search-nav-item nav-link d-flex <?php echo $searchType == 'articles' ? 'active' : ''; ?>" data-toggle="tab" data-value="articles" href="#tab3"><i class="bx bx-book tx-18  mr-2"></i>Articles</a>
                                    <a class="search-nav-item nav-link d-flex <?php echo $searchType == 'pages' ? 'active' : ''; ?>" data-toggle="tab" data-value="pages" href="#tab4"><i class="bx bx-news tx-18 mr-2"></i>Pages</a>
                                </nav>
                                <input name="search-type" type="hidden" value="<?php echo $searchType; ?>">
                            </div>
                            <p class="text-muted mb-0 pl-3">About <?php echo count($results); ?> results.</p>
                        </div>
                    </div>

                    <?php if(!empty($results)): ?>
                        <?php foreach ($results as $result): ?>
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <a href="<?php echo $result->url; ?>" class="tx-18 font-weight-semibold text-primary"><?php echo $result->title; ?></a>
                                    </div>
                                    <p class="text-success mb-1"><?php echo $result->url; ?></p>
                                    <p class="mb-0 text-muted"><?php echo $result->description; ?></p>
                                    <div class="mt-2">
                                        <a href="<?php echo $result->url; ?>" class="btn ripple btn-outline-light btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                             <strong>Sorry!</strong> No results were found with the parameters received.
                        </div>
                    <?php endif; ?>
                    <!-- <div class="text-center ml-3 mb-4">
                        <div class="row row-sm">
                            <nav>
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
</div>