<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Catalogue extends MY_Controller {



	public $module;

	function __construct() {

		parent::__construct();

		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);

		$this->load->library(array('configbie'));

		$this->load->library('nestedsetbie', array('table' => 'item_catalogue'));

	}

	

	public function view($page = 1){

		$this->commonbie->permission("item/backend/catalogue/view", $this->auth['permission']);

		$page = (int)$page;

		$data['from'] = 0;

		$data['to'] = 0;

		

		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;

		$keyword = $this->input->get('keyword');

		if(!empty($keyword)){

			$keyword = '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')';

		}

		$config['total_rows'] = $this->Autoload_Model->_get_where(array(

			'select' => 'id',

			'table' => 'item_catalogue',

			'keyword' => $keyword,

			'count' => TRUE,

		));

		if($config['total_rows'] > 0){

			$this->load->library('pagination');

			$config['base_url'] = base_url('item/backend/catalogue/view');

			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');

			$config['first_url'] = $config['base_url'].$config['suffix'];

			$config['per_page'] = $perpage;

			$config['uri_segment'] = 5;

			$config['use_page_numbers'] = TRUE;

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

			$data['PaginationList'] = $this->pagination->create_links();

			$totalPage = ceil($config['total_rows']/$config['per_page']);

			$page = ($page <= 0)?1:$page;

			$page = ($page > $totalPage)?$totalPage:$page;

			$page = $page - 1;

			$data['from'] = ($page * $config['per_page']) + 1;

			$data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);

			$data['listCatalogue'] = $this->Autoload_Model->_get_where(array(

				'select' => '*, (SELECT fullname FROM user WHERE user.id = item_catalogue.userid_created) as user_created',

				'table' => 'item_catalogue',

				'limit' => $config['per_page'],

				'start' => $page * $config['per_page'],

				'keyword' => $keyword,

				'order_by' => 'id desc',

			), TRUE);





		}

		

		

		$data['script'] = 'item_catalogue';

		$data['config'] = $config;

		$data['template'] = 'item/backend/catalogue/view';

		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);

	}

	

	public function Create(){

		$this->commonbie->permission("item/backend/catalogue/create", $this->auth['permission']);

		if($this->input->post('create')){

			$this->load->library('form_validation');

			$this->form_validation->CI =& $this;

			$this->form_validation->set_error_delimiters('','/');

			$this->form_validation->set_rules('title', 'Ti??u ????? danh m???c', 'trim|required');

			$this->form_validation->set_rules('canonical', '???????ng d???n danh m???c', 'trim|required|callback__CheckCanonical');

			if($this->form_validation->run($this)){



				$_insert = array(

					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),

					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),

					'canonical' => slug($this->input->post('canonical')),

					'publish' => $this->input->post('publish'),

					'meta_title' => $this->input->post('meta_title'),

					'meta_description' => $this->input->post('meta_description'),

					'userid_created' => $this->auth['id'],


                    'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),

				);

				$resultid = $this->Autoload_Model->_create(array(

					'table' => 'item_catalogue',

					'data' => $_insert,

				));

				if($resultid > 0){

					$canonical = slug($this->input->post('canonical'));

					if(!empty($canonical)){

						$router = array(

							'canonical' => $canonical,

							'crc32' => sprintf("%u", crc32($canonical)),

							'uri' => 'item/frontend/catalogue/view',

							'param' => $resultid,

							'type' => 'number',

							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),

						);

						$this->Autoload_Model->_create(array(

							'table' => 'router',

							'data' => $router,

						));

					}

					$this->session->set_flashdata('message-success', 'Th??m danh m???c b??i vi???t m???i th??nh c??ng');

					redirect('item/backend/catalogue/view');

				}

			}

		}

		

		$data['template'] = 'item/backend/catalogue/create';

		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);

	}

	

	public function Update($id = 0){

		$this->commonbie->permission("item/backend/catalogue/update", $this->auth['permission']);

		$id = (int)$id;

		$detailCatalogue = $this->Autoload_Model->_get_where(array(

			'select' => '*',

			'table' => 'item_catalogue',

			'where' => array('id' => $id),

		));

		if(!isset($detailCatalogue) || is_array($detailCatalogue) == false || count($detailCatalogue) == 0){

			$this->session->set_flashdata('message-danger', 'Danh m???c b??i vi???t kh??ng t???n t???i');

			redirect('item/backend/catalogue/view');

		}

		if($this->input->post('update')){

			$this->load->library('form_validation');

			$this->form_validation->CI =& $this;

			$this->form_validation->set_error_delimiters('','/');

			$this->form_validation->set_rules('title', 'Ti??u ????? danh m???c', 'trim|required');

			$this->form_validation->set_rules('canonical', '???????ng d???n danh m???c', 'trim|required|callback__CheckCanonical');

			if($this->form_validation->run($this)){





				$_update = array(

					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),

					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),

					'canonical' => slug($this->input->post('canonical')),

					'publish' => $this->input->post('publish'),

					'userid_updated' => $this->auth['id'],

					'meta_title' => $this->input->post('meta_title'),

					'meta_description' => $this->input->post('meta_description'),


                    'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),

				);

				$flag = $this->Autoload_Model->_update(array(

					'where' => array('id' => $id),

					'table' => 'item_catalogue',

					'data' => $_update,

				));

				if($flag > 0){


					$canonical = slug($this->input->post('canonical'));

					if(!empty($canonical)){

						$this->Autoload_Model->_delete(array(

							'where' => array('canonical' => $detailCatalogue['canonical'],'uri' => 'item/frontend/catalogue/view','param' => $id),

							'table' => 'router',

						));

						$router = array(

							'canonical' => $canonical,

							'crc32' => sprintf("%u", crc32($canonical)),

							'uri' => 'item/frontend/catalogue/view',

							'param' => $id,

							'type' => 'number',

							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),

						);

						$routerid = $this->Autoload_Model->_create(array(

							'table' => 'router',

							'data' => $router,

						));

					}



					$this->session->set_flashdata('message-success', 'C???p nh???t Danh m???c b??i vi???t th??nh c??ng');

					redirect('item/backend/catalogue/view');

				}

			}

		}

		

		

		

		$data['detailCatalogue'] = $detailCatalogue;

		$data['template'] = 'item/backend/catalogue/update';

		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);

	}

	

	public function _CheckCanonical($canonical = ''){

		

		$originalCanonical = $this->input->post('original_canonical');

		if($canonical != $originalCanonical){

			$crc32 = sprintf("%u", crc32(slug($canonical)));

			$router = $this->Autoload_Model->_get_where(array(

				'select' => 'id',

				'table' => 'router',

				'where' => array('crc32' => $crc32),

				'count' => TRUE

			));

			if($router > 0){

				$this->form_validation->set_message('_CheckCanonical','???????ng d???n ???? t???n t???i, h??y ch???n m???t ???????ng d???n kh??c');

				return false;

			}

		}

		return true;

	}

	

	

}

