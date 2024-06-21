<?php
App::uses('UserDb', 'Model');

/**
 * UserDb Test Case
 */
class UserDbTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_db'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserDb = ClassRegistry::init('UserDb');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserDb);

		parent::tearDown();
	}

}
