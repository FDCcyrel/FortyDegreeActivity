<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Users Controller
 */
class UsersController extends AppController {
    public $uses = array('User');
	public $layout = 'new_layout';
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array('username' => 'email', 'password' => 'password')
                )
            ),
            'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard'), // Example redirect after login
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login') // Example redirect after logout
        )
    );
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('usersave', 'register','thankyou');
    }
	public function usersave()
	{
		$this->render('register');
	}
    public function loginview()
    {
        $this->render('login');
    }
   // Example to debug password hashing and comparison
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

            
            echo "Hashed Password (Entered): $hashedEnteredPassword <br>";
            echo "Hashed Password (Stored): {$user['User']['password']} <br>";

          
            if ($hashedEnteredPassword === $user['User']['password']) {
               
                echo 'Passwords match!';
               
                if ($this->Auth->login($user['User'])) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
              
                echo 'Passwords do not match.';
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        } else {
          
            echo 'User not found.';
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
    
    $this->render('login');
}


    
    
    
    
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create(); 
            $this->User->set($this->request->data);
            
            if ($this->User->validates()) {
               
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('User registered successfully.'));
                    return $this->redirect(['action' => 'thankyou']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
              
                $this->Flash->error(__('Please fix the errors below.'));
                $this->set('errors', $this->User->validationErrors);
            }
        }
        $this->render('register');
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
