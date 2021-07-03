<div class="ttm-page-title-row">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="title-box ttm-textcolor-white">

                    <div class="page-title-heading">

                        <h2 class="title"><?php echo $detailCatalogue['title'] ?></h2>

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

<div class="site-main" style="padding-top: 0px">

    <!-- sidebar -->

    <div class="sidebar ttm-sidebar-right ttm-bgcolor-white clearfix">

        <div class="container">

            <!-- row -->

            <div class="row d-block">

                <div class="col-lg-9 content-area pull-left">

                    <!-- ttm-blog-classic-->

                    <article class="post ttm-blog-classic">

                        <div class="featured-imagebox featured-imagebox-post">

                            <h1 style="margin: 0px;font-size: 24px;line-height: 25px;text-transform: none;"><?php echo $detailsoftware['title']; ?></h1>

                            <div class="featured-content featured-content-post" style="padding-top: 0px">

                                <div class="post-meta">

                                    <span class="ttm-meta-line"><i class="fa fa-calendar"></i><?php echo $detailsoftware['created']; ?></span>

                                    <span class="ttm-meta-line"><i class="fa fa-eye"></i><?php echo $detailsoftware['viewed']; ?> <?php echo $this->lang->line('luotxem')?></span>


                                </div>

                                <div class="separator">

                                    <style>
                                        .section-main img {
                                            max-width: 100% !important;
                                        }

                                        #at4-share, #at-cv-toaster,#at-share-dock {
                                            display: none !important;
                                        }
                                    </style>
                                    <div class="link_share_detail" style="margin: 10px 0px">
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_google_plus"></a>
                                            <a class="a2a_button_skype"></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <div class="clearfix "></div>
                                    </div>
                                </div>
                                <div class="featured-desc">

                                    <?php echo $detailsoftware['description']; ?>

                                </div>
                                <div></div>
                                <?php echo $this->load->view('homepage/frontend/common/tuyensinh')?>


                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <?php if(isset($softwares_same) && is_array($softwares_same) && count($softwares_same)){ ?>

                            <div class="ttm-blog-classic-content single-blog">

                                <div class="ttm-blog-classic-box-comment">

                                    <div id="comments" class="comments-area" style="margin: 0px">

                                        <h2 class="comments-title"><?php echo $this->lang->line('articles_same')?></h2>
                                        <ul style="padding: 0px;margin: 0px">
                                            <?php foreach($softwares_same as $key => $val) { ?>
                                                <?php
                                                $href = rewrite_url($val['canonical'], true, true);
                                                ?>
                                                <li style="margin-bottom: 8px;"><a href="<?php echo $href?>"><?php echo $val['title']?>     <i style="color: #7D7D8A;font-style: italic;
font-size: 13px; margin-left: 10px;"> ( <?php echo $val['created']?>) </i> </a> </li>
                                            <?php }?>

                                        </ul>


                                    </div>

                                </div>

                            </div>

                        <?php }?>




                    </article>

                    <!-- ttm-blog-classic end -->

                </div>


                <?php echo $this->load->view('homepage/frontend/common/aside')?>

            </div><!-- row end -->



        </div>

    </div>

    <!-- sidebar end -->

</div>