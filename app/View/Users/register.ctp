<div class="container mt-4">
    <h2 class="mb-4">Register</h2>
    



    <?php
        $flashMessages = $this->Flash->render();
        if (!empty($flashMessages)) {
            echo '<div id="flash-messages" class="alert alert-danger">' . $flashMessages . '</div>';
        }
        ?>

            <?php
            echo '<div id="validation-messages" class="alert alert-info">';
            echo '<ul>'; 

         
            if ($this->Form->isFieldError('User.name')) {
                echo '<li>' . $this->Form->error('User.name', array('wrap' => array('class' => 'error'))) . '</li>';
            }

           
            if ($this->Form->isFieldError('User.email')) {
                echo '<li>' . $this->Form->error('User.email', array('wrap' => array('class' => 'error'))) . '</li>';
            }

            
            if ($this->Form->isFieldError('User.password')) {
                echo '<li>' . $this->Form->error('User.password', array('wrap' => array('class' => 'error'))) . '</li>';
            }
            
            if ($this->Form->isFieldError('User.confirm_password')) {
                echo '<li>' . $this->Form->error('User.confirm_password', array('wrap' => array('class' => 'error'))) . '</li>';
            }

            echo '</ul>'; 
            echo '</div>';
            ?>


    <div class="row">
        <div class="col-md-6 offset-md-3">
            
        <form method="post" action="<?php echo $this->Html->url(array('controller'=>'users','action'=>'register')); ?>" onsubmit="return validateForm()" id="registerForm">

                <div class="form-group" id="usernameFormGroup">
                        <label for="username">Name (5-20 characters)</label>
                        <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="username" name="name" value="<?php echo isset($data['name']) ? h($data['username']) : ''; ?>">
                    </div>


                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo isset($data['email']) ? h($data['email']) : ''; ?>" >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => '/')); ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

<script>
     $(document).ready(function() {
        setTimeout(function() {
            $('#flash-messages').fadeOut('slow');
            $('#validation-messages').fadeOut('slow');
        }, 2000);
    });


</script>



