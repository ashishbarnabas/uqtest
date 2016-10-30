<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ApiController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Api');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->post_api_key = new POSTAPI();
		$this->Auth->allow('index', 'library');
	}


	public function index(){
		$this->autoRender = false;
		$this->set('title_for_layout', 'UQTEST');
	}

	public function library($id=null){

		$this->set('request_type', 'POST');

		//GET Request
		if($this->request->is('get') && $id != null){
			$checkid = $this->Api->find('first', array(
				'conditions' => array(
					'id' => $id
				)
			));
			$this->set('requested_id', $id);
			$this->set('check_response', $checkid);
			$this->set('request_type', 'GET');

		} else if($this->request->is('post')) {

			$this->autoRender = false;
			$data = $this->request->data;
			CakeLog::write('APILog', $data);

			if(!empty($data)){
				$key = $this->post_api_key->apikey;
				if($this->validatedata($data)) {
					$this->request->data['Api']['id'] = $data['id'];
					$this->request->data['Api']['name'] = $data['name'];
					$this->request->data['Api']['abbr'] = $data['abbr'];
					$this->request->data['Api']['code'] = $data['code'];
					$this->request->data['Api']['url'] = $data['url'];
					if ($this->Api->save($this->request->data)) {
						return 'Data successfully saved';
					}
				} else {
					return 'Invalid Data';
				}
			}
		}

	}

	public function validatedata($data){
		$validateid = false;
		$validatecode = false;
		$validatename = false;
		$validateabbr = false;
		$validateurl = false;

		if(!filter_var($data['id'], FILTER_VALIDATE_INT) === false){
			$validateid = true;
		}

		if(is_string($data['name'])){
			$validatename = true;
		}

		if(is_string($data['abbr'])){
			$validateabbr = true;
		}

		if(!filter_var($data['url'], FILTER_VALIDATE_URL) === false) {
			$validateurl = true;
		}

		if((is_string($data['code'])) && (strlen($data['code']) == 6)){
			$code[0] = substr($data['code'], 0, 3);
			$code[1] = substr($data['code'], 3);
			if(ctype_alpha($code[0]) && ctype_digit ($code[1])){
				$validatecode = true;
			}
		}

		if($validateid && $validatecode && $validateabbr && $validatename && $validateurl){
			return true;
		} else {
			return false;
		}
	}
}
