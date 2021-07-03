<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
	}
	
	public function status(){
		$id = $this->input->post('objectid');
		$object = $this->Autoload_Model->_get_where(array(
			'select' => 'id, publish',
			'table' => 'product_area',
			'where' => array('id' => $id,'alanguage' => $this->fclang),
		));
		
		$_update['publish'] = (($object['publish'] == 1)?0:1);
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id,'alanguage' => $this->fclang),
			'table' => 'product_area',
			'data' => $_update,
		));
	}
	
	public function listCatalogue(){
		$page = (int)$this->input->get('page');
		$data['from'] = 0;
		$data['to'] = 0;
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'product_area',
			'where' => array( 'alanguage' => $this->fclang),
			'keyword' => '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')',
			'count' => TRUE,
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] ='#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = $perpage;
			$config['cur_page'] = $page;
			$config['page'] = $page;
			$config['uri_segment'] = 2;
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
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['from'] = ($page * $config['per_page']) + 1;
			$data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
			$listCatalogue = $this->Autoload_Model->_get_where(array(
				'select' => 'id, title, publish, created,image,viewed,canonical, order,ishome, (SELECT fullname FROM user WHERE user.id = product_area.userid_created) as user_created',
				'table' => 'product_area',
				'keyword' => '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')',
				'where' => array( 'alanguage' => $this->fclang),
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by' => 'id desc',
			), TRUE);	
		}
		
		$html = '';
		if(isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)){ 
			foreach($listCatalogue as $key => $val){
                $count = $this->Autoload_Model->_get_where(array(
                    'select' => 'id',
                    'table' => 'product',
                    'where' => array( 'productAreaID' => $val['id']),
                    'count' => TRUE,
                ));
			 	$html = $html .'<tr class="gradeX" id="post-'.$val['id'].'">';
					$html = $html .'<td>';
						$html = $html .'<input type="checkbox" name="checkbox[]" value="'.$val['id'].'" class="checkbox-item">';
						$html = $html .'<label for="" class="label-checkboxitem"></label>';
					$html = $html .'</td>';
					$html = $html .'<td>';
						$html = $html .'<div class="uk-flex uk-flex-middle">';
							$html = $html .'<div class="image mr5">';
								$html = $html .'<span class="image-post img-cover"><img src="'.getthumb($val['image']).'" alt="'.$val['title'].'" /></span>';
							$html = $html .'</div>';
							$html = $html .'<div class="main-info">';
								$html = $html .'<div class="title"><a class="maintitle" href="'.site_url('article/backend/article/update/'.$val['id']).'" title="">'.$val['title'].' ('.$count.')</a></div>';
							$html = $html .'</div>';
						$html = $html .'</div>';
					$html = $html .'</td>';
					$html = $html .'<td>';
						$html = $html .form_input('order['.$val['id'].']', $val['order'], 'data-module="article" data-id="'.$val['id'].'"  class="form-control sort-order" placeholder="Vị trí" style="width:50px;text-align:right;"');
					$html = $html .'</td>';
					$html = $html .'<td>'.$val['user_created'].'</td>';
					$html = $html .'<td>'.gettime($val['created'],'d/m/Y').'</td>';
                $html = $html.'<td class="">
													<div class="switch">
														<div class="onoffswitch">
															<input type="checkbox" '.(($val['ishome'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="product_area" data-title="ishome" data-id="'.$val['id'].'" id="publish_frontend-'.$val['id'].'">
															<label class="onoffswitch-label" for="publish_frontend-'.$val['id'].'">
																<span class="onoffswitch-inner"></span>
																<span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</td>';
					$html = $html .'<td>';
						$html = $html .'<div class="switch">';
						$html = $html .'<div class="onoffswitch">';
								$html = $html.'<input type="checkbox" '.(($val['publish'] == 0) ? 'checked=""' : '').' class="onoffswitch-checkbox publish" data-id="'.$val['id'].'" id="publish-'.$val['id'].'">';
								$html = $html .'<label class="onoffswitch-label" for="publish-'.$val['id'].'">';
									$html = $html .'<span class="onoffswitch-inner"></span>';
									$html = $html .'<span class="onoffswitch-switch"></span>';
								$html = $html .'</label>';
							$html = $html .'</div>';
						$html = $html .'</div>';
					$html = $html .'</td>';
					$html = $html .'<td class="text-center">';
						$html = $html .'<a type="button" href="'.site_url('product/backend/area/update/'.$val['id'].'').'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
						$html = $html .'<a type="button" class="btn btn-danger ajax-delete" data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="'.$val['canonical'].'" data-id="'.$val['id'].'" data-module="article"><i class="fa fa-trash"></i></a>';
					$html = $html .'</td>';
				$html = $html .'</tr>';
			}
		}else{ 
			$html = $html.'<tr>
				<td colspan="9"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
			</tr>';
		}
		echo json_encode(array(
			'pagination' => (isset($listPagination)) ? $listPagination : '',
			'html' => (isset($html)) ? $html : '',
			'total' => $config['total_rows'],
		));die();		
	}
}
