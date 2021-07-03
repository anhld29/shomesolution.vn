<?php

function strReplaceAssoc(array $replace, $subject) {
    return str_replace(array_keys($replace), array_values($replace), $subject);
}
function download_remote_file($url, $img)
{
    $url = $url;
    $destination = $img;
    $fp = fopen ($destination, 'w+');
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
    curl_setopt( $ch, CURLOPT_FILE, $fp );
    curl_exec( $ch );
    curl_close( $ch );
    fclose( $fp );
}
if(!function_exists('removeutf8')){
    function removeutf8($value = NULL){
        $chars = array(
            'a'	=>	array('ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','á','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă'),
            'e' =>	array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê'),
            'i'	=>	array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
            'o'	=>	array('ố','ồ','ổ','ỗ','ộ','Ố','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ'),
            'u'	=>	array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư'),
            'y'	=>	array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
            'd'	=>	array('đ','Đ'),
        );
        foreach ($chars as $key => $arr)
            foreach ($arr as $val)
                $value = str_replace($val, $key, $value);
        return $value;
    }
}

$arrContextOptions = array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
$replaceQ = array(
    'https://bepnamduong.vn/' => '',
    'Xem thêm tổng quan' => '',
    'Xem thêm thông số kĩ thuật' => '',
    'Xem thêm đặc điểm nổi bật' => '',


);
define('arrContextOptions', serialize($arrContextOptions));
define('replaceQ', serialize($replaceQ));
define('url_get', 'https://bepnamduong.vn');
function save_image($src){
    $list = explode('/',$src);
    if(!empty($list)){
        $noi = '';
        $count = (int)(count($list)-2);
        for ($i=0;$i<=$count;$i++){
            if($i==0){
                $noi = $noi.$list[$i];
            }else{
                $noi = $noi.$list[$i].'/';
            }
        }
    }

    if (!file_exists($noi)) {
        mkdir($noi, 0777, true);
    }
    $k = 0; foreach ($list as $keyL=>$images){  $k++;
        if(count($list) == $k){
            download_remote_file(url_get.$src, $noi. $images);
        }
    }

}

?>