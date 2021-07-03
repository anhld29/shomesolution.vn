<div class="ttm-page-title-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-box ttm-textcolor-white">
                    <div class="page-title-heading">
                        <h1 class="title"><?php echo $detailCatalogue['title'] ?></h1>
                    </div><!-- /.page-title-captions -->
                    <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="<?php echo base_url() ?>"><i class="ti ti-home"></i>&nbsp;&nbsp;<?php echo $this->lang->line('home_page')?></a>
                                </span>

                        <?php foreach ($breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], true, true);
                            ?>
                            <span class="ttm-bread-sep">&nbsp; | &nbsp;</span>
                            <a href="<?php echo $href; ?>"><?php echo $title; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>

<div class="site-main">

    <!--blog-section-->
    <section class="ttm-row blog-grid-section clearfix">
        <div class="container">
            <!-- row -->
            <div class="row">
                <?php if (isset($softwareList) && is_array($softwareList) && count($softwareList)) { ?>
                    <?php foreach ($softwareList as $key => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $image = $val['image'];
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $description = cutnchar(strip_tags($val['description']), 100);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <!-- featured-imagebox-post -->
                            <div class="featured-imagebox featured-imagebox-post box-shadow">
                                <div class="featured-thumbnail">
                                    <a href="<?php echo $href; ?>"> <img class="img-fluid" src="<?php echo $image; ?>"
                                                                         alt="<?php echo $title; ?>"
                                                                         style="height: 249px;object-fit: cover;width: 100%"></a>

                                </div>
                                <div class="featured-content featured-content-post">
                                    <div class="post-title featured-title">
                                        <h5><a href="<?php echo $href; ?>"><?php echo $title; ?></a>
                                        </h5>
                                    </div>
                                    <div class="post-meta">
                                        <span class="ttm-meta-line"><i
                                                    class="fa fa-calendar"></i><?php echo $val['created'] ?></span>
                                        <span class="ttm-meta-line"><i
                                                    class="fa fa-eye"></i><?php echo $val['viewed'] ?> <?php echo $this->lang->line('luotxem')?></span>
                                    </div>
                                    <p class="software-description"><?php echo $description; ?></p>

                                </div>
                            </div><!-- featured-imagebox-post end -->
                        </div>
                    <?php } ?><?php } ?>
            </div><!-- row end-->
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>


                </div>
            </div>
        </div>
    </section>
    <!--blog-section end-->

</div>