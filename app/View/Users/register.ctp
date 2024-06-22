<div class="container mt-4">
    <h2 class="mb-4"><?php echo __('Register'); ?></h2>

    <?php
    if (!empty($errors)) {
        echo '<div id="validation-messages" class="alert alert-danger">';
        echo '<ul>';
        foreach ($errors as $field => $error) {
            foreach ($error as $errMsg) {
                echo '<li>' . $errMsg . '</li>';
            }
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>

    <?php echo $this->Form->create('User', array('id' => 'registerForm')); ?>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Name (5-20 characters)')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('email', array('type' => 'email', 'class' => 'form-control', 'label' => 'Email address')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Password')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Confirm Password')); ?>
            </div>

            <button type="submit" class="btn btn-primary"><?php echo __('Register'); ?></button>
            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>" class="btn btn-secondary"><?php echo __('Login'); ?></a>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>
