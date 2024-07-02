<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *ßß
 */
class Message extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
public $useTable = 'messages';
public $belongsTo = array(
	'Sender' => array(
		'className' => 'User',
		'foreignKey' => 'sender_id'
	),
	'Receiver' => array(
		'className' => 'User',
		'foreignKey' => 'receiver_id'
	)
);
	public $validate = array(
		'messages' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public function beforeSave($options = array()) {

		// Set date_created and date_updated
		if (empty($this->data[$this->alias]['date_created'])) {
			$this->data[$this->alias]['date_created'] = date('Y-m-d H:i:s');
		}
		$this->data[$this->alias]['date_updated'] = date('Y-m-d H:i:s');
		
		return true;
	}

/**
 * belongsTo associations
 *
 * @var array
 */
}
