<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	// public function sleep(){
	// 	sleep(2);
	// }

	public function bookmark(){
		// echo 1;die;

		$id = $this->input->post('idContact');
		$bookmark = $this->input->post('bookmark');
		$_update['bookmark'] = ($bookmark == 0) ? 1 : 0 ;
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => 'contact',
			'data' => $_update,
		));
	}

	public function viewed(){
		$id = $this->input->post('id');
		$viewed = $this->input->post('viewed');
		// echo $viewed; die();
		if($viewed == 0){
			$viewed =1;
			$_update['viewed'] = $viewed;
			$result = $this->Autoload_Model->_update(array(
				'where' => array('id' => $id),
				'table' => 'contact',
				'data' => $_update,
			));
			echo $result; die();
		}
	}

    public function listContact()
    {
        $page = (int)$this->input->get('page');
        $data['from'] = 0;
        $data['to'] = 0;
        if (!empty($_GET['module']) && $_GET['module'] == 'registration') {
            $table = 'registration';

        } else if( $_GET['module'] == 'contact') {
            $table = 'contact';
        }else if( $_GET['module'] == 'mailsubricre') {
            $table = 'contact';
        }
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 5;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $catalogueid = (int)$this->input->get('catalogueid');
        if ($catalogueid > 0) {
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => $table,
                'count' => TRUE,
                // 'where' => array('catalogueid' => $catalogueid),
                'where' => ($catalogueid == 0) ? '' : array('catalogueid' => $catalogueid),
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
            ));
        } else if($_GET['module'] == 'contact'){
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => $table,
                'count' => TRUE,
                'where' => ($catalogueid ==0) ? array('type'=>0) : array( 'catalogueid' => $catalogueid,'type'=>0) ,
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
            ));
        }else if($_GET['module'] == 'mailsubricre'){
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => $table,
                'count' => TRUE,
                'where' => ($catalogueid ==0) ? array('type'=>1) : array( 'catalogueid' => $catalogueid,'type'=>1) ,
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
            ));
        }
        $html = '';
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = base_url('contact/backend/contact/view');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = $perpage;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 5;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<ul class="pagination no-margin">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a class="btn-primary">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $listPagination = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);

            if (!empty($_GET['module']) && $_GET['module'] == 'registration') {
                $listContact = $this->Autoload_Model->_get_where(array(
                    'select' => '*, (SELECT title FROM training_catalogue WHERE training_catalogue.id = registration.nganhhoc) as catalogueTitle',
                    'table' => 'registration',
                    'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
                    'start' => $page * $config['per_page'],
                    'limit' => $config['per_page'],
                    'order_by' => 'created desc',
                ), TRUE);
                if (isset($listContact) && is_array($listContact) && count($listContact)) {
                    foreach ($listContact as $key => $val) {
                        $html = $html . '<tr class="gradeX" id="">
													<td class="pd-top text-center pdt25" >
														<input type="checkbox" name="checkbox[]" value="'. $val['id'].'" class="checkbox-item">
														<label for="" class="label-checkboxitem"></label>
													</td>

													<td class="pd-top">
														<div class="">
															'.$val['fullname'].'<br>
															<b>S??? ??i???n tho???i:</b> '. $val['phone'].'<br>
															<b>Email:</b> '. $val['email'].'<br>
															<b>?????a ch???:</b> '. $val['address'].'<br>
															<b>N??m sinh:</b> '. $val['namsinh'].'<br>
														</div>
													</td>
													<td class="pd-top">
														'. $val['catalogueTitle'].'
													</td>
													<td class="pd-top">
														'. $val['trinhdo'].'
													</td>
													<td class="pd-top">

														<div class="">
															<a class="detail-contact subtitle-1">
																'. $val['message'].'
															</a>
														</div>
													</td>
													<td class="pd-top text-center">'. gettime($val['created'],' h:i:s d/m/Y').'</td>
													<td class="text-center actions" style="padding-top:18px;">

														<a  type="button" class="btn btn-danger btn-delete ajax-delete"  data-id="'.$val['id'].'" data-title="L??u ??: Khi b???n x??a nh??m, to??n b??? th??nh vi??n trong nh??m n??y s??? b??? x??a. H??y ch???c ch???n r???ng b???n mu???n th???c hi???n h??nh ?????ng n??y!" data-router="" data-module="registration" data-child=""><i class="fa fa-trash"></i></a>
													</td>
												</tr>';
                    }
                }


            }
            else if( $_GET['module'] == 'contact'){
                $listContact = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, file, viewed, fullname, email, phone, created, subject, message, bookmark,(SELECT title FROM contact_catalogue WHERE contact_catalogue.id = contact.catalogueid) as catalogueTitle',
                    'table' => 'contact',
                    'where' => ($catalogueid ==0) ? array('type'=>0) : array( 'catalogueid' => $catalogueid,'type'=>0) ,
                    'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
                    'start' => $page * $config['per_page'],
                    'limit' => $config['per_page'],
                    'order_by' => 'viewed asc, created desc',
                ), TRUE);
                if (isset($listContact) && is_array($listContact) && count($listContact)) {
                    foreach ($listContact as $key => $val) {

                        $html = $html.'<tr class="gradeX" id="">
													<td class="pd-top text-center pdt25" >
														<input type="checkbox" name="checkbox[]" value="' . $val['id'] . '" class="checkbox-item">
														<label for="" class="label-checkboxitem"></label>
													</td>
												
													<td class="pd-top">
														<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" class="detail-contact title-1" href="" >'.$val['fullname'].'</a>
														<div class="">
															<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" href="" class="detail-contact subtitle-1 " title="' . $val['phone'] . '">
																' . $val['phone'] . '<br>
																'.$val['email'].'<br>
															</a>
														</div>
													</td>
													<td class="pd-top">
														<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" class="maintitle detail-contact title-1 " style="" href="" title="">
															'.$val['subject'].'
														</a>
														<div class="">
															<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" href="" class="detail-contact subtitle-1" title="">
																'.$val['message'].'
															</a>
														</div>
													</td>
													<td class="pd-top text-center">'. gettime($val['created'],' h:i:s d/m/Y').'</td>
													<td class="text-center actions" style="padding-top:18px;">

														<a  type="button" class="btn btn-danger btn-delete ajax-delete"  data-id="' . $val['id'] . '" data-title="L??u ??: Khi b???n x??a nh??m, to??n b??? th??nh vi??n trong nh??m n??y s??? b??? x??a. H??y ch???c ch???n r???ng b???n mu???n th???c hi???n h??nh ?????ng n??y!" data-router="" data-module="contact" data-child=""><i class="fa fa-trash"></i></a>
													</td>
												</tr>';
                    }
                }
            }else if($_GET['module'] == 'mailsubricre'){
                $listContact = $this->Autoload_Model->_get_where(array(
                    'select' => '*,(SELECT title FROM contact_catalogue WHERE contact_catalogue.id = contact.catalogueid) as catalogueTitle',
                    'table' => 'contact',
                    'where' => ($catalogueid ==0) ? array('type'=>1) : array( 'catalogueid' => $catalogueid,'type'=>1) ,
                    'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
                    'start' => $page * $config['per_page'],
                    'limit' => $config['per_page'],
                    'order_by' => 'viewed asc, created desc',
                ), TRUE);
                if (isset($listContact) && is_array($listContact) && count($listContact)) {
                    foreach ($listContact as $key => $val) {

                        $html = $html.'<tr class="gradeX" id="">
                                                <td class="pd-top text-center pdt25" >
                                                    <input type="checkbox" name="checkbox[]" value="'.$val['id'].'" class="checkbox-item">
                                                    <label for="" class="label-checkboxitem"></label>
                                                </td>
                                                <td class="pd-top">'.$val['title'].'</td>


                                                <td class="pd-top">
                                                    <a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" class="detail-contact title-1" href="" >'. $val['fullname'].'</a>
                                                    <div class="">
                                                        <a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" href="" class="detail-contact subtitle-1" >'.$val['email'].'</a>
                                                    </div>
                                                </td>

<td class="pd-top ">'.$val['phone'].'</td>
<td class="pd-top ">'.$val['message'].'</td>
                                                <td class="pd-top text-center">'.gettime($val['created'],' h:i:s d/m/Y').'</td>
                                                <td class="text-center actions" style="padding-top:18px;">
                                                    <a  type="button" class="btn btn-danger btn-delete ajax-delete"  data-id="' . $val['id'] . '" data-title="L??u ??: Khi b???n x??a nh??m, to??n b??? th??nh vi??n trong nh??m n??y s??? b??? x??a. H??y ch???c ch???n r???ng b???n mu???n th???c hi???n h??nh ?????ng n??y!" data-router="" data-module="contact" data-child=""><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>';
                    }
                }
            }



        } else {
            $html = $html . '<tr><td colspan="9"><small class="text-danger">Kh??ng c?? d??? li???u ph?? h???p</small></td></tr> ';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
            'total' => $config['total_rows'],
        ));
        die();
    }




    /* ================ delete ======================= */
	public function ajax_delete(){
		$param['module'] = $this->input->post('module');
		$param['id'] = (int)$this->input->post('id');
		$param['child'] = (int)$this->input->post('child');

		$flag = $this->Autoload_Model->_delete(array(
			'where' => array('id' => $param['id']),
			'table' => $param['module']
		));
		echo $flag; die();
	}

	public function ajax_group_delete(){
		$param = $this->input->post('param');
		if(isset($param['list']) && is_array($param['list']) && count($param['list'])){
			foreach($param['list'] as $key => $val){
				$result = $this->Autoload_Model->_delete(array(
					'where' => array('id' => $val),
					'table' => $param['module'],
				));
				if($result > 0){
					$countChild = $this->Autoload_Model->_get_where(array(
						'where' => array('catalogueid' => $val),
						'table' => 'contact',
						'count' => TRUE,
					));
					if($countChild >0){
						$resultChild = $this->Autoload_Model->_delete(array(
							'where' => array('catalogueid' => $val),
							'table' => 'contact',
						));
						if($resultChild <= 0){
							$error = array(
								'flag' => 1,
								'message' => 'X??a kh??ng th??nh c??ng ph???n t??? con trong nh??m',
							);
							echo json_encode(array(
								'error' => $error,
							));die;
						}
					}else{
						$error = array(
							'flag' => 1,
							'message' => 'X??a kh??ng th??nh c??ng',
						);
						echo json_encode(array(
							'error' => $error,
						));die;
					}
				}
				$error = array(
					'flag' => 0,
					'message' => '',
				);
				echo json_encode(array(
					'error' => $error,
				));die;
			}
		}
	}
	
	
	public function phone_call(){
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_error_delimiters('','/');
		$this->form_validation->set_rules('phone', 'S??? ??i???n tho???i', 'trim|required|is_numeric|min_length[10]|max_length[11]');
		if($this->form_validation->run($this)){
			$this->load->library(array('mailbie'));
			$this->mailbie->sent(array(
				'to' => 'tuannc.dev@gmail.com',
				'cc' => 'minhphuong2811.tb@gmail.com',
				'subject' => 'Th??ng tin kh??ch h??ng: ',
				'message' => '<div>S??? ??i???n tho???i: <span style="color:red;">'.$this->input->post('phone').'</span></div>',
			));
			$this->session->set_flashdata('message-success', 'G???i th??ng tin th??nh c??ng, Ch??ng t??i s??? li??n h??? l???i v???i b???n trong th???i gian s???m nh???t');
			$error['flag'] = 0;
			$error['message'] = ''; 
		}else{
			$error['flag'] = 1;
			$error['message'] = validation_errors(); 
			
		}
		echo json_encode(array(
			'error' => $error,
		));die();
	}

	public function save_contact_register(){
		if($this->input->post('data')){
			$data = $this->input->post('data');
			$email = $this->input->post('email');
			
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			
			
			if($this->form_validation->run($this)){
				$error = '';
				//validate th??nh c??ng ti???n h??nh l??u th??ng tin v??o db contact
				$_insert = array(
					'subject' => '????ng k?? nh???n b???n tin ??u ????i',
					'email' => $email,
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				
				$insertId = $this->Autoload_Model->_create(array(
					'table' => 'contact',
					'data' => $_insert,
				));

				//g???i email
				$this->load->library('mailbie');
					
				$this->mailbie->sent(array(
					'to' => array('tudo2109@gmail.com'),
					'cc' => '',
					'subject' => 'Y??u c???u ????ng k?? nh???n th??ng b??o t??? h??? th???ng '.$this->fcSystem['contact_website'].'',
					'message' =>	'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<section class="mail-content" style="border: 1px solid #E5E5E5;">
										<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
											<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">Th??ng tin kh??ch h??ng</span></h2>
										</div>
										<div class="content" style="padding: 0 15px;">
											<p style="margin-bottom: 10px;"><label class="md-label" style="font-size: 13px;font-weight: 600; margin-right: 20px;">Email: </label><span style="text-transform: capitalize;">'.$email.'</span></p>
										</div>
									</section>
									',
				));	

				$this->mailbie->sent(array(
					// 'to' => array($this->fcSystem['contact_email']),
					'to' => array($email),
					'cc' => '',
					'subject' => 'Th??ng b??o t??? h??? th???ng '.$this->fcSystem['contact_website'].'',
					'message' =>	'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<section class="mail-content" style="border: 1px solid #E5E5E5;">
										<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
											<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">'.$this->fcSystem['contact_website'].' ch??o m???ng b???n</span></h2>
										</div>
										<div class="content" style="padding: 0 15px;">
											'.$this->fcSystem['email_content_1'].'
										</div>

									</section>
									',
				));

				
				if($insertId > 0){
					echo json_encode(array(
						'error' => $error,
					));die;
				}
				
				echo json_encode(array(
					'error' => '???? c?? l???i x???y ra. Xin vui l??ng quay l???i sau ??t ph??t !',
				));die;
				
			}else{
				echo json_encode(array(
					'error' => validation_errors(),
				)); die;
			}
			
		}
	}


	public function save(){
		$post = $this->input->post('post');
		$temp = '';
		if(isset($post) && is_array($post) && count($post)){
			foreach($post as $key => $val){
				$temp[$val['name']] =  $val['value'];
			}


		}

		if(isset($temp) && is_array($temp) && count($temp)){
			$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<section class="mail-content" style="border: 1px solid #E5E5E5;">
							<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
								<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">Th??ng tin li??n h???</span></h2>
							</div>
							<div class="content" style="padding: 0 15px;">';
								if (isset($temp) && is_array($temp) && count($temp)) {
									$html.= '<p style="margin-bottom: 10px;"><label class="md-label" style="font-size: 13px;font-weight: 600; margin-right: 20px;">'.$temp['email'].': </label><span style="">'.$temp['phone'].'</span></p>';
								}
			$html .= 		'</div>
						</section>';
			$this->load->library('mailbie');
			$this->mailbie->sent(array(
				'to' => $this->fcSystem['contact_email'],
				'cc' => '',
				'subject' => 'Y??u c???u l???y t??i li???u t??? h??? th???ng '.$this->fcSystem['contact_website'],
				'message' => $html,
			));
		}




		echo $html;die();


	}

	public function save_info_contact(){
		if($this->input->post()){
			$data = $this->input->post('data');
			$validate = $this->input->post('validate');


			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');

			if (isset($validate) && is_array($validate) && count($validate)) {
				foreach($validate as $key => $val){
					$this->form_validation->set_rules($val['name'], $val['label'], $val['rule']);
				}
			}
			if($this->form_validation->run($this)){
				$error = '';
				//validate th??nh c??ng ti???n h??nh l??u th??ng tin v??o db contact
				if (isset($data) && is_array($data) && count($data)) {
					foreach($data as $key => $val){
						$_insert[$val['name']] = $val['value'];
					}
				}
				$_insert['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);

				$insertId = $this->Autoload_Model->_create(array(
					'table' => 'contact',
					'data' => $_insert,
				));

				if($insertId > 0){
					// g???i mail cho ng?????i qu???n tr???

					$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<section class="mail-content" style="border: 1px solid #E5E5E5;">
									<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
										<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">Th??ng tin li??n h???</span></h2>
									</div>
									<div class="content" style="padding: 0 15px;">';
										if (isset($data) && is_array($data) && count($data)) {
											foreach ($data as $key => $val) {
												$html.= '<p style="margin-bottom: 10px;"><label class="md-label" style="font-size: 13px;font-weight: 600; margin-right: 20px;">'.$validate[$key]['label'].': </label><span style="">'.$val['value'].'</span></p>';
											}
										}
					$html .= 		'</div>
								</section>';


					$this->load->library('mailbie');
					$this->mailbie->sent(array(
						'to' => $this->fcSystem['contact_email'],
						'cc' => '',
						'subject' => 'Y??u c???u "'.$_insert['subject'].'" t??? h??? th???ng '.$this->fcSystem['contact_website'],
						'message' => $html,
					));

					echo json_encode(array(
						'error' => $error,
					));die;
				}

				echo json_encode(array(
					'error' => '???? c?? l???i x???y ra. Xin vui l??ng quay l???i sau ??t ph??t !',
				));die;

			}else{
				echo json_encode(array(
					'error' => validation_errors(),
				)); die;
			}

		}
	}
	
}