<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <?php
        // Check for authentication errors and display if any
        if ($this->Session->check('Message.auth')) :
            echo '<div class="alert alert-danger">' . $this->Session->flash('auth') . '</div>';
        endif;
        ?>

        <h1>Welcome to the Message Board</h1>
        <p class="lead">Please log in or register to continue.</p>
        <div>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'login')); ?>" class="btn btn-primary btn-lg btn-custom">Log In</a>
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'register')); ?>" class="btn btn-secondary btn-lg btn-custom">Register</a>
        </div>
      </div>
    </div>
  </div>