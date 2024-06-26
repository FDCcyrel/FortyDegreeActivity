<?php
App::uses('AppController', 'Controller');

class MessagesController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator');
    public $layout = 'messages'; 

    public function inbox() {
        $currentUser = $this->Auth->user();
        $myid = $currentUser['id'];
        
        
        $interactedPartners = $this->Message->find('all', array(
            'conditions' => array(
                'OR' => array(
                    array('Message.sender_id' => $myid),
                    array('Message.receiver_id' => $myid)
                )
            ),
            'fields' => array('DISTINCT Message.sender_id', 'Message.receiver_id'),
            'recursive' => -1
        ));
    
        $latestMessages = array();
        $processedPairs = array(); 
    
        foreach ($interactedPartners as $partner) {
            $senderId = $partner['Message']['sender_id'];
            $receiverId = $partner['Message']['receiver_id'];
            
         
            if ($senderId > $receiverId) {
                list($senderId, $receiverId) = array($receiverId, $senderId);
            }
            
            
            $pairKey = $senderId . '_' . $receiverId;
    
            
            if (in_array($pairKey, $processedPairs)) {
                continue; 
            }
    
            // Mark this pair as processed
            $processedPairs[] = $pairKey;
    
            // Define conditions to fetch the latest message between current user and the partner
            $conditions = array(
                'OR' => array(
                    array(
                        'Message.sender_id' => $senderId,
                        'Message.receiver_id' => $receiverId
                    ),
                    array(
                        'Message.sender_id' => $receiverId,
                        'Message.receiver_id' => $senderId
                    )
                )
            );
    
            // Fetch the latest message based on conditions
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
    
           
            if ($latestMessage) {
                $latestMessages[] = $latestMessage;
            }
        }
    
        // Set data to pass to the view
        $this->set(array(
            'latestMessages' => $latestMessages,
            'myid' => $myid
        ));
    }
    
    
    
    
    
    
    public function view($sender_id  = null, $receiver_id = null) {
       
        $currentUser = $this->Auth->user();
        $myid = $currentUser['id'];
        $offset = isset($this->request->query['offset']) ? (int)$this->request->query['offset'] : 0;
        $last_id = isset($this->request->query['last_id']) ? (int)$this->request->query['last_id'] : 0;
        
        $limit = 10;
    
        $conditions = array(
            'OR' => array(
                array(
                    'Message.sender_id' => $sender_id,
                    'Message.receiver_id' => $receiver_id
                ),
                array(
                    'Message.sender_id' => $receiver_id,
                    'Message.receiver_id' => $sender_id
                )
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
    
           
            $response = array(
                'success' => true,
                'messages' => $messages
            );
    
          
            $this->response->body(json_encode($response));
            $this->response->type('json');
    
            
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
    
            $this->set(compact('messages', 'myid','sender_id','receiver_id','offset')); 
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
            $senderId = $this->request->data['sender_id']; 
    
            if($this->Auth->user('id') == $senderId) {
                $this->Message->create();
                $saved = $this->Message->save(array(
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'messages' => $replyMessage,
             
            ));
            }
            else
            {
                $this->Message->create();
                $saved = $this->Message->save(array(
                'sender_id' => $receiverId,
                'receiver_id' => $senderId,
                'messages' => $replyMessage,
            ));
            }

    
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