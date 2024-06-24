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
            if ($this->Auth->login()) {
                date_default_timezone_set('Asia/Manila');
                $this->User->id = $this->Auth->user('id'); 
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
    
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
    
    // UsersController.php

public function search() {
    $this->autoRender = false; 
    $searchTerm = $this->request->query('term');
    $userId = $this->Auth->user('id');
    $conditions = array(
        'User.name LIKE' => '%' . $searchTerm . '%',
        'User.id !=' => $userId // Exclude current user
    );

   
    $users = $this->User->find('all', array(
        'conditions' => $conditions,
        'fields' => array('User.id', 'User.name'),
        'limit' => 10
    ));

    
    $results = array();
    foreach ($users as $user) {
        $results[] = array(
            'id' => $user['User']['id'],
            'text' => $user['User']['name']
        );
    }

   
    echo json_encode($results);
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
    public function view_profile() {
        $userId = $this->Auth->user('id');
   
    
        // Fetch user data from the User table based on the user's ID
        $userData = $this->User->findById($userId);
    
        // Check if user data was found
        if (!$userData) {
            throw new NotFoundException(__('Invalid user'));
        }
    
        // Pass user data to the view
        $this->set('user', $userData);
    }
    
    
	public function thankyou() {
		$this->render('thankyou'); 
	}

    public function edit() {
        // Ensure user is authenticated and get user ID
        $userId = $this->Auth->user('id');
        if (!$userId) {
            throw new NotFoundException(__('Invalid user'));
        }
    
        if ($this->request->is(['post', 'put'])) {
            // Set user ID in the data to ensure we're updating the correct user
            $this->request->data['User']['id'] = $userId;
    
            // Handle file upload if a new file is provided
            if (!empty($this->request->data['User']['photo_path']['tmp_name'])) {
                $file = $this->request->data['User']['photo_path'];
                $filename = $file['name'];
                $uploadPath = WWW_ROOT . 'img' . DS . 'uploads' . DS . $filename;
    
                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    // File upload successful, save file path to database
                    $this->request->data['User']['photo_path'] = 'uploads/' . $filename;
                } else {
                    // File upload failed
                    $this->Session->setFlash(__('Failed to upload photo. Please try again.'));
                    return;
                }
            }
    
            // Attempt to save the user data
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your profile has been updated.'));
                return $this->redirect(['action' => 'view_profile']);
            } else {
                $this->Session->setFlash(__('Unable to update your profile. Please, try again.'));
            }
        } else {
            // Fetch user data to populate the form
            $this->request->data = $this->User->findById($userId);
            if (!$this->request->data) {
                throw new NotFoundException(__('Invalid user'));
            }
        }
    }
    
	
	
	
	
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

}
