<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller{

    public function __construct(){
        parent::__construct();
    }


    public function authentication(){
        $order = <<<HTTP_BODY
{
    "products": [{
        "name": "bút",
        "weight": 0.1,
        "quantity": 1
    }, {
        "name": "tẩy",
        "weight": 0.2,
        "quantity": 1
    }],
    "order": {
        "id": "a4",
        "pick_name": "HCM-nội thành",
        "pick_address": "590 CMT8 P.11",
        "pick_province": "TP. Hồ Chí Minh",
        "pick_district": "Quận 3",
        "pick_ward": "Phường 1",
        "pick_tel": "0911222333",
        "tel": "0911222333",
        "name": "GHTK - HCM - Noi Thanh",
        "address": "123 nguyễn chí thanh",
        "province": "TP. Hồ Chí Minh",
        "district": "Quận 1",
        "ward": "Phường Bến Nghé",
        "hamlet": "Khác",
        "is_freeship": "1",
        "pick_date": "2016-09-30",
        "pick_money": 47000,
        "note": "Khối lượng tính cước tối đa: 1.00 kg",
        "value": 3000000,
        "transport": "fly"
    }
}
HTTP_BODY;


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://khachhang.ghtklab.com/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: 2BEbAc88EFB9A9cAB21779D293E11c13D7E3F808",
                "Content-Length: " . strlen($order),
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo 'Response: ' . $response;

    }

}
