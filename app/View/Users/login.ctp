<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Log In</h3>
                </div>
                <div class="panel-body">
                    <?php
                       echo '<div id="validation-messages" class="alert alert-danger">';
                       echo '<ul>'; 
                    echo $this->Session->flash('auth'); 
                    echo $this->Session->flash();
                    echo '</ul>';
                    echo '</div>';
                    ?>
                    <?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <?php echo $this->Form->input('email', array(
                                'class' => 'form-control',
                                'placeholder' => 'Email',
                                'label' => array('class' => 'control-label col-sm-3'),
                                'div' => 'col-sm-9'
                            )); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('password', array(
                                'class' => 'form-control',
                                'placeholder' => 'Password',
                                'label' => array('class' => 'control-label col-sm-3'),
                                'div' => 'col-sm-9'
                            )); ?>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register')); ?>" class="btn btn-secondary">Register</a>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
