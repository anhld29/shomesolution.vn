<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Catalogue extends MY_Controller {



	public $module;

	function __construct() {

		parent::__construct();

		$this->load->library('nestedsetbie', array('table' => 'job_catalogue'));

		$this->fc_lang = $this->config->item('fc_lang');

	}



	public function View($id = 0, $page = 1){

		$id = (int)$id;

		$page = (int)$page;

		$perpage = 12;

		$seoPage = '';

		$detailCatalogue = $this->Autoload_Model->_get_where(array(

			'select' => 'id, title, canonical, image, lft, rgt, meta_keyword, meta_title, meta_description, description',

			'table' => 'job_catalogue',

			'where' => array('id' => $id,'alanguage' => $this->fc_lang),

		));

		if(!isset($detailCatalogue) && !is_array($detailCatalogue) && count($detailCatalogue) == 0){

			$this->session->set_flashdata('message-danger', 'Danh mục bài viết không tồn tại');

			redirect(BASE_URL);

		}

		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(

			'select' => 'id, title, slug, canonical, lft, rgt',

			'table' => 'job_catalogue',

			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),

			'order_by' => 'lft ASC, order ASC'

		), TRUE);



		$config['total_rows'] = $this->Autoload_Model->_condition(array(

			'module' => 'job',

			'select' => '`object`.`id`',

			'where' => '`object`.`publish_time` <= "'.$this->currentTime.'" AND `object`.`publish` = 0 AND `object`.`alanguage` = \''.$this->fc_lang.'\'',

			'catalogueid' => $id,

			'count' => TRUE

		));







		$config['base_url'] = rewrite_url($detailCatalogue['canonical'], FALSE, TRUE);

		if($config['total_rows'] > 0){

			$this->load->library('pagination');

			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');

			$config['prefix'] = 'trang-';

			$config['first_url'] = $config['base_url'].$config['suffix'];

			$config['per_page'] = $perpage;

			$config['uri_segment'] = 2;

			$config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="pagination">';

            $config['full_tag_close'] = '</div>';

            $config['first_tag_open'] = '';

            $config['first_tag_close'] = '';

            $config['last_tag_open'] = '';

            $config['last_tag_close'] = '';

            $config['cur_tag_open'] = '<a class="page-numbers active">';

            $config['cur_tag_close'] = '</a>';

            $config['next_tag_open'] = '';

            $config['next_tag_close'] = '';

            $config['prev_tag_open'] = '';

            $config['prev_tag_close'] = '';

            $config['num_tag_open'] = '';

            $config['num_tag_close'] = '';



			$this->pagination->initialize($config);

			$data['PaginationList'] = $this->pagination->create_links();

			$totalPage = ceil($config['total_rows']/$config['per_page']);

			$page = ($page <= 0)?1:$page;

			$page = ($page > $totalPage)?$totalPage:$page;

			$seoPage = ($page >= 2)?(' - Trang '.$page):'';

			if($page >= 2){

				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');

			}

			$page = $page - 1;

			$data['jobList'] = $this->Autoload_Model->_condition(array(

				'module' => 'job',

				'select' => '`object`.`id`, `object`.`title`,`object`.`canonical`, `object`.`image`, `object`.`created`, `object`.`viewed`, `object`.`description`, (SELECT fullname FROM user WHERE user.id = object.userid_created) as user_created, (SELECT title FROM job_catalogue WHERE job_catalogue.id = object.catalogueid) as catalogue_title, (SELECT count(id) FROM comment WHERE comment.detailid = object.id AND comment.module = \'job\') as comment',

				'where' => '`object`.`publish_time` <= "'.$this->currentTime.'" AND `object`.`publish` = 0 AND `object`.`alanguage` = \''.$this->fc_lang.'\'',

				'catalogueid' => $id,

				'limit' => $config['per_page'],

				'start' => ($page * $config['per_page']),

				'order_by' => '`object`.`created` desc',

			));



		}



		$data['id'] = $id;

		$data['module'] = 'job_catalogue';

		$data['meta_title'] = (!empty($detailCatalogue['meta_title'])?$detailCatalogue['meta_title']:$detailCatalogue['title']).$seoPage;

		$data['meta_description'] = (!empty($detailCatalogue['meta_description'])?$detailCatalogue['meta_description']:cutnchar(strip_tags($detailCatalogue['description']), 255)).$seoPage;

		$data['meta_image'] = !empty($detailCatalogue['image'])?base_url($detailCatalogue['image']):'';

		$data['detailCatalogue'] = $detailCatalogue;

		if(!isset($data['canonical']) || empty($data['canonical'])){

			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');

		}






        /*
		if (($detailCatalogue['rgt'] - $detailCatalogue['lft']) > 1) {
			$data['listChild'] = $this->Autoload_Model->_get_where(array(

				'select' => 'id, title, slug, canonical',

				'table' => 'job_catalogue',

				'where' => array('parentid' => $detailCatalogue['id'],'publish' => 0,'alanguage' => $this->fc_lang),

				'order_by' => 'order ASC,id desc'

			), TRUE);

			if (isset($data['listChild']) && is_array($data['listChild']) && count($data['listChild'])) {
				foreach ($data['listChild'] as $key => $val) {
					$data['listChild'][$key]['post'] = $this->Autoload_Model->_condition(array(
						'module' => 'job',
						'select' => '`object`.`id`, `object`.`title`, `object`.`image`,  `object`.`viewed`, `object`.`canonical`',
						'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
						'catalogueid' => $val['id'],
						'limit' => 8,
						'order_by' => '`object`.`order` asc, `object`.`id` desc',
					));
				}
			}
			if(svl_ismobile()){
				$data['template'] = 'job/mobile/catalogue/listChild';
				$this->load->view('homepage/mobile/layout/home', isset($data) ? $data : NULL);
			}else{
				$data['template'] = 'job/frontend/catalogue/listChild';
				$this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
			}



		}else{

			if(svl_ismobile()){
				$data['template'] = 'job/mobile/catalogue/view';
				$this->load->view('homepage/mobile/layout/home', isset($data) ? $data : NULL);
			}else{

			}
		}*/
        $data['template'] = 'job/frontend/catalogue/view';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);

		


	}
	public function listCatalogue(){
		$page = (int)$this->input->get('page');
		$param['catalogueid'] = $this->input->get('catalogueid');
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));

		$json = [];
		$data['from'] = 0;
		$data['to'] = 0;
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$query = '';

		if (!empty($param['catalogueid'])) {
			$query = $query . ' AND tb3.catalogueid IN' . ' (' . $param['catalogueid'] . ') AND `tb1`.`alanguage` = \'' . $this->fclang . '\'';
		}


		$json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "job"', 'full');
		$query = substr($query, 4, strlen($query));
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'tb1.id',
			'table' => 'job as tb1',
			'keyword' => (!empty($keyword)) ? '(tb1.title LIKE \'%' . $keyword . '%\')' : '',
			'join' => $json,
			'query' => $query,
			'distinct' => 'true',
			'count' => TRUE,
		));


		if ($config['total_rows'] > 0) {
			$this->load->library('pagination');
			$config['base_url'] = '#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
			$config['first_url'] = $config['base_url'] . $config['suffix'];
			$config['per_page'] = $perpage;
			$config['cur_page'] = $page;
			$config['page'] = $page;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = '<ul >';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
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
			$listproduct = $this->Autoload_Model->_get_where(array(
				'distinct' => 'true',
				'select' => 'tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.image, tb1.viewed',
				'table' => 'job as tb1',
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'keyword' => (!empty($keyword)) ? '(tb1.title LIKE \'%' . $keyword . '%\')' : '',
				'join' => $json,
				'query' => $query,
				'order_by' => 'tb1.id desc',
			), true);

		}
		$html = '';

		if (isset($listproduct) && is_array($listproduct) && count($listproduct)) {
			$j =0 ;foreach ($listproduct as $key => $val) { $j++;
				$href = rewrite_url($val['canonical'], TRUE, TRUE);
				$canonical = $href;


				$html = $html . '<div class="col-md-3 col-sm-3 col-xs-3">
                                            <div class="item1">
                                                <div class="image">
                                                    <a href="'.$href.'"><img src="'.$val['image'].'"
                                                                                        alt="'.$val['title'].'"></a>
                                                </div>
                                                <div class="nav-image">
                                                    <h3 class="title"><a
                                                            href="'.$href.'">'.$val['title'].'</a>
                                                    </h3>
                                                    <ul>
                                                        <li><div class="fb-like" data-href="'.$canonical.'" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div></li>
                                                        <li style="display: flex;align-items: center;">'.$val['viewed'].'
                                                            <img src="template/frontend/noithat-PC/images/i3.png"
                                                                 alt="'.$val['viewed'].'"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';

				if($j%4==0){$html = $html . '<div class="clearfix"></div>';}
			}
		} else {
			$html = $html . 'Không tìm thấy dữ liệu';
		}

		echo json_encode(array(
			'pagination' => (isset($listPagination)) ? $listPagination : '',
			'html' => (isset($html)) ? $html : '',
		));
		die();
	}
}

