<?php
App::uses('AppController', 'Controller');

class MessagesController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator');
    public $layout = 'messages'; 

    public function inbox() {
		$currentUser = $this->Auth->user();
	
		// Define conditions to filter messages
		$conditions = array(
			'OR' => array(
				'Message.sender_id !=' => $currentUser['id'],
				'Message.receiver_id' => $currentUser['id']
			)
		);
	
		$this->paginate = array(
			'conditions' => $conditions,
			'limit' => 10,
			'order' => array(
				'Message.date_created' => 'desc'
			),
			'contain' => array(
				'Sender' => array(
					'fields' => array('name') 
				)
			)
		);
	
		
		$messages = $this->paginate('Message');
		$this->set(compact('messages'));
	}
	

  
	public function compose() {
        if ($this->request->is('post')) {
            // Load the Message model
            $this->loadModel('Message');
            
            // Get sender's ID (assuming AuthComponent is used)
            $senderId = $this->Auth->user('id');
            
            // Prepare message data from form submission
            $messageData = array(
                'Message' => array(
                    'sender_id' => $senderId,
                    'receiver_id' => $this->request->data['Message']['receiver_id'],
                    'messages' => $this->request->data['Message']['messages'],
                    'date_created' => date('Y-m-d H:i:s')
                )
            );

            // Attempt to save the message
            if ($this->Message->save($messageData)) {
                // Message saved successfully
                $this->Session->setFlash('Message sent successfully.', 'flash_success');
                $this->redirect(array('action' => 'inbox'));
            } else {
                // Error saving message
                $this->Session->setFlash('Failed to send message. Please try again.', 'flash_error');
            }
        }
    }

    // Example action for sending a message
    public function send() {
        // Logic for sending a message
    }

    // Example action for viewing a single message
    public function view($id = null) {
        // Logic for viewing a single message
    }

    // Example action for deleting a message
    public function delete($id = null) {
        // Logic for deleting a message
    }

    // Remove scaffold when not needed for production
    // public $scaffold;

}