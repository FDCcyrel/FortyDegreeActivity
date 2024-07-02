<!-- File: app/View/Users/change_email.ctp -->

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Change Email</h2>
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
            <?php
            echo $this->Form->create('User', array(
                'url' => array('controller' => 'users', 'action' => 'change_email'),
                'class' => 'form-horizontal'
            ));
            ?>
            <div class="form-group">
               
                <div class="col-sm-9">
                    <?php
                    echo $this->Form->input('email', array(
                        'value' => '', 
                        'class' => 'form-control',
                        'placeholder' => '',
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                    <?php echo $this->Form->button('Update Email', array('class' => 'btn btn-primary')); ?>
                    <?php echo $this->Html->link('Back', ['controller' => 'users', 'action' => 'first'], ['class' => 'btn btn-default']); ?>
                </div>
            

               
                
            </div>
            <?php
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
