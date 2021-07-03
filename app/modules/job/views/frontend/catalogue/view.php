<div id="main" class="wrapper main-car-detail main-cars-list" style="margin-top: 20px;">
    <div id="main-contact">
        <div class="container">
            <div class="">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>

                    <?php foreach ($breadcrumb as $key => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], true, true);
                        ?>
                        <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a
                                href="<?php echo $href; ?>"
                                title="<?php echo $title; ?>"><?php echo $title; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-9 col-sm-8 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">

                    <div class="blog-listitem ">
                        <h1 style="font-size: 22px;font-weight: bold;line-height: 25px;text-transform: uppercase"><?php echo $detailCatalogue['title']; ?></h1>

                        <?php if (isset($jobList) && is_array($jobList) && count($jobList)) { ?>
                            <?php foreach ($jobList as $key => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $image = $val['image'];
                                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                $description = cutnchar(strip_tags($val['description']), 400);
                                ?>
                                <div class="blog-item ">
                                    <div class="blog-item-inner clearfix">
                                        <div class="itemBlogImg col-md-3 col-xs-12 col-sm-4">
                                            <div class="article-image">
                                                <div>
                                                    <a href="<?php echo $href; ?>">
                                                        <img src="<?php echo $image; ?>" style="height: 174px;object-fit: cover;width: 100%"  alt="<?php echo $title; ?>"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs" style="height: 20px"></div>
                                        <div class="itemBlogContent col-md-9 col-xs-12 col-sm-8 ">
                                            <div class="blog-content">
                                                <div class="article-title font-title">
                                                    <h4><a href="<?php echo $href; ?>"><?php echo $title; ?></a></h4>
                                                </div>
                                                <div class="blog-meta">
                                                    <span class="author"><i class="fa fa-clock-o"></i>&nbsp;<?php echo $val['created'] ?></span>&nbsp;&nbsp;&nbsp;
                                                    <span class="comment_count"><i class="fa fa-eye"></i>&nbsp;<?php echo $val['viewed'] ?> lượt xem</span>
                                                </div>
                                                <p class="article-description" style="text-decoration: none;
    word-break: break-word;
    overflow: hidden;
    display: -webkit-box;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;"><?php echo $description; ?></p>
                                                <div class="readmore">
                                                    <a class="btn btn-primary" style="background: #005596;
    border-color: #005596;"  href="<?php echo $href; ?>">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>
                    </div>
                    <div class="product-filter product-filter-bottom filters-panel clearfix">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                            </div>
                        </div>
                    </div>


                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>

            </div>
        </div>
    </div>
</div>
<style>
    .blog-item .itemBlogImg,.itemBlogContent{
        padding: 0px 5px;
    }
    .blog-item-inner{
        margin: 0px -5px;
    }
    .blog-item{
        margin-bottom: 20px;
    }
</style>
