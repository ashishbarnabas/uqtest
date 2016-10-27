<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

class AppController extends Controller {
    public $uses = array('User');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'statics', 'action' => 'index'),
            'authError' => 'Access denied.',
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter()
    {
        $this->Auth->deny();
        //CakeLog::write('error', 'testing');
        if ($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }

    public function isAuthorized($user) {
        $user = $this->Auth->user();
        if ($user['role'] == 'admin') {
            return true;
        }

        return false;

    }
}
