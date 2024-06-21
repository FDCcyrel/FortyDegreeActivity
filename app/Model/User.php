<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
public $useTable = 'users';
	public $validate = array(
		'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Name cannot be blank',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'length' => array(
                'rule' => array('lengthBetween', 5, 20),
                'message' => 'Name must be between 5 to 20 characters long'
            )
        ),
		'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address',
                'allowEmpty' => false,
                'required' => true,
            ),
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Email cannot be blank',
                'required' => true,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This email address has already been taken',
            ),
        ),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Password cannot be blank',
				'required' => true, 
				//'on' => 'create', 
				),
			 ),
		'confirm_password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Confirm Password cannot be blank',
				'required' => true
			),
			'comparePasswords' => array(
				'rule' => array('comparePasswords', 'password'),
				'message' => 'Passwords do not match'
			)
		),


	);

	public function beforeSave($options = array()) {
		if (!empty($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password(
				$this->data[$this->alias]['password']
			);
		}
		
		if (isset($this->data[$this->alias]['confirm_password'])) {
			$this->data[$this->alias]['confirm_password'] = AuthComponent::password(
				$this->data[$this->alias]['confirm_password']
			);
		}
		
		// Set date_created and date_updated
		if (empty($this->data[$this->alias]['date_created'])) {
			$this->data[$this->alias]['date_created'] = date('Y-m-d H:i:s');
		}
		$this->data[$this->alias]['date_updated'] = date('Y-m-d H:i:s');
		
		return true;
	}
	
	
	

	public function comparePasswords($checkPassword, $passwordFieldName) {
		if (is_array($checkPassword)) {
			$confirmPassword = current($checkPassword); 
		} else {
			$confirmPassword = $checkPassword;
		}
		$enteredPassword = $this->data[$this->alias][$passwordFieldName];
		return $confirmPassword === $enteredPassword;
	}
	
	
	
	
}
