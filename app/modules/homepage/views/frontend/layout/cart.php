<!DOCTYPE html>
<html lang="vi-VN" class="anyflexbox boxshadow display-table">
<head>
    <base href="<?php echo base_url(); ?>"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="vi"/>
    <link rel="alternate" href="<?php echo base_url(); ?>" hreflang="vi-vn"/>
    <meta name="robots" content="index,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="<?php echo (isset($this->fcSystem['homepage_company'])) ? $this->fcSystem['homepage_company'] : ''; ?>"/>
    <meta name="copyright" content="<?php echo (isset($this->fcSystem['homepage_company'])) ? $this->fcSystem['homepage_company'] : ''; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="refresh" content="1800"/>

    <!--for Google -->

    <title><?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?></title>
    <meta name="description" charset="UTF-8" content="<?php echo isset($meta_description)?htmlspecialchars($meta_description):'';?>" />
    <?php echo isset($canonical)?'<link rel="canonical" href="'.$canonical.'" />':'';?>
    <meta property="og:locale" content="vi_VN" />
    <!-- for Facebook -->
    <meta property="og:title" content="<?php echo (isset($meta_title) && !empty($meta_title))?htmlspecialchars($meta_title):'';?>" />
    <meta property="og:type" content="<?php echo (isset($og_type) && $og_type != '') ? $og_type : 'article'; ?>" />
    <meta property="og:image" content="<?php echo (isset($meta_image) && !empty($meta_image)) ? $meta_image : 'https://myaladdinzshop.online/image-share-facebook.jpg'; ?>" />
    <meta property="og:url" content="<?php echo (isset($canonical) && !empty($canonical)) ? $canonical : base_url(); ?>" />
    <meta property="og:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
    <meta property="og:site_name" content="<?php echo (isset($this->fcSystem['homepage_company'])) ? $this->fcSystem['homepage_company'] : ''; ?>" />
    <meta property="fb:admins" content=""/>
    <meta property="fb:app_id" content="" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?>" />
    <meta name="twitter:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
    <meta name="twitter:image" content="<?php echo (isset($meta_image) && !empty($meta_image))?$meta_image:'https://myaladdinzshop.online/image-share-facebook.jpg';?>" />
    <link rel="icon" href="<?php echo $this->fcSystem['homepage_favicon']; ?>"  type="image/png" sizes="30x30">

    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url(); ?>';
    </script>

    <link href="template/cart/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="template/cart/css/nprogress.css" rel="stylesheet" type="text/css"/>
    <link href="template/cart/css/font-awesome.min.css" rel="stylesheet"  type="text/css"/>
    <link href="template/cart/css/select2-min.css" rel="stylesheet" type="text/css"/>
    <link href="template/cart/css/checkout.css" rel="stylesheet" type="text/css"/>
    <link href="template/cart/css/checkout00.css" rel="stylesheet" type="text/css"/>

    <?php echo $this->fcSystem['script_header']; ?>
</head>

<body class="body--custom-background-color ">
<?php $this->load->view(isset($template) ? $template : ''); ?>
<?php $this->load->view('homepage/frontend/core/cart'); ?>


</body>

</html>


