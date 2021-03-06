<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Software extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'software_catalogue'));
		$this->module = 'software';
	}
	
	public function view($page = 1){
		$this->commonbie->permission("software/backend/software/view", $this->auth['permission']);
		$page = (int)$page;
		$data['from'] = 0;
		$data['to'] = 0;
		
		$extend = (!in_array('software/backend/software/viewall', json_decode($this->auth['permission'], TRUE))) ? 'userid_created = '.$this->auth['id'].'' : '';
		
		
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));

		$catalogueid = (int)$this->input->get('catalogueid');
		if($catalogueid > 0){
			$config['total_rows'] = $this->Autoload_Model->_condition(array(
				'module' => 'software',
				'select' => '`object`.`id`',
				'where' => ((!empty($extend)) ? '`object`.`userid_created` = '.$this->auth['id'].' AND `alanguage` = \''.$this->fclang.'\'' : '`alanguage` = \''.$this->fclang.'\'' ),
				'keyword' => '(`object`.`title` LIKE \'%'.$keyword.'%\' AND `object`.`description` LIKE \'%'.$keyword.'%\')',
				'catalogueid' => $catalogueid,
				'count' => TRUE
			));
		}else{
			$config['total_rows'] = $this->Autoload_Model->_get_where(array(
				'select' => 'id',
				'table' => 'software',
				'where' => array( 'alanguage' => $this->fclang),

				'where_extend' => $extend,
				'keyword' => '(title LIKE \'%'.$keyword.'%\')',
				'count' => TRUE,
			));
		}
		
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('software/backend/software/view');
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
			if($catalogueid > 0){
				$data['listsoftware'] = $this->Autoload_Model->_condition(array(
					'module' => 'software',
					'select' => '`object`.`id`,`object`.`ishome`,`object`.`highlight`, `object`.`title`, `object`.`slug`,`object`.`canonical`, `object`.`catalogueid`, `object`.`catalogue`, `object`.`publish`, `object`.`image`, `object`.`created`, `object`.`order`, `object`.`viewed`, (SELECT fullname FROM user WHERE user.id = object.userid_created) as user_created, (SELECT title FROM software_catalogue WHERE software_catalogue.id = object.catalogueid) as catalogue_title',
					'where' => ((!empty($extend)) ? '`object`.`userid_created` = '.$this->auth['id'].' AND `alanguage` = \''.$this->fclang.'\'' : '`alanguage` = \''.$this->fclang.'\'' ),
					'keyword' => '(`object`.`title` LIKE \'%'.$keyword.'%\' AND `object`.`description` LIKE \'%'.$keyword.'%\')',
					'catalogueid' => $catalogueid,
					'limit' => $perpage,
					'order_by' => '`object`.`created` desc',
				));
			}else{
				$data['listsoftware'] = $this->Autoload_Model->_get_where(array(
					'select' => 'id, catalogueid,highlight,ishome, catalogue, title, canonical, publish,ishome,highlight,isaside,isfooter, created, order, viewed, image, (SELECT fullname FROM user WHERE user.id = software.userid_created) as user_created, (SELECT title FROM software_catalogue WHERE software_catalogue.id = software.catalogueid) as catalogue_title',
					'table' => 'software',
					'where_extend' => $extend,
					'where' => array( 'alanguage' => $this->fclang),
					'limit' => $config['per_page'],
					'start' => $page * $config['per_page'],
                    'keyword' => '(`title` LIKE \'%'.$keyword.'%\')',
					'order_by' => 'created desc',
				), TRUE);	
			}
		}
		$data['script'] = 'software';
		$data['config'] = $config;
		$data['template'] = 'software/backend/software/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Create(){
		$this->commonbie->permission("software/backend/software/create", $this->auth['permission']);
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Ti??u ????? b??i vi???t', 'trim|required');
			$this->form_validation->set_rules('catalogueid', 'Danh m???c ch??nh', 'trim|is_natural_no_zero');
			//$this->form_validation->set_rules('canonical', '???????ng d???n b??i vi???t', 'trim|required|callback__CheckCanonical');
			if($this->form_validation->run($this)){
				$image = $this->input->post('image');
				$_insert = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('description'),
					'catalogueid' => $this->input->post('catalogueid'),
					'catalogue' => json_encode($this->input->post('catalogue')),
					'tag' => json_encode($this->input->post('tag')),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'publish' => $this->input->post('publish'),
					'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
					'image' => $image,
                    'userid_created' => $this->auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'alanguage' => $this->fclang
				);
				
					
				$resultid = $this->Autoload_Model->_create(array(
					'table' => 'software',
					'data' => $_insert,
				));
				if($resultid > 0){
					/*
					$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$router = array(
							'canonical' => $canonical,
							'crc32' => sprintf("%u", crc32($canonical)),
							'uri' => 'software/frontend/software/view',
							'param' => $resultid,
							'type' => 'number',
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
						$routerid = $this->Autoload_Model->_create(array(
							'table' => 'router',
							'data' => $router,
						));
					}*/
					$catalogue = $this->input->post('catalogue');
					$_catalogue_relation_ship[] = array(
						'module' => 'software',
						'moduleid' => $resultid,
						'catalogueid' => $this->input->post('catalogueid'),
					);
					if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
						foreach($catalogue as $key => $val){
							if($val == $this->input->post('catalogueid')) continue;
							$_catalogue_relation_ship[] = array(
								'module' => 'software',
								'moduleid' => $resultid,
								'catalogueid' => $val
							);
						}
					}
					
					$this->Autoload_Model->_create_batch(array(
						'table' => 'catalogue_relationship',
						'data' => $_catalogue_relation_ship,
					));
					
					
					$tag = $this->input->post('tag');
					if(isset($tag) && is_array($tag) && count($tag)){
						foreach($tag as $key => $val){
							$_tag_relation_ship[] = array(
								'module' => 'software',
								'moduleid' => $resultid,
								'tagid' => $val
							);
						}
						$this->Autoload_Model->_create_batch(array(
							'table' => 'tag_relationship',
							'data' => $_tag_relation_ship,
						));
					}
					
					$this->session->set_flashdata('message-success', 'Th??m b??i vi???t m???i th??nh c??ng');
					redirect('software/backend/software/view');
				}
			}
		}
		$data['script'] = 'software';
		$data['template'] = 'software/backend/software/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Update($id = 0){
		$data = comment(array('id' => $id, 'module' => $this->module));
		
		
		
		$this->commonbie->permission("software/backend/software/update", $this->auth['permission']);
		$id = (int)$id;
		$detailsoftware = $this->Autoload_Model->_get_where(array(
			'select' => '*',
			'table' => 'software',
			'where' => array('id' => $id,'alanguage' => $this->fclang),
		));
		if(!isset($detailsoftware) || is_array($detailsoftware) == false || count($detailsoftware) == 0){
			$this->session->set_flashdata('message-danger', 'b??i vi???t kh??ng t???n t???i');
			redirect('software/backend/software/view');
		}
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Ti??u ????? b??i vi???t', 'trim|required');
			//$this->form_validation->set_rules('canonical', '???????ng d???n b??i vi???t', 'trim|required|callback__CheckCanonical');
			if($this->form_validation->run($this)){
				$_update = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('description'),
					'catalogueid' => $this->input->post('catalogueid'),
					'catalogue' => json_encode($this->input->post('catalogue')),
					'tag' => json_encode($this->input->post('tag')),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'publish' => $this->input->post('publish'),
					'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
					'image' => $this->input->post('image'),
                    'userid_created' => $this->auth['id'],
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);

				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'software',
					'data' => $_update,
				));
				if($flag > 0){
					/*
					$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$this->Autoload_Model->_delete(array(
							'where' => array('canonical' => $detailsoftware['canonical'],'uri' => 'software/frontend/software/view','param' => $id),
							'table' => 'router',
						));
						$router = array(
							'canonical' => $canonical,
							'crc32' => sprintf("%u", crc32($canonical)),
							'uri' => 'software/frontend/software/view',
							'param' => $id,
							'type' => 'number',
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
						$routerid = $this->Autoload_Model->_create(array(
							'table' => 'router',
							'data' => $router,
						));
					}
					*/
					$this->Autoload_Model->_delete(array(
						'where' => array('module' => 'software','moduleid' => $id),
						'table' => 'catalogue_relationship',
					));
					
					$catalogue = $this->input->post('catalogue');
					$_catalogue_relation_ship[] = array(
						'module' => 'software',
						'moduleid' => $id,
						'catalogueid' => $this->input->post('catalogueid'),
					);
					if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
						foreach($catalogue as $key => $val){
							if($val == $this->input->post('catalogueid')) continue;
							$_catalogue_relation_ship[] = array(
								'module' => 'software',
								'moduleid' => $id,
								'catalogueid' => $val
							);
						}
					}
					$this->Autoload_Model->_create_batch(array(
						'table' => 'catalogue_relationship',
						'data' => $_catalogue_relation_ship,
					));

					
					$tag = $this->input->post('tag');
					$this->Autoload_Model->_delete(array(
						'where' => array('module' => 'software','moduleid' => $id),
						'table' => 'tag_relationship',
					));
					if(isset($tag) && is_array($tag) && count($tag)){
						foreach($tag as $key => $val){
							$_tag_relation_ship[] = array(
								'module' => 'software',
								'moduleid' => $id,
								'tagid' => $val
							);
						}
						$this->Autoload_Model->_create_batch(array(
							'table' => 'tag_relationship',
							'data' => $_tag_relation_ship,
						));
					
					}
					
					$this->session->set_flashdata('message-success', 'C???p nh???t b??i vi???t th??nh c??ng');
					redirect('software/backend/software/view');
				}
			}
		}
		
		
		$data['script'] = 'software';
		$data['detailsoftware'] = $detailsoftware;
		$data['template'] = 'software/backend/software/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function duplicate($id = 0){
		$page = ($this->input->get('page')) ? $this->input->get('page') : 1;
		$this->commonbie->permission("software/backend/software/duplicate", $this->auth['permission']);
		
		$id = (int)$id;
		$detailArticle = $this->Autoload_Model->_get_where(array(
			'select' => '*',
			'table' => 'software',
			'where' => array('id' => $id),
		));
		if(!isset($detailArticle) || is_array($detailArticle) == false || count($detailArticle) == 0){
			$this->session->set_flashdata('message-danger', 'B??i vi???t kh??ng t???n t???i');
			redirect('software/backend/software/view');
		}
		$detailArticle['title'] = str_duplicate(array('value' => $detailArticle['title']));
		$detailArticle['canonical'] = str_duplicate(array('value' => $detailArticle['canonical'], 'field' => 'canonical'));
		$data['detailArticle'] = $detailArticle;

		
		//Ki????m tra xem sa??n ph????m co?? n????m trong ch????ng tri??nh khuy????n ma??i na??o kh??ng
		$current = gmdate('Y-m-d H:i:s', time() + 7*3600);
		if($this->input->post('create')){

			$album = $this->input->post('album');

			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Ti??u ????? b??i vi???t', 'trim|required');
			$this->form_validation->set_rules('catalogueid', 'Danh m???c ch??nh', 'trim|is_natural_no_zero');
			//$this->form_validation->set_rules('canonical', '???????ng d???n b??i vi???t', 'trim|required|callback__CheckCanonical');
			
			if($this->form_validation->run($this)){
				$_insert = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('description'),
					'catalogueid' => $this->input->post('catalogueid'),
					'catalogue' => json_encode($this->input->post('catalogue')),
					'tag' => json_encode($this->input->post('tag')),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'publish' => $this->input->post('publish'),
					'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
					'image' => $this->input->post('image'),
					'amp' => $this->input->post('amp'),
					'userid_created' => $this->auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'alanguage' => $this->fclang
				);
				$resultid = $this->Autoload_Model->_create(array(
					'table' => 'software',
					'data' => $_insert,
				));

				if($resultid > 0){
					/*$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$router = array(
							'canonical' => $canonical,
							'crc32' => sprintf("%u", crc32($canonical)),
							'uri' => 'software/frontend/software/view',
							'param' => $resultid,
							'type' => 'number',
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
						$routerid = $this->Autoload_Model->_create(array(
							'table' => 'router',
							'data' => $router,
						));
					}*/


					$catalogue = $this->input->post('catalogue');
					$_catalogue_relation_ship[] = array(
						'module' => 'software',
						'moduleid' => $resultid,
						'catalogueid' => $this->input->post('catalogueid'),
					);
					if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
						foreach($catalogue as $key => $val){
							if($val == $this->input->post('catalogueid')) continue;
							$_catalogue_relation_ship[] = array(
								'module' => 'software',
								'moduleid' => $resultid,
								'catalogueid' => $val
							);
						}
					}
					
					$this->Autoload_Model->_create_batch(array(
						'table' => 'catalogue_relationship',
						'data' => $_catalogue_relation_ship,
					));
					
					
					$tag = $this->input->post('tag');
					if(isset($tag) && is_array($tag) && count($tag)){
						foreach($tag as $key => $val){
							$_tag_relation_ship[] = array(
								'module' => 'software',
								'moduleid' => $resultid,
								'tagid' => $val
							);
						}
						$this->Autoload_Model->_create_batch(array(
							'table' => 'tag_relationship',
							'data' => $_tag_relation_ship,
						));
					}
					
					$this->session->set_flashdata('message-success', 'Th??m b??i vi???t m???i th??nh c??ng');
					redirect('software/backend/software/view');
				}
			}
		}
		$data['script'] = 'software';
		$data['template'] = 'software/backend/software/duplicate';
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
