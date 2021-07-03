<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
	}
	
	public function status(){
		$id = $this->input->post('objectid');
		$object = $this->Autoload_Model->_get_where(array(
			'select' => 'id, publish',
			'table' => 'attribute_catalogue',
			'where' => array('id' => $id),
		));
		
		$_update['publish'] = (($object['publish'] == 1)?0:1);
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => 'attribute_catalogue',
			'data' => $_update,
		));
	}
	
	public function listCatalogue(){
		$page = (int)$this->input->get('page');
		$data['from'] = 0;
		$data['to'] = 0;
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$view = $this->input->get('view');
		$query = '';
		if($view > 0){
		    if($view == 1){
                $query = $query =" tour = 1";

            }elseif ($view == 2){
                $query = $query =" room = 1";

            }elseif ($view == 3){
                $query = $query =" car = 1";
            }
        }

		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'attribute_catalogue',
			'keyword' => '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')',
			'query' => $query,
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
				'select' => 'id, title, publish, keyword,created, order,car,room,tour,level,ishome,highlight,image,highlight,isaside,issearch, (SELECT fullname FROM user WHERE user.id = attribute_catalogue.userid_created) as user_created',
				'table' => 'attribute_catalogue',
                'keyword' => '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')',
                'query' => $query,
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by' => 'lft asc',
			), TRUE);	
		}
		
		$html = '';
		 if(isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)){ 
			 foreach($listCatalogue as $key => $val){ 
				$html = $html .'<tr class="gradeX">';
					$html = $html.'<td>';
						$html = $html.'<input type="checkbox" name="checkbox[]" value="'.$val['id'].'" class="checkbox-item">';
						$html = $html.'<label for="" class="label-checkboxitem"></label>';
					$html = $html.'</td>';
					$html = $html.'<td>'.$val['id'].'</td>';
					$html = $html.'<td><a class="maintitle" href="'.site_url('attributes/backend/attributes/view?cataloguesid='.$val['id'].'').'">'.str_repeat('|----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title'].'</a><a href="'. $val['keyword'].'"
                                                                                                                                                                                                                                                                             title="Lấy địa chỉ liên kết"
                                                                                                                                                                                                                                                                             onclick="prompt(\'Lấy địa chỉ liên kết\',\''. $val['keyword'].'\'); return false;"></td>';
					$html = $html.'<td>';
						$html = $html.'<input type="text" name="order['.$val['id'].']" value="'.$val['order'].'" class="form-control" placeholder="Vị trí" style="width:50px;">';
					$html = $html.'</td>';
					$html = $html.'<td>'.$val['user_created'].'</td>';
					$html = $html.'<td>'.gettime($val['created'],'d/m/Y').'</td>';


                    /*if($view == 2){
                        $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['issearch'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="issearch" data-id="'.$val['id'].'" id="publish_issearch'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_issearch'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                     </td>';
                        $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['isaside'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="isaside" data-id="'.$val['id'].'" id="publish_isaside'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_isaside'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                     </td>';
                    }


                 $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['ishome'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="ishome" data-id="'.$val['id'].'" id="publish_ishome'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_ishome'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                     </td>'; $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['tour'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="tour" data-id="'.$val['id'].'" id="publish_tour'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_tour'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>';
                 $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['room'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="room" data-id="'.$val['id'].'" id="publish_room'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_room'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>';
                 $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['car'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="car" data-id="'.$val['id'].'" id="publish_car'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_car'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>';*/

                 $html = $html.'<td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" '.(($val['highlight'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="highlight" data-id="'.$val['id'].'" id="publish_highlight'.$val['id'].'">
                                                            <label class="onoffswitch-label" for="publish_highlight'.$val['id'].'">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                     </td>';
					$html = $html.'<td>';
						$html = $html.'<div class="switch">';
							$html = $html.'<div class="onoffswitch">';
								$html = $html.'<input type="checkbox" '.(($val['publish'] == 0) ? 'checked=""' : '').' class="onoffswitch-checkbox publish" data-id="'.$val['id'].'" id="publish-'.$val['id'].'">';
								$html = $html.'<label class="onoffswitch-label" for="publish-'.$val['id'].'">';
									$html = $html.'<span class="onoffswitch-inner"></span>';
									$html = $html.'<span class="onoffswitch-switch"></span>';
								$html = $html.'</label>';
							$html = $html.'</div>';
						$html = $html.'</div>';
					$html = $html.'</td>';


					$html = $html.'<td class="text-center">';
						$html = $html.'<a type="button" href="'.(site_url('attribute/backend/catalogue/update/'.$val['id'].'')).'" class="btn btn-sm btn-primary mr5"><i class="fa fa-edit"></i></a>';
						$html = $html.'<a type="button" class="btn btn-sm btn-danger ajax-delete " data-title="Lưu ý: Khi bạn xóa danh mục, toàn bộ thuộc tính trong nhóm này sẽ bị xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này!" data-id="'.$val['id'].'" data-module="attribute_catalogue"><i class="fa fa-trash"></i></a>';
					$html = $html.'</td>';
				$html = $html.'</tr>';
			 }
		}else{
             if($view == 2) {
                 $html = $html . '<tr>
				<td colspan="11"><small class="text-danger">Không có dữ liệu</small></td>
			</tr>';
             }else{
                 $html = $html . '<tr>
				<td colspan="10"><small class="text-danger">Không có dữ liệu</small></td>
			</tr>';
             }


		}
		echo json_encode(array(
			'pagination' => (isset($listPagination)) ? $listPagination : '',
			'html' => (isset($html)) ? $html : '',
			'total' => $config['total_rows'],
		));die();		
	}
}
