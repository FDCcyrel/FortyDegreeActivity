<!-- app/View/Users/change_password.ctp -->
<div class="container">

    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
    <?php 
        echo '<div id="validation-messages" class="alert alert-danger">';
        echo $this->Session->flash(); 
        echo '</div>';
        ?>
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
            <h2>Change Password</h2>
            
            <?php
            echo $this->Form->create('User', array(
                'url' => array('controller' => 'users', 'action' => 'change_password'),
                'class' => 'form-horizontal'
            ));
            echo $this->Form->input('current_password', array(
                'type' => 'password',
                'label' => 'Current Password',
                'class' => 'form-control',
                'div' => 'form-group',
            ));
            echo $this->Form->input('new_password', array(
                'type' => 'password',
                'label' => 'New Password',
                'class' => 'form-control',
                'div' => 'form-group',
            ));
            echo $this->Form->input('confirm_passwords', array(
                'type' => 'password',
                'label' => 'Confirm New Password',
                'class' => 'form-control',
                'div' => 'form-group',
            ));
            ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php echo $this->Form->button('Change Password', array('class' => 'btn btn-primary')); ?>
                    <?php echo $this->Html->link('Back', ['controller' => 'users', 'action' => 'first'], ['class' => 'btn btn-default']); ?>
                </div>
               
                  
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
