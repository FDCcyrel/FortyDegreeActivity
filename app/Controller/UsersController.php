<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Users Controller
 */
class UsersController extends AppController {
    public $uses = array('User');
	public $layout = 'new_layout';
    

    public function first()
    {
        $this->render('dashboard');
    }
    public function logout() {
        $this->Session->destroy(); 
    
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
    

    public function login() {
        if ($this->request->is('post')) {
            $email = $this->request->data['User']['email'];
            $password = $this->request->data['User']['password'];
    
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $email
                )
            ));
    
            if ($user) {
                $hashedEnteredPassword = AuthComponent::password($password);
                if ($hashedEnteredPassword === $user['User']['password']) {
                    if ($this->Auth->login($user['User'])) {
                        return $this->redirect($this->Auth->redirect());
                    } else {
                        $this->Session->setFlash('Something went wrong.', 'default', array(), 'auth');
                    }
                } else {
                    $this->Session->setFlash('Incorrect password.', 'default', array(), 'auth');
                }
            } else {
                $this->Session->setFlash('Invalid username or password, try again.', 'default', array(), 'auth');
            }
        }
    }
    
    
    
    
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'thankyou'));
            } else {
               
                $this->set('errors', $this->User->validationErrors);
            }
        }
        $this->set('title_for_layout', __('User Registration'));
    }
    
	public function thankyou() {
		$this->render('thankyou'); 
	}
	
	
	
	
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

}
