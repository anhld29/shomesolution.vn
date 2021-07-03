<div id="main" class="wrapper main-project">
    <div class="top-title">
        <div class="container-fluid">
            <h2 class="title-primary1" style="color: #ed8d38"><?php echo $detailCatalogue['title'] ?> </h2>
        </div>
    </div>
    <section class="content-Experimental content-Experimental-bottom">
        <div class="container-fluid">
            <div class="top-category-project">
                <div class="row">

                    <?php if (isset($listChild) && is_array($listChild) && count($listChild)) { ?>
                        <div class="col-md-12 col-xs-12 col-xs-12">
                            <div class="category-right">
                                <ul>
                                    <?php
                                    foreach ($listChild as $key => $val) {
                                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                        ?>
                                        <li><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <?php if (isset($listChild) && is_array($listChild) && count($listChild)) { ?>
                <?php foreach ($listChild as $key => $val) {
                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                    <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                        <h2 class="title-primary1"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h2>
                        <div class="row">
                            <div class="content-Experimental-right">
                                <?php foreach ($val['post'] as $keyP => $valP) {
                                    $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="item1">
                                            <div class="image">
                                                <a href="<?php echo $hrefP ?>"><img src="<?php echo $valP['image'] ?>"
                                                                                    alt="<?php echo $valP['title'] ?>"></a>
                                            </div>
                                            <div class="nav-image">
                                                <h3 class="title"><a
                                                        href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a>
                                                </h3>
                                                <ul>
                                                    <li>
                                                        <div class="fb-like" data-href="<?php echo $hrefP ?>"
                                                             data-width="" data-layout="button" data-action="like"
                                                             data-size="small" data-share="true"></div>
                                                    </li>
                                                    <li style="display: flex;align-items: center;"><?php echo $valP['viewed'] ?>
                                                        <img src="template/frontend/noithat-PC/images/i3.png"
                                                             alt="<?php echo $valP['viewed'] ?>"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <?php echo $this->load->view('homepage/frontend/common/newHome') ?>
    <?php echo $this->load->view('homepage/frontend/common/tag') ?>
    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>



</div>