<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Users Controller
 */
class UsersController extends AppController {
    public $uses = array('User'); 
	public $layout = 'new_layout';
    public $components = array('Session');


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
                $this->set('errors', $this->User->validationErrors);
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
    
    
    public function change_password() {
        
        if ($this->request->is('post')) {
        
            $this->User->id = $this->Auth->user('id');
            if ($this->User->exists()) {
            
                $this->User->set($this->request->data);
                
                if ($this->User->validates()) {
                
                    $currentPassword = $this->User->field('password');
                    $enteredCurrentPassword = AuthComponent::password($this->request->data['User']['current_password']);
                
                    if ($currentPassword === $enteredCurrentPassword) {
                        $this->User->saveField('password', $this->request->data['User']['new_password']);
                        $this->Session->setFlash('Password changed successfully.');
                        return $this->redirect(array('action' => 'view_profile'));
                    } else {
                        
                        $this->Session->setFlash('Current password is incorrect.');
                    }
                } else {
                    $this->set('errors', $this->User->validationErrors);
                }
            } else {
                throw new NotFoundException(__('Invalid user'));
            }
        }
    }
    
    
    


    public function change_email() {
       
        $userId = $this->Auth->user('id'); // Assuming 'id' is the primary key field
        $currentUser = $this->User->findById($userId);
    
        if (!$currentUser) {
            throw new NotFoundException(__('User not found'));
        }
    
        // Handle form submission
        if ($this->request->is('post') || $this->request->is('put')) {
            // Set only the fields you want to update
            $this->User->id = $userId; // Set the ID of the user to update
    
            // Only update the 'email' field
            $this->User->saveField('email', $this->request->data['User']['email']);
    
            // Optionally, handle success and failure scenarios
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Email updated successfully.');
                $this->redirect(array('action' => 'first'));
            } else {
                $this->Session->setFlash('Failed to update email.');
                $this->set('errors', $this->User->validationErrors);
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
