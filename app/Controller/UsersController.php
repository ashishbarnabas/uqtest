<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController {
	public $helpers = array('Html', 'Form');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
		$this->Auth->allow('admin_logout', 'admin_login');
	}

	//Authorization for users login
	public function isAuthorized($user) {
		$user = $this->Auth->user();
		$id = $user['id'];
		if($user['role'] == "admin"){
			return true;
		} else {
			$this->Session->setFlash(__("You do not have permission to do this."));
			$this->redirect('/admin/users/login/');
		}
		return parent::isAuthorized($user);
	}

	public function admin_login($id = null) {
		$this->set('header_title','Admin Login');
		$this->set('title_for_layout', 'UQ Web Dev Test - Login');

		if ($this->request->is('post')||$this->request->is('put')) {
			if ($this->Auth->login()) {
				$user = $this->Auth->user();
				return $this->redirect('/api/library/');
			}   else {
				$this->set('login', 'The username and/or password you have entered is incorrect. Please try again.');
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}

	public function admin_logout() {
		$this->autoRender = false;
		if ($this->Auth->logout()) {
			$this->redirect('/admin/users/login/');
		} else {
			$this->Session->setFlash(__('Logout failed, try again'));
		}
	}
}
