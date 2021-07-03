<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class ConfigBie{



    function __construct($params = NULL){

        $this->params = $params;

    }



    // meta_title là 1 row -> seo_meta_title

    // contact_address

    // chưa có thì insert

    // có thì update
    public function system(){
        $data['homepage'] =  array(
            'label' => 'Thông tin chung',
            'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu website. Logo của website và icon website trên tab trình duyệt',
            'value' => array(
                'brandname' => array('type' => 'text', 'label' => 'Tên thương hiệu'),
                'company' => array('type' => 'text', 'label' => 'Tên công ty'),
                'logo' => array('type' => 'images', 'label' => 'Logo'),
                'logof' => array('type' => 'images', 'label' => 'Logo footer'),
                'favicon' => array('type' => 'images', 'label' => 'Favicon'),
                'masodn' => array('type' => 'text', 'label' => 'Mã số doanh nghiệp'),
                'count_menu' => array('type' => 'text', 'label' => 'Số menu hiển thị trên header'),
                'icon' => array('type' => 'images', 'label' => 'Icon cửa hàng'),
//                'description' => array('type' => 'textarea', 'label' => 'Giới thiệu chân trang'),
                // 'slogan' => array('type' => 'text', 'label' => 'Slogan'),


            ),

        );

        $data['contact'] =  array(
            'label' => 'Thông tin liên lạc',
            'description' => 'Cấu hình đầy đủ thông tin liên hệ giúp khách hàng dễ dàng tiếp cận với dịch vụ của bạn',
            'value' => array(
                'address' => array('type' => 'text', 'label' => 'Địa chỉ'),
                'hotline' => array('type' => 'text', 'label' => 'Hotline'),
                 'phone' => array('type' => 'text', 'label' => 'Số điện thoại'),
                'email' => array('type' => 'text', 'label' => 'Email'),
                'website' => array('type' => 'text', 'label' => 'Website'),
                'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
                'contact' => array('type' => 'editor', 'label' => 'Liên hệ'),
                'timelv' => array('type' => 'text', 'label' => 'Giờ làm việc'),
            ),
        );


        $data['seo'] =  array(

            'label' => 'Cấu hình thẻ tiêu đề',

            'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',

            'value' => array(

                'meta_title' => array('type' => 'text', 'label' => 'Tiêu đề trang','extend' => ' trên 70 kí tự', 'class' => 'meta-title', 'id' => 'titleCount'),

                'meta_description' => array('type' => 'textarea', 'label' => 'Mô tả trang','extend' => ' trên 320 kí tự', 'class' => 'meta-description', 'id' => 'descriptionCount'),
                'meta_images' => array('type' => 'images', 'label' => 'Ảnh'),

            ),

        );

        $data['social'] =  array(
            'label' => 'Cấu hình mạng xã hội',
            'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
            'value' => array(
                'facebook' => array('type' => 'text', 'label' => 'Facebook'),
                'facebookm' => array('type' => 'text', 'label' => 'Facebook message'),
                 'instagram' => array('type' => 'text', 'label' => 'Instagram'),
//                 'twitter' => array('type' => 'text', 'label' => 'Twitter'),
//                'google_plus' => array('type' => 'text', 'label' => 'Google plus'),
//                'pinterest' => array('type' => 'text', 'label' => 'Pinterest'),
                'youtube' => array('type' => 'text', 'label' => 'Youtube'),
//                'rss' => array('type' => 'text', 'label' => 'RSS'),
//                'skype' => array('type' => 'text', 'label' => 'Skype'),
               'zalo' => array('type' => 'text', 'label' => 'Số zalo'),
            ),
        );
       
        $data['script'] =  array(
            'label' => 'Script',
            'description' => '',
            'value' => array(
                'header' => array('type' => 'textarea', 'label' => 'Script header'),
                'footer' => array('type' => 'textarea', 'label' => 'Script footer'),

            ),
        );
//        $data['title'] =  array(
//            'label' => 'Script',
//            'description' => '',
//            'value' => array(
//                'title1' => array('type' => 'text', 'label' => 'Lọc sản phẩm phù hợp với bạn'),
//                'title2' => array('type' => 'textarea', 'label' => 'Mô tả'),
//
//            ),
//        );


//
        $data['banner'] =  array(

            'label' => 'Hình ảnh',

            'description' => '',

            'value' => array(


//                'aboutus' => array('type' => 'text', 'label' => 'Tiêu đề giới thiệu'),
//                'link' => array('type' => 'text', 'label' => 'LINK giới thiệu'),
//                'contact' => array('type' => 'textarea', 'label' => 'Mô tả liên hệ'),
//                'contact_phone' => array('type' => 'textarea', 'label' => 'Support 24/7 - Online 24 hours'),
//                'contact_address' => array('type' => 'text', 'label' => 'Mon- Sat: 5:00 am to 6:30 pm'),
//                'contact_sunday' => array('type' => 'text', 'label' => 'Sunday: Close'),
//                'image4' => array('type' => 'images', 'label' => 'Ảnh 4'),
//                'image5' => array('type' => 'images', 'label' => 'Ảnh 5'),
//                'image6' => array('type' => 'images', 'label' => 'Ảnh 6'),
//                'image7' => array('type' => 'images', 'label' => 'Ảnh 7'),
//                'image8' => array('type' => 'images', 'label' => 'Ảnh 8'),
//                'image9' => array('type' => 'images', 'label' => 'Ảnh 9'),
                'tragop_pc' => array('type' => 'images', 'label' => 'Ảnh trả góp trang chủ PC'),
                'tragop_mobile' => array('type' => 'images', 'label' => 'Ảnh trả góp trang chủ MOBILE'),
                '365_pc' => array('type' => 'images', 'label' => 'Ảnh 365 PC'),
                '365_mobile' => array('type' => 'images', 'label' => 'Ảnh 365 MOBILE'),
            ),

        );
        $data['link'] =  array(

            'label' => 'Link',

            'description' => '',

            'value' => array(
                'tragop' => array('type' => 'text', 'label' => 'Tiêu đề trả góp'),
                'link_tragop' => array('type' => 'text', 'label' => 'Link trả góp'),
                'mota_tragop' => array('type' => 'editor', 'label' => 'Chi tiết trả góp'),
                'anh_tragop' => array('type' => 'images', 'label' => 'Ảnh page trả góp'),
                '_linkanh_tragop' => array('type' => 'text', 'label' => 'LInk Ảnh page trả góp'),
                'tieude_tragop' => array('type' => 'text', 'label' => 'Tiêu đề page trả góp'),
                'mota_page_tragop' => array('type' => 'text', 'label' => 'Mô tả page trả góp'),
                'bst' => array('type' => 'text', 'label' => ' BST'),
                'link_bst' => array('type' => 'text', 'label' => 'Link BST'),
                'bct' => array('type' => 'text', 'label' => 'Link bộ công thương'),
                'xemthem' => array('type' => 'text', 'label' => 'Xem thêm thương hiệu'),
            ),

        );
        $data['menu'] =  array(

            'label' => 'Menu',

            'description' => '',

            'value' => array(
                'icon_tl' => array('type' => 'images', 'label' => 'Icon hàng thanh lý'),
                'title_tl' => array('type' => 'text', 'label' => 'Tiêu đề hàng thanh lý'),
                'link_tl' => array('type' => 'text', 'label' => 'Link hàng thanh lý'),
                'icon_km' => array('type' => 'images', 'label' => 'Icon khuyến mại'),
                'title_km' => array('type' => 'text', 'label' => 'Tiêu đề khuyến mại'),
                'link_tkm' => array('type' => 'text', 'label' => 'Link khuyến mại'),

            ),

        );
        $data['store'] =  array(

            'label' => 'Cửa hàng',

            'description' => '',

            'value' => array(
                'image' => array('type' => 'images', 'label' => 'Hình ảnh cửa hàng'),
                'so' => array('type' => 'text', 'label' => 'Số cửa hàng'),


            ),

        );
        $data['title'] =  array(

            'label' => 'Tiêu đề',

            'description' => '',

            'value' => array(
                'title_1' => array('type' => 'text', 'label' => 'COMBO PHÒNG BẾP'),
                'title_2' => array('type' => 'text', 'label' => 'PHÒNG BẾP CỦA BẠN'),
                'title_3' => array('type' => 'text', 'label' => 'COMBO PHÒNG TẮM'),
                'title_4' => array('type' => 'text', 'label' => 'PHÒNG TẮM CỦA BẠN'),
                'title_5' => array('type' => 'text', 'label' => 'Thương Hiệu Nổi Tiếng'),
                'title_6' => array('type' => 'text', 'label' => 'Tại sao lại chọn ...'),
                'title_7' => array('type' => 'text', 'label' => 'Nhập thông tin nhận tư vấn'),
                'title_8' => array('type' => 'editor', 'label' => 'Mô tả nhập thông tin nhận tư vấn'),
                'title_9' => array('type' => 'textarea', 'label' => 'Mô tả chi tiết sản phẩm'),


            ),

        );
        $data['partner'] =  array(

            'label' => 'Đối tác',

            'description' => '',

            'value' => array(
                'title' => array('type' => 'text', 'label' => 'Tiêu đề'),
                'title_2' => array('type' => 'editor', 'label' => 'Mô tả'),


            ),

        );

        return $data;

    }

}

