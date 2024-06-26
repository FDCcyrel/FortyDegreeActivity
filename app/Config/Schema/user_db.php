<?php
class AppSchema extends CakeSchema {

    public $user_db = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
        'username' => array('type' => 'string', 'null' => false, 'default' => null),
        'password' => array('type' => 'string', 'null' => false, 'default' => null),
        'email' => array('type' => 'string', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array()
    );

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
    }
}
