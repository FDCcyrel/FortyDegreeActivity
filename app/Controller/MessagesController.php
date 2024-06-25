<?php
App::uses('AppController', 'Controller');

class MessagesController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator');
    public $layout = 'messages'; 

    public function inbox() {
        $currentUser = $this->Auth->user();
        
      
        $interactedSenders = $this->Message->find('all', array(
            'conditions' => array(
                'Message.receiver_id' => $currentUser['id']
            ),
            'fields' => array('DISTINCT Message.sender_id'),
            'recursive' => -1
        ));
        
     
        // Extract all unique sender IDs
        $senderIds = Hash::extract($interactedSenders, '{n}.Message.sender_id');
        
        // Fetch the latest message for each sender
        $latestMessages = array();
        
        foreach ($senderIds as $senderId) {
           
            $conditions = array(
                'OR' => array(
                    array('AND' => array(
                        'Message.sender_id' => $senderId,
                        'Message.receiver_id' => $currentUser['id']
                    )),
                    array('AND' => array(
                        'Message.sender_id' => $currentUser['id'],
                        'Message.receiver_id' => $senderId
                    ))
                )
            );
          
          
            $latestMessage = $this->Message->find('first', array(
                'conditions' => $conditions,
                'order' => array(
                    'Message.date_created' => 'desc'
                ),
                'contain' => array(
                    'Sender' => array(
                        'fields' => array('name')
                    )
                )
            ));
            
          
            if ($latestMessage && $latestMessage['Message']['sender_id'] === $senderId) {
                $latestMessages[] = $latestMessage;
            }
        }
        
      
        $this->set('latestMessages', $latestMessages);
    }
    
    
    
    
    
    
    
    
    
    
    
   
    public function view($id = null) {
        $sender_id = $id;
        $currentUser = $this->Auth->user();
        $myid = $this->Auth->user('id');
        $offset = isset($this->request->query['offset']) ? (int)$this->request->query['offset'] : 0;
        $last_id = isset($this->request->query['last_id']) ? (int)$this->request->query['last_id'] : 0;
        
        $limit = 10;
    
        $conditions = array(
            'OR' => array(
                'Message.sender_id' => $currentUser['id'],
                'Message.receiver_id' => $currentUser['id']
            )
        );
    
       
        if ($last_id > 0) {
            $conditions['Message.id <'] = $last_id;
        }
    
        
    
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
    
            // Fetch messages based on conditions, offset, and limit
            $messages = $this->Message->find('all', array(
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => 'Message.date_created DESC',
                'contain' => array(
                    'Sender' => array('fields' => array('name'))
                )
            ));
    
            // Prepare the response array
            $response = array(
                'success' => true,
                'messages' => $messages
            );
    
            // Set response type and content
            $this->response->body(json_encode($response));
            $this->response->type('json');
    
            // Return the JSON response
            return $this->response;
        } else {
            $this->paginate = array(
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => 'Message.date_created DESC',
                'contain' => array(
                    'Sender' => array('fields' => array('name'))
                )
            );
    
            $messages = $this->paginate('Message');
    
            $this->set(compact('messages', 'sender_id', 'myid', 'offset')); // Pass variables to view
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    

	public function compose() {
        if ($this->request->is('post')) {
          
            $this->loadModel('Message');
            
          
            $senderId = $this->Auth->user('id');
            
            
            $messageData = array(
                'Message' => array(
                    'sender_id' => $senderId,
                    'receiver_id' => $this->request->data['Message']['receiver_id'],
                    'messages' => $this->request->data['Message']['messages'],
                    'date_created' => date('Y-m-d H:i:s')
                )
            );

           
            if ($this->Message->save($messageData)) {
                
                $this->Session->setFlash('Message sent successfully.', 'flash_success');
                $this->redirect(array('action' => 'inbox'));
            } else {
              
                $this->Session->setFlash('Failed to send message. Please try again.', 'flash_error');
            }
        }
    }

    
    public function replyMessage() {
        $this->autoRender = false; 
    
        if ($this->request->is('ajax')) {
            $replyMessage = $this->request->data['message']; 
            $receiverId = $this->request->data['receiver_id']; 
            $senderId = $this->Auth->user('id'); 
    
           
            $this->Message->create();
            $saved = $this->Message->save(array(
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'messages' => $replyMessage,
             
            ));
    
            if ($saved) {
                $messageId = $this->Message->id;
                $message = $this->Message->findById($messageId); 
    
                $this->set('message', $message); 
                echo json_encode(array('success' => true, 'message' => $message));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to save message.'));
            }
        }
    }
    
    public function deleteMessage() {
        $this->autoRender = false; 
    
        if ($this->request->is('ajax')) {
            $messageId = $this->request->data('message_id');
    
         
            $message = $this->Message->findById($messageId);
    
            if (!$message) {
               
                $this->response->statusCode(404);
                echo json_encode(array('success' => false, 'message' => 'Message not found'));
                return;
            }
    
         
            if ($this->Message->delete($messageId, true)) {
             
                echo json_encode(array('success' => true));
            } else {
              
                $this->response->statusCode(500);
                echo json_encode(array('success' => false, 'message' => 'Failed to delete message'));
            }
        } else {
          
            $this->response->statusCode(400);
            echo json_encode(array('success' => false, 'message' => 'Bad request'));
        }
    }
    

    public function delete($senderId) {
        $receiverId = $this->Auth->user('id');
       
        if (!$senderId || !$receiverId) {
            throw new NotFoundException(__('Invalid sender or receiver ID'));
        }
        
       
        if ($this->Message->deleteAll(
            array(
                'OR' => array(
                    array('sender_id' => $senderId, 'receiver_id' => $receiverId),
                    array('sender_id' => $receiverId, 'receiver_id' => $senderId)
                )
            ),
            false 
        )) {
            $this->Session->setFlash(__('Invalid username or password, try again'));
        } else {
            $this->Flash->error(__('Failed to delete conversation.'));
        }
        
       
        return $this->redirect(array('controller' => 'messages', 'action' => 'inbox'));
    }


}