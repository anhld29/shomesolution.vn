<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Job extends MY_Controller {



	public $module;

	function __construct() {

		parent::__construct();

		$this->load->library('nestedsetbie', array('table' => 'job_catalogue'));

		$this->module = 'job';

		$this->fc_lang = $this->config->item('fc_lang');

	}

	

	public function view($id = 0){

		$id = (int)$id;
		$publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);
		

		if(!isset($this->auth) || is_array($this->auth) == false || count($this->auth) == 0){
			$detailjob = $this->Autoload_Model->_get_where(array(

			'select' => 'id,vitri,diadiem,mucluong, title, slug, canonical, catalogueid, description, image, viewed, (SELECT fullname FROM user WHERE user.id = job.userid_created) as fullname, created',

			'table' => 'job',

			'where' => array('publish_time <=' => $publish_time,'id' => $id,'publish' => 0,'alanguage' => $this->fc_lang),

			));
		}else{
			$detailjob = $this->Autoload_Model->_get_where(array(

			'select' => 'id,vitri,diadiem,mucluong, title, slug, canonical, catalogueid, description, image, viewed, (SELECT fullname FROM user WHERE user.id = job.userid_created) as fullname, created',

			'table' => 'job',

			'where' => array('id' => $id),

			));
		}

		if(!isset($detailjob) || is_array($detailjob) == false || count($detailjob) == 0){

			$this->session->set_flashdata('message-danger', 'Bài viết không tồn tại');

			redirect(BASE_URL);

		}

		$data = comment(array('id' => $id, 'module' => $this->module));

		$detailCatalogue = $this->Autoload_Model->_get_where(array(

			'select' => 'id, title, canonical, image, lft, rgt,highlight,ishome,isfooter,isaside',

			'table' => 'job_catalogue',

			'where' => array('id' => $detailjob['catalogueid'],'alanguage' => $this->fc_lang),

		));

		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(

			'select' => 'id, title, slug, canonical, lft, rgt',

			'table' => 'job_catalogue',

			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),

			'order_by' => 'lft ASC, order ASC'

		), TRUE);

		

		/* CẬP NHẬT LƯỢT XEM TỰ NHIÊN */

		$this->Autoload_Model->_update(array(

			'table' => 'job',

			'where' => array('id' => $id),

			'data' => array('viewed'=>$detailjob['viewed'] + 1),

		));

		

		/* OBJECT đã xem */

		$objectSee = isset($_COOKIE[CODE.'jobCookie'])?$_COOKIE[CODE.'jobCookie']:NULL;

		$objectid = json_decode($objectSee, TRUE);

		if (!isset($objectSee) || empty($objectSee)) {

			setcookie(CODE.'jobCookie', json_encode(array(

				0 => $id

			)), time() + (86400 * 30), '/');

		}else{

			foreach ($objectid as $key) {

				$objectid[] = $id;

			}

			$objectid = array_values(array_unique($objectid));

			setcookie(CODE.'jobCookie', json_encode($objectid), time() + (86400 * 30), '/');

		}

		

		$data['jobs_same'] = $this->Autoload_Model->_get_where(array(

			'select' => 'id, title, slug, canonical, image, description, created,viewed',

			'table' => 'job',

			'where' => array('id!= ' => $detailjob['id'], 'catalogueid' => $detailCatalogue['id'],'alanguage' => $this->fc_lang),

			'order_by' => 'order desc, id desc',

			'limit' => 10,

		), TRUE);

		

		$data['tag'] = $this->Autoload_Model->_get_where(array(

			'select' => 'tb1.id , tb1.title, tb1.canonical',

			'table' => 'tag as tb1',

			'join' => array(

				array('tag_relationship as tb2' , 'tb2.tagid = tb1.id', 'inner'),

			),

			'where' => array(

				'publish' => 0,

				'tb2.module' => 'job',

				'tb2.moduleid' => $id,'tb1.alanguage' => $this->fc_lang

			),

		), true);

		$data['module'] = 'job';

		$data['moduleid'] = $detailjob['id'];

		$data['meta_title'] = !empty($detailjob['meta_title'])?$detailjob['meta_title']:$detailjob['title'];

		$data['meta_description'] = html_entity_decode(htmlspecialchars_decode(!empty($detailjob['meta_description'])?$detailjob['meta_description']:cutnchar(strip_tags($detailjob['description']), 300)));

		$data['meta_image'] = !empty($detailjob['image'])?base_url($detailjob['image']):'';

		$data['detailjob'] = $detailjob;

		$data['detailCatalogue'] = $detailCatalogue;

		$data['canonical'] = rewrite_url($detailjob['canonical'], TRUE, TRUE);

		$data['og_type'] = 'job';




        $data['template'] = 'job/frontend/job/view';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);


	}

	

	

}

